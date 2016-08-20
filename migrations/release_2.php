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
	static private $lmdi_trashbin = 0;

	public function effectively_installed()
	{
		return isset($this->config['lmdi_trashbin2']);
	}


	static public function depends_on()
	{
		return array('\lmdi\trashbin\migrations\release_1');
	}


	public function update_data()
	{
		self::$lmdi_trashbin = $this->config['lmdi_trashbin'];
		return array(
			array('config.add', array('lmdi_trashbin2', 0)),
		);
	}


	public function revert_data()
	{
		return array(
			array('custom', array(array(&$this, 'reset_pruning_state'))),
			array('config.remove', array('lmdi_trashbin2')),
		);
	}


	public function reset_pruning_state()
	{
		$sql = 'UPDATE '. FORUMS_TABLE . '
			SET enable_prune=DEFAULT  
			WHERE forum_id='. (int) self::$lmdi_trashbin;
		$this->db->sql_query($sql);
	}

}
