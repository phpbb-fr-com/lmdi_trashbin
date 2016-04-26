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
	'TRASHBIN'			=> 'Corbeille du forum',

// ACP
	'ACP_TRASHBIN_TITLE'	=> 'Corbeille du forum',
	'ACP_TRASHBIN_SETTINGS'	=> 'Paramétrage de l\'extension',
	'ALLOW_FEATURE'		=> 'Sélection du forum de destination',
	'ALLOW_FEATURE_EXPLAIN'	=> 'Vous pouvez sélectionner ci-contre le forum qui sera la destination des sujets mis à la corbeille.',
// Duplicated strings
	'FORUM_PRUNE_SETTINGS'		=> 'Paramètres de délestage de la corbeille',
	'FORUM_AUTO_PRUNE'			=> 'Activer l’auto-délestage',
	'FORUM_AUTO_PRUNE_EXPLAIN'	=> 'Déleste le forum des sujets, réglez les paramètres de fréquence/ancienneté ci-dessous.',
	'AUTO_PRUNE_DAYS'			=> 'Ancienneté des messages délestés automatiquement',
	'AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Nombre de jours depuis le dernier message avant suppression du sujet.',
	'AUTO_PRUNE_FREQ'			=> 'Fréquence du délestage automatique',
	'AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Durée en jours entre les événements de délestage.',

));
