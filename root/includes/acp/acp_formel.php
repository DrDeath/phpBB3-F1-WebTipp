<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* includes/acp/acp_formel.php
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package phpbb3f1webtipp
*/
class acp_formel
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('mods/acp_formel');

		include($phpbb_root_path . 'includes/functions_formel.' . $phpEx);

		//Select the template file
		$this->tpl_name = 'acp_formel';

		// Salting the form...yumyum ...
		add_form_key('acp_formel');

		// What are we working on?
		switch ($mode)
		{
			case 'settings':

				$reset_all			= request_var('reset_all',			0	);
				$forum_id			= request_var('forum_id', 			0	);
				$mod_id				= request_var('mod_id',				0	);
				$deadline_offset	= request_var('deadline_offset',	0	);
				$event_change		= request_var('event_change',		0	);
				$restrict_to		= request_var('restrict_to',		0	);
				$no_team_img		= request_var('no_team_img',		''	);
				$no_race_img		= request_var('no_race_img',		''	);
				$no_car_img			= request_var('no_car_img',			''	);
				$no_driver_img		= request_var('no_driver_img',		''	);
				$team_img_width		= request_var('team_img_width',		0	);
				$team_img_height	= request_var('team_img_height',	0	);
				$race_img_width		= request_var('race_img_width',		0	);
				$race_img_height	= request_var('race_img_height',	0	);
				$driver_img_width	= request_var('driver_img_width',	0	);
				$driver_img_height	= request_var('driver_img_height',	0	);
				$car_img_width		= request_var('car_img_width',		0	);
				$car_img_height		= request_var('car_img_height',		0	);
				$show_in_profile	= request_var('show_in_profile',	0	);
				$show_in_viewtopic	= request_var('show_in_viewtopic',	0	);
				$show_avatar		= request_var('show_avatar',		0	);
				$points_mentioned	= request_var('points_mentioned',	0	);
				$points_placed		= request_var('points_placed',		0	);
				$points_fastest		= request_var('points_fastest',		0	);
				$points_tired		= request_var('points_tired',		0	);
				$points_enabled		= request_var('points_enabled',		0	);
				$points_per_tip		= request_var('points_per_tip',		0	);
				$points_safety_car	= request_var('points_safety_car',	0	);

				$lang = 'ACP_F1_SETTINGS';

				$this->page_title = $lang;

				$reset_all = (isset($_POST['reset_all'])) ? true : false;

				// Reset all config data
				if ($reset_all)
				{
					// Have we confirmed with yes ?
					if (confirm_box(true))
					{
						$sql = 'TRUNCATE TABLE ' . FORMEL_TIPPS_TABLE;
						$result = $db->sql_query($sql);

						$sql = 'TRUNCATE TABLE ' . FORMEL_WM_TABLE;
						$result = $db->sql_query($sql);

						$sql_ary = array(
							'race_result'		=> 0,
							'race_quali'		=> 0,
						);

						$sql = 'UPDATE ' . FORMEL_RACES_TABLE . '
							SET ' . $db->sql_build_array('UPDATE', $sql_ary) ;
						$db->sql_query($sql);

						//remove penalty from drivers
						$sql_ary = array(
							'driver_penalty'	=> 0,
						);

						$sql = 'UPDATE ' . FORMEL_DRIVERS_TABLE . '
							SET ' . $db->sql_build_array('UPDATE', $sql_ary) ;
						$db->sql_query($sql);

						//remove penalty from teams
						$sql_ary = array(
							'team_penalty'	=> 0,
						);

						$sql = 'UPDATE ' . FORMEL_TEAMS_TABLE . '
							SET ' . $db->sql_build_array('UPDATE', $sql_ary) ;
						$db->sql_query($sql);

						add_log('admin', 'LOG_FORMEL_SAISON_RESET');

						$error = $user->lang[$lang . '_SEASON_RESETTED'];
						trigger_error($error . adm_back_link($this->u_action));
					}
					// Create a confirmbox with yes and no.
					else
					{
						$s_hidden_fields = build_hidden_fields(array(
							'reset_all'		=> true,
							)
						);

						// display mode
						confirm_box(false, $user->lang[$lang . '_SEASON_RESET_EXPLAIN'], $s_hidden_fields);
					}
				}

				// Get all config data
				$formel_config = get_formel_config();

				// Pull all config data
				$sql = 'SELECT *
					FROM ' . FORMEL_CONFIG_TABLE;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$config_name = $row['config_name'];
					$config_value = $row['config_value'];
					$default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
					$new[$config_name] = request_var($config_name, $default_config[$config_name]);

					if (isset($_POST['submit']))
					{
						// Is it salty ?
						if (!check_form_key('acp_formel'))
						{
							trigger_error('FORM_INVALID');
						}

						$sql_ary = array(
							'config_value'		=> $new[$config_name],
						);

						$sql = 'UPDATE ' . FORMEL_CONFIG_TABLE . '
							SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
							WHERE config_name = '$config_name'" ;
						$db->sql_query($sql);
					}
				}

				$db->sql_freeresult($result);

				if (isset($_POST['submit']))
				{
					add_log('admin', 'LOG_FORMEL_SETTINGS');

					$error = $user->lang[$lang . '_UPDATED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Init some vars
				$combo_mod_entries 		= '';

				$show_avatar_yes 		= ($new['show_avatar']) ? "checked=\"checked\"" : "";
				$show_avatar_no 		= (!$new['show_avatar']) ? "checked=\"checked\"" : "";

				$show_in_profile_yes 	= ($new['show_in_profile']) ? "checked=\"checked\"" : "";
				$show_in_profile_no 	= (!$new['show_in_profile']) ? "checked=\"checked\"" : "";

				$show_in_viewtopic_yes 	= ($new['show_in_viewtopic']) ? "checked=\"checked\"" : "";
				$show_in_viewtopic_no 	= (!$new['show_in_viewtopic']) ? "checked=\"checked\"" : "";

				$show_gfx_yes 			= ($new['show_gfx']) ? "checked=\"checked\"" : "";
				$show_gfx_no 			= (!$new['show_gfx']) ? "checked=\"checked\"" : "";

				$show_gfxr_yes 			= ($new['show_gfxr']) ? "checked=\"checked\"" : "";
				$show_gfxr_no 			= (!$new['show_gfxr']) ? "checked=\"checked\"" : "";

				$show_headbanner_yes 	= ($new['show_headbanner']) ? "checked=\"checked\"" : "";
				$show_headbanner_no 	= (!$new['show_headbanner']) ? "checked=\"checked\"" : "";

				$show_countdown_yes 	= ($new['show_countdown']) ? "checked=\"checked\"" : "";
				$show_countdown_no 		= (!$new['show_countdown']) ? "checked=\"checked\"" : "";

				$guest_viewing_yes 		= ($new['guest_viewing']) ? "checked=\"checked\"" : "";
				$guest_viewing_no 		= (!$new['guest_viewing']) ? "checked=\"checked\"" : "";

				$points_enabled_yes		= ($new['points_enabled']) ? "checked=\"checked\"" : "";
				$points_enabled_no 		= (!$new['points_enabled']) ? "checked=\"checked\"" : "";

				//Get all possible moderators
				$sql = 'SELECT u.username, u.user_id
					FROM	' . MODERATOR_CACHE_TABLE . ' mc, ' . USER_GROUP_TABLE . ' ug, 	' . USERS_TABLE. ' u
					WHERE ug.group_id = mc.group_id
						AND ug.user_id = u.user_id
						AND ug.user_pending = 0
					GROUP BY ug.user_id
					ORDER BY u.username';

				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$selected = ($row['user_id'] == $new['mod_id']) ? 'selected' : '';
					$combo_mod_entries .= '<option value="' . $row['user_id'] . '" ' . $selected . '>' . $row['username'] . '</option>';
				}

				// If no normal moderator was found, select all possible founders.
				if (empty($combo_mod_entries))
				{
					$sql = ' SELECT username, user_id, user_type
						FROM	' . USERS_TABLE. '
						WHERE user_type = ' . USER_FOUNDER . '
						ORDER BY username';
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$selected = ($row['user_id'] == $new['mod_id'] ) ? 'selected' : '';
						$combo_mod_entries .= '<option value="' . $row['user_id'] . '" ' . $selected . '>' . $row['username'] . '</option>';
					}
				}

				// Generate possible mods combobox
				$mods_combo		 = '<select name="mod_id">';
				$mods_combo		.= $combo_mod_entries;
				$mods_combo		.= '</select>';

				// Get all group data
				// Don't select the default phpBB3 groups
				// If choosen "deactivated" - all "registered user" have access.
				$combo_groups_entries = '';

				$sql = 'SELECT *
					FROM ' . GROUPS_TABLE . '
					WHERE group_type <> ' . GROUP_SPECIAL ;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$selected = ($row['group_id'] == $formel_config['restrict_to']) ? 'selected' : '';
					$combo_groups_entries .= '<option value="' . $row['group_id'] . '" ' . $selected . '>' . $row['group_name'] . '</option>';
				}

				$db->sql_freeresult($result);

				// Generate groups combobox
				$selected = ($formel_config['restrict_to'] == 0) ? 'selected' : '';
				$group_combo	 = '<select name="restrict_to">';
				$group_combo	.= '<option value="0" ' . $selected . '>' . $user->lang[$lang . '_DEACTIVATED'] . '</option>';
				$group_combo	.= $combo_groups_entries;
				$group_combo	.= '</select>';

				// Get all forum data - Don't select categories or links
				$combo_forums_entries = '';

				$sql = 'SELECT forum_id, forum_name, forum_type
					FROM ' . FORUMS_TABLE . '
					WHERE forum_type <> ' . FORUM_CAT . '
						AND forum_type <> ' . FORUM_LINK . '
					ORDER BY forum_name ASC';
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$selected = ($row['forum_id'] == $new['forum_id'] ) ? 'selected' : '';
					$combo_forums_entries .= '<option value="' . $row['forum_id'] . '" ' . $selected . '>' . $row['forum_name'] . '</option>';
				}
				$db->sql_freeresult($result);

				// Generate forums combobox
				$selected		 = ($new['forum_id'] == 0) ? 'selected' : '';
				$forums_combo	 = '<select name="forum_id">';
				$forums_combo	.= '<option value="0" ' . $selected . '>' . $user->lang[$lang . '_DEACTIVATED'] . '</option>';
				$forums_combo	.= $combo_forums_entries;
				$forums_combo	.= '</select>';

				if ($new['show_headbanner'])
				{
					$template->assign_block_vars('headbanner_on', array());
				}

				if ($new['show_gfxr'])
				{
					$template->assign_block_vars('gfxr_on', array());
				}

				if ($new['show_gfx'])
				{
					$template->assign_block_vars('gfx_on', array());
				}

				if ($new['points_enabled'])
				{
					$template->assign_block_vars('points_on', array());
				}

				$template->assign_vars(array(
					'D_MODERATOR'						=> $mods_combo,
					'D_ACCESS_GROUP'					=> $group_combo,
					'D_FORUM'							=> $forums_combo,

					'S_SETTING'							=> true,
					'S_SHOW_AVATAR_YES'					=> $show_avatar_yes,
					'S_SHOW_AVATAR_NO'					=> $show_avatar_no,
					'S_SHOW_IN_PROFILE_YES'				=> $show_in_profile_yes,
					'S_SHOW_IN_PROFILE_NO'				=> $show_in_profile_no,
					'S_SHOW_IN_VIEWTOPIC_YES'			=> $show_in_viewtopic_yes,
					'S_SHOW_IN_VIEWTOPIC_NO'			=> $show_in_viewtopic_no,
					'S_SHOW_HEADBANNER_NO'				=> $show_headbanner_no,
					'S_SHOW_HEADBANNER_YES'				=> $show_headbanner_yes,
					'S_SHOW_GFXR_NO'					=> $show_gfxr_no,
					'S_SHOW_GFXR_YES'					=> $show_gfxr_yes,
					'S_SHOW_GFX_NO'						=> $show_gfx_no,
					'S_SHOW_GFX_YES'					=> $show_gfx_yes,
					'S_SHOW_COUNTDOWN_YES'				=> $show_countdown_yes,
					'S_SHOW_COUNTDOWN_NO'				=> $show_countdown_no,
					'S_GUEST_VIEWING_YES'				=> $guest_viewing_yes,
					'S_GUEST_VIEWING_NO'				=> $guest_viewing_no,
					'S_POINTS_ENABLED_YES'				=> $points_enabled_yes,
					'S_POINTS_ENABLED_NO'				=> $points_enabled_no,

					'ACP_F1_SETTING_OFFSET'					=> $formel_config['deadline_offset'],
					'ACP_F1_SETTING_RACEOFFSET'				=> $formel_config['event_change'],
					'ACP_F1_SETTING_FORUM'					=> $formel_config['forum_id'],
					'ACP_F1_SETTING_SHOW_IN_PROFILE'		=> $new['show_in_profile'],
					'ACP_F1_SETTING_SHOW_IN_VIEWTOPIC'		=> $new['show_in_viewtopic'],
					'ACP_F1_SETTING_POINTS_MENTIONED'		=> $new['points_mentioned'],
					'ACP_F1_SETTING_POINTS_PLACED'			=> $new['points_placed'],
					'ACP_F1_SETTING_POINTS_FASTEST'			=> $new['points_fastest'],
					'ACP_F1_SETTING_POINTS_TIRED'			=> $new['points_tired'],
					'ACP_F1_SETTING_POINTS_SAFETY_CAR'		=> $new['points_safety_car'],
					'ACP_F1_SETTING_HEADBANNER_IMG_HEIGHT'	=> $new['head_height'],
					'ACP_F1_SETTING_HEADBANNER_IMG_WIDTH'	=> $new['head_width'],
					'ACP_F1_SETTING_HEADBANNER1_IMG'		=> $new['headbanner1_img'],
					'ACP_F1_SETTING_HEADBANNER1_URL'		=> $new['headbanner1_url'],
					'ACP_F1_SETTING_HEADBANNER2_IMG'		=> $new['headbanner2_img'],
					'ACP_F1_SETTING_HEADBANNER2_URL'		=> $new['headbanner2_url'],
					'ACP_F1_SETTING_HEADBANNER3_IMG'		=> $new['headbanner3_img'],
					'ACP_F1_SETTING_HEADBANNER3_URL'		=> $new['headbanner3_url'],
					'ACP_F1_SETTING_NO_RACE_IMG'			=> $new['no_race_img'],
					'ACP_F1_SETTING_RACE_IMG_HEIGHT'		=> $new['race_img_height'],
					'ACP_F1_SETTING_RACE_IMG_WIDTH'			=> $new['race_img_width'],
					'ACP_F1_SETTING_NO_CAR_IMG'				=> $new['no_car_img'],
					'ACP_F1_SETTING_CAR_IMG_HEIGHT'			=> $new['car_img_height'],
					'ACP_F1_SETTING_CAR_IMG_WIDTH'			=> $new['car_img_width'],
					'ACP_F1_SETTING_NO_DRIVER_IMG'			=> $new['no_driver_img'],
					'ACP_F1_SETTING_DRIVER_IMG_HEIGHT'		=> $new['driver_img_height'],
					'ACP_F1_SETTING_DRIVER_IMG_WIDTH'		=> $new['driver_img_width'],
					'ACP_F1_SETTING_NO_TEAM_IMG'			=> $new['no_team_img'],
					'ACP_F1_SETTING_TEAM_IMG_HEIGHT'		=> $new['team_img_height'],
					'ACP_F1_SETTING_TEAM_IMG_WIDTH'			=> $new['team_img_width'],
					'ACP_F1_SETTING_SHOW_COUNTDOWN'			=> $new['show_countdown'],
					'ACP_F1_SETTING_GUEST_VIEWING'			=> $new['guest_viewing'],
					'ACP_F1_SETTING_POINTS_VALUE'			=> $new['points_value'],
					'ACP_F1_SETTING_SHOW_AVATAR'			=> $new['show_avatar'],
					)
				);

			break;

			case 'drivers':

				$lang = 'ACP_F1_DRIVERS';
				$this->page_title = $lang;

				$reset_all = (isset($_POST['reset_all'])) ? true : false;

				// Check buttons
				$button_adddriver 	= (isset($_POST['adddriver'])) 	? true : false;
				$button_add 		= (isset($_POST['add'])) 		? true : false;
				$button_del 		= (isset($_POST['del'])) 		? true : false;
				$button_edit 		= (isset($_POST['edit'])) 		? true : false;

				// Check data
				$driverimg			= request_var('driverimg'		,	''	);
				$drivername			= request_var('drivername'		,	''	,	true	);
				$driverteam			= request_var('driverteam'		,	0	);
				$driver_id			= request_var('driver_id'		,	0	);
				$driver_penalty		= request_var('driver_penalty'	,	0.0	);
				$driver_disabled	= request_var('driver_disabled'	,	0	);

				// Init some vars
				$formel_config = get_formel_config();

				// Add a new entry
				if ($button_add && $drivername <> '')
				{
					// Is it salty ?
					if (!check_form_key('acp_formel'))
					{
						trigger_error('FORM_INVALID');
					}

					if ($driver_id == 0)
					{
						$sql_ary = array(
							'driver_name'		=> $drivername,
							'driver_img'		=> $driverimg,
							'driver_team'		=> $driverteam,
							'driver_penalty'	=> $driver_penalty,
							'driver_disabled'	=> $driver_disabled,
						);

						$db->sql_query('INSERT INTO ' . FORMEL_DRIVERS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));

						add_log('admin', 'LOG_FORMEL_DRIVER_ADDED');
					}
					else
					{
						if ($formel_config['show_gfx'] == 1)
						{
							$sql_ary = array(
								'driver_name'		=> $drivername,
								'driver_img'		=> $driverimg,
								'driver_team'		=> $driverteam,
								'driver_penalty'	=> $driver_penalty,
								'driver_disabled'	=> $driver_disabled,
							);

							$sql = 'UPDATE ' . FORMEL_DRIVERS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
								WHERE driver_id = $driver_id";
							$db->sql_query($sql);
						}
						else
						{
							$sql_ary = array(
								'driver_name'		=> $drivername,
								'driver_team'		=> $driverteam,
								'driver_penalty'	=> $driver_penalty,
								'driver_disabled'	=> $driver_disabled,
							);

							$sql = 'UPDATE ' . FORMEL_DRIVERS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
								WHERE driver_id = $driver_id";
							$db->sql_query($sql);
						}

						add_log('admin', 'LOG_FORMEL_DRIVER_EDITED', $driver_id);
					}

					$error = $user->lang[$lang . '_DRIVER_UPDATED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Delete an entry
				if ($button_del && $driver_id <> 0)
				{
					// Is it salty ?
					if (!check_form_key('acp_formel'))
					{
						trigger_error('FORM_INVALID');
					}

					$sql = 'DELETE FROM ' . FORMEL_DRIVERS_TABLE . '
							WHERE driver_id = ' . (int) $driver_id;
					$db->sql_query($sql);

					add_log('admin', 'LOG_FORMEL_DRIVER_DELETED', $driver_id);

					$error = $user->lang[$lang . '_DRIVER_DELETED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Load add- oder editpage
				if ($button_adddriver || ($button_edit && $driver_id <> 0) || ($button_add && $drivername == ''))
				{
					$preselected_id = '';

					// Create error messages
					if ($button_add && $drivername == '')
					{
						$error	 = $user->lang[$lang . '_ERROR_DRIVERNAME'];
						$error	.= ($button_add && $driverimg == '') ? '<br />' . $user->lang[$lang . '_ERROR_IMAGE'] : '';
						trigger_error($error . adm_back_link($this->u_action));
					}

					// Init some vars
					$title_exp 	= $user->lang[$lang . '_TITEL_ADD_DRIVER_EXPLAIN'];
					$title 		= $user->lang[$lang . '_TITEL_ADD_DRIVER'];

					// Load initial values
					if ($button_edit || ($button_add && $drivername == ''))
					{
						// overwrites the "add driver" title and sets the "edit driver" title
						$title_exp 	= $user->lang[$lang . '_TITEL_EDIT_DRIVER_EXPLAIN']; // overwrites the "add driver" title and sets the "edit driver" title
						$title 		= $user->lang[$lang . '_TITEL_EDIT_DRIVER'];

						// Get drivers data
						$sql = 'SELECT *
							FROM ' . FORMEL_DRIVERS_TABLE . '
							WHERE driver_id = ' . (int) $driver_id . '
								ORDER BY driver_name';
						$result = $db->sql_query($sql);

						$row = $db->sql_fetchrow($result);

						if ($button_edit)
						{
							$drivername 	= $row['driver_name'];
						}

						$driverimg 			= $row['driver_img'];
						$preselected_id 	= $row['driver_team'];
						$driver_penalty 	= $row['driver_penalty'];
						$driver_disabled 	= $row['driver_disabled'];

						$db->sql_freeresult($result);
					}

					// Get all teams data
					$sql = 'SELECT *
						FROM ' . FORMEL_TEAMS_TABLE . '
						ORDER BY team_name';
					$result = $db->sql_query($sql);

					// Fill combobox
					while ($row = $db->sql_fetchrow($result))
					{
						$preselected = ($row['team_id'] == $preselected_id) ? 'selected' : '';

						$template->assign_block_vars('teamrow', array(
							'TEAMNAME'		=> $row['team_name'],
							'TEAM_ID'		=> $row['team_id'],
							'PRESELECTED'	=> $preselected,
							)
						);
					}

					$db->sql_freeresult($result);

					// Generate page
					if ($formel_config['show_gfx'] == 1)
					{
						$template->assign_block_vars('gfx_on', array());
					}

					$template->assign_vars(array(
						'U_ACTION'					=> $this->u_action,
						'S_ADDDRIVERS'				=> true,
						'FORMEL_IMG'				=> $phpbb_root_path . 'images/formel/formel_drivers.jpg',
						'PREDEFINED_NAME'			=> $drivername,
						'PREDEFINED_IMG'			=> $driverimg,
						'PREDEFINED_PENALTY'		=> $driver_penalty,
						'S_DRIVER_DISABLED'			=> ($driver_disabled == true) ? "checked=\"checked\"" : "",
						'S_DRIVER_ENABLED'			=> ($driver_disabled == false) ? "checked=\"checked\"" : "",
						'DRIVER_ID'					=> $driver_id,
						'L_ACP_F1_DRIVERS_EXPLAIN'	=> $title_exp,
						'L_ACP_F1_DRIVERS'			=> $title,
						)
					);
				}
				else
				{
					// Load the driver overview page
					// Get all teams data
					$sql = 'SELECT *
						FROM ' . FORMEL_TEAMS_TABLE . '
						ORDER BY team_name';
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$teams[$row['team_id']]		= $row['team_name'];
						$teamlogos[$row['team_id']]	= $row['team_img'];
					}

					$db->sql_freeresult($result);

					// Get all drivers data
					$sql = 'SELECT *
						FROM ' . FORMEL_DRIVERS_TABLE . '
						ORDER BY driver_name';
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$driverimg			= $row['driver_img'];
						$current_user_id	= $row['driver_id'];
						$driverimg			= ($driverimg == '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_driver_img'] . '" width="' . $formel_config['driver_img_width'] . '" height="' . $formel_config['driver_img_height'] . '" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $driverimg . '" width="' . $formel_config['driver_img_width'] . '" height="' . $formel_config['driver_img_height'] . '" alt="">';
						$driver_penalty 	= $row['driver_penalty'];
						$driver_disabled 	= $row['driver_disabled'];

						$pointssql = 'SELECT SUM(wm_points) AS total_points
							FROM ' . FORMEL_WM_TABLE . '
							WHERE wm_driver = ' . (int) $current_user_id;
						$user_points = $db->sql_query($pointssql);

						$driver_points = $db->sql_fetchrow($user_points);
						$points = ($driver_points['total_points'] <> '') ? $driver_points['total_points'] - $driver_penalty : 0 - $driver_penalty;

						$db->sql_freeresult($user_points);

						if ($formel_config['show_gfx'] == 1)
						{
							$template->assign_block_vars('driverrow_gfx', array(
								'DRIVERNAME'		=> $row['driver_name'],
								'DRIVERID'			=> $row['driver_id'],
								'DRIVERIMG'			=> $driverimg,
								'DRIVERTEAM'		=> (isset($teams[$row['driver_team']])) ? $teams[$row['driver_team']] : '',
								'DRIVERPOINTS'		=> $points,
								'DRIVER_PENALTY'	=> $driver_penalty,
								'DRIVER_DISABLED'	=> ($driver_disabled == true) ? $user->lang['NO'] : $user->lang['YES'],
								)
							);
						}
						else
						{
							$template->assign_block_vars('driverrow', array(
								'DRIVERNAME'		=> $row['driver_name'],
								'DRIVERID'			=> $row['driver_id'],
								'DRIVERIMG'			=> $driverimg,
								'DRIVERTEAM'		=> (isset($teams[$row['driver_team']])) ? $teams[$row['driver_team']] : '',
								'DRIVERPOINTS'		=> $points,
								'DRIVER_PENALTY'	=> $driver_penalty,
								'DRIVER_DISABLED'	=> ($driver_disabled == true) ? $user->lang['NO'] : $user->lang['YES'],
								)
							);
						}
					}

					$db->sql_freeresult($result);

					$colspan = 7;

					if ($formel_config['show_gfx'] == 1)
					{
						$colspan = 8;
						$template->assign_block_vars('gfx_on', array());
					}

					// Generate page
					$template->assign_vars(array(
						'U_ACTION'			=> $this->u_action,
						'S_DRIVERS'			=> true,
						'FORMEL_IMG'		=> $phpbb_root_path . 'images/formel/formel_drivers.jpg',
						'COLSPAN'			=> $colspan,
						'DRIVER_ID'			=> $driver_id,
						)
					);
				}

			break;

			case 'teams':

				$lang = 'ACP_F1_TEAMS';

				$this->page_title = $lang;

				// Check buttons & data
				$button_addteam 	= (isset($_POST['addteam'])) 	? true : false;
				$button_add 		= (isset($_POST['add'])) 		? true : false;
				$button_del 		= (isset($_POST['del'])) 		? true : false;
				$button_edit 		= (isset($_POST['edit'])) 		? true : false;

				$teamimg 			= request_var('teamimg'		,	''	,	true	);
				$teamcar 			= request_var('teamcar'		,	''	,	true	);
				$teamname 			= request_var('teamname'	,	''	,	true	);
				$team_id 			= request_var('team_id'		,	0	);
				$team_penalty		= request_var('team_penalty',	0.0	);

				// Init some vars
				$formel_config = get_formel_config();

				// Add a new team
				if ($button_add && $teamname <> '')
				{
					// Is it salty ?
					if (!check_form_key('acp_formel'))
					{
						trigger_error('FORM_INVALID');
					}

					if ($team_id == 0)
					{
						$sql_ary = array(
							'team_name'		=> $teamname,
							'team_img'		=> $teamimg,
							'team_car'		=> $teamcar,
							'team_penalty'	=> $team_penalty,
						);

						$db->sql_query('INSERT INTO ' . FORMEL_TEAMS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));

						add_log('admin', 'LOG_FORMEL_TEAM_ADDED');
					}
					else
					{
						if ($formel_config['show_gfx'] == 1)
						{
							$sql_ary = array(
								'team_name'		=> $teamname,
								'team_img'		=> $teamimg,
								'team_car'		=> $teamcar,
								'team_penalty'	=> $team_penalty,
							);

							$sql = 'UPDATE ' . FORMEL_TEAMS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE team_id = ' . (int) $team_id;

							$db->sql_query($sql);
						}
						else
						{
							$sql_ary = array(
								'team_name'		=> $teamname,
								'team_penalty'	=> $team_penalty,
							);

							$sql = 'UPDATE ' . FORMEL_TEAMS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE team_id = ' . (int) $team_id;

							$db->sql_query($sql);
						}

						add_log('admin', 'LOG_FORMEL_TEAM_EDITED', $team_id);
					}

					$error = $user->lang[$lang . '_TEAM_UPDATED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Delete an entry
				if ($button_del && $team_id <> 0)
				{
					// Is it salty ?
					if (!check_form_key('acp_formel'))
					{
						trigger_error('FORM_INVALID');
					}

					$sql = 'DELETE FROM ' . FORMEL_TEAMS_TABLE . '
							WHERE team_id = ' . (int) $team_id;
					$db->sql_query($sql);

					add_log('admin', 'LOG_FORMEL_TEAM_DELETED', $team_id);

					$error = $user->lang[$lang . '_TEAM_DELETED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Load add oder edit team
				if ($button_addteam || ($button_edit && $team_id <> 0) || ($button_add && $teamname == ''))
				{
					if ($button_add && $teamname == '')
					{
						$error  = $user->lang[$lang . '_ERROR_TEAMNAME'];
						trigger_error($error . adm_back_link($this->u_action));
					}

					// Init some vars
					$title_exp = $user->lang[$lang . '_ADDTEAM_TITLE_EXPLAIN'];
					$title = $user->lang[$lang . '_ADDTEAM_TITLE'];

					// Load values
					if ($button_edit)
					{
						$title_exp = $user->lang[$lang . '_EDITTEAM_TITLE_EXPLAIN'];
						$title = $user->lang[$lang . '_EDITTEAM_TITLE'];

						$sql = 'SELECT *
							FROM ' . FORMEL_TEAMS_TABLE . '
							WHERE team_id = ' . (int) $team_id . '
							ORDER BY team_name';
						$result = $db->sql_query($sql);

						$row = $db->sql_fetchrow($result);

						$teamname		= $row['team_name'];
						$teamimg		= $row['team_img'];
						$teamcar		= $row['team_car'];
						$team_penalty 	= $row['team_penalty'];

						$db->sql_freeresult($result);
					}

					// Generate page
					if ($formel_config['show_gfx'] == 1)
					{
						$template->assign_block_vars('gfx_on', array());
					}

					$template->assign_vars(array(
						'S_ADDTEAM'					=> true,
						'FORMEL_IMG'				=> $phpbb_root_path . 'images/formel/formel_teams.jpg',
						'PREDEFINED_NAME'			=> $teamname,
						'PREDEFINED_IMG'			=> $teamimg,
						'PREDEFINED_CAR'			=> $teamcar,
						'PREDEFINED_ID'				=> $team_id,
						'PREDEFINED_PENALTY'		=> $team_penalty,
						'L_ACP_F1_TEAMS_EXPLAIN'	=> $title_exp,
						'L_ACP_F1_TEAMS'			=> $title,
						)
					);
				}
				else
				{
					// Load the team overview page
					// Fetch all teams
					$sql = 'SELECT *
						FROM ' . FORMEL_TEAMS_TABLE . '
						ORDER BY team_name';
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$team_img		= $row['team_img'];
						$team_car		= $row['team_car'];
						$current_team	= $row['team_id'];
						$team_img		= ($team_img == '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_team_img'] . '" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $team_img . '" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" alt="">';
						$team_car		= ($team_car == '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_car_img'] . '" width="' . $formel_config['car_img_width'] . '" height="' . $formel_config['car_img_height'] . '" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $team_car . '" width="' . $formel_config['car_img_width'] . '" height="' . $formel_config['car_img_height'] . '" alt="">';
						$team_penalty 	= $row['team_penalty'];

						$pointssql		= '	SELECT SUM(wm_points) AS total_points
											FROM ' . FORMEL_WM_TABLE . '
											WHERE wm_team = ' . (int) $current_team;
						$team_points = $db->sql_query($pointssql);

						$current_points = $db->sql_fetchrow($team_points);

						$points = ($current_points['total_points'] <> '') ? $current_points['total_points'] - $team_penalty: 0 - $team_penalty;

						$db->sql_freeresult($team_points);

						if ($formel_config['show_gfx'] == 1)
						{
							$template->assign_block_vars('teamrow_gfx', array(
								'TEAMNAME'		=> $row['team_name'],
								'TEAMID'		=> $row['team_id'],
								'POINTS'		=> $points,
								'TEAMIMG'		=> $team_img,
								'TEAMCAR'		=> $team_car,
								'TEAM_PENALTY'	=> $team_penalty,
								)
							);
						}
						else
						{
							$template->assign_block_vars('teamrow', array(
								'TEAMNAME'		=> $row['team_name'],
								'TEAMID'		=> $row['team_id'],
								'POINTS'		=> $points,
								'TEAMIMG'		=> $team_img,
								'TEAMCAR'		=> $team_car,
								'TEAM_PENALTY'	=> $team_penalty,
								)
							);
						}
					}

					$db->sql_freeresult($result);

					// Generate page
					$colspan = 5;

					if ($formel_config['show_gfx'] == 1)
					{
						$colspan = 7;
						$template->assign_block_vars('gfx_on', array());
					}

					$template->assign_vars(array(
						'U_ACTION'		=> $this->u_action,
						'S_TEAMS'		=> true,
						'FORMEL_IMG'	=> $phpbb_root_path . 'images/formel/formel_teams.jpg',
						'COLSPAN'		=> $colspan,
						)
					);
				}
			break;

			case 'races':

				$lang = 'ACP_F1_RACES';

				$this->page_title = $lang;

				// Check buttons & data
				$button_addrace = (isset($_POST['addrace'])) 	? true : false;
				$button_add 	= (isset($_POST['add'])) 		? true : false;
				$button_del 	= (isset($_POST['del'])) 		? true : false;
				$button_edit 	= (isset($_POST['edit'])) 		? true : false;

				$b_day 			= request_var('c_day'			,	$user->format_date(time(),"d")	);
				$b_month 		= request_var('c_month'			,	$user->format_date(time(),"n")	);
				$b_year 		= request_var('c_year'			,	$user->format_date(time(),"Y")	);
				$b_hour 		= request_var('c_hour'			,	$user->format_date(time(),"G")	);
				$b_minute 		= request_var('c_minute'		,	0	);
				$b_second 		= request_var('c_second'		,	0	);

				$raceimg 		= request_var('raceimg'			,	''	,	true	);
				$racename 		= request_var('racename'		,	''	,	true	);
				$racelength 	= request_var('racelength'		,	''	,	true	);
				$racedistance 	= request_var('racedistance'	,	''	,	true	);
				$racelaps 		= request_var('racelaps'		,	0	,	true	);
				$racedebut 		= request_var('racedebut'		,	0	,	true	);

				$race_id 		= request_var('race_id'			,	0	);

				// Get all config data
				$formel_config = get_formel_config();

				// Add a new race
				if ($button_add && $racename == '')
				{
					$error  = $user->lang[$lang . '_ERROR_RACENAME'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				if ($button_add && $racename <> '')
				{
					// Is it salty ?
					if (!check_form_key('acp_formel'))
					{
						trigger_error('FORM_INVALID');
					}

					$racetime = mktime($b_hour, $b_minute, $b_second, $b_month, $b_day, $b_year, date("I"));

					if ( $race_id == 0 )
					{
						$sql_ary = array(
							'race_name'		=> $racename,
							'race_img'		=> $raceimg,
							'race_time'		=> $racetime,
							'race_length'	=> $racelength,
							'race_laps'		=> $racelaps,
							'race_distance'	=> $racedistance,
							'race_debut'	=> $racedebut
						);

						$db->sql_query('INSERT INTO ' . FORMEL_RACES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));

						add_log('admin', 'LOG_FORMEL_RACE_ADDED');
					}
					else
					{
						if ($formel_config['show_gfxr'] == 1)
						{
							$sql_ary = array(
								'race_name'		=> $racename,
								'race_img'		=> $raceimg,
								'race_time'		=> $racetime,
								'race_length'	=> $racelength,
								'race_laps'		=> $racelaps,
								'race_distance'	=> $racedistance,
								'race_debut'	=> $racedebut
							);

							$sql = 'UPDATE ' . FORMEL_RACES_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE race_id = ' . (int) $race_id;
							$db->sql_query($sql);
						}
						else
						{
							$sql_ary = array(
								'race_name'		=> $racename,
								'race_time'		=> $racetime,
								'race_length'	=> $racelength,
								'race_laps'		=> $racelaps,
								'race_distance'	=> $racedistance,
								'race_debut'	=> $racedebut
							);

							$sql = 'UPDATE ' . FORMEL_RACES_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE race_id = ' . (int) $race_id;
							$db->sql_query($sql);
						}

						add_log('admin', 'LOG_FORMEL_RACE_EDITED', $race_id);
					}

					$error = $user->lang[$lang . '_RACE_UPDATED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Delete a race
				if ($button_del && $race_id <> 0)
				{
					// Is it salty ?
					if (!check_form_key('acp_formel'))
					{
						trigger_error('FORM_INVALID');
					}

					$sql = 'DELETE FROM ' . FORMEL_RACES_TABLE . '
							WHERE race_id = ' . (int) $race_id;
					$db->sql_query($sql);

					add_log('admin', 'LOG_FORMEL_RACE_DELETED', $race_id);

					$error = $user->lang[$lang . '_RACE_DELETED'];
					trigger_error($error . adm_back_link($this->u_action));
				}

				// Load add oder edit race
				if ($button_addrace || ($button_edit && $race_id <> 0) || ($button_add && $racename == ''))
				{
					$title_exp 	= $user->lang[$lang . '_TITEL_ADD_RACE_EXPLAIN'];
					$title 		= $user->lang[$lang . '_TITEL_ADD_RACE'];

					// Load values
					if ($button_edit)
					{
						$title_exp 		= $user->lang[$lang . '_TITEL_EDIT_RACE_EXPLAIN'];
						$title 			= $user->lang[$lang . '_TITEL_EDIT_RACE'];

						$sql 			= '	SELECT *
											FROM ' . FORMEL_RACES_TABLE . '
											WHERE race_id = ' . (int) $race_id;
						$result = $db->sql_query($sql);

						$row 			= $db->sql_fetchrow($result);

						$racename 		= $row['race_name'];
						$raceimg 		= $row['race_img'];
						$racelength 	= $row['race_length'];
						$racelaps 		= $row['race_laps'];
						$racedistance 	= $row['race_distance'];
						$racedebut 		= $row['race_debut'];
						$racetime 		= $row['race_time'];

						$b_day 		= $user->format_date($racetime, "j");
						$b_month 	= $user->format_date($racetime, "n");
						$b_year 	= $user->format_date($racetime, "Y");
						$b_hour 	= $user->format_date($racetime, "G");
						$b_minute 	= $user->format_date($racetime, "i");
						$b_second 	= $user->format_date($racetime, "s");

						$db->sql_freeresult($result);
					}

					// Day month year hour minute second comboboxes
					$c_day = '<select name="c_day" size="1" class="gensmall">';

					for ($i = 1; $i < 32; ++$i)
					{
						$c_day .= '<option value="' . $i . '">&nbsp;' . $i . '&nbsp;</option>';
					}

					$c_day .= '</select>';
					$c_month = '<select name="c_month" size="1" class="gensmall">
								<option value="1">&nbsp;' . $user->lang['datetime']['January'] . '&nbsp;</option>
								<option value="2">&nbsp;' . $user->lang['datetime']['February'] . '&nbsp;</option>
								<option value="3">&nbsp;' . $user->lang['datetime']['March'] . '&nbsp;</option>
								<option value="4">&nbsp;' . $user->lang['datetime']['April'] . '&nbsp;</option>
								<option value="5">&nbsp;' . $user->lang['datetime']['May'] . '&nbsp;</option>
								<option value="6">&nbsp;' . $user->lang['datetime']['June'] . '&nbsp;</option>
								<option value="7">&nbsp;' . $user->lang['datetime']['July'] . '&nbsp;</option>
								<option value="8">&nbsp;' . $user->lang['datetime']['August'] . '&nbsp;</option>
								<option value="9">&nbsp;' . $user->lang['datetime']['September'] . '&nbsp;</option>
								<option value="10">&nbsp;' . $user->lang['datetime']['October'] . '&nbsp;</option>
								<option value="11">&nbsp;' . $user->lang['datetime']['November'] . '&nbsp;</option>
								<option value="12">&nbsp;' . $user->lang['datetime']['December'] . '&nbsp;</option>
								</select>';
					$c_hour = '<select name="c_hour" size="1" class="gensmall">';

					for ($i = 0; $i < 24; ++$i)
					{
						$c_hour .= '<option value="' . $i . '">&nbsp;' . $i . '&nbsp;</option>';
					}

					$c_hour .= '</select>';

					$c_minute = '<select name="c_minute" size="1" class="gensmall">';
					$c_second = '<select name="c_second" size="1" class="gensmall">';

					for ($i = 0; $i < 60; ++$i)
					{
						$j = ($i < 10) ? '0' : '';
						$c_minute .= '<option value="' . $i . '">&nbsp;' . $j . $i . '&nbsp;</option>';
						$c_second .= '<option value="' . $i . '">&nbsp;' . $j . $i .'&nbsp;</option>';
					}

					$c_minute .= '</select>';
					$c_second .= '</select>';

					$c_day 		= str_replace("value=\"" . $b_day . "\">", "value=\"" . $b_day . "\" SELECTED>" ,$c_day);
					$c_month 	= str_replace("value=\"" . $b_month . "\">", "value=\"" . $b_month . "\" SELECTED>" ,$c_month);
					$c_year 	= '<input type="text" class="post" name="c_year" size="4" maxlength="4" value="' . $b_year . '" />';
					$c_hour 	= str_replace("value=\"" . $b_hour . "\">", "value=\"" . $b_hour . "\" SELECTED>" ,$c_hour);
					$c_minute 	= str_replace("value=\"" . $b_minute . "\">", "value=\"" . $b_minute . "\" SELECTED>" ,$c_minute);
					$c_second 	= str_replace("value=\"" . $b_second . "\">", "value=\"" . $b_second . "\" SELECTED>" ,$c_second);

					$racetime_combos = $c_day . '&nbsp;.&nbsp;' . $c_month . '&nbsp;.&nbsp;' . $c_year . '&nbsp;&nbsp;&nbsp;' . $c_hour . '&nbsp;:&nbsp;' . $c_minute . '&nbsp;:&nbsp;' . $c_second;

					// Generate page
					if ($formel_config['show_gfxr'] == 1)
					{
						$template->assign_block_vars('gfxr_on', array());
					}

					$template->assign_vars(array(
						'S_ADD_RACES'			=> true,
						'U_ACTION'				=> $this->u_action,
						'FORMEL_IMG' 			=> $phpbb_root_path . 'images/formel/formel_races.jpg',
						'PREDEFINED_NAME' 		=> $racename,
						'PREDEFINED_IMG' 		=> $raceimg,
						'PREDEFINED_LENGTH' 	=> $racelength,
						'PREDEFINED_LAPS' 		=> $racelaps,
						'PREDEFINED_DISTANCE' 	=> $racedistance,
						'PREDEFINED_DEBUT' 		=> $racedebut,
						'PREDEFINED_ID' 		=> $race_id,
						'L_ACP_F1_RACES_EXPLAIN'=> $title_exp,
						'L_ACP_F1_RACES' 		=> $title,
						'RACETIME_COMBOS' 		=> $racetime_combos,
						)
					);
				}
				else
				{
					// Load the race page
					// Get all race data
					$sql = 'SELECT *
							FROM ' . FORMEL_RACES_TABLE . '
								ORDER BY race_time ASC';
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$race_img = $row['race_img'];
						$race_img = ($race_img == '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_race_img'] . '" width="94" height="54" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $race_img . '" width="94" height="54" alt="">';

						if ($formel_config['show_gfxr'] == 1)
						{
							$template->assign_block_vars('racerow_gfxr', array(
								'RACEIMG' 	=> $race_img,
								'RACENAME' 	=> $row['race_name'],
								'RACEID' 	=> $row['race_id'],
								'RACETIME' 	=> $user->format_date( $row['race_time']),
								'RACEDEAD' 	=> $user->format_date( $row['race_time'] - $formel_config['deadline_offset'] )
							));
						}
						else
						{
							$template->assign_block_vars('racerow', array(
								'RACENAME' 	=> $row['race_name'],
								'RACEID' 	=> $row['race_id'],
								'RACETIME' 	=> $user->format_date( $row['race_time'] ),
								'RACEDEAD' 	=> $user->format_date( $row['race_time'] - $formel_config['deadline_offset'] )
							));
						}
					}

					$db->sql_freeresult($result);

					// Generate page
					$colspan = 5;

					if ($formel_config['show_gfxr'] == 1)
					{
						$colspan = 6;
						$template->assign_block_vars('gfxr_on', array());
					}

					$template->assign_vars(array(
						'S_RACES'		=> true,
						'U_ACTION'		=> $this->u_action,
						'COLSPAN' 		=> $colspan,
						'FORMEL_IMG' 	=> $phpbb_root_path . 'images/formel/formel_races.jpg',
						)
					);
				}

			break;

			default:

				$error_msg = 'You should never reach this point ;-)';
				trigger_error($error_msg);

			break;
		}
	}
}

?>