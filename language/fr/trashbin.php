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
	'ACP_TRASHBIN_ALLOW_FEATURE'		=> 'Sélection du forum de destination',
	'ACP_TRASHBIN_ALLOW_FEATURE_EXPLAIN'	=> 'Vous pouvez sélectionner ci-contre le forum qui sera la destination des sujets mis à la corbeille.',
	'ACP_TRASHBIN_FORUM_PRUNE_SETTINGS'		=> 'Paramètres de délestage de la corbeille',
	'ACP_TRASHBIN_FORUM_AUTO_PRUNE'			=> 'Activer l’auto-délestage',
	'ACP_TRASHBIN_FORUM_AUTO_PRUNE_EXPLAIN'	=> 'Déleste le forum des sujets, réglez les paramètres de fréquence/ancienneté ci-dessous.',
	'ACP_TRASHBIN_AUTO_PRUNE_DAYS'			=> 'Ancienneté des messages délestés automatiquement',
	'ACP_TRASHBIN_AUTO_PRUNE_DAYS_EXPLAIN'	=> 'Nombre de jours depuis le dernier message avant suppression du sujet.',
	'ACP_TRASHBIN_AUTO_PRUNE_FREQ'			=> 'Fréquence du délestage automatique',
	'ACP_TRASHBIN_AUTO_PRUNE_FREQ_EXPLAIN'	=> 'Durée en jours entre les événements de délestage.',

));
