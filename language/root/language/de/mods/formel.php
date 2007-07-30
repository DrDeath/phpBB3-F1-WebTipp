<?php
/** 
*
* \language\de\mods\formel.php - [Language - Formel 1 WebTipp][German]
*
* @package language
* @version $Id: formel.php 1 2007-07-30 13:25:14Z stoffel04 $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
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

// Formel 1 WebTipp START
$lang = array_merge($lang, array(
	'formel_title'							=> 'Formel 1 WebTipp',
	'formel_headerlink'						=> 'F1-WebTipp',
	'formel_current_race'					=> 'Aktuelles Rennen',
	'formel_current_quali'					=> 'Qualifikation',
	'formel_current_result'					=> 'Ergebnis',
	'formel_no_quali'						=> 'Keine Qualifikation verfügbar',
	'formel_no_result'						=> 'Kein Ergebnis verfügbar',
	'formel_racename'						=> 'Rennstrecke',
	'formel_racelength'						=> 'Streckenlänge',
	'formel_racedistance'					=> 'Renndistanz',
	'formel_racelaps'						=> 'Anzahl Runden',
	'formel_racedebut'						=> 'Streckendebüt',
	'formel_racetime'						=> 'Rennstart',
	'formel_racedead'						=> 'Deadline',
	'formel_next_race'						=> 'Nächstes',
	'formel_prev_race'						=> 'Vorheriges',
	'formel_place'							=> 'Platz',
	'formel_edit'							=> 'Bearbeiten',
	'formel_rules'							=> 'Spielregeln',
	'formel_forum'							=> 'Diskussionsforum',
	'formel_statistics'						=> 'Statistik',
	'formel_call_mod'						=> 'Moderator benachrichtigen',
	'formel_pole'							=> 'Poleposition',
	'formel_race_winner'					=> 'Sieger',
	'formel_delete'							=> 'Löschen',
	'formel_pace'							=> 'Schnellste Runde',
	'formel_tired'							=> 'Anzahl Ausfälle',
	'formel_tipp_not_found'					=> 'Es wurde kein Tipp gefunden',
	'formel_your_tipp'						=> 'Dein Tipp',
	'formel_your_points'					=> 'Deine Punkte',
	'formel_game_over'						=> 'Die Frist ist abgelaufen. Du kannst für dieses Rennen keinen Tipp mehr abgeben.',
	'formel_add_tipp'						=> 'Tipp abgeben',
	'formel_del_tipp'						=> 'Tipp löschen',
	'formel_edit_tipp'						=> 'Tipp bearbeiten',
	'formel_tipp_deleted'					=> 'Der Tipp wurde erfolgreich gelöscht<br /><br />Klicke %shier%s, um zum WebTipp zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'formel_doublicate_values'				=> 'Der Tipp wurde nicht angenommen: Ein Fahrer wurde doppelt platziert<br /><br />Klicke %shier%s, um zu dem Formel 1 Tipp zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
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