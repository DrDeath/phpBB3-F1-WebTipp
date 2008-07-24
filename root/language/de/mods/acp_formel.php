<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/de/mods/acp_formel.php - [Language ACP - Deutsch]
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

$lang = array_merge($lang, array(
	'ACP_F1_MANAGEMENT'								=> 'Formel 1 WebTipp',
	'ACP_F1_SETTINGS'								=> 'Formel 1 Konfiguration',
	'ACP_F1_SETTINGS_EXPLAIN'						=> 'Hier kannst Du die Formel 1 WebTipp Konfiguration bearbeiten',
	'ACP_F1_SETTINGS_CONFIG'						=> 'Formel 1 Konfiguration',
	'ACP_F1_SETTINGS_MODERATOR'						=> 'WebTipp Moderator',
	'ACP_F1_SETTINGS_MODERATOR_EXPLAIN'				=> 'Dies muss ein Mitglied einer Moderatorengruppe sein',
	'ACP_F1_SETTINGS_DEACTIVATED'					=> '*** de-aktiviert ***',
	'ACP_F1_SETTINGS_UPDATED'						=> 'Formel 1 Konfiguration erfolgreich aktualisiert',
	'ACP_F1_SETTINGS_ACCESS_GROUP'					=> 'WebTipp Gruppe',
	'ACP_F1_SETTINGS_ACCESS_GROUP_EXPLAIN'			=> 'Hier kannst Du den Zugriff auf den WebTipp auf eine bestimmte Gruppe beschränken',
	'ACP_F1_SETTINGS_OFFSET'						=> 'Deadline Offset',
	'ACP_F1_SETTINGS_OFFSET_EXPLAIN'				=> 'Hier kannst Du die Deadline für die Tippabgabe bestimmten.<br />(Zeit in Sekunden bis zum Rennbeginn)',
	'ACP_F1_SETTINGS_RACEOFFSET'					=> 'Renn Verzögerung',
	'ACP_F1_SETTINGS_RACEOFFSET_EXPLAIN'			=> 'Hier wird festgelegt wann das "Aktuelle Rennen" wechselt.<br />(Zeit in Sekunden ab Rennbeginn)',
	'ACP_F1_SETTINGS_FORUM'							=> 'Formel 1 Forum',
	'ACP_F1_SETTINGS_FORUM_EXPLAIN'					=> 'Hier kann das Diskussionsforum zum WebTipp eingetragen werden',
	'ACP_F1_SETTINGS_SHOW_PROFILE'					=> 'Anzeige im Profil',
	'ACP_F1_SETTINGS_SHOW_PROFILE_EXPLAIN'			=> 'Sollen die Tippergebnisse in den Userprofilen angezeigt werden?',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN'				=> 'Countdown anzeigen',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_EXPLAIN'		=> 'Hier kannst Du festlegen, ob der Countdown im WebTipp gezeigt werden soll.',
	'ACP_F1_SETTINGS_POINTS'						=> 'Punktevergabe',
	'ACP_F1_SETTINGS_POINTS_MENTIONED'				=> 'Erwähnt',
	'ACP_F1_SETTINGS_POINTS_MENTIONED_EXPLAIN'		=> 'Punkte für das Erwähnen eines Fahrers',
	'ACP_F1_SETTINGS_POINTS_PLACED'					=> 'Platziert',
	'ACP_F1_SETTINGS_POINTS_PLACED_EXPLAIN'			=> 'Punkte für das richtige Platzieren eines Fahrers',
	'ACP_F1_SETTINGS_POINTS_FASTEST'				=> 'Schnellste',
	'ACP_F1_SETTINGS_POINTS_FASTEST_EXPLAIN'		=> 'Punkte für die schnellste Runde',
	'ACP_F1_SETTINGS_POINTS_TIRED'					=> 'Ausfälle',
	'ACP_F1_SETTINGS_POINTS_TIRED_EXPLAIN'			=> 'Punkte für die richtige Anzahl Ausfälle',
	'ACP_F1_SETTINGS_PICS'							=> 'Bilder',
	'ACP_F1_SETTINGS_SHOW_HEADBANNER'				=> 'Banner anzeigen',
	'ACP_F1_SETTINGS_SHOW_HEADBANNER_EXPLAIN'		=> 'Hier kannst Du festlegen, ob der Banner im Header gezeigt werden soll.',
	'ACP_F1_SETTINGS_SHOW_AVATAR'					=> 'Avatar anzeigen',
	'ACP_F1_SETTINGS_SHOW_AVATAR_EXPLAIN'			=> 'Hier kannst Du festlegen, ob der Avatar des Benutzers in der Spieler Statistik angezeigt werden soll',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_HEIGHT'			=> 'Banner Höhe',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_HEIGHT_EXPLAIN'	=> 'Hier kannst Du die <strong>Höhe in Px</strong> angeben,<br />in der der Banner dargestellt werden soll',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_WIDTH'			=> 'Banner Breite',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_WIDTH_EXPLAIN'	=> 'Hier kannst Du die <strong>Breite in Px</strong> angeben,<br />in der der Banner dargestellt werden soll',
	'ACP_F1_SETTINGS_HEADBANNER1_IMG'				=> 'Banner Webtipp',
	'ACP_F1_SETTINGS_HEADBANNER1_IMG_EXPLAIN'		=> 'Banner für die WebTipp Übersichtsseite',
	'ACP_F1_SETTINGS_HEADBANNER1_URL'				=> 'Banner WebTipp URL',
	'ACP_F1_SETTINGS_HEADBANNER1_URL_EXPLAIN'		=> 'URL des Banners auf der WebTipp Übersichtsseite',
	'ACP_F1_SETTINGS_HEADBANNER2_IMG'				=> 'Banner Regeln',
	'ACP_F1_SETTINGS_HEADBANNER2_IMG_EXPLAIN'		=> 'Banner für die WebTipp Regelnseite',
	'ACP_F1_SETTINGS_HEADBANNER2_URL'				=> 'Banner Regeln URL',
	'ACP_F1_SETTINGS_HEADBANNER2_URL_EXPLAIN'		=> 'URL des Banners auf der WebTipp Regelnseite',
	'ACP_F1_SETTINGS_HEADBANNER3_IMG'				=> 'Banner Statistik',
	'ACP_F1_SETTINGS_HEADBANNER3_IMG_EXPLAIN'		=> 'Banner für die WebTipp Statistikseite',
	'ACP_F1_SETTINGS_HEADBANNER3_URL'				=> 'Banner Statistik URL',
	'ACP_F1_SETTINGS_HEADBANNER3_URL_EXPLAIN'		=> 'URL des Banners auf der WebTipp Statistikseite',
	'ACP_F1_SETTINGS_SHOW_GFXR'						=> 'Rennstrecken-Grafiken anzeigen',
	'ACP_F1_SETTINGS_SHOW_GFXR_EXPLAIN'				=> 'Sollen die Grafiken der Rennstrecken angezeigt werden?',
	'ACP_F1_SETTINGS_NO_RACE_IMG'					=> 'Standart Rennstrecke',
	'ACP_F1_SETTINGS_NO_RACE_IMG_EXPLAIN'			=> 'Hier kannst Du das Bild angeben, welches angezeigt wird,<br />wenn kein Rennstreckenbild vorhanden ist',
	'ACP_F1_SETTINGS_RACE_IMG_HEIGHT'				=> 'Rennstrecke Höhe',
	'ACP_F1_SETTINGS_RACE_IMG_HEIGHT_EXPLAIN'		=> 'Hier kannst Du die <strong>Höhe in Px</strong> angeben,<br />in der die Rennstrecke dargestellt werden soll',
	'ACP_F1_SETTINGS_RACE_IMG_WIDTH'				=> 'Rennstrecke Breite',
	'ACP_F1_SETTINGS_RACE_IMG_WIDTH_EXPLAIN'		=> 'Hier kannst Du die <strong>Breite in Px</strong> angeben,<br />in der die Rennstrecke dargestellt werden soll',
	'ACP_F1_SETTINGS_SHOW_GFX'						=> 'Fahrer- und Team-Grafiken anzeigen',
	'ACP_F1_SETTINGS_SHOW_GFX_EXPLAIN'				=> 'Sollen die Grafiken der Fahrer und Teams angezeigt werden?',
	'ACP_F1_SETTINGS_NO_CAR_IMG'					=> 'Standart Autobild',
	'ACP_F1_SETTINGS_NO_CAR_IMG_EXPLAIN'			=> 'Hier kannst Du das Bild angeben, welches angezeigt wird,<br />wenn kein Autobild vorhanden ist',
	'ACP_F1_SETTINGS_CAR_IMG_HEIGHT'				=> 'Autobild Höhe',
	'ACP_F1_SETTINGS_CAR_IMG_HEIGHT_EXPLAIN'		=> 'Hier kannst Du die <strong>Höhe in Px</strong> angeben,<br />in der das Autobild dargestellt werden soll',
	'ACP_F1_SETTINGS_CAR_IMG_WIDTH'					=> 'Autobild Breite',
	'ACP_F1_SETTINGS_CAR_IMG_WIDTH_EXPLAIN'			=> 'Hier kannst Du die <strong>Breite in Px</strong> angeben,<br />in der das Autobild dargestellt werden soll', 
	'ACP_F1_SETTINGS_NO_DRIVER_IMG'					=> 'Standart Fahrerbild',
	'ACP_F1_SETTINGS_NO_DRIVER_IMG_EXPLAIN'			=> 'Hier kannst Du das Bild angeben, welches angezeigt wird,<br />wenn kein Fahrerbild vorhanden ist',
	'ACP_F1_SETTINGS_DRIVER_IMG_HEIGHT'				=> 'Fahrerbild Höhe',
	'ACP_F1_SETTINGS_DRIVER_IMG_HEIGHT_EXPLAIN'		=> 'Hier kannst Du die <strong>Höhe in Px</strong> angeben,<br />in der das Fahrerbild dargestellt werden soll',
	'ACP_F1_SETTINGS_DRIVER_IMG_WIDTH'				=> 'Fahrerbild Breite',
	'ACP_F1_SETTINGS_DRIVER_IMG_WIDTH_EXPLAIN'		=> 'Hier kannst Du die <strong>Breite in Px</strong> angeben,<br />in der das Fahrerbild dargestellt werden soll',
	'ACP_F1_SETTINGS_NO_TEAM_IMG'					=> 'Standart Teamlogo',
	'ACP_F1_SETTINGS_NO_TEAM_IMG_EXPLAIN'			=> 'Hier kannst Du das Bild angeben, welches angezeigt wird,<br />wenn kein Teamlogo vorhanden ist',
	'ACP_F1_SETTINGS_TEAM_IMG_HEIGHT'				=> 'Teamlogo Höhe',
	'ACP_F1_SETTINGS_TEAM_IMG_HEIGHT_EXPLAIN'		=> 'Hier kannst Du die <strong>Höhe in Px</strong> angeben,<br />in der das Teamlogo dargestellt werden soll',
	'ACP_F1_SETTINGS_TEAM_IMG_WIDTH'				=> 'Teamlogo Breite',
	'ACP_F1_SETTINGS_TEAM_IMG_WIDTH_EXPLAIN'		=> 'Hier kannst Du die <strong>Breite in Px</strong> angeben,<br />in der das Teamlogo dargestellt werden soll',
	'ACP_F1_SETTINGS_SEASON_RESET'					=> 'Saison zurücksetzen',
	'ACP_F1_SETTINGS_SEASON_RESET_EXPLAIN'			=> '<strong>Achtung:</strong> Wenn Du auf den Button klickst, wird die Saison unwiderruflich zurückgesetzt!<br /><br />Nach dem Reset müssen noch die Renntermine der neuen Saison angepasst werden. Der <a href="http://www.lpi-clan.de">Support</a> dieses Mods bietet hierfür SQL-Updates an.',	
	'ACP_F1_SETTINGS_SEASON_RESETTED'				=> 'Saison zurückgesetzt. Renntermine aktualisieren!',
	
	'ACP_F1_DRIVERS'								=> 'Formel 1 Fahrer',
	'ACP_F1_DRIVERS_EXPLAIN'						=> 'Hier kannst Du neue Formel 1 Fahrer erstellen oder vorhandene bearbeiten',
	'ACP_F1_DRIVERS_ADD'							=> 'Eintragen',
	'ACP_F1_DRIVERS_ADD_DRIVER'						=> 'Neuer Fahrer',
	'ACP_F1_DRIVERS_TITEL_ADD_DRIVER'				=> 'Formel 1 Fahrer eintragen',
	'ACP_F1_DRIVERS_TITEL_ADD_DRIVER_EXPLAIN'		=> 'Hier kannst Du einen neuen Formel 1 Fahrer erstellen',
	'ACP_F1_DRIVERS_DRIVERNAME'						=> 'Fahrername',
	'ACP_F1_DRIVERS_DRIVERIMAGE'					=> 'Portrait',
	'ACP_F1_DRIVERS_DRIVERTEAM'						=> 'Team',
	'ACP_F1_DRIVERS_DRIVERPOINTS'					=> 'WM Punkte',
	'ACP_F1_DRIVERS_EDIT_DRIVER'					=> 'Bearbeiten',
	'ACP_F1_DRIVERS_TITEL_EDIT_DRIVER'				=> 'Formel 1 Fahrer bearbeiten',
	'ACP_F1_DRIVERS_TITEL_EDIT_DRIVER_EXPLAIN'		=> 'Hier kannst Du einen Formel 1 Fahrer bearbeiten',
	'ACP_F1_DRIVERS_DELETE_DRIVER'					=> 'Löschen',
	'ACP_F1_DRIVERS_DRIVER_DELETED'					=> 'Der Eintrag wurde erfolgreich gelöscht',
	'ACP_F1_DRIVERS_DRIVER_UPDATED'					=> 'Fahrer Datenbank erfolgreich aktualisiert',
	'ACP_F1_DRIVERS_ERROR_IMAGE'					=> 'Bitte gib ein Fahrerbild an',
	'ACP_F1_DRIVERS_ERROR_DRIVERNAME'				=> 'Bitte gib einen Fahrernamen an',

	'ACP_F1_TEAMS'									=> 'Formel 1 Teams',
	'ACP_F1_TEAMS_EXPLAIN'							=> 'Hier kannst Du neue Formel 1 Teams erstellen oder vorhandene bearbeiten',
	'ACP_F1_TEAMS_ADD_TEAM'							=> 'Neues Team',
	'ACP_F1_TEAMS_ADDTEAM_TITLE'					=> 'Formel 1 Team eintragen',
	'ACP_F1_TEAMS_ADDTEAM_TITLE_EXPLAIN'			=> 'Hier kannst Du ein neues Formel 1 Team erstellen',
	'ACP_F1_TEAMS_ADDTEAM_TEAMNAME'					=> 'Teamname',
	'ACP_F1_TEAMS_ADDTEAM_TEAMIMAGE'				=> 'Team Logo',
	'ACP_F1_TEAMS_ADDTEAM_TEAMCAR'					=> 'Team Auto',
	'ACP_F1_TEAMS_ADD'								=> 'Eintragen',
	'ACP_F1_TEAMS_EDITTEAM_TITLE'					=> 'Formel 1 Team bearbeiten',
	'ACP_F1_TEAMS_EDITTEAM_TITLE_EXPLAIN'			=> 'Hier kannst Du ein Formel 1 Team bearbeiten',
	'ACP_F1_TEAMS_DRIVERTEAM'						=> 'Team',
	'ACP_F1_TEAMS_DRIVERPOINTS'						=> 'WM Punkte',
	'ACP_F1_TEAMS_EDIT_TEAM'						=> 'Bearbeiten',
	'ACP_F1_TEAMS_DELETE_TEAM'						=> 'Löschen',
	'ACP_F1_TEAMS_TEAM_UPDATED'						=> 'Team Datenbank erfolgreich aktualisiert',
	'ACP_F1_TEAMS_TEAM_DELETED'						=> 'Der Eintrag wurde erfolgreich gelöscht',
	'ACP_F1_TEAMS_ERROR_TEAMNAME'					=> 'Bitte gib einen Teamnamen an',
	'ACP_F1_TEAMS_PENALTY'							=> 'Strafpunkte',

	'ACP_F1_RACES'									=> 'Formel 1 Rennen',
	'ACP_F1_RACES_EXPLAIN'							=> 'Hier kannst Du neue Formel 1 Rennen erstellen oder vorhandene bearbeiten',
	'ACP_F1_RACES_ADD_RACE'							=> 'Neues Rennen',
	'ACP_F1_RACES_TITEL_ADD_RACE'					=> 'Formel 1 Rennen eintragen',	
	'ACP_F1_RACES_TITEL_ADD_RACE_EXPLAIN'			=> 'Hier kannst Du ein neues Formel 1 Rennen erstellen',	
	'ACP_F1_RACES_RACENAME'							=> 'Austragungsort',
	'ACP_F1_RACES_RACEIMAGE'						=> 'Strecken Logo',
	'ACP_F1_RACES_RACELENGTH'						=> 'Streckenlänge',
	'ACP_F1_RACES_RACEDISTANCE'						=> 'Renndistanz',
	'ACP_F1_RACES_RACELAPS'							=> 'Anzahl der Runden',
	'ACP_F1_RACES_RACEDEBUT'						=> 'Streckendebüt',
	'ACP_F1_RACES_RACETIME'							=> 'Rennbeginn',
	'ACP_F1_RACES_RACEDEAD'							=> 'Deadline',
	'ACP_F1_RACES_EDIT_RACE'						=> 'Bearbeiten',
	'ACP_F1_RACES_TITEL_EDIT_RACE'					=> 'Formel 1 Rennen bearbeiten',	
	'ACP_F1_RACES_TITEL_EDIT_RACE_EXPLAIN'			=> 'Hier kannst Du ein Formel 1 Rennen bearbeiten',	
	'ACP_F1_RACES_DELETE_RACE'						=> 'Löschen',
	'ACP_F1_RACES_ADD'								=> 'Eintragen',
	'ACP_F1_RACES_RACE_UPDATED'						=> 'Renn Datenbank erfolgreich aktualisiert',
	'ACP_F1_RACES_RACE_DELETED'						=> 'Der Eintrag wurde erfolgreich gelöscht',
	'ACP_F1_RACES_ERROR_RACENAME'					=> 'Bitte gib alle benötigten Felder an',
	
	'ACP_F1_SETTINGS_COUNTDOWN'						=> 'Countdown',	
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN'				=> 'Countdown anzeigen',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_EXPLAIN'		=> 'Hier kannst Du festlegen, ob der Countdown im WebTipp gezeigt werden soll.',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_TITLE'			=> 'Countdown Titel',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_DESC'			=> 'Countdown Beschreibung',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_TEXT'			=> 'Text für Countdown abgelaufen',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_STOP'			=> 'Countdown bis',
));

?>