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

));
