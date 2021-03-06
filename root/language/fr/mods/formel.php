<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/fr/mods/formel.php - [Language - F1 WebTipp][French]
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

$lang = array_merge($lang, array(
	'FORMEL_TITLE'							=> 'Formula 1 WebTip',
	'FORMEL_CURRENT_RACE'					=> 'Le Grand Prix',
	'FORMEL_CURRENT_QUALI'					=> 'Qualifications',
	'FORMEL_CURRENT_RESULT'					=> 'Résultats',
	'FORMEL_NO_QUALI'						=> 'Pas de qualification trouvé',
	'FORMEL_NO_RESULTS'						=> 'Pas de résultat trouvé',
	'FORMEL_RACENAME'						=> 'Lieu',
	'FORMEL_RACELENGTH'						=> 'Longueur d\'un tour',
	'FORMEL_RACEDISTANCE'					=> 'Longueur de course',
	'FORMEL_RACELAPS'						=> 'Tours',
	'FORMEL_RACEDEBUT'						=> 'Premier Grand Prix',
	'FORMEL_RACETIME'						=> 'Début du Grand Prix',
	'FORMEL_RACEDEAD'						=> 'Date limite pour les pronos',
	'FORMEL_NEXT_RACE'						=> 'GP suivant',
	'FORMEL_PREV_RACE'						=> 'GP précédent',
	'FORMEL_PLACE'							=> 'Place',
	'FORMEL_EDIT'							=> 'Editer',
	'FORMEL_RULES'							=> 'Règles',
	'FORMEL_FORUM'							=> 'Forum du Formule 1',
	'FORMEL_STATISTICS'						=> 'Statistiques',
	'FORMEL_CALL_MOD'						=> 'Alerter un modérateur',
	'FORMEL_POLE'							=> 'Poleposition',
	'FORMEL_RACE_WINNER'					=> 'Vainqueur',
	'FORMEL_DELETE'							=> 'Effacer',
	'FORMEL_PACE'							=> 'Tour le plus rapide',
	'FORMEL_TIRED'							=> 'Nombre d\'abandons',
	'FORMEL_SAFETYCAR'						=> 'Voiture de sécurité',
	'FORMEL_NO_TIPP'						=> 'Pas de prono trouvé',
	'FORMEL_YOUR_TIPP'						=> 'Vos pronos',
	'FORMEL_YOUR_POINTS'					=> 'Vos points',
	'FORMEL_GAME_OVER'						=> 'Temps écoulé. Vous ne pouvez plus rien changer.',
	'FORMEL_ADD_TIPP'						=> 'Envoyer vos pronos',
	'FORMEL_DEL_TIPP'						=> 'Effacer vos pronos',
	'FORMEL_EDIT_TIPP'						=> 'Editer vos pronos',
	'FORMEL_TIPP_DELETED'					=> 'Les pronos ont été supprimés<br /><br />Cliquer %sici%s pour revenir sur la page des pronos<br /><br />Cliquer %sici%s pour aller sur le forum',
	'FORMEL_DUBLICATE_VALUES'				=> 'Erreur lors de l\'envoi de vos pronos: Vous avez placé un pilote deux fois<br /><br />Cliquer %sici%s pour revenir sur la page des pronos<br /><br />Cliquer %sici%s pour aller sur le forum',
	'FORMEL_ACCEPTED_TIPP'					=> 'Vos pronos ont été acceptés<br /><br />Cliquer %sici%s pour d\'autres pronos<br /><br />Cliquer %sici%s pour aller sur le forum',
	'FORMEL_RESULTS_TITLE'					=> 'WebTipp modération',
	'FORMEL_RESULTS_TITLE_EXP'				=> 'Ici vous pouvez ajouter ou éditer des résultats',
	'FORMEL_MOD_BUTTON_TEXT'				=> 'Modération',
	'FORMEL_RESULTS_DELETED'				=> 'Résultats effacés<br /><br />Cliquer %sici%s pour revenir sur WebTipp modération<br /><br />Cliquer %sici%s pour revenir sur le WebTipp',
	'FORMEL_RESULTS_ERROR'					=> 'Erreur lors de l\'enregistrement. Veuillez réessayer<br /><br />Cliquer %sici%s pour revenir sur WebTipp moderation<br /><br />Cliquer %sici%s pour revenir sur le WebTipp',
	'FORMEL_RESULTS_DOUBLE'					=> 'Vous avez placé un pilote deux fois. Veuillez réessayer<br /><br />Cliquer %sicie%s pour retourner sur WebTipp modération<br /><br />Cliquer %sici%s pour revenir sur le WebTipp',
	'FORMEL_RESULTS_ACCEPTED'				=> 'Résultats enregistrés<br /><br />Cliquer %sici%s pour retourner sur WebTipp modération<br /><br />Cliquer %sici%s pour revenir sur le WebTipp',
	'FORMEL_RESULTS_ADD'					=> 'Ajouter',
	'FORMEL_RESULTS_QUALI_TITLE'			=> 'Ajouter les qualifications',
	'FORMEL_RESULTS_RESULT_TITLE'			=> 'Editer les résultats du Grand Prix',
	'FORMEL_TOP_POINTS'						=> 'Points',
	'FORMEL_TOP_NAME'						=> 'Top joueurs',
	'FORMEL_TOP_DRIVER'						=> 'Top pilotes',
	'FORMEL_TOP_TEAMS'						=> 'Top écuries',
	'FORMEL_NO_TIPPS'						=> 'Pas encore de prono',
	'FORMEL_TIPPS_MADE'						=> 'Les pronos enregistrés: ',
	'FORMEL_BACK_TO_TIPP'					=> 'Retour aux pronos',
	'FORMEL_USER_STATS'						=> 'Utilisateurs',
	'FORMEL_DRIVER_STATS'					=> 'Pilotes',
	'FORMEL_TEAM_STATS'						=> 'Ecuries',
	'FORMEL_TOP_MORE'						=> 'Tout montrer',
	'FORMEL_STATS_TITLE'					=> 'Formule 1 statistiques',
	'FORMEL_POINTS_WON'						=> 'Points',
	'FORMEL_ALL_POINTS'						=> 'Total points',
	'FORMEL_RULES_TITLE'					=> 'Règles',
	'FORMEL_RULES_GENERAL'					=> 'Général',
	'FORMEL_PROFILE_WEBTIPP'				=> 'Formule 1 points',
	'FORMEL_PROFILE_RANK'					=> '%s. Place',
	'FORMEL_PROFILE_NORANK'					=> 'Pas de place',
	'FORMEL_PROFILE_TIPSS'					=> '%s de %s grands prix',
	'FORMEL_RULES_GENERAL_EXP'				=> "Vous pouvez réaliser des pronos pour chaques grands prix et ainsi obtenir un maximum de points. Si vous êtes absent pendant un certain temps, il est possible d'indiquer vos pronos sur plusieurs grands prix et les éditer autant de fois que cela est nécéssaire. Consultez les statistiques pour voir les différents classements. Si vous voulez voir les pronos des autres membres, cliquez juste sur leurs pseudos de la page d'accueil du Formule 1.",
	'FORMEL_RULES_SCORE'					=> 'Points',
	'FORMEL_RULES_SCORE_EXP'				=> "Vous pouvez pronostiquer pour les 10 premiers pilotes, ainsi que le meilleur tour, le nombre de sorties et le nombre de déploiements de la voiture de sécurité",
	'FORMEL_RULES_MENTIONED'				=> 'Chaque pilote cité dans le Top 10, vous gagnerez <strong>%s</strong>.',
	'FORMEL_RULES_PLACED'					=> 'Chaque pilote cité  à la bonne place, vous gagnerez <strong>%s</strong>.',
	'FORMEL_RULES_FASTEST'					=> 'Si vous trouvez le pilote le plus rapide, vous gagnerez <strong>%s</strong>.',
	'FORMEL_RULES_TIRED'					=> "Si vous trouvez le bon nombre d'abandons, vous gagnerez <strong>%s</strong>.",
	'FORMEL_RULES_SAFETYCAR'				=> 'Pour le nombre correct de sorties de la voiture de sécurité, vous pouvez gagner <strong>%s</strong>.',
	'FORMEL_RULES_TOTAL'					=> "Au total, vous pouvez gagner <strong>%s</strong>.",
	'FORMEL_RULES_POINT'					=> "Point",
	'FORMEL_RULES_POINTS'					=> "Points",
	'FORMEL_DEFINE'							=> 'Pas placé',
	'FORMEL_ACCESS_DENIED'					=> 'Accès refusé. Vous devez appartenir à un groupe pour faire vos pronos.<br /><br />Cliquer %sici%s pour rejoindre un groupe<br />Cliquer %sici%s pour retourner au forum forum',
	'FORMEL_MOD_ACCESS_DENIED'				=> 'Accès refusé. Vous devez être modérateur ou administrateurpour accèder à la modération.<br /><br />Cliquer %sici%s pour retourner à Formular 1 Webtipp.<br />Cliquer %sici%s pour retourner sur le forum',
	'FORMEL_ERROR_MODE'						=> 'Erreur ! <br /><br />Cliquer %sici%s pour retourner sur Formular 1 Webtipp.<br />Cliquer %sici%s pour retourner sur le forum',
	'FORMEL_CLOSE_WINDOW'					=> 'Fermer la fenêtre',
	'FORMEL_HIDDEN'							=> 'Caché pendant les pronos',
	'FORMEL_COUNTDOWN_DEADLINE'				=> 'Compte à rebours des pronos',
	'FORMEL_DEADLINE_REACHED'				=> 'Terminé',

	'INSERT_F1_FIRST_FILL'					=> 'Insérer les données dans les tables config, pilotes, écuries et courses.',
	'INSERT_F1_CONFIG'						=> 'Insérer les données dans les tables formel_config',
	'FORMEL_GUESTS_PLACE_NO_TIP'			=> '<strong>Les invités ne peuvent pas faire de pronostics.</strong><br /><br />Pour placer un pronostic vous devez être enregistrés et connectés.<br />',
	'FORMEL_RACE_ABORD'						=> 'Course interrompue. (Demi de points.)',
	'FORMEL_RACE_DOUBLE'					=> 'Course aux points doubles',

	'VIEWING_F1WEBTIPP'						=> 'Consulte de Formula 1 WebTip',

	'FORMEL_MAIL_ADMIN'						=> 'Pronos F1 - les mails de rappel pour le grand prix de %1$s ont été envoyés',
	'FORMEL_MAIL_ADMIN_MESSAGE'				=> 'Les mails ont été envoyés aux utilisateurs suivants: %1$s',
	'FORMEL_LOG'							=> 'Pronos F1 - Rappel e-mail envoyé à: %1$s',
	'FORMEL_LOG_ERROR'						=> '<strong>Pronos F1 - Rappel mail à %1$s n\'a pas réussi.</strong>',
));

?>
