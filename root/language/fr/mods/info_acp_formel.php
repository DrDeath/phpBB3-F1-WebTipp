<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/fr/mods/info_acp_formel.php
* French translation: Fafa ( fafa@ufolep62tt.net )
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB')) 
{ 
	exit; 
} 

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE 
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

// BBCodes 
// Note to translators: you can translate everything but what's between { and }

// Formel 1 Modul
$lang = array_merge($lang, array(
	'ACP_FORMEL_MANAGEMENT'			=> 'Formel 1 WebTip',
	'ACP_FORMEL_SETTINGS'			=> 'Formel 1 Configurations',
	'ACP_FORMEL_DRIVERS'			=> 'Formel 1 Pilotes',	
	'ACP_FORMEL_TEAMS'				=> 'Formel 1 Ecuries',
	'ACP_FORMEL_RACES'				=> 'Formel 1 Courses',
	'LOG_FORMEL_TIP_GIVEN'			=> 'Les pronos de la course %s ajoutés.',
	'LOG_FORMEL_TIP_EDITED'			=> 'Les pronos de la course %s édités.',
	'LOG_FORMEL_TIP_NOT_VALID'		=> 'Les pronos de la course %s non valides. Pronos rejetés.',
	'LOG_FORMEL_TIP_DELETED'		=> 'Les pronos de la course %s effacés.',
	'LOG_FORMEL_QUALI_DELETED'		=> 'ID des qualifications de la course %s effacé.',
	'LOG_FORMEL_QUALI_ADDED'		=> 'ID des qualifications de la course %s ajouté.',
	'LOG_FORMEL_QUALI_NOT_VALID'	=> 'ID des qualifications de la course %s n\'est pas valide. Entrée rejetée.',
	'LOG_FORMEL_RESULT_DELETED'		=> 'ID des résultats de la course %s effacé.',
	'LOG_FORMEL_RESULT_ADDED'		=> 'ID des résultats de la course %s ajouté.',
	'LOG_FORMEL_RESULT_NOT_VALID'	=> 'ID des résultats de la course %s n\'est pas valide. Entrée rejetée.',
	'LOG_FORMEL_SAISON_RESET'		=> 'F1 WebTipp saison réduit',
	'LOG_FORMEL_SETTINGS'			=> 'Configuration mis à jour.',
	'LOG_FORMEL_RACE_ADDED'			=> 'Course ajouté.',
	'LOG_FORMEL_RACE_EDITED'		=> 'ID de course %s édité.',
	'LOG_FORMEL_RACE_DELETED'		=> 'ID de course %s effacé',
	'LOG_FORMEL_TEAM_ADDED'			=> 'Ecurie ajouté.',
	'LOG_FORMEL_TEAM_EDITED'		=> 'ID de l\'écurie %s édité.',
	'LOG_FORMEL_TEAM_DELETED'		=> 'ID de l\'écurie %s effacé.',
	'LOG_FORMEL_DRIVER_ADDED'		=> 'Pilote ajouté.',
	'LOG_FORMEL_DRIVER_EDITED'		=> 'ID du pilote %s édité.',
	'LOG_FORMEL_DRIVER_DELETED'		=> 'ID du pilote %s effacé.',
));

?>