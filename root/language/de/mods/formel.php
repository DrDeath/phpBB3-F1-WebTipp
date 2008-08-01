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
	'FORMEL_YOUR_POINTS'					=> 'Deine Punkte',
	'FORMEL_GAME_OVER'						=> 'Die Frist ist abgelaufen. Du kannst für dieses Rennen keinen Tipp mehr abgeben.',
	'FORMEL_ADD_TIPP'						=> 'Tipp abgeben',
	'FORMEL_DEL_TIPP'						=> 'Tipp löschen',
	'FORMEL_EDIT_TIPP'						=> 'Tipp bearbeiten',
	'FORMEL_TIPP_DELETED'					=> 'Der Tipp wurde erfolgreich gelöscht<br /><br />Klicke %shier%s, um zum WebTipp zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_DUBLICATE_VALUES'				=> '<span style="color:red; font-weight:bold; font-size: 1.5em">Der Tipp wurde nicht angenommen: Ein Fahrer wurde doppelt platziert</span><br /><br />Klicke %shier%s, um zu dem Formel 1 Tipp zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_ACCEPTED_TIPP'					=> 'Der Tipp wurde erfolgreich eingetragen<br /><br />Klicke %shier%s, um für weitere Rennen zu tippen<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_RESULTS_TITLE'					=> 'WebTipp Moderation',
	'FORMEL_RESULTS_TITLE_EXP'				=> 'Hier kannst Du die Ergebnisse für die einzelnen Rennen eintragen oder bearbeiten',
	'FORMEL_MOD_BUTTON_TEXT'				=> 'Moderation',
	'FORMEL_RESULTS_DELETED'				=> 'Die Rennergebnisse wurden gelöscht<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_RESULTS_ERROR'					=> 'Es gab einen Fehler. Bitte versuche es erneut<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_RESULTS_DOUBLE'					=> 'Es wurde ein Fahrer doppelt eingetragen. Bitte versuche es erneut<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_RESULTS_ACCEPTED'				=> 'Die Ergebnisse wurden eingetragen<br /><br />Klicke %shier%s, um zur WebTipp Moderation zurückzukehren<br /><br />Klicke %shier%s, um zum Forum zurückzukehren',
	'FORMEL_RESULTS_ADD'					=> 'Eintragen',
	'FORMEL_RESULTS_QUALI_TITLE'			=> 'Qualifikation eintragen',
	'FORMEL_RESULTS_RESULT_TITLE'			=> 'Rennergebnis eintragen',
	'FORMEL_TOP_POINTS'						=> 'Punkte',
	'FORMEL_TOP_NAME'						=> 'Top Spieler',
	'FORMEL_TOP_DRIVER'						=> 'Top Fahrer',
	'FORMEL_TOP_TEAMS'						=> 'Top Teams',
	'FORMEL_NO_TIPPS'						=> 'Es wurden noch keine Tipps abgegeben',
	'FORMEL_TIPPS_MADE'						=> 'Abgegebene Tipps: ',
	'FORMEL_BACK_TO_TIPP'					=> 'Zurück zum Tipp',
	'FORMEL_USER_STATS'						=> 'Spieler',
	'FORMEL_DRIVER_STATS'					=> 'Fahrer',
	'FORMEL_TEAM_STATS'						=> 'Teams',
	'FORMEL_TOP_MORE'						=> 'Zeige alle',
	'FORMEL_STATS_TITLE'					=> 'Formel 1 Statistik',
	'FORMEL_POINTS_WON'						=> 'Erzielte Punkte',
	'FORMEL_ALL_POINTS'						=> 'Gesamt Punkte',
	'FORMEL_RULES_TITLE'					=> 'Spielregeln',
	'FORMEL_RULES_GENERAL'					=> 'Allgemeines',
	'FORMEL_PROFILE_WEBTIPP'				=> 'Formel 1 Punkte',
	'FORMEL_PROFILE_RANK'					=> '%s. Platz',
	'FORMEL_PROFILE_NORANK'					=> 'Keine Platzierung',
	'FORMEL_PROFILE_TIPSS'					=> '%s von %s Rennen getippt',
	'FORMEL_RULES_GENERAL_EXP'				=> 'Der Formel 1 WebTipp ist ein Saison begleitendes Tippspiel. Hier kannst Du den anderen Communitymitgliedern zeigen, wer wirklich Ahnung von der Formel 1 hat!<br /><br />Du kannst zu jedem Formel 1 Rennen einen Tipp abgeben und Punkte sammeln. Solltest Du einmal längere Zeit nicht anwesend sein, kannst Du auch jetzt schon Deinen Tipp für die kommenden Rennen abgeben. Diese kannst Du auch jederzeit wieder ändern. Die aktuellen Punktestände von Dir und den anderen Tippern kannst Du auf der Statistikseite einsehen. Du kannst Dir auch die Tipps der anderen User ansehen, indem Du auf der WebTipp Übersichtsseite bei den abgegebenen Tipps auf einen Usernamen klickst. ( Tipps werden allerdings erst nach Erreichen der Deadline angezeigt )',
	'FORMEL_RULES_SCORE'					=> 'Punktevergabe',
	'FORMEL_RULES_MENTIONED'				=> 'Hast Du in Deinem Tipp einen Fahrer erwähnt, der als einer der ersten 8 Fahrer ins Ziel kam, erhälst Du dafür <strong>%s</strong>.',
	'FORMEL_RULES_SCORE_EXP'				=> 'Getippt wird auf die ersten 8 Plätze, die schnellste Runde, sowie die Anzahl der Ausfälle.',
	'FORMEL_RULES_PLACED'					=> 'Wenn Du diesen Fahrer auch noch auf den richtigen Platz gesetzt hast, erhälst Du dafür noch einmal <strong>%s</strong>.',
	'FORMEL_RULES_FASTEST'					=> 'Hast Du den schnellsten Fahrer richtig genannt, bekommst Du dafür <strong>%s</strong>.',
	'FORMEL_RULES_TIRED'					=> 'Für die richtige Anzahl der Ausfälle bekommst Du <strong>%s</strong>.',
	'FORMEL_RULES_TOTAL'					=> 'Insgesamt kannst Du also mit jedem Tipp (rein theoretisch) <strong>%s</strong> erspielen.',
	'FORMEL_RULES_POINT'					=> 'Punkt',
	'FORMEL_RULES_POINTS'					=> 'Punkte',
	'FORMEL_DEFINE'							=> 'Nicht gesetzt',
	'FORMEL_ACCESS_DENIED'					=> 'Der Zugriff auf den Formel 1 WebTipp ist nur einer bestimmten Benutzergruppe gestattet.<br /><br />Klick %shier%s, um einen Aufnahmeantrag zu stellen<br />Klick %shier%s, um zum Index zurückzukehren',
	'FORMEL_MOD_ACCESS_DENIED'				=> 'Der Zugriff auf die Formel 1 WebTipp Moderation ist nur Moderatoren oder Administratoren gestattet.<br /><br />Klick %shier%s um zum Formel 1 WebTipp zurückzukehren.<br />Klick %shier%s, um zum Index zurückzukehren',
	'FORMEL_ERROR_MODE'						=> 'Fehler ! Mode unbekannt !<br /><br />Klick %shier%s um zum Formel 1 WebTipp zurückzukehren.<br />Klick %shier%s, um zum Index zurückzukehren',
	'FORMEL_CLOSE_WINDOW'					=> 'Fenster schliessen',
	'FORMEL_HIDDEN'							=> 'Verdeckt bis Deadline',
	'FORMEL_COUNTDOWN_DEADLINE'				=> 'Countdown bis Deadline',
	'FORMEL_DEADLINE_REACHED'				=> 'Countdown beendet',
	'INSTALL_FORMEL_NO_FOUNDER'				=> 'Du musst als Gründer eingeloggt sein um dieses Script auszuführen.',
	'INSTALL_FORMEL_OPTION_INSTALL'			=> '<span style="color:green; font-weight: bold;font-size: 1.5em;">Formel 1 WebTipp MOD v0.1.29 (beta)</span><br /><br />Script für automatische Formel 1 WebTipp Installation. <br />Es werden Berechtigungen, ACP Module, Datenbanktabellen und Standard Daten erzeugt.<br /><br /><span style="color:red; font-weight: bold;">Dieser Vorgang wird alle Einstellungen, Fahrer, Teams, Rennen und abgegebene Tipps von einer evtl. vorherigen Formel 1 WebTipp Installation löschen!</span><br /><br />Bist Du Dir sicher das du weiter machen möchtest? Wenn ja, dann klicke %shier%s<br /><br />Klick %shier%s um zum Index zurückzukehren.',
	'INSTALL_FORMEL_DONE'					=> '<span style="color:green; font-weight: bold;font-size: 1.5em;">Formel 1 WebTipp MOD v0.1.29 (beta)</span><br /><br />Alle Berechtigungen, ACP Module, Datenbanktabellen und Standard Daten wurden erfolgreich installiert.',
));
// Formel 1 WebTipp END
?>