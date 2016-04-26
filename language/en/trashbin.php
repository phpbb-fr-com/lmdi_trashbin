<?php
/**
* gloss.php
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


// ACP
	'ACP_TRASHBIN_TITLE'	=> 'Board Trashbin',
	'ACP_TRASHBIN_SETTINGS'	=> 'Settings',
	'ALLOW_FEATURE'		=> 'Target forum selection',
	'ALLOW_FEATURE_EXPLAIN'	=> 'You may select the forum used as a target of the topic move.',

	'FORUM_PRUNE_SETTINGS'		=> 'Trashbin prune settings',
	'FORUM_AUTO_PRUNE'			=> 'Enable auto-pruning',
	'FORUM_AUTO_PRUNE_EXPLAIN'	=> 'Prunes the trashbin of topics, set the frequency/age parameters below.',
	'AUTO_PRUNE_DAYS'			=> 'Auto-prune post age',
	'AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Number of days since last post after which topic is removed.',
	'AUTO_PRUNE_FREQ'			=> 'Auto-prune frequency',
	'AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Time in days between pruning events.',

));
