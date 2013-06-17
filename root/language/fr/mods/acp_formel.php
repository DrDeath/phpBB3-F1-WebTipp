<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/fr/mods/acp_formel.php
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

$lang = array_merge($lang, array(
	'ACP_F1_MANAGEMENT'								=> 'Formula 1 WebTip',
	'ACP_F1_SETTINGS'								=> 'Formula 1 Configuration',
	'ACP_F1_SETTINGS_EXPLAIN'						=> 'Ici vous pouvez éditer vos configurations de Formula 1 WebTipps',
	'ACP_F1_SETTINGS_CONFIG'						=> 'Formula 1 Configuration',
	'ACP_F1_SETTINGS_MODERATOR'						=> 'WebTip modérateur',
	'ACP_F1_SETTINGS_MODERATOR_EXPLAIN'				=> 'Il doit être modérateur d\'un forum',
	'ACP_F1_SETTINGS_DEACTIVATED'					=> '*** désactivé ***',
	'ACP_F1_SETTINGS_UPDATED'						=> 'Configurations changées avec succès',
	'ACP_F1_SETTINGS_ACCESS_GROUP'					=> 'WebTip Groupes',
	'ACP_F1_SETTINGS_ACCESS_GROUP_EXPLAIN'			=> 'Ici vous pouvez donnez les permissions d\'un groupe pour le WebTipp',
	'ACP_F1_SETTINGS_OFFSET'						=> 'Temps limite des pronos',
	'ACP_F1_SETTINGS_OFFSET_EXPLAIN'				=> 'Ici vous pouvez changer la limite. (Temps en seconde avant la course)',
	'ACP_F1_SETTINGS_RACEOFFSET'					=> 'Affichage prochaine course',
	'ACP_F1_SETTINGS_RACEOFFSET_EXPLAIN'			=> 'Affichage de la course après son départ (Temps en secondes après le début de la course)',
	'ACP_F1_SETTINGS_FORUM'							=> 'Forum',
	'ACP_F1_SETTINGS_FORUM_EXPLAIN'					=> 'Forum pour discuter du Formule 1',
	'ACP_F1_SETTINGS_SHOW_PROFILE'					=> 'Affichage dans le profil',
	'ACP_F1_SETTINGS_SHOW_PROFILE_EXPLAIN'			=> 'Voulez-vous les informations dans le profil?',
	'ACP_F1_SETTINGS_SHOW_VIEWTOPIC'				=> 'Affichage dans le sujet',
	'ACP_F1_SETTINGS_SHOW_VIEWTOPIC_EXPLAIN'		=> 'Voulez-vous les informations dans le sujet?',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN'				=> 'Compte à rebours des pronos',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_EXPLAIN'		=> 'Voulez vous l\'affichage du compte à rebours?',
	'ACP_F1_SETTINGS_POINTS'						=> 'Points',
	'ACP_F1_SETTINGS_POINTS_MENTIONED'				=> 'Cité',
	'ACP_F1_SETTINGS_POINTS_MENTIONED_EXPLAIN'		=> 'Points pour un pilote cité dans le Top8',
	'ACP_F1_SETTINGS_POINTS_PLACED'					=> 'Placé',
	'ACP_F1_SETTINGS_POINTS_PLACED_EXPLAIN'			=> 'Points pour un pilote placéà la bonne place',
	'ACP_F1_SETTINGS_POINTS_FASTEST'				=> 'Vitesse',
	'ACP_F1_SETTINGS_POINTS_FASTEST_EXPLAIN'		=> 'Points pour le tour le plus rapide',
	'ACP_F1_SETTINGS_POINTS_TIRED'					=> 'Abandons',
	'ACP_F1_SETTINGS_POINTS_TIRED_EXPLAIN'			=> 'Points pour le nombre correct d\'abandons',
	'ACP_F1_SETTINGS_SAFETY_CAR'					=> 'Voiture de Sécurité',
	'ACP_F1_SETTINGS_SAFETY_CAR_EXPLAIN' 			=> 'Points pour le décompte exact du déploiement de la voiture de sécurité',
	'ACP_F1_SETTINGS_PICS'							=> 'Images',
	'ACP_F1_SETTINGS_SHOW_HEADBANNER'				=> 'Montrer la bannière',
	'ACP_F1_SETTINGS_SHOW_HEADBANNER_EXPLAIN'		=> 'Ici vous pouvez définir si vous montrez ou non la bannière',
	'ACP_F1_SETTINGS_SHOW_AVATAR'					=> 'Montrer l\'avatar',
	'ACP_F1_SETTINGS_SHOW_AVATAR_EXPLAIN'			=> 'Ici vous pouvez définir si vous montrez ou non l\'avatar sur les stats des membres',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_HEIGHT'			=> 'Hauteur de bannière',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_HEIGHT_EXPLAIN'	=> 'Ici vous pouvez définir la <strong> hauteur en px</strong> de la bannière',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_WIDTH'			=> 'Longueur de bannière',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_WIDTH_EXPLAIN'	=> 'Ici vous pouvez définir la <strong>longueur en px</strong> de la bannière',
	'ACP_F1_SETTINGS_HEADBANNER1_IMG'				=> 'Bannière Webtipp',
	'ACP_F1_SETTINGS_HEADBANNER1_IMG_EXPLAIN'		=> 'Bannière pour la page de vue d\'ensemble de WebTipp',
	'ACP_F1_SETTINGS_HEADBANNER1_URL'				=> 'URL bannière WebTipp',
	'ACP_F1_SETTINGS_HEADBANNER1_URL_EXPLAIN'		=> 'URL pour la bannière de la page de vue d\'ensemble de WebTipp',
	'ACP_F1_SETTINGS_HEADBANNER2_IMG'				=> 'Bannière régles',
	'ACP_F1_SETTINGS_HEADBANNER2_IMG_EXPLAIN'		=> 'Bannière pour la page des règles de WebTipp',
	'ACP_F1_SETTINGS_HEADBANNER2_URL'				=> 'URL bannière règles',
	'ACP_F1_SETTINGS_HEADBANNER2_URL_EXPLAIN'		=> 'URL pour la bannière de la page des règles de WebTipp',
	'ACP_F1_SETTINGS_HEADBANNER3_IMG'				=> 'Bannière Statistiques',
	'ACP_F1_SETTINGS_HEADBANNER3_IMG_EXPLAIN'		=> 'Bannière pour la page des stats de WebTipp',
	'ACP_F1_SETTINGS_HEADBANNER3_URL'				=> 'URL de la bannière des stats',
	'ACP_F1_SETTINGS_HEADBANNER3_URL_EXPLAIN'		=> 'URL pour la bannière de la page des stats',
	'ACP_F1_SETTINGS_SHOW_GFXR'						=> 'Montrer les images des courses',
	'ACP_F1_SETTINGS_SHOW_GFXR_EXPLAIN'				=> 'Voulez vous montrer les images des courses?',
	'ACP_F1_SETTINGS_NO_RACE_IMG'					=> 'Image standart de la course',
	'ACP_F1_SETTINGS_NO_RACE_IMG_EXPLAIN'			=> 'Ici vous pouvez définir une image de la course, vide pour pas d\'image',
	'ACP_F1_SETTINGS_RACE_IMG_HEIGHT'				=> 'Hauteur de l\'image de la course',
	'ACP_F1_SETTINGS_RACE_IMG_HEIGHT_EXPLAIN'		=> 'Ici vous pouvez définir la <strong>hauteur en px</strong> pour l\'image de la course',
	'ACP_F1_SETTINGS_RACE_IMG_WIDTH'				=> 'Longueur de l\'image de la course',
	'ACP_F1_SETTINGS_RACE_IMG_WIDTH_EXPLAIN'		=> 'Ici vous pouvez définir la <strong>longueur en px</strong> pour l\'image de la course',
	'ACP_F1_SETTINGS_SHOW_GFX'						=> 'Montrer les images',
	'ACP_F1_SETTINGS_SHOW_GFX_EXPLAIN'				=> 'Voulez montrer les images des pilotes, des écuries et des voitures?',
	'ACP_F1_SETTINGS_NO_CAR_IMG'					=> 'Image standart des voitures',
	'ACP_F1_SETTINGS_NO_CAR_IMG_EXPLAIN'			=> 'Ici vous pouvez définir une image standart des voitures, vide pour pas d\'image',
	'ACP_F1_SETTINGS_CAR_IMG_HEIGHT'				=> 'Hauteur de l\'image des voitures',
	'ACP_F1_SETTINGS_CAR_IMG_HEIGHT_EXPLAIN'		=> 'Ici vous pouvez définir la <strong>hauteur en px</strong> des images des voitures',
	'ACP_F1_SETTINGS_CAR_IMG_WIDTH'					=> 'Longueur des images des voitures',
	'ACP_F1_SETTINGS_CAR_IMG_WIDTH_EXPLAIN'			=> 'Ici vous pouvez définir la <strong>longueur en px</strong> pour les images des voitures',
	'ACP_F1_SETTINGS_NO_DRIVER_IMG'					=> 'Images standarts des pilotes',
	'ACP_F1_SETTINGS_NO_DRIVER_IMG_EXPLAIN'			=> 'Ici vous pouvez définir les images standarts des pilotes, vide pour pas d\'image',
	'ACP_F1_SETTINGS_DRIVER_IMG_HEIGHT'				=> 'Hauteur des images des pilotes',
	'ACP_F1_SETTINGS_DRIVER_IMG_HEIGHT_EXPLAIN'		=> 'Ici vous pouvez définir la <strong>hauteur en px</strong> pour les images des pilotes',
	'ACP_F1_SETTINGS_DRIVER_IMG_WIDTH'				=> 'Longueurs des images des pilotes',
	'ACP_F1_SETTINGS_DRIVER_IMG_WIDTH_EXPLAIN'		=> 'Ici vous pouvez définir la <strong>longueur en px</strong> pour les images de pilotes',
	'ACP_F1_SETTINGS_NO_TEAM_IMG'					=> 'Images standarts des écuries',
	'ACP_F1_SETTINGS_NO_TEAM_IMG_EXPLAIN'			=> 'Ici vous pouvez dénir les images standarts des écuries, vide pour pas d\'image',
	'ACP_F1_SETTINGS_TEAM_IMG_HEIGHT'				=> 'Hauteurs des images des écuries',
	'ACP_F1_SETTINGS_TEAM_IMG_HEIGHT_EXPLAIN'		=> 'Ici vous pouvez définir la  <strong>hauteur en px</strong> pour les images des écuries',
	'ACP_F1_SETTINGS_TEAM_IMG_WIDTH'				=> 'Hauteurs des images des écuries',
	'ACP_F1_SETTINGS_TEAM_IMG_WIDTH_EXPLAIN'		=> 'Ici vous pouvez définir la  <strong>hauteur en px</strong> pour les images des écuries',
	'ACP_F1_SETTINGS_SEASON_RESET'					=> 'Reset de la saison',
	'ACP_F1_SETTINGS_SEASON_RESET_EXPLAIN'			=> '<strong>Attention:</strong> Si vous cliquez sur ce bouton, toute la saison sera perdu!<br /><br />Après reset de la saison, vous pourrez remettre à jour toutes les courses.',
	'ACP_F1_SETTINGS_SEASON_RESETTED'				=> 'Annulation de la saison. Mise à jour des courses!',
	'ACP_F1_SETTING_GUEST_VIEWING'					=> 'WebTipp visible pour les invités',
	'ACP_F1_SETTING_GUEST_VIEWING_EXPLAIN'			=> 'Seulement possible si la permission au <strong>groupe WebTip</strong> est <strong>désactivé</strong>.',
	'ACP_F1_SETTINGS_POINTS_ENABLED'				=> 'Activer Ultimate Point',
	'ACP_F1_SETTINGS_POINTS_ENABLED_EXPLAIN'		=> 'Ici vous pouvez définir s il faut permettre l octroi de points pour WebTipps ou non.<br /><strong>Hint: </strong>Seulement opérationnel si vous avez installé le mod ultimate point.',
	'ACP_F1_SETTINGS_POINTS_VALUE'					=> 'Points pour un prono donné',
	'ACP_F1_SETTINGS_POINTS_VALUE_EXPLAIN'			=> 'Ici vous pouvez définir combien <strong>de points</strong> vaut un bon prono.',
	'ACP_F1_SETTINGS_REMINDER_ENABLED'				=> 'Activer Cronjob pour les mails de rappel',
	'ACP_F1_SETTINGS_REMINDER_ENABLED_EXPLAIN'		=> 'Ici vous pouvez spécifier si un courriel de rappel doit être envoyé 2-3 jours avant le début du grand prix.<br /><strong>Attention: </strong>Ne peut être activé que lorsque les pronos F1 ont été limitée à un groupe particulier.',

	'ACP_F1_DRIVERS'								=> 'Formula 1 Pilotes',
	'ACP_F1_DRIVERS_EXPLAIN'						=> 'Ici vous pouvez ajouter ou éditer des pilotes',
	'ACP_F1_DRIVERS_ADD'							=> 'Envoyer',
	'ACP_F1_DRIVERS_ADD_DRIVER'						=> 'Ajouter un pilote',
	'ACP_F1_DRIVERS_TITEL_ADD_DRIVER'				=> 'Ajouter un pilote',
	'ACP_F1_DRIVERS_TITEL_ADD_DRIVER_EXPLAIN'		=> 'Ici vous pouvez ajouter un nouveau pilote',
	'ACP_F1_DRIVERS_DRIVERNAME'						=> 'Nom du pilote',
	'ACP_F1_DRIVERS_DRIVERIMAGE'					=> 'Image du pilote',
	'ACP_F1_DRIVERS_DRIVERTEAM'						=> 'Ecurie du pilote',
	'ACP_F1_DRIVERS_DRIVERPOINTS'					=> 'Points du pilote',
	'ACP_F1_DRIVERS_EDIT_DRIVER'					=> 'Editer',
	'ACP_F1_DRIVERS_TITEL_EDIT_DRIVER'				=> 'Editer le pilote',
	'ACP_F1_DRIVERS_TITEL_EDIT_DRIVER_EXPLAIN'		=> 'Ici vous pouvez éditer un pilote',
	'ACP_F1_DRIVERS_DELETE_DRIVER'					=> 'Effacer',
	'ACP_F1_DRIVERS_DRIVER_DELETED'					=> 'Les données du pilote sont retirées',
	'ACP_F1_DRIVERS_DRIVER_UPDATED'					=> 'Mis à jour les données du pilote',
	'ACP_F1_DRIVERS_ERROR_IMAGE'					=> 'Mettre la photo du pilote',
	'ACP_F1_DRIVERS_ERROR_DRIVERNAME'				=> 'Mettre le nom du pilote',
	'ACP_F1_DRIVERS_PENALTY'						=> 'Pénalité',
	'ACP_F1_DRIVERS_DISABLED'						=> 'Sélectionnable',

	'ACP_F1_TEAMS'									=> 'Formula 1 Ecuries',
	'ACP_F1_TEAMS_EXPLAIN'							=> 'Ici vous pouvez ajouter ou éditer une écurie',
	'ACP_F1_TEAMS_ADD_TEAM'							=> 'Ajouter une écurie',
	'ACP_F1_TEAMS_ADDTEAM_TITLE'					=> 'Ajouter une écurie',
	'ACP_F1_TEAMS_ADDTEAM_TITLE_EXPLAIN'			=> 'Ici vous pouvez ajouter une nouvelle écurie',
	'ACP_F1_TEAMS_ADDTEAM_TEAMNAME'					=> 'Nom de l\'écurie',
	'ACP_F1_TEAMS_ADDTEAM_TEAMIMAGE'				=> 'Logo de l\'écurie',
	'ACP_F1_TEAMS_ADDTEAM_TEAMCAR'					=> 'Voiture de l\'écurie',
	'ACP_F1_TEAMS_ADD'								=> 'Envoyer',
	'ACP_F1_TEAMS_EDITTEAM_TITLE'					=> 'Editer',
	'ACP_F1_TEAMS_EDITTEAM_TITLE_EXPLAIN'			=> 'Ici vous pouvez éditer une écurie',
	'ACP_F1_TEAMS_DRIVERTEAM'						=> 'Ecurie',
	'ACP_F1_TEAMS_DRIVERPOINTS'						=> 'WM Points',
	'ACP_F1_TEAMS_EDIT_TEAM'						=> 'Editer',
	'ACP_F1_TEAMS_DELETE_TEAM'						=> 'Effacer',
	'ACP_F1_TEAMS_TEAM_UPDATED'						=> 'Ecurie enregistrée',
	'ACP_F1_TEAMS_TEAM_DELETED'						=> 'Ecurie effacée',
	'ACP_F1_TEAMS_ERROR_TEAMNAME'					=> 'Donnez un nom svp',
	'ACP_F1_TEAMS_PENALTY'							=> 'Pénalité',

	'ACP_F1_RACES'									=> 'Formula 1 Courses',
	'ACP_F1_RACES_EXPLAIN'							=> 'Ici vous pouvez ajouter ou éditer une course',
	'ACP_F1_RACES_ADD_RACE'							=> 'Nouvelle course',
	'ACP_F1_RACES_TITEL_ADD_RACE'					=> 'Ajouter une course',
	'ACP_F1_RACES_TITEL_ADD_RACE_EXPLAIN'			=> 'Ici vous pouvez ajouter une nouvelle course',
	'ACP_F1_RACES_RACENAME'							=> 'Lieu',
	'ACP_F1_RACES_RACEIMAGE'						=> 'Logo',
	'ACP_F1_RACES_RACELENGTH'						=> 'longueur d\'un tour',
	'ACP_F1_RACES_RACEDISTANCE'						=> 'Distance',
	'ACP_F1_RACES_RACELAPS'							=> 'Tours',
	'ACP_F1_RACES_RACEDEBUT'						=> 'Création de la course',
	'ACP_F1_RACES_RACETIME'							=> 'Début de la course',
	'ACP_F1_RACES_RACEDEAD'							=> 'Fin des pronos',
	'ACP_F1_RACES_EDIT_RACE'						=> 'Editer',
	'ACP_F1_RACES_TITEL_EDIT_RACE'					=> 'Editer la course',
	'ACP_F1_RACES_TITEL_EDIT_RACE_EXPLAIN'			=> 'Ici vous pouvez éditer la course',
	'ACP_F1_RACES_DELETE_RACE'						=> 'Effacer',
	'ACP_F1_RACES_ADD'								=> 'Envoyer',
	'ACP_F1_RACES_RACE_UPDATED'						=> 'Course en registrée',
	'ACP_F1_RACES_RACE_DELETED'						=> 'Course effacée',
	'ACP_F1_RACES_ERROR_RACENAME'					=> 'Donnez un nom svp',
));

?>