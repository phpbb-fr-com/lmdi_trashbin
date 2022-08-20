<?php
/**
 * trashbin.php
 *
 * @package phpBB Extension - LMDI Trashbin
 * @copyright (c) 2016-2019 LMDI - Pierre Duhem
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'TRASHBIN_LINK'                         => 'Mettre à la corbeille',
	'TRASHBIN_TEXT'                         => 'Sujet mis à la corbeille par %s (forum d’origine : %s).',

	// ACP
	'ACP_TRASHBIN_TITLE'                    => 'Corbeille du forum',
	'ACP_TRASHBIN_SETTINGS'                 => 'Paramètres généraux',
	'ACP_TRASHBIN_ALLOW_FEATURE'            => 'Sélectionner le forum cible',
	'ACP_TRASHBIN_ALLOW_FEATURE_EXPLAIN'    => 'Sélectionnez le forum qui fera office de corbeille.',
	'ACP_TRASHBIN_FORUM_PRUNE_SETTINGS'     => 'Paramètres de délestage de la corbeille',
]);
