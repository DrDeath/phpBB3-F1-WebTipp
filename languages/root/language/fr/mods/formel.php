<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* French translation: Fafa ( fafa@ufolep62tt.net )
* language/fr/mods/formel.php - [Language - french]
*
*/

/**
* DO NOT CHANGE
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

$lang = array_merge($lang, array(
	'FORMEL_TITLE'                           => 'Formula 1 WebTip',
	'FORMEL_CURRENT_RACE'                    => 'Le Grand Prix',
	'FORMEL_CURRENT_QUALI'                   => 'Qualifications',
	'FORMEL_CURRENT_RESULT'                  => 'Résultats',
	'FORMEL_NO_QUALI'                        => 'Pas de qualification trouvé',
	'FORMEL_NO_RESULTS'                       => 'Pas de résultat trouvé',
	'FORMEL_RACENAME'                        => 'Lieu',
	'FORMEL_RACELENGTH'                      => 'Longueur d\'un tour',
	'FORMEL_RACEDISTANCE'                    => 'Longueur de course',
	'FORMEL_RACELAPS'                        => 'Tours',
	'FORMEL_RACEDEBUT'                       => 'Premier Grand Prix',
	'FORMEL_RACETIME'                        => 'Début du Grand Prix',
	'FORMEL_RACEDEAD'                        => 'Date limite pour les pronos',
	'FORMEL_NEXT_RACE'                       => 'GP suivant',
	'FORMEL_PREV_RACE'                       => 'GP précédent',
	'FORMEL_PLACE'                           => 'Place',
	'FORMEL_EDIT'                            => 'Editer',
	'FORMEL_RULES'                           => 'Règles',
	'FORMEL_FORUM'                           => 'Forum du Formule 1',
	'FORMEL_STATISTICS'                      => 'Statistiques',
	'FORMEL_CALL_MOD'                        => 'Alerter un modérateur',
	'FORMEL_POLE'                            => 'Poleposition',
	'FORMEL_RACE_WINNER'                     => 'Vainqueur',
	'FORMEL_DELETE'                          => 'Effacer',
	'FORMEL_PACE'                            => 'Tour le plus rapide',
	'FORMEL_TIRED'                           => 'Nombre d\'abandons',
	'FORMEL_NO_TIPP'                         => 'Pas de prono trouvé',
	'FORMEL_YOUR_TIPP'                       => 'Vos pronos',
	'formel_your_points'                     => 'Vos points',
	'formel_game_over'                       => 'Temps écoulé. Vous ne pouvez plus rien changer.',
	'formel_add_tipp'                        => 'Envoyer vos pronos',
	'formel_del_tipp'                        => 'Effacer vos pronos',
	'formel_edit_tipp'                       => 'Editer vos pronos',
	'formel_tipp_deleted'                    => 'Les pronos ont été supprimés<br /><br />Cliquer %sici%s pour revenir sur la page des pronos<br /><br />Cliquer %sici%s pour aller sur le forum',
	'formel_doublicate_values'               => 'Erreur lors de l\'envoi de vos pronos: Vous avez placé un pilote deux fois<br /><br />Cliquer %sici%s pour revenir sur la page des pronos<br /><br />Cliquer %sici%s pour aller sur le forum',
	'formel_accepted_tipp'                   => 'Vos pronos ont été acceptés<br /><br />Cliquer %sici%s pour d\'autres pronos<br /><br />Cliquer %sici%s pour aller sur le forum',
	'formel_results_title'                   => 'WebTipp modération',
	'formel_results_title_exp'               => 'Ici vous pouvez ajouter ou éditer des résultats',
	'formel_results_reset'                   => 'Effacer qualifications/résultats',
	'formel_mod_button_text'                 => 'Modération',
	'formel_results_deleted'                 => 'Résultats effacés<br /><br />Cliquer %sici%s pour revenir sur WebTipp modération<br /><br />Cliquer %sici%s pour revenir sur le forum',
	'formel_results_error'                   => 'Erreur lors de l\'enregistrement. Veuillez réessayer<br /><br />Cliquer %sici%s pour revenir sur WebTipp moderation<br /><br />Cliquer %sici%s pour revenir sur le forum',
	'formel_results_double'                  => 'Vous avez placé un pilote deux fois. Veuillez réessayer<br /><br />Cliquer %sicie%s pour retourner sur WebTipp modération<br /><br />Cliquer %sici%s pour revenir sur le forum',
	'formel_results_accepted'                => 'Résultats enregistrés<br /><br />Cliquer %sici%s pour retourner sur WebTipp modération<br /><br />Cliquer %sici%s pour revenir sur le forum',
	'formel_results_add'                     => 'Ajouter',
	'formel_results_reset'                   => 'Reset',
	'formel_results_qualititle'              => 'Ajouter les qualifications',
	'formel_results_resulttitle'             => 'Editer les résultats du Grand Prix',
	'formel_top_points'                      => 'Points',
	'formel_top_name'                        => 'Top joueurs',
	'formel_top_driver'                      => 'Top pilotes',
	'formel_top_teams'                       => 'Top écuries',
	'formel_no_players'                      => 'Pas encore de prono',
	'formel_tipps_made'                      => 'Les pronos enregistrés: ',
	'formel_back_to_tipp'                    => 'Retour aux pronos',
	'formel_user_stats'                      => 'Utilisateurs',
	'formel_driver_stats'                    => 'Pilotes',
	'formel_team_stats'                      => 'Ecuries',
	'formel_top_more'                        => 'Tout montrer',
	'formel_stats_title'                     => 'Formule 1 statistiques',
	'formel_points_won'                      => 'Points',
	'formel_all_points'                      => 'Total points',
	'formel_watching_tipp'                   => 'Pronostiqueurs',
	'formel_rules_title'                     => "Règles",
	'formel_rules_general'                   => "Général",
	'formel_profile_title'                   => 'Formule 1 points',
	'formel_profile_rank'                    => '%s. Place',
	'formel_profile_norank'                  => 'Pas de place',
	'formel_profile_tipps'                   => '%s de %s grands prix',
	'formel_rules_gen_exp'                   => "Vous pouvez réaliser des pronos pour chaques grands prix et ainsi obtenir un maximum de points. Si vous êtes absent pendant un certain temps, il est possible d'indiquer vos pronos sur plusieurs grands prix et les éditer autant de fois que cela est nécéssaire. Consultez les statistiques pour voir les différents classements. Si vous voulez voir les pronos des autres membres, cliquez juste sur leurs pseudos de la page d'accueil du Formule 1.",
	'formel_rules_score'                     => "Points",
	'formel_rules_points_exp'                => "Vous pouvez placer vos pronos pour les 8 premiers pilotes, ensuite le tour le plus rapide, enfin le nombre d'abandons.",
	'formel_rules_mentioned'                 => "Chaque pilote cité dans le Top 8, vous gagnerez <strong>%s</strong>.",
	'formel_rules_placed'                    => "Chaque pilote cité  à la bonne place, vous gagnerez <strong>%s</strong>.",
	'formel_rules_fastest'                   => "Si vous trouvez le pilote le plus rapide, vous gagnerez <strong>%s</strong>.",
	'formel_rules_tired'                     => "Si vous trouvez le bon nombre d'abandons, vous gagnerez <strong>%s</strong>.",
	'formel_rules_total'                     => "Au total, vous pouvez gagner <strong>%s</strong>.",
	'formel_rules_point'                     => "Point",
	'formel_rules_points'                    => "Points",
	'formel_define'                          => 'Pas placé',
	'formel_access_denied'                   => 'Accès refusé. Vous devez appartenir à un groupe pour faire vos pronos.<br /><br />Cliquer %sici%s pour rejoindre un groupe<br />Cliquer %sici%s pour retourner au forum forum',
	'formel_mod_access_denied'               => 'Accès refusé. Vous devez être modérateur ou administrateurpour accèder à la modération.<br /><br />Cliquer %sici%s pour retourner à Formular 1 Webtipp.<br />Cliquer %sici%s pour retourner sur le forum',
	'formel_error_mode' 		             => 'Erreur ! <br /><br />Cliquer %sici%s pour retourner sur Formular 1 Webtipp.<br />Cliquer %sici%s pour retourner sur le forum',
	'formel_close_window'					 => 'Fermer la fenêtre',
	'formel_hidden'							 => 'Caché pendant les pronos',
	'formel_countdown_deadline'				 => 'Compte à rebours des pronos',
	'formel_deadline_reached'				 => 'Terminé',
));

?>
