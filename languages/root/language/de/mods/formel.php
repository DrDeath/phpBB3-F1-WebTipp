<?php
/** 
*
* \language\de\mods\formel.php - [Language - Formel 1 WebTipp][German]
*
* @package language
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
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

// BBCodes 
// Note to translators: you can translate everything but what's between { and }

// Formel 1 WebTipp 
$lang = array_merge($lang, array(
	'FORMEL_TITLE'							=> 'Formel 1 WebTipp',
	'FORMEL_CURRENT_RACE'					=> 'Aktuelles Rennen',
	'FORMEL_CURRENT_QUALI'					=> 'Qualifikation',
	'FORMEL_CURRENT_RESULT'					=> 'Ergebnis',
	'FORMEL_NO_QUALI'						=> 'Keine Qualifikation verfügbar',
	'FORMEL_NO_RESULTS'						=> 'Kein Ergebnis verfügbar',
	'FORMEL_RACENAME'						=> 'Rennstrecke',
	'FORMEL_RACELENGTH'						=> 'Streckenlänge',
	'FORMEL_RACEDISTANCE'					=> 'Renndistanz',
	'FORMEL_RACELAPS'						=> 'Anzahl Runden',
	'FORMEL_RACEDEBUT'						=> 'Streckendebüt',
	'FORMEL_RACETIME'						=> 'Rennstart',
	'FORMEL_RACEDEAD'						=> 'Deadline',
	'FORMEL_NEXT_RACE'						=> 'Nächstes',
	'FORMEL_PREV_RACE'						=> 'Vorheriges',
	'FORMEL_PLACE'							=> 'Platz',
	'FORMEL_EDIT'							=> 'Bearbeiten',
	'FORMEL_RULES'							=> 'Spielregeln',
	'FORMEL_FORUM'							=> 'Diskussionsforum',
	'FORMEL_STATISTICS'						=> 'Statistik',
	'FORMEL_CALL_MOD'						=> 'Moderator benachrichtigen',
	'FORMEL_POLE'							=> 'Poleposition',
	'FORMEL_RACE_WINNER'					=> 'Sieger',
	'FORMEL_DELETE'							=> 'Löschen',
	'FORMEL_PACE'							=> 'Schnellste Runde',
	'FORMEL_TIRED'							=> 'Anzahl Ausfälle',
	'FORMEL_NO_TIPP'						=> 'Es wurde kein Tipp gefunden',
	'FORMEL_YOUR_TIPP'						=> 'Dein Tipp',
	'formel_your_points'					=> 'Deine Punkte',
	'formel_game_over'						=> 'Die Frist ist abgelaufen. Du kannst für dieses Rennen keinen Tipp mehr abgeben.',
	'formel_add_tipp'						=> 'Tipp abgeben',
	'formel_del_tipp'						=> 'Tipp löschen',
	'formel_edit_tipp'						=> 'Tipp bearbeiten',
	'formel_tipp_deleted'					=> 'Der Tipp wurde erfolgreich gelöscht<br /><br />Klicke %shier%s, um zum WebTipp zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_doublicate_values'				=> '<span style="color:red; font-weight:bold; font-size: 1.5em">Der Tipp wurde nicht angenommen: Ein Fahrer wurde doppelt platziert</span><br /><br />Klicke %shier%s, um zu dem Formel 1 Tipp zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_accepted_tipp'					=> 'Der Tipp wurde erfolgreich eingetragen<br /><br />Klicke %shier%s, um für weitere Rennen zu tippen<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_results_title'					=> 'WebTipp Moderation',
	'formel_results_title_exp'				=> 'Hier kannst Du die Ergebnisse für die einzelnen Rennen eintragen oder bearbeiten',
	'formel_results_reset'					=> 'Qualifikation/Ergebnis löschen',
	'formel_mod_button_text'				=> 'Moderation',
	'formel_results_deleted'				=> 'Die Rennergebnisse wurden gelöscht<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_results_error'					=> 'Es gab einen Fehler. Bitte versuche es erneut<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_results_double'					=> 'Es wurde ein Fahrer doppelt eingetragen. Bitte versuche es erneut<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_results_accepted'				=> 'Die Ergebnisse wurden eingetragen<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_results_add'					=> 'Eintragen',
	'formel_results_reset'					=> 'Reset',
	'formel_results_qualititle'				=> 'Qualifikation eintragen',
	'formel_results_resulttitle'			=> 'Rennergebnis eintragen',
	'formel_top_points'						=> 'Punkte',
	'formel_top_name'						=> 'Top Spieler',
	'formel_top_driver'						=> 'Top Fahrer',
	'formel_top_teams'						=> 'Top Teams',
	'formel_no_players'						=> 'Es wurden noch keine Tipps abgegeben',
	'formel_tipps_made'						=> 'Abgegebene Tipps: ',
	'formel_back_to_tipp'					=> 'Zurück zum Tipp',
	'formel_user_stats'						=> 'Spieler',
	'formel_driver_stats'					=> 'Fahrer',
	'formel_team_stats'						=> 'Teams',
	'formel_top_more'						=> 'Zeige alle',
	'formel_stats_title'					=> 'Formel 1 Statistik',
	'formel_points_won'						=> 'Erzielte Punkte',
	'formel_all_points'						=> 'Gesamt Punkte',
	'formel_watching_tipp'					=> 'Tipper',
	'formel_rules_title'					=> 'Spielregeln',
	'formel_rules_general'					=> 'Allgemeines',
	'formel_profile_title'					=> 'Formel 1 Punkte',
	'formel_profile_rank'					=> '%s. Platz',
	'formel_profile_norank'					=> 'Keine Platzierung',
	'formel_profile_tipps'					=> '%s von %s Rennen getippt',
	'formel_rules_gen_exp'					=> 'Der Formel 1 WebTipp ist ein Saison begleitendes Tippspiel. Hier kannst Du den anderen Communitymitgliedern zeigen, wer wirklich Ahnung von der Formel 1 hat!<br /><br />Du kannst zu jedem Formel 1 Rennen einen Tipp abgeben und Punkte sammeln. Solltest Du einmal längere Zeit nicht anwesend sein, kannst Du auch jetzt schon Deinen Tipp für die kommenden Rennen abgeben. Diese kannst Du auch jederzeit wieder ändern. Die aktuellen Punktestände von Dir und den anderen Tippern kannst Du auf der Statistikseite einsehen. Du kannst Dir auch die Tipps der anderen User ansehen, indem Du auf der WebTipp Übersichtsseite bei den abgegebenen Tipps auf einen Usernamen klickst. ( Tipps werden allerdings erst nach Erreichen der Deadline angezeigt )',
	'formel_rules_score'					=> 'Punktevergabe',
	'formel_rules_points_exp'				=> 'Getippt wird auf die ersten 8 Plätze, die schnellste Runde, sowie die Anzahl der Ausfälle.',
	'formel_rules_mentioned'				=> 'Hast Du in Deinem Tipp einen Fahrer erwähnt, der als einer der ersten 8 Fahrer ins Ziel kam, erhälst Du dafür <strong>%s</strong>.',
	'formel_rules_placed'					=> 'Wenn Du diesen Fahrer auch noch auf den richtigen Platz gesetzt hast, erhälst Du dafür noch einmal <strong>%s</strong>.',
	'formel_rules_fastest'					=> 'Hast Du den schnellsten Fahrer richtig genannt, bekommst Du dafür <strong>%s</strong>.',
	'formel_rules_tired'					=> 'Für die richtige Anzahl der Ausfälle bekommst Du <strong>%s</strong>.',
	'formel_rules_total'					=> 'Insgesamt kannst Du also mit jedem Tipp (rein theoretisch) <strong>%s</strong> erspielen.',
	'formel_rules_point'					=> 'Punkt',
	'formel_rules_points'					=> 'Punkte',
	'formel_define'							=> 'Nicht gesetzt',
	'formel_access_denied'					=> 'Der Zugriff auf den Formel 1 WebTipp ist nur einer bestimmten Benutzergruppe gestattet.<br /><br />Klick %shier%s, um einen Aufnahmeantrag zu stellen<br />Klick %shier%s, um zum Index zurückzukehren',
	'formel_mod_access_denied'				=> 'Der Zugriff auf die Formel 1 WebTipp Moderation ist nur Moderatoren oder Administratoren gestattet.<br /><br />Klick %shier%s um zum Formel 1 WebTipp zurückzukehren.<br />Klick %shier%s, um zum Index zurückzukehren',
	'formel_error_mode'						=> 'Fehler ! Mode unbekannt !<br /><br />Klick %shier%s um zum Formel 1 WebTipp zurückzukehren.<br />Klick %shier%s, um zum Index zurückzukehren',
	'formel_close_window'					=> 'Fenster schliessen',
	'formel_hidden'							=> 'Verdeckt bis Deadline',
	'formel_countdown_deadline'				=> 'Countdown bis Deadline',
	'formel_deadline_reached'				=> 'Countdown beendet',
));
// Formel 1 WebTipp END
?>