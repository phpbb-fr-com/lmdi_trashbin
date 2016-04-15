<?php
/**
* gloss.php
* @package phpBB Extension - LMDI Trashbin
* @copyright (c) 2015-2016 LMDI - Pierre Duhem
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* Deutsche übersetzung: Frank Ingermann
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
	'TRASHBIN'			=> 'Forum-Papierkorb',

// ACP
	'ACP_TRASHBIN_TITLE'	=> 'Forum-Papierkorb',
	'ACP_TRASHBIN_SETTINGS'	=> 'Einstellungen',
	'ALLOW_FEATURE'		=> 'Zielforum auswählen',
	'ALLOW_FEATURE_EXPLAIN'	=> 'Du kannst hier das Forum auswählen, das Ziel der Themen-Verlagerung sein wird.',

));
