<?php
/**
*
* umil [German]
*
* @author Nathan Guse (EXreaction) http://lithiumstudios.org
* @package phpBB3 UMIL - Unified MOD Install File
* @version $Id: umil.php 88 2009-01-28 03:51:36Z HighwayofLife $
* @copyright (c) 2009 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACTION'						=> 'Aktion',
	'ADVANCED'						=> 'Erweiterte Einstellungen',
	'AUTH_CACHE_PURGE'				=> 'Leere den Authentifizierungs-Cache',

	'CACHE_PURGE'					=> 'Leere den Forums-Cache',
	'CONFIGURE'						=> 'Konfigurieren',
	'CONFIG_ADD'					=> 'Erstelle neue Konfigurations-Variable: %s',
	'CONFIG_ALREADY_EXISTS'			=> 'ERROR: Konfigurations-Variable %s existiert bereits.',
	'CONFIG_NOT_EXIST'				=> 'ERROR: Konfigurations-Variable %s existiert nicht.',
	'CONFIG_REMOVE'					=> 'Entferne Konfigurations-Variable: %s',
	'CONFIG_UPDATE'					=> 'Aktualisiere Konfigurations-Variable: %s',

	'DISPLAY_RESULTS'				=> 'Zeige ausführliches Ergebnis',
	'DISPLAY_RESULTS_EXPLAIN'		=> 'Wähle “Ja” aus, um alle Aktionen und Ergebnisse während des ausgewählten Vorgangs anzeigen zu lassen.',

	'ERROR_NOTICE'					=> 'Ein oder mehrere Fehler sind während des ausgewählten Vorgangs aufgetreten.<br />Bitte lade <a href="%1$s">diese Datei</a>, die die aufgetretenen Fehler beinhaltet, herunter und bitte den MOD Author um Unterstützung.<br /><br />Solltest Du Problem haben diese Datei direkt herunterzuladen, versuche es über Deinen FTP Client. Der Pfad dazu lautet: %2$s',
	'ERROR_NOTICE_NO_FILE'			=> 'Ein oder mehrere Fehler sind während des ausgewählten Vorgangs aufgetreten.  Bitte notiere Dir alle aufgetretenen Fehler und bitte den MOD Author um Unterstützung.',

	'FAIL'							=> 'Fehlgeschlagen',
	'FILE_COULD_NOT_READ'			=> 'ERROR: Konnte folgende Datei zum lesen nicht öffnen: %s',
	'FOUNDERS_ONLY'					=> 'Du musst Forum Gründer sein um auf diese Seite zugreifen zu können.',

	'GROUP_NOT_EXIST'				=> 'Gruppe existiert nicht',

	'IGNORE'						=> 'Ignorieren',
	'IMAGESET_CACHE_PURGE'			=> 'Aktualisiere den %s imageset',
	'INSTALL'						=> 'Installieren',
	'INSTALL_MOD'					=> 'Installiere %s',
	'INSTALL_MOD_CONFIRM'			=> 'Bist Du bereit “%s” zu installieren?',

	'MODULE_ADD'					=> 'Erstelle %1$s Module: %2$s',
	'MODULE_ALREADY_EXIST'			=> 'ERROR: Module existiert bereits.',
	'MODULE_NOT_EXIST'				=> 'ERROR: Module existiert nicht.',
	'MODULE_REMOVE'					=> 'Entferne %1$s Module: %2$s',

	'NONE'							=> 'Keine',
	'NO_TABLE_DATA'					=> 'ERROR: Es wurden keine Tabellen Daten spezifiziert',

	'PARENT_NOT_EXIST'				=> 'ERROR: Die übergeordnete Kategorie für das angegebene Modul existiert nicht.',
	'PERMISSIONS_WARNING'			=> 'Neue Berechtigungen wurden hinzugefügt. Bitte prüfe dringend Deine Berechtigungseinstellungen um sicher zu sein, dass sie so sind wie Du es möchtest.',
	'PERMISSION_ADD'				=> 'Erstelle neue Berechtigungs-Option: %s',
	'PERMISSION_ALREADY_EXISTS'		=> 'ERROR: Berechtigungs-Option %s existiert bereits.',
	'PERMISSION_NOT_EXIST'			=> 'ERROR: PBerechtigungs-Option %s existiert nicht.',
	'PERMISSION_REMOVE'				=> 'Entferne Berechtigungs-Option: %s',
	'PERMISSION_SET_GROUP'			=> 'Setze Berechtigung für die Gruppe: %s',
	'PERMISSION_SET_ROLE'			=> 'Setze Berechtigung für die Rolle: %s',
	'PERMISSION_UNSET_GROUP'		=> 'Entferne Berechtigung von der Gruppe %s',
	'PERMISSION_UNSET_ROLE'			=> 'Entferne Berechtigung von der Rolle %s',

	'ROLE_NOT_EXIST'				=> 'Rolle existiert nicht',

	'SUCCESS'						=> 'Erfolgreich',

	'TABLE_ADD'						=> 'Erstelle neue Datenbanktabelle: %s',
	'TABLE_ALREADY_EXISTS'			=> 'ERROR: Datenbank Tabelle %s existiert bereits.',
	'TABLE_COLUMN_ADD'				=> 'Erstelle neue Spalte mit dem Namen: %2$s zur Tabelle: %1$s',
	'TABLE_COLUMN_ALREADY_EXISTS'	=> 'ERROR: Die Spalte %2$s exitiert bereits in der Tabelle %1$s.',
	'TABLE_COLUMN_NOT_EXIST'		=> 'ERROR: Die Spalte %2$s existiert in der Tabelle %1$s nicht.',
	'TABLE_COLUMN_REMOVE'			=> 'Entferne die Spalte mit dem Namen: %2$s aus der Tabelle: %1$s',
	'TABLE_COLUMN_UPDATE'			=> 'Aktualisiere die Spalte mit dem Namen: %2$s aus der Tabelle: %1$s',
	'TABLE_INSERT_DATA'				=> 'Füge Daten in die Tabelle %s ein.',
	'TABLE_KEY_ADD'					=> 'Erstelle einen Schlüssel mit dem Namen: %2$s zur Tabelle: %1$s',
	'TABLE_KEY_ALREADY_EXIST'		=> 'ERROR: Der Index: %2$s exisitert bereits in der Tabelle: %1$s.',
	'TABLE_KEY_NOT_EXIST'			=> 'ERROR: Der Index: %2$s existiert nicht in der Tabelle: %1$s.',
	'TABLE_KEY_REMOVE'				=> 'Entferne einen Schlüssel mit dem Namen: %2$s aus der Tabelle: %1$s',
	'TABLE_NOT_EXIST'				=> 'ERROR: Datenbank Tabelle: %s existiert nicht.',
	'TABLE_REMOVE'					=> 'Entferne Datenbank Tabelle: %s',
	'TEMPLATE_CACHE_PURGE'			=> 'Aktualisiere das Template: %s ',
	'THEME_CACHE_PURGE'				=> 'Aktualisiere das Theme: %s ',

	'UNINSTALL'						=> 'Deinstallieren',
	'UNINSTALL_MOD'					=> 'Deinstalliere %s',
	'UNINSTALL_MOD_CONFIRM'			=> 'Bist Du bereit “%s” zu deinstallieren?<br />Alle Einstellungen und Daten, die dieses MOD gespeichert hat gehen verloren und werden endgültig gelöscht!',
	'UNKNOWN'						=> 'Unbekannt',
	'UPDATE_MOD'					=> 'Aktualisiere %s',
	'UPDATE_MOD_CONFIRM'			=> 'Bist Du bereit “%s” zu aktualisieren?',
	'UPDATE_UMIL'					=> 'Diese Version von UMIL ist veraltet.<br /><br />Bitte lade dir die aktuellste UMIL Version (Unified MOD Install Library) von: <a href="%1$s">%1$s</a> herunter',

	'VERSIONS'						=> 'Mod Version: <strong>%1$s</strong><br />Aktuell installiert: <strong>%2$s</strong>',
	'VERSION_SELECT'				=> 'Versions-Auswahl',
	'VERSION_SELECT_EXPLAIN'		=> 'Wähle bitte nichts anderes als “Ignorieren” aus, außer Du weißt was Du tust oder jemand hat Dir gesagt dies zu tun.',
));

?>