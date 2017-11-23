<?php
/**
* trashbin.php
* @package phpBB Extension - LMDI Trashbin
* @copyright (c) 2016 LMDI - Pierre Duhem
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge ($lang, array(
	'TRASHBIN'	=> 'Board Trashbin',
	'TRASHBIN_MOVE'	=> 'Topic moved to the trashbin',
	'TRASHBIN_TEXT'	=> 'Topic moved to the trashbin.',
	'TRASHBIN_SOURCE'	=> ' Source forum: %d (%s).',


// ACP
	'ACP_TRASHBIN_TITLE'	=> 'Board Trashbin',
	'ACP_TRASHBIN_SETTINGS'	=> 'Settings',
	'ACP_TRASHBIN_ALLOW_FEATURE'		=> 'Target forum selection',
	'ACP_TRASHBIN_ALLOW_FEATURE_EXPLAIN'	=> 'You may select the forum used as a target of the topic move.',

	'ACP_TRASHBIN_FORUM_PRUNE_SETTINGS'		=> 'Trashbin prune settings',
	'ACP_TRASHBIN_FORUM_AUTO_PRUNE'			=> 'Enable auto-pruning',
	'ACP_TRASHBIN_FORUM_AUTO_PRUNE_EXPLAIN'	=> 'Topics placed in  the trashbin are automatically pruned when the parameters (prune frequency and postage) below are satisfied.',
	'ACP_TRASHBIN_AUTO_PRUNE_DAYS'			=> 'Auto-prune post age',
	'ACP_TRASHBIN_AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Number of days since last post after which topic is removed.',
	'ACP_TRASHBIN_AUTO_PRUNE_FREQ'			=> 'Auto-prune frequency',
	'ACP_TRASHBIN_AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Time in days between pruning events.',

));
