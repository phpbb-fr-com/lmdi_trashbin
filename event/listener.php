<?php
/**
*
* @package phpBB Extension - LMDI Trashbin extension
* @copyright (c) 2016 LMDI - Pierre Duhem
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
	protected $cache;
	protected $user;
	protected $db;
	protected $template;
	protected $config;
	protected $root_path;
	protected $phpEx;
	protected $request;
	protected $auth;
	protected $fid;
	protected $tid;



	public function __construct(
		\phpbb\db\driver\driver_interface $db,
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\cache\service $cache,
		\phpbb\user $user,
		\phpbb\request\request $request,
		\phpbb\auth\auth $auth,
		$root_path, 
		$phpEx
		)
	{
		$this->db = $db;
		$this->config = $config;
		$this->template = $template;
		$this->cache = $cache;
		$this->user = $user;
		$this->request = $request;
		$this->auth = $auth;
		$this->root_path = $root_path;
		$this->phpEx = $phpEx;
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
		if ($target != $this->fid)
		{
			$params = "f=$this->fid&amp;t=$this->tid&amp;trash=1";
			$url = append_sid($this->root_path . 'viewtopic.' . $this->phpEx, $params);
			$this->template->assign_vars(array(
				'U_TRASHBIN'	=> $url,
				'L_TRASHBIN'	=> $this->user->lang['TRASHBIN'],
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
		global $phpbb_log;
		$trash = $this->request->variable('trash', 0);
		$this->fid = (int) $this->request->variable('f', 0);
		$this->tid = (int) $this->request->variable('t', 0);
		if ($trash)
		{
			$user_id = $this->user->data['user_id'];
			$target = $this->config['lmdi_trashbin'];
			if ($target != 0 && $this->fid != $target)
			{
				if($this->auth->acl_get('m_delete', $this->fid) or $this->auth->acl_get('m_move', $this->fid))
				{
					include($this->root_path . 'includes/functions_admin.' . $this->phpEx);
					move_topics(array($this->tid), $target);
					$sql = 'SELECT forum_name FROM '. FORUMS_TABLE .' WHERE forum_id='. $this->fid;
					$result = $this->db->sql_query($sql);
					$forum = $this->db->sql_fetchrow($result);
					$this->db->sql_freeresult($result);
					$trashbin = $this->user->lang['TRASHBIN'];
					// See line 578, mcp_main.php
					$phpbb_log->add('mod', $user_id, $this->user->ip, 'LOG_MOVE', false, 
						array(
						'forum_id' => $target,
						'topic_id' => $this->tid,
						$forum['forum_name'],
						$trashbin,
						$this->fid,
						$target,
						));
					$params = "f=$target&amp;t=$this->tid";
					$url = append_sid("{$this->root_path}viewtopic.$this->phpEx", $params);
					redirect($url);
				}
			}
		}
	}

}
