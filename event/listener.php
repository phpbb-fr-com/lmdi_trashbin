<?php
/**
*
* @package phpBB Extension - LMDI Trashbin
* @copyright (c) 2016-2019 LMDI - Pierre Duhem
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\trashbin\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $user;
	protected $language;
	protected $db;
	protected $template;
	protected $config;
	protected $root_path;
	protected $phpEx;
	protected $request;
	protected $auth;
	protected $phpbb_log;
	protected $fid;	// Class global because of function build_url
	protected $tid;

	public function __construct(
		\phpbb\db\driver\driver_interface $db,
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\user $user,
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\auth\auth $auth,
		\phpbb\log\log $log,
		$root_path,
		$phpEx
		)
	{
		$this->db = $db;
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->language = $language;
		$this->request = $request;
		$this->auth = $auth;
		$this->root_path = $root_path;
		$this->phpEx = $phpEx;
		$this->phpbb_log = $log;
	}


	static public function getSubscribedEvents ()
	{
	return array(
		'core.user_setup'				=> 'load_language_on_setup',
		'core.page_header'				=> 'build_url',
		'core.viewtopic_get_post_data'	=> 'move_topic',
		);
	}


	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'lmdi/trashbin',
			'lang_set' => 'trashbin',
			);
		$event['lang_set_ext'] = $lang_set_ext;
	}


	public function build_url($event)
	{
		$target = $this->config['lmdi_trashbin'];
		// Moderator with right to move or delete, trashbin configured and we aren't in the trashbin
		if (($this->auth->acl_get('m_delete', $this->fid) || $this->auth->acl_get('m_move', $this->fid)) && $target && ($target != $this->fid))
		{
			$params = "f=$this->fid&amp;t=$this->tid&amp;trash=1";
			$url = append_sid($this->root_path . 'viewtopic.' . $this->phpEx, $params);
			$this->template->assign_vars(array(
				'U_TRASHBIN'	=> $url,
				'L_TRASHBIN'	=> $this->language->lang('TRASHBIN'),
				'S_TRASHBIN'	=> true,
				));
		}
		else
		{
		$this->template->assign_vars(array(
			'S_TRASHBIN'	=> false,
			));
		}
	}


	public function move_topic($event)
	{
		$this->fid = $event['forum_id'];
		$this->tid = $event['topic_id'];
		$trash = $this->request->variable('trash', 0);
		if ($trash)
		{
			$user_id = $this->user->data['user_id'];
			$target = $this->config['lmdi_trashbin'];
			// Trashbin already configured and we aren't within this forum
			if ($target != 0 && $this->fid != $target)
			{
				// Various permissions
				if (($this->auth->acl_get('m_delete', $this->fid) || $this->auth->acl_get('m_move', $this->fid)) && ($this->auth->acl_get('f_noapprove', $target) && $this->auth->acl_get('f_list', $target)))
				{
					if (!function_exists('move_topics'))
					{
						include($this->root_path . 'includes/functions_admin.' . $this->phpEx);
					}
					if (!function_exists('submit_post'))
					{
						include($this->root_path . 'includes/functions_posting.' . $this->phpEx);
					}

					// Deletion of the subscriptions to the topic moved to trashbin
					$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
						WHERE topic_id=' . (int) $this->tid;
					$this->db->sql_query($sql);

					// Creation of a post with same subject line, date = today to keep the topic alive
					$uid = $bitfield = $options = '';
					$topic_data = $event['topic_data'];
					$forum_name = $topic_data['forum_name'];
					$subject = $topic_data['topic_title'];
					generate_text_for_storage($subject, $uid, $bitfield, $options, false, false, false);
					$subject = str_replace ('<t>', '', $subject);
					$subject = str_replace ('</t>', '', $subject);
					$post_text = $this->language->lang('TRASHBIN_TEXT', $forum_name);
					generate_text_for_storage($post_text, $uid, $bitfield, $options, true, true, true);
					$data = array(
						'forum_id'		=> $this->fid,
						'topic_id'		=> $this->tid,
						'icon_id'			=> false,
						'enable_bbcode'	=> true,
						'enable_smilies'	=> true,
						'enable_urls'		=> true,
						'enable_sig'		=> true,
						'message'			=> $post_text,
						'message_md5'		=> md5($post_text),
						'bbcode_bitfield'	=> $bitfield,
						'bbcode_uid'		=> $uid,
						'post_edit_locked'	=> 0,
						'topic_title'		=> $subject,
						'notify_set'		=> false,
						'notify'			=> false,
						'post_time'		=> 0,
						'forum_name'		=> '',
						'enable_indexing'	=> true,
						);
					$poll = array();
					submit_post('reply', $subject, '', POST_NORMAL, $poll, $data);

					// Moving and resetting the topic_type to normal
					move_topics(array($this->tid), $target);
					$sql = 'UPDATE ' . TOPICS_TABLE . ' SET topic_type = 0, topic_status = 0
						WHERE topic_id = ' . (int) $this->tid;
					$this->db->sql_query($sql);

					// Logging
					$trashbin = $this->language->lang('TRASHBIN');
					// See line 578, mcp_main.php
					$this->phpbb_log->add('mod', $user_id, $this->user->ip, 'LOG_MOVE', false,
						array(
						'forum_id' => $target,
						'topic_id' => $this->tid,
						$forum_name,
						$trashbin,
						$this->fid,
						$target,
						));

					// Redirection of browser to the trashbin
					$params = "f=$target&amp;t=$this->tid";
					$url = append_sid("{$this->root_path}viewtopic.$this->phpEx", $params);
					redirect($url);
				}
			}
		}
	}

}
