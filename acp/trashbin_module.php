<?php
/**
 * @package phpBB Extension - LMDI Trashbin
 * @copyright (c) 2019 Pierre Duhem - LMDI
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace lmdi\trashbin\acp;

class trashbin_module
{

	public $u_action;

	public function main($id, $mode)
	{
		global $db, $language, $template, $request, $config;

		$language->add_lang('trashbin', 'lmdi/trashbin');
		$language->add_lang('acp/forums');

		$this->tpl_name = 'acp_trashbin_body';
		$this->page_title = $language->lang('ACP_TRASHBIN_TITLE');

		$action = $request->variable('action', '');
		$action_config = $this->u_action . "&amp;action=config";

		if ($action == 'config')
		{
			if (!check_form_key('acp_trashbin_body'))
			{
				trigger_error('FORM_INVALID');
			}
			else
			{
				$otarget = (int) $config['lmdi_trashbin'];
				$target = $request->variable('forum', 0);
				if ($otarget != $target)
				{
					// Reset the pruning status of old target
					$sql = 'UPDATE ' . FORUMS_TABLE . '
						SET enable_prune = 0 
						WHERE forum_id = ' . (int) $otarget;
					$db->sql_query($sql);
				}
				$enable_prune = $request->variable('enable_prune', 0);
				$prune_freq = $request->variable('prune_freq', 0);
				$prune_days = $request->variable('prune_days', 0);
				$sql_ary = array(
					'enable_prune' => $enable_prune,
					'prune_days'   => $prune_days,
					'prune_freq'   => $prune_freq,
				);
				$sql = 'UPDATE ' . FORUMS_TABLE . '
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE forum_id = ' . (int) $target;
				$db->sql_query($sql);
				$config->set('lmdi_trashbin', $target);
				trigger_error($language->lang('CONFIG_UPDATED') . adm_back_link($this->u_action));
			}
		}

		$form_key = 'acp_trashbin_body';
		add_form_key($form_key);

		$target = $config['lmdi_trashbin'];
		$forum_list = make_forum_select(false, false, true, true, true, false, true);

		// Build forum options
		$s_forum_options = '';
		foreach ($forum_list as $f_id => $f_row)
		{
			$s_forum_options .= '<option value="' . $f_id . '"' . ($target == $f_row['forum_id'] ? ' selected' : '') . ($f_row['disabled'] ? ' disabled class="disabled-option"' : '') . '>' . $f_row['padding'] . $f_row['forum_name'] . '</option>';
		}

		$template->assign_vars(array(
			'S_FORUM_OPTIONS'    => $s_forum_options,
		));

		$sql = 'SELECT * FROM ' . FORUMS_TABLE . '
			WHERE forum_id = ' . (int) $target;
		$result = $db->sql_query($sql);
		$forum = $db->sql_fetchrow($result);
		$template->assign_vars(array(
			'C_ACTION'       => $action_config,
			'S_PRUNE_ENABLE' => $forum['enable_prune'],
			'PRUNE_DAYS'     => $forum['prune_days'],
			'PRUNE_FREQ'     => $forum['prune_freq'],
		));
		$db->sql_freeresult($result);
	}
}
