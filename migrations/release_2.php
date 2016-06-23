<?php
/**
*
* @package phpBB Extension - LMDI Trashbin extension
* @copyright (c) 2016 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\trashbin\migrations;

class release_2 extends \phpbb\db\migration\migration
{
	protected $trashbin;

	public function effectively_installed()
	{
		return isset($this->config['lmdi_trashbin']);
	}

	static public function depends_on()
	{
		return array('\lmdi\trashbin\migrations\release_1');
	}


	public function revert_data()
	{
		return array(
			array('custom', array(array(&$this, 'reset_pruning_state'))),
		);
	}


	public function reset_pruning_state()
	{
		global $config;
		$trashbin = (int) $config['lmdi_trashbin'];
		$sql = 'UPDATE '. FORUMS_TABLE . '
			SET enable_prune=0 
			WHERE forum_id='.$trashbin;
		$this->db->sql_query($sql);
	}


}
