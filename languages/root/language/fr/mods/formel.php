<?php
/** 
*
* @package phpbb3f1webtipp
* @version $Id: formel.php 1 2007-07-30 13:25:14Z stoffel04 $
* French translation: Fafa ( fafa@ufolep62tt.net ) 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
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
	'formel_title'                           => 'Formula 1 WebTip',
	'formel_headerlink'                      => 'F1-WebTip',
	'formel_current_race'                    => 'Le Grand Prix',
	'formel_current_quali'                   => 'Qualifications',
	'formel_current_result'                  => 'Résultats',
	'formel_no_quali'                        => 'Pas de qualification trouvé',
	'formel_no_result'                       => 'Pas de résultat trouvé',
	'formel_racename'                        => 'Lieu',
	'formel_racelength'                      => 'Longueur d\'un tour',
	'formel_racedistance'                    => 'Longueur de course',
	'formel_racelaps'                        => 'Tours',
	'formel_racedebut'                       => 'Premier Grand Prix',
	'formel_racetime'                        => 'Début du Grand Prix',
	'formel_racedead'                        => 'Date limite pour les pronos',
	'formel_next_race'                       => 'GP suivant',
	'formel_prev_race'                       => 'GP précédent',
	'formel_place'                           => 'Place',
	'formel_edit'                            => 'Editer',
	'formel_rules'                           => 'Règles',
	'formel_forum'                           => 'Forum du Formule 1',
	'formel_statistics'                      => 'Statistiques',
	'formel_call_mod'                        => 'Alerter un modérateur',
	'formel_pole'                            => 'Poleposition',
	'formel_race_winner'                     => 'Vainqueur',
	'formel_delete'                          => 'Effacer',
	'formel_pace'                            => 'Tour le plus rapide',
	'formel_tired'                           => 'Nombre d\'abandons',
	'formel_tipp_not_found'                  => 'Pas de prono trouvé',
	'formel_your_tipp'                       => 'Vos pronos',
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
