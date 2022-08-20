<?php
/**
 * trashbin.php
 *
 * @package phpBB Extension - LMDI Trashbin
 * @copyright (c) 2015-2019 LMDI - Pierre Duhem
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
	$lang = [];
}

$lang = array_merge($lang, [
	'TRASHBIN_LINK'                      => 'In den Papierkorb werfen',
	'TRASHBIN_TEXT'                      => 'Das Thema wurde vom %s ins Papierkorb geworfen (Quelle: %s).',

	// ACP
	'ACP_TRASHBIN_TITLE'                 => 'Forum-Papierkorb',
	'ACP_TRASHBIN_SETTINGS'              => 'Einstellungen',
	'ACP_TRASHBIN_ALLOW_FEATURE'         => 'Zielforum auswählen',
	'ACP_TRASHBIN_ALLOW_FEATURE_EXPLAIN' => 'Du kannst hier das Forum auswählen, das Ziel der Themen-Verlagerung sein wird.',
	'ACP_TRASHBIN_FORUM_PRUNE_SETTINGS'  => 'Einstellungen zum Löschen des Papierkorbs',
	'ACP_TRASHBIN_OPTIONS_NONE'          => 'Wählen Sie einen Papierkorb',
]);
