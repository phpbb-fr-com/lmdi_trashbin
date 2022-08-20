<?php
/**
 *
 * @package phpBB Extension - LMDI Trashbin extension
 * @copyright (c) 2016-2019 Pierre Duhem - LMDI
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace lmdi\trashbin\migrations;

class release_2 extends \phpbb\db\migration\migration
{
	private $lmdi_trashbin = 0;

	public function effectively_installed()
	{
		return isset($this->config['lmdi_trashbin2']);
	}


	public static function depends_on()
	{
		return array('\lmdi\trashbin\migrations\release_1');
	}


	public function update_data()
	{
		$this->lmdi_trashbin = (int) $this->config['lmdi_trashbin'];
	}


	public function revert_data()
	{
		return array(
			array('custom', array(array(&$this, 'reset_pruning_state'))),
		);
	}


	public function reset_pruning_state()
	{
		$sql = 'UPDATE ' . FORUMS_TABLE . '
			SET enable_prune=DEFAULT, prune_days=DEFAULT, prune_freq=DEFAULT
			WHERE forum_id=' . $this->lmdi_trashbin;
		$this->db->sql_query($sql);
	}
}
