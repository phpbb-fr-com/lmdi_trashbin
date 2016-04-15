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
));
