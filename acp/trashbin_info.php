<?php
/**
*
* @package phpBB Extension - LMDI Trashbin
* @copyright (c) 2015-2019 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\trashbin\acp;

class trashbin_info
{
	function module()
	{
		return array(
			'filename'	=> '\lmdi\trashbin\acp\trashbin_module',
			'title'		=> 'ACP_TRASHBIN_TITLE',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings' => array('title' => 'ACP_TRASHBIN_SETTINGS',
									'auth'  => 'ext_lmdi/trashbin',
									'cat'   => array('ACP_TRASHBIN_TITLE')),
			),
		);
	}
}
