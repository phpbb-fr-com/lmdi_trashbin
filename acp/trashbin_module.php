<?php
/**
* @package phpBB Extension - LMDI Trashbin
* @copyright (c) 2016 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\trashbin\acp;

class trashbin_module {

	protected $gloss_helper;
	var $u_action;
	var $action;

	public function main ($id, $mode)
	{
		global $db, $user, $template, $request, $config;
		
		$user->add_lang_ext ('lmdi/trashbin', 'trashbin');

		$this->tpl_name = 'acp_trashbin_body';
		$this->page_title = $user->lang('ACP_TRASHBIN_TITLE');

		$action = $request->variable ('action', '');
		$action_config = $this->u_action . "&action=config";

		if ($action == 'config')
		{
			if (!check_form_key('acp_trashbin_body'))
			{
				trigger_error('FORM_INVALID');
			}
			else
			{
				$otarget = (int) $config['lmdi_trashbin'];
				$target = (int) $request->variable ('forum', 0);
				if ($otarget != $target)
				{
					// Reset the pruning status of old target
					$sql = "UPDATE ". FORUMS_TABLE . "
						SET enable_prune = 0 
						WHERE forum_id = $otarget";
					$db->sql_query($sql);
				}
				$enable_prune = (int) $request->variable ('enable_prune', 0);
				$prune_freq = (int) $request->variable ('prune_freq', 0);
				$prune_days = (int) $request->variable ('prune_days', 0);
				$sql = "UPDATE ". FORUMS_TABLE . "
					SET enable_prune = $enable_prune, prune_days = $prune_days, prune_freq = $prune_freq
					WHERE forum_id = $target";
				$db->sql_query($sql);
				$config->set ('lmdi_trashbin', $target);
				$message = $user->lang['CONFIG_UPDATED'];
				trigger_error($message . adm_back_link ($this->u_action));
			}
		}

		$form_key = 'acp_trashbin_body';
		add_form_key ($form_key);

		$target = $config['lmdi_trashbin'];
		$forum_list = make_forum_select(false, false, true, true, true, false, true);
		foreach ($forum_list as $row)
		{
			$template->assign_block_vars('forums', array(
				'FORUM_NAME'			=> $row['forum_name'],
				'FORUM_ID'			=> $row['forum_id'],
				'SELECTED'			=> (($target == $row['forum_id']) ? "selected" : "")
			));
		}

		$sql = "SELECT * from " . FORUMS_TABLE . " WHERE forum_id = '$target'";
		$result = $db->sql_query($sql);
		$forum = $db->sql_fetchrow ($result);

		$template->assign_vars (array(
			'C_ACTION'		=> $action_config,
			'S_PRUNE_ENABLE'	=> $forum['enable_prune'],
			'PRUNE_DAYS'		=> $forum['prune_days'],
			'PRUNE_FREQ'		=> $forum['prune_freq'],
			));
		$db->sql_freeresult($result);
	}

}
