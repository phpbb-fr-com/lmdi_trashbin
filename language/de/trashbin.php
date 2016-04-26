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

	'FORUM_PRUNE_SETTINGS'		=> 'Einstellungen zum Löschen des Papierkorbs',
	'FORUM_AUTO_PRUNE'			=> 'Automatisches Löschen aktivieren',
	'FORUM_AUTO_PRUNE_EXPLAIN'	=> 'Löscht Themen des Papierkorbs automatisch, wenn sie den folgenden Kriterien entsprechen.',
	'AUTO_PRUNE_DAYS'			=> 'Seit dem letzten Beitrag vergangene Tage',
	'AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Die Anzahl der Tage seit dem letzten Beitrag, nach denen das Thema gelöscht wird.',
	'AUTO_PRUNE_FREQ'			=> 'Prüfungsintervall für automatisches Löschen',
	'AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Das Intervall, in dem nach automatisch zu löschenden Themen gesucht wird.',

));
