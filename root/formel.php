<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.'.$phpEx);
include($phpbb_root_path . 'includes/functions_formel.'.$phpEx);


// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/formel');

// Only registered users can go beyond this point
if (!$user->data['is_registered'])
{
	if ($user->data['is_bot'])
	{
		redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
	}
	login_box('', $user->lang['LOGIN_INFO']);
}

// Get formel config
$formel_config = get_formel_config();
$formel_forum_id = $formel_config['forum_id'];
$formel_group_id = $formel_config['restrict_to'];
$formel_mod_id = $formel_config['mod_id'];

// Check if user has one of the formular 1 admin permission. 
// If user has one or more of these permissions, he gets also formular 1 moderator permissions.
$is_admin = $auth->acl_gets('a_formel_settings', 'a_formel_drivers', 'a_formel_teams', 'a_formel_races');

// Check for : restricted group access - admin access - formular 1 moderator access
if ( $formel_group_id <> 0 && !get_formel_auth() && $is_admin <> 1 && $user->data['user_id'] <> $formel_mod_id )
{
	$auth_msg = sprintf($user->lang['formel_access_denied'], '<a href="' . append_sid("ucp.$phpEx?i=groups") . '" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
	trigger_error($auth_msg);
}

// Creating breadcrumps
$template->assign_block_vars('navlinks', array( 
	'U_VIEW_FORUM'		=> append_sid("./formel.$phpEx"),
	'FORUM_NAME' 		=> $user->lang['formel_title'],
));

// Salting the form...yumyum ...
add_form_key('formel');


// Start switching the mode...
$mode = request_var('mode', 'standard');

switch ($mode)
{
	case 'standard':

		// Set template vars
		$page_title = $user->lang['formel_title'];
		$template_html = 'formel_body.html';

		// Check buttons & data
		$race_offset 	= request_var('race_offset'		,	0	);
		$race_id 		= request_var('race_id'			,	0	);
		$next 			= request_var('next'			,	''	);
		$prev 			= request_var('prev'			,	''	);
		$place_my_tipp 	= request_var('place_my_tipp'	,	''	);
		$edit_my_tipp 	= request_var('edit_my_tipp'	,	''	);
		$del_tipp 		= request_var('del_tipp'		,	''	);
		$user_id 		= $user->data['user_id'];
		$my_tipp_array 	= array();
		$my_tipp 		= '';
		$tipp_time 		= request_var('tipp_time'		,	0	);
		$tipp_time 		= intval($tipp_time);

		//Define some vars
		$driver_team_name = $driverteamname = $gfxdrivercar = $gfxdrivercombo = $single_fastest	= $single_tired	= '';

		// Check if the user want to see prev/next race
		if ($next) 
		{
			$race_offset++;
		}
		else if ($prev) 
		{
			$race_offset--;
		}

		// Delete a tip
		if ( $del_tipp ) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_DELETED', $race_id);			
			formel_del_tip($user_id,$race_id);

		}

		// Add or edit a tip
		if ( ($place_my_tipp || $edit_my_tipp) && $tipp_time - $formel_config['deadline_offset'] >= time() ) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			for ($i = 0; $i < 8; $i++) 
			{
				$value = request_var('place' . ( $i + 1 ), 0);
				if (checkarrayforvalue($value,$my_tipp_array)) 
				{
					add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_NOT_VALID', $race_id);
					$tipp_msg = sprintf($user->lang['formel_doublicate_values'], '<a href="javascript:history.back()" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
					trigger_error($tipp_msg);
				}
				$my_tipp_array[$i] = $value;
			}
			$my_tipp_array[8] = request_var('place9', 0);  //[8] --> fastest driver
			$my_tipp_array[9] = request_var('place10', 0); //[9] --> tired count
			$my_tipp = implode(",",$my_tipp_array);

			if ($place_my_tipp) 
			{
				$sql_ary = array(
					'tipp_user'		=> $user_id,
					'tipp_race'		=> $race_id,
					'tipp_result'	=> $my_tipp,
					'tipp_points'	=> 0
				);

				$db->sql_query('INSERT INTO ' . FORMEL_TIPPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
				add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_GIVEN', $race_id);
			}
			else 
			{
				$sql_ary = array(
					'tipp_result'	=> $my_tipp
				);

				$sql = 'UPDATE ' . FORMEL_TIPPS_TABLE . ' 
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
					WHERE tipp_user = $user_id
						AND tipp_race = $race_id";
				$db->sql_query($sql);
				add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_EDITED', $race_id);
			}
			$tipp_msg = sprintf($user->lang['formel_accepted_tipp'], '<a href="'.append_sid("formel.$phpEx").'" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
			trigger_error( $tipp_msg);
		}

		// Get all races
		$races = get_formel_races();
		$current_time = time();

		// Get all teams
		$teams = get_formel_teams();

		// Get all drivers
		$drivers = get_formel_drivers();
		$driver_combodata = get_formel_drivers_data();

		// Get all tips and fill top10
		$sql = 'SELECT sum(tipp_points) AS total_points, tipp_user 
			FROM ' . FORMEL_TIPPS_TABLE . '
			GROUP BY tipp_user
			ORDER BY total_points DESC LIMIT 5';
		$result = $db->sql_query($sql);

		$rank = $real_rank  = 0;
		$previous_points = false;
		while ($row = $db->sql_fetchrow($result)) 
		{ 
			$real_rank++; 
			if($row['total_points'] <> $previous_points) 
			{ 
				$rank = $real_rank; 
				$previous_points = $row['total_points']; 
			}
			$tipp_user_row		= get_formel_userdata($row['tipp_user']);
			$tipp_username_link	= get_username_string('full', $tipp_user_row['user_id'], $tipp_user_row['username'], $tipp_user_row['user_colour']);
			$template->assign_block_vars('top_tippers', array(
				'TIPPER_NAME' 	=> $tipp_username_link,
				'RANK'		=> $rank,
				'TIPPER_POINTS' => $row['total_points'])
			);
		}
 		$db->sql_freeresult($result);

		// Get all wm points and fill top10 drivers
		$sql = 'SELECT sum(wm_points) AS total_points, wm_driver 
			FROM ' . FORMEL_WM_TABLE . '
			GROUP BY wm_driver
			ORDER BY total_points DESC LIMIT 5';
		$result = $db->sql_query($sql);

		$rank = $real_rank  = 0;
		$previous_points = false;
		while ($row = $db->sql_fetchrow($result)) 
		{ 
			$real_rank++; 
			if($row['total_points'] <> $previous_points) 
			{ 
				$rank = $real_rank; 
				$previous_points = $row['total_points']; 
			}
			$wm_drivername = $drivers[$row['wm_driver']]['driver_name'];
			$template->assign_block_vars('top_drivers', array(
				'RANK'			=> $rank,
				'WM_DRIVERNAME'	=> $wm_drivername,
				'WM_POINTS'		=> $row['total_points'])
			);
		}
		$db->sql_freeresult($result);

		// Get all wm points and fill top10 teams
		$sql = 'SELECT sum(wm_points) AS total_points, wm_team 
			FROM ' . FORMEL_WM_TABLE . '
			GROUP BY wm_team
			ORDER BY total_points DESC LIMIT 5';
		$result = $db->sql_query($sql);

		$rank = $real_rank  = 0;
		$previous_points = false;
		while ($row = $db->sql_fetchrow($result)) 
		{ 
			$real_rank++; 
			if($row['total_points'] <> $previous_points) 
			{ 
				$rank = $real_rank; 
				$previous_points = $row['total_points']; 
			}
			$wm_teamname = $teams[$row['wm_team']]['team_name'];
			$template->assign_block_vars('top_teams', array(
				'RANK'			=> $rank,
				'WM_TEAMNAME'	=> $wm_teamname,
				'WM_POINTS'	=> $row['total_points'])
			);
		}
		$db->sql_freeresult($result);

		// Find current race
		for ($i = 0; $i < count($races); $i++) 
		{
			if ($races[$i]['race_time'] > $current_time - $formel_config['event_change']) 
			{
				// Check for a overflow
				$race_offset = ($i + $race_offset == count($races)) ? 0-$i  : $race_offset;
				$race_offset = ($i + $race_offset < 0) ? count($races)-1-$i : $race_offset;

				// Define current race incl. user given offset
				$chosen_race = $i + $race_offset;

				$user_tipp_points = 0;
				$race_id = $races[$chosen_race]['race_id'];
				$user_id = $user->data['user_id'];

				//Countdown data
				if ($formel_config['show_countdown'] == 1)
				{
					$event_stop	= date($races[$chosen_race]['race_time'] - $formel_config['deadline_offset']);
					$b_day		= $user->format_date($event_stop, 'd');
					$b_month	= $user->format_date($event_stop, 'n');
					$b_year		= $user->format_date($event_stop, 'Y');
					$b_hour		= $user->format_date($event_stop, 'H');
					$b_minute	= $user->format_date($event_stop, 'i');
					$b_second	= $user->format_date($event_stop, 's');
					switch ($b_month)
					{
						case 1:
								$b_month = 'January';
						break;
							
						case 2:
								$b_month = 'February';
						break;
							
						case 3:
								$b_month = 'March';
						break;
							
						case 4:
								$b_month = 'April';
						break;
							
						case 5:
								$b_month = 'May';
						break;
						
						case 6:
								$b_month = 'June';
						break;
							
						case 7:
								$b_month = 'July';
						break;
							
						case 8:
								$b_month = 'August';
						break;
							
						case 9:
								$b_month = 'September';
						break;
							
						case 10:
								$b_month = 'October';
						break;
							
						case 11:
								$b_month = 'November';
						break;
							
						case 12:
								$b_month = 'December';
						break;
					}

					$stop = $b_month.' '.$b_day.', '.$b_year.' '.$b_hour.':'.$b_minute.':'.$b_second;
					$countdown = "<script language='JavaScript' type='text/javascript'>
								<!--
								var eventdate = new Date('".$stop."');
								function toSt(n)
								{
															s=''
															if(n<10) s+='0'
															return s+n.toString();
								}
								function countdown()
								{
									d=new Date();
									count=Math.floor((eventdate.getTime()-d.getTime())/1000);
									if(count<=0)
									{
										var time_event = document.getElementById('time_event');
										var event_time = document.getElementById('event_time');
										time_event.style.display = 'none';
										event_time.style.display = '';
										return;
									}
									secs_count = toSt(count%60);
									count=Math.floor(count/60);
									mins_count = toSt(count%60);
									count=Math.floor(count/60);
									hours_count = toSt(count%24);
									count=Math.floor(count/24);
									days_count = count;
									document.countdown.days.value = days_count;
									document.countdown.hours.value = hours_count;
									document.countdown.mins.value = mins_count;
									document.countdown.secs.value = secs_count;
									window.setTimeout('countdown()',500);
								}
								//-->
								</script>";
				}
				
				// Get race image and data
				$race_img = $races[$chosen_race]['race_img'];
				$race_img = ($race_img == '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_race_img'] . '" width="' . $formel_config['race_img_width'] . '" height="' . $formel_config['race_img_height'] . '" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $race_img . '" width="' . $formel_config['race_img_width'] . '" height="' . $formel_config['race_img_height'] . '" alt="">';
				$template->assign_block_vars('racerow', array(
					'RACEIMG' 		=> $race_img,
					'RACENAME' 		=> $races[$chosen_race]['race_name'],
					'RACELENGTH' 	=> $races[$chosen_race]['race_length'] . ' km',
					'RACEDEBUT' 	=> $races[$chosen_race]['race_debut'],
					'RACEDISTANCE' 	=> $races[$chosen_race]['race_distance'] . ' km',
					'RACELAPS' 		=> $races[$chosen_race]['race_laps'],
					'RACETIME' 		=> $user->format_date($races[$chosen_race]['race_time']),
					'RACEDEAD' 		=> $user->format_date($races[$chosen_race]['race_time'] - $formel_config['deadline_offset']))
				);

				if ( $formel_config['show_gfxr'] == 1 )
				{
					$template->assign_block_vars('racerow.racegfx', array());
				}

				// Find current tippers and their points
				// Get tip data
				$sql = 'SELECT * 
					FROM ' . FORMEL_TIPPS_TABLE . " 
					WHERE tipp_race = '" . $db->sql_escape($race_id) . "'
						ORDER BY tipp_points DESC";
				$result = $db->sql_query($sql);

				$tippers_active = $db->sql_affectedrows($result);
				$cur_counter = 1;
				while ($row = $db->sql_fetchrow($result)) 
				{
					$current_tippers_userdata 	= get_formel_userdata($row['tipp_user']);
					$current_tipp_id 			= $row['tipp_id'];
					$current_tippers_username 	= get_username_string('username', $row['tipp_user'], $current_tippers_userdata['username'], $current_tippers_userdata['user_colour'] );
					$current_tippers_colour		= get_username_string('colour'  , $row['tipp_user'], $current_tippers_userdata['username'], $current_tippers_userdata['user_colour'] );
					$separator 					= ( $cur_counter == $tippers_active ) ? '': ', ';
					$template->assign_block_vars('tipps_made', array(
						'USERTIPP' 		=> append_sid("./formel.$phpEx?mode=usertipp&amp;tipp=$current_tipp_id&amp;race=$chosen_race"),
						'SEPARATOR' 	=> $separator,
						'USERNAME' 		=> $current_tippers_username . ' (' . $row['tipp_points'] . ')',
						'STYLE'			=> ($current_tippers_colour) ? ' style="color: ' . $current_tippers_colour . '; font-weight: bold;"' : '',
						)
					);
					$cur_counter++;
				}
				if ( $tippers_active == 0 ) 
				{
					$template->assign_block_vars('no_tipps_made', array(
						'NOTIPPS'	=> $user->lang['formel_no_players'])
					);
				}
				$db->sql_freeresult($result);

				// Get tip data
				$sql = 'SELECT * 
					FROM ' . FORMEL_TIPPS_TABLE . " 
					WHERE tipp_race = '" . $db->sql_escape($race_id) . "' 
						AND tipp_user = '" . $db->sql_escape($user_id) . "'";
				$result = $db->sql_query($sql);

				$tipp_active = $db->sql_affectedrows($result);
				$delete_button = '';
				$tipp_button = $user->lang['formel_add_tipp'];
				$tipp_button_name = 'place_my_tipp';
				$tipp_data = $db->sql_fetchrowset($result);
				$db->sql_freeresult($result);

				// Check if a tip has been made before
				if ($tipp_active > 0) 
				{
					$tipp_button		= $user->lang['formel_edit_tipp'];
					$tipp_button_name	= 'edit_my_tipp';
					$delete_button		= '&nbsp;<input class="button1" type="submit" name="del_tipp" value="' . $user->lang['formel_del_tipp'] . '">';
					$tipp_array			= explode(",",$tipp_data[0]['tipp_result']);
					$user_tipp_points	= $tipp_data[0]['tipp_points'];

					for ($i = 0; $i < count($tipp_array) - 2; $i++) 
					{
						$results		= explode(",",$races[$chosen_race]['race_result']);
						$position		= ($i == 0) ? $user->lang['formel_race_winner'] : $i+1 . '. ' . $user->lang['formel_place'];
						$box_name		= 'place' . ($i+1);
						$single_points	= '';

						if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time) 
						{
							//Actual race is over
							$driverid 			= (isset($drivers[$tipp_array[$i]]['driver_id']))			?	$drivers[$tipp_array[$i]]['driver_id']			:	'';
							$drivercombo 		= (isset($drivers[$tipp_array[$i]]['driver_name']))			?	$drivers[$tipp_array[$i]]['driver_name']		:	'';
							$driverteamname 	= (isset($drivers[$tipp_array[$i]]['driver_team_name']))	?	$drivers[$tipp_array[$i]]['driver_team_name']	:	'';
							$gfxdrivercar 		= (isset($drivers[$tipp_array[$i]]['driver_car']))			?	$drivers[$tipp_array[$i]]['driver_car']			:	'';
							$gfxdrivercombo 	= (isset($drivers[$tipp_array[$i]]['driver_img']))			?	$drivers[$tipp_array[$i]]['driver_img']			:	'';

							//Recalc tip points for every single placed tip
							if (isset($results[$i]))
							{
								if ($driverid == $results[$i])
								{
									$single_points += $formel_config['points_placed'];
								}
							}
							for ($j = 0; $j < count($tipp_array) - 2; $j++)
							{
								if (isset($results[$j]))
								{
									if ($driverid == $results[$j])
									{
										$single_points += $formel_config['points_mentioned'];
									}
								}
							}
							if ($single_points == 0) $single_points='';
							// End recalc
						}
						else 
						{
							//Actual race is not over
							$drivercombo = '<select name="' . $box_name . '" size="1">';   
							for ($k = 0; $k < count($driver_combodata); $k++) 
							{
								$this_driver_id 	 = $driver_combodata[$k]['driver_id'];
								$this_driver_name 	 = $driver_combodata[$k]['driver_name'];
								$selected 			 = ( $this_driver_id == $tipp_array[$i]) ? 'selected' : '';
								$drivercombo 		.= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
							}
							$drivercombo .= '</select>';
						}
						if ( $formel_config['show_gfx'] == 1 )
						{
							//Layout cosmetic
							if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time)
							{
								//Race is over - Show driverimage and so on
								$template->assign_block_vars('gfx_users_tipp', array(
									'L_PLACE'			=>	'&nbsp;' . $position . '<br />',
									'DRIVERCOMBO'		=>	$drivercombo . '<br />',
									'DRIVERTEAMNAME'	=>	'&nbsp;' . $driverteamname,
									'GFXDRIVERCOMBO'	=>	$gfxdrivercombo,
									'GXFDRIVERCAR'		=>	$gfxdrivercar,
									'SINGLE_POINTS'		=>	$single_points)
								);
							}
							else
							{
								// Race is not over - Show position instead of driverimage
								$template->assign_block_vars('gfx_users_tipp', array(
									'L_PLACE'			=>	'',
									'DRIVERCOMBO'		=>	$drivercombo,
									'DRIVERTEAMNAME'	=>	$driverteamname,
									'GFXDRIVERCOMBO'	=>	$position,
									'GXFDRIVERCAR'		=>	$gfxdrivercar,
									'SINGLE_POINTS'		=>	$single_points)
								);
							}
						}
						else
						{
							$template->assign_block_vars('users_tipp', array(
								'L_PLACE'		=>	$position,
								'DRIVERCOMBO'	=>	$drivercombo,
								'SINGLE_POINTS'	=>	$single_points)
							);
						}
					}
					if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time) 
					{
						//Actual Race is over
						$single_fastest	= '';
						$single_tired	= '';
						$drivercombo	= (isset($drivers[$tipp_array[8]]['driver_name'])) ? $drivers[$tipp_array[8]]['driver_name'] : '';
						$tiredcombo		= (isset($tipp_array[9])) ? $tipp_array[9] : '';

						//Recalc tip points for fastest driver
						if (isset($results[8]) && $results[8] <> 0 )
						{
							if ($tipp_array[8] == $results[8])
							{
								$single_fastest += $formel_config['points_fastest'];
							}
						}
						//Recalc tip points for tired count
						if (isset($results[9]))
						{
							if ($tipp_array[9] == $results[9])
							{
								$single_tired += $formel_config['points_tired'];
							}
						}
					}
					else 
					{
						//Actual Race is not over
						$drivercombo = '<select name="place9" size="1">';
						for ($k = 0; $k < count($driver_combodata); $k++) 
						{
							$this_driver_id		 = $driver_combodata[$k]['driver_id'];
							$this_driver_name	 = $driver_combodata[$k]['driver_name'];
							$selected			 = ( $this_driver_id == $tipp_array[8]) ? 'selected' : '';
							$drivercombo		.= '<option value="' . $this_driver_id . '" ' . $selected .'>' . $this_driver_name . '</option>';
						}
						$drivercombo .= '</select>';

						$tiredcombo = '<select name="place10" size="1">';
						
						//We have 11 Teams with 2 cars each --> 22 drivers
						for ($k = 0; $k < 23; $k++) 
						{
							$selected 			 = ( $k == $tipp_array[9]) ? 'selected' : '';
							$tiredcombo 		.= '<option value="' . $k . '" ' . $selected . '>' . $k . '</option>';
						}
						$tiredcombo .= '</select>';
					}


					if ( $formel_config['show_gfx'] == 1 )
					{
						$template->assign_block_vars('extended_users_tipp_gfx', array(
							'L_PACE'			=> $user->lang['formel_pace'],
							'L_TIRED'			=> $user->lang['formel_tired'],
							'TIREDCOMBO'		=> $tiredcombo,
							'DRIVERCOMBO'		=> $drivercombo,
							'GFXDRIVERCOMBO'	=> $gfxdrivercombo,
							'SINGLE_FASTEST'	=> $single_fastest,
							'SINGLE_TIRED'		=> $single_tired)
						);
					}
					else
					{
						$template->assign_block_vars('extended_users_tipp', array(
							'L_PACE'			=> $user->lang['formel_pace'],
							'L_TIRED'			=> $user->lang['formel_tired'],
							'TIREDCOMBO'		=> $tiredcombo,
							'DRIVERCOMBO'		=> $drivercombo,
							'GFXDRIVERCOMBO'	=> $gfxdrivercombo,
							'SINGLE_FASTEST'	=> $single_fastest,
							'SINGLE_TIRED'		=> $single_tired)
						);
					}
				}

				// What to do if the user has no tip so far
				else 
				{
					if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] > $current_time) 
					{
						//Actual Race is not over
						for ($i = 0; $i < 8; $i++) 
						{
							$position = ($i == 0) ? $user->lang['formel_race_winner'] : $i+1 . '. ' . $user->lang['formel_place'];
							$box_name = 'place' . ($i+1);

							$drivercombo = '<select name="' . $box_name . '" size="1">';
							for ($k = 0; $k < count($driver_combodata); $k++) 
							{
								$this_driver_id		 = $driver_combodata[$k]['driver_id'];
								$this_driver_name	 = $driver_combodata[$k]['driver_name'];
								$drivercombo		.= '<option value="' . $this_driver_id . '">' . $this_driver_name . '</option>';
							}
							$drivercombo .= '</select>';

							$template->assign_block_vars('add_tipp', array(
								'L_PLACE'		=> $position,
								'DRIVERCOMBO'	=> $drivercombo)
							);
						}

						$drivercombo = '<select name="place9" size="1">';
						for ($k = 0; $k < count($driver_combodata); $k++) 
						{
							$this_driver_id		 = $driver_combodata[$k]['driver_id'];
							$this_driver_name	 = $driver_combodata[$k]['driver_name'];
							$drivercombo 		.= '<option value="' . $this_driver_id . '">' . $this_driver_name . '</option>';
						}
						$drivercombo .= '</select>';

						$tiredcombo = '<select name="place10" size="1">';
						
						//We have 11 Teams with 2 cars each --> 22 drivers
						for ($k = 0; $k < 23; $k++) 
						{
							$tiredcombo .= '<option value="' . $k . '">' . $k . '</option>';
						}
						$tiredcombo .= '</select>';

						$template->assign_block_vars('extended_add_tipp', array(
							'L_PACE'		=> $user->lang['formel_pace'],
							'L_TIRED'		=> $user->lang['formel_tired'],
							'TIREDCOMBO'	=> $tiredcombo,
							'DRIVERCOMBO'	=> $drivercombo)
						);
					}
				}

				// Checks for a saved quali
				if ( $races[$chosen_race]['race_quali'] <> '0' ) 
				{
					// Get the driver ids
					$quali = explode(",",$races[$chosen_race]['race_quali']);

					// Start output
					for ($j = 0; $j < count($quali); $j++) 
					{
						$current_driver_id = $quali[$j];
						$position = ($j == 0) ? $user->lang['formel_pole'].': ' : $j+1 . '. ' . $user->lang['formel_place'] . ': ';
						if ( $formel_config['show_gfx'] == 1 )
						{
							$template->assign_block_vars('qualirow_gfx', array(
								'L_PLACE'			=> $position,
								'DRIVERIMG'			=> (isset($drivers[$current_driver_id]['driver_img'])) ? $drivers[$current_driver_id]['driver_img'] : '',
								'DRIVERCAR'			=> (isset($drivers[$current_driver_id]['driver_car'])) ? $drivers[$current_driver_id]['driver_car'] : '',
								'DRIVERNAME'		=> (isset($drivers[$current_driver_id]['driver_name'])) ? $drivers[$current_driver_id]['driver_name'] : '',
								'DRIVERTEAMNAME'	=> (isset($drivers[$current_driver_id]['driver_team_name'])) ? $drivers[$current_driver_id]['driver_team_name'] : '')
							);
						}
						else 
						{
							$template->assign_block_vars('qualirow', array(
								'L_PLACE'		=> $position,
								'DRIVERNAME'	=> (isset($drivers[$current_driver_id]['driver_name'])) ? $drivers[$current_driver_id]['driver_name'] : '')
							);
						}
					}
				}
				else 
				{
					// If no quali was found
					$template->assign_block_vars('no_quali', array(
						'NO_QUALI' 	=> $user->lang['formel_no_quali'])
					);
				}

				// Checks for a saved result
				if ( $races[$chosen_race]['race_result'] <> '0' ) 
				{
					// Get the driver ids
					$results = explode(",",$races[$chosen_race]['race_result']);

					// Start output
					for ($j = 0; $j < count($results)-2; $j++) 
					{
						$current_driver_id = $results[$j];
						$position = ($j == 0) ? $user->lang['formel_race_winner'].': ' : $j+1 . '. ' . $user->lang['formel_place'] . ': ';
						if ( $formel_config['show_gfx'] == 1 )
						{
							$template->assign_block_vars('resultsrow_gfx', array(
								'L_PLACE'			=> $position,
								'DRIVERIMG'			=> (isset($drivers[$current_driver_id]['driver_img'])) ? $drivers[$current_driver_id]['driver_img'] : '',
								'DRIVERCAR'			=> (isset($drivers[$current_driver_id]['driver_car'])) ? $drivers[$current_driver_id]['driver_car'] : '',
								'DRIVERNAME'		=> (isset($drivers[$current_driver_id]['driver_name'])) ? $drivers[$current_driver_id]['driver_name'] : '',
								'DRIVERTEAMNAME'	=> (isset($drivers[$current_driver_id]['driver_team_name'])) ? $drivers[$current_driver_id]['driver_team_name'] : '',)
							);
						}
						else 
						{
							$template->assign_block_vars('resultsrow', array(
								'L_PLACE'		=> $position,
								'DRIVERNAME'	=> (isset($drivers[$current_driver_id]['driver_name'])) ? $drivers[$current_driver_id]['driver_name'] : '')
							);
						}
					}

					if ( $formel_config['show_gfx'] == 1 )
					{
						$template->assign_block_vars('extended_results_gfx', array(
							'L_PACE'			=> $user->lang['formel_pace'],
							'L_TIRED'			=> $user->lang['formel_tired'],
							'L_YOUR_POINTS'		=> $user->lang['formel_your_points'],
							'PACE'				=> (isset($drivers[$results[8]]['driver_name'])) ? $drivers[$results[8]]['driver_name'] : '',
							'TIRED'				=> (isset($results[9])) ? $results[9] : '',
							'YOUR_POINTS'		=> $user_tipp_points)	
						);
					}
					else
					{
						$template->assign_block_vars('extended_results', array(
							'L_PACE'			=> $user->lang['formel_pace'],
							'L_TIRED'			=> $user->lang['formel_tired'],
							'L_YOUR_POINTS'		=> $user->lang['formel_your_points'],
							'PACE'				=> (isset($drivers[$results[8]]['driver_name'])) ? $drivers[$results[8]]['driver_name'] : '',
							'TIRED'				=> (isset($results[9])) ? $results[9] : '',
							'YOUR_POINTS'		=> $user_tipp_points)
						);
					}
				}
				else 
				{
					// If no result was found
					$template->assign_block_vars('no_results', array(
						'NO_RESULTS'	=> $user->lang['formel_no_result'])
					);
				}

				// Game over
				if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time) 
				{
					$template->assign_block_vars('game_over', array(
						'GAME_OVER'		=> $user->lang['formel_game_over'])
					);
				}
				else 
				{
					$template->assign_block_vars('place_tipp', array(
						'DELETE_TIPP'	=> $delete_button,
						'L_PLACE_TIPP'	=> $tipp_button,
						'PLACE_TIPP'	=> $tipp_button_name)
					);
				}
				break;
			}
		}

		// Forum button
		$discuss_button = '';
		if ( $formel_forum_id ) 
		{
			$formel_forum_url	= append_sid("viewforum.$phpEx?f=$formel_forum_id");
			$formel_forum_name	= $user->lang['formel_forum'];
			$discuss_button		= '<input class="button1" type="button" onClick="window.location.href=\'' . $formel_forum_url . '\'" value="' . $formel_forum_name . '">&nbsp;&nbsp;';
		}

		// Moderator switch and options
		$u_call_mod = append_sid("ucp.$phpEx?i=pm&amp;mode=compose&amp;u=$formel_mod_id");
		$l_call_mod = $user->lang['formel_call_mod'];
		
		// Some debug code to test the $auth
		//echo "<pre>";print_r($auth);echo "</pre>";die();
		
		//Check if user is formel moderator or has admin access
		if ($user_id == $formel_config['mod_id'] || ($is_admin == 1) ) 
		{
			$u_call_mod = append_sid("./formel.$phpEx?mode=results");
			$l_call_mod = $user->lang['formel_mod_button_text'];
			$template->assign_block_vars('tipp_moderator', array());
		}

		// Show headerbanner ?
		if ( $formel_config['show_headbanner'] )
		{
			$template->assign_block_vars('head_on', array());
		}

		$chosen_race = (isset($chosen_race)) ? $chosen_race : 0;
		
		$template->assign_vars(array(
			'S_STANDARD'			=> true,
			'S_COUNTDOWN'			=> ($formel_config['show_countdown'] == 1) ? true : false,
			'S_FORM_ACTION'			=> append_sid("./formel.$phpEx"),
			'U_FORMEL'				=> append_sid("./formel.$phpEx"),
			'RACE_OFFSET'			=> $race_offset,
			'HEADER_IMG'			=> $formel_config['headbanner1_img'],
			'HEADER_URL'			=> $formel_config['headbanner1_url'],
			'HEADER_HEIGHT'			=> $formel_config['head_height'],
			'HEADER_WIDTH'			=> $formel_config['head_width'],
			'RACE_ID'				=> (isset($races[$chosen_race]['race_id'])) ? $races[$chosen_race]['race_id'] : 1,
			'RACE_TIME'				=> (isset($races[$chosen_race]['race_time'])) ? $races[$chosen_race]['race_time'] : 1,
			'L_CURRENT_RACE'		=> $user->lang['formel_current_race'],
			'L_NEXT_RACE'			=> $user->lang['formel_next_race'],
			'L_PREV_RACE'			=> $user->lang['formel_prev_race'],
			'L_YOUR_TIPP'			=> $user->lang['formel_your_tipp'],
			'L_CURRENT_QUALI'		=> $user->lang['formel_current_quali'],
			'L_CURRENT_RESULT'		=> $user->lang['formel_current_result'],
			'L_RACENAME'			=> $user->lang['formel_racename'],
			'L_RACEDEBUT'			=> $user->lang['formel_racedebut'],
			'L_RACELENGTH'			=> $user->lang['formel_racelength'],
			'L_RACELAPS'			=> $user->lang['formel_racelaps'],
			'L_RACEDISTANCE'		=> $user->lang['formel_racedistance'],
			'L_RACETIME'			=> $user->lang['formel_racetime'],
			'L_TOP_NAME'			=> $user->lang['formel_top_name'],
			'L_TIPPS_MADE'			=> $user->lang['formel_tipps_made'],
			'L_TOP_DRIVER'			=> $user->lang['formel_top_driver'],
			'L_TOP_TEAMS'			=> $user->lang['formel_top_teams'],
			'L_TOP_MORE'			=> $user->lang['formel_top_more'],
			'U_TOP_MORE_USERS'		=> append_sid("formel.$phpEx?mode=stats&amp;show_users=1"),
			'U_TOP_MORE_DRIVERS'	=> append_sid("formel.$phpEx?mode=stats&amp;show_drivers=1"),
			'U_TOP_MORE_TEAMS'		=> append_sid("formel.$phpEx?mode=stats&amp;show_teams=1"),
			'L_TOP_POINTS'			=> $user->lang['formel_top_points'],
			'L_RACEDEAD'			=> $user->lang['formel_racedead'],
			'L_FORMEL_TITLE'		=> $user->lang['formel_title'],
			'U_FORMEL_RULES'		=> append_sid("formel.$phpEx?mode=rules"),
			'U_FORMEL_FORUM'		=> $discuss_button,
			'U_FORMEL_STATISTICS'	=> append_sid("formel.$phpEx?mode=stats"),
			'U_FORMEL_CALL_MOD'		=> $u_call_mod,
			'L_FORMEL_RULES'		=> $user->lang['formel_rules'],
			'L_FORMEL_STATISTICS'	=> $user->lang['formel_statistics'],
			'L_COUNTDOWN'			=> $user->lang['formel_countdown_deadline'],
			'L_DEADLINE_REACHED'	=> $user->lang['formel_deadline_reached'],
			'COUNTDOWN'				=> (isset($countdown)) ? $countdown : '',
			'COUNTDOWN_ON'			=> (isset($countdown)) ? 'onLoad="javascript:countdown();"' : '',
			'L_FORMEL_CALL_MOD'		=> $l_call_mod)
		);
	break;
		
	case 'results':

		// Set template vars
		$page_title = $user->lang['formel_title'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'	=> append_sid("./formel.$phpEx?mode=results"),
			'FORUM_NAME'	=> $user->lang['formel_results_title'],
		));
		
		// Check URL hijacker . Access only for formel moderators or admins
		if ( $user->data['user_id'] <> $formel_mod_id && $is_admin <> 1)
		{
			$auth_msg = sprintf($user->lang['formel_mod_access_denied'], '<a href="' . append_sid("formel.$phpEx") . '" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
			trigger_error($auth_msg);
		}
		
		// Init some language vars
		$l_edit 	= $user->lang['formel_edit'];
		$l_del 		= $user->lang['formel_delete'];
		$l_add 		= $user->lang['formel_results_add'];	
		
		// Fetch all races
		$sql = 'SELECT * 
			FROM ' . FORMEL_RACES_TABLE . ' 
			ORDER BY race_time ASC';
		$result = $db->sql_query($sql);
		
		while ($row = $db->sql_fetchrow($result))
		{
			$race_img 			= $row['race_img'];
			$race_id 			= $row['race_id'];
			$race_img 			= ($race_img == '') 				? '' : '<img src="' . $phpbb_root_path . 'images/formel/' . $race_img . '" width="94" height="54" alt="">';
			$quali_buttons 		= ( $row['race_quali'] == '0' ) 	? '<input class="button1" type="submit" name="quali"  value="' . $l_add . '">' : '<input class="button1" type="submit" name="editquali"  value="' . $l_edit . '">&nbsp;&nbsp;<input class="button1" type="submit" name="resetquali"  value="' . $l_del . '">';
			$result_buttons 	= ( $row['race_result'] == '0' ) 	? '<input class="button1" type="submit" name="result" value="' . $l_add . '">' : '<input class="button1" type="submit" name="editresult" value="' . $l_edit . '">&nbsp;&nbsp;<input class="button1" type="submit" name="resetresult" value="' . $l_del . '">';

			if ( $formel_config['show_gfxr'] == 1 )
			{
				$template->assign_block_vars('racerow_gfxr', array(
					'L_RACE'			=> $user->lang['formel_racename'],
					'L_TIME'			=> $user->lang['formel_racetime'],
					'L_DEAD'			=> $user->lang['formel_racedead'],
					'RACEIMG'			=> $race_img,
					'QUALI_BUTTONS'		=> $quali_buttons,
					'RESULT_BUTTONS'	=> $result_buttons,
					'RACEID'			=> $race_id,
					'RACENAME'			=> $row['race_name'],
					'RACETIME'			=> $user->format_date($row['race_time']),
					'RACEDEAD'			=> $user->format_date($row['race_time'] - $formel_config['deadline_offset']))
				);
			}
			else 
			{
				$template->assign_block_vars('racerow', array(
					'L_RACE'			=> $user->lang['formel_racename'],
					'L_TIME'			=> $user->lang['formel_racetime'],
					'L_DEAD'			=> $user->lang['formel_racedead'],
					'QUALI_BUTTONS'		=> $quali_buttons,
					'RESULT_BUTTONS'	=> $result_buttons,
					'RACEID'			=> $race_id,
					'RACENAME'			=> $row['race_name'],
					'RACETIME'			=> $user->format_date($row['race_time']),
					'RACEDEAD'			=> $user->format_date($row['race_time'] - $formel_config['deadline_offset']))
				);
			}
		}
		$db->sql_freeresult($result);
		
		$template->assign_vars(array(
			'S_RESULTS'						=> true,
			'S_FORM_ACTION'					=> append_sid("./formel.$phpEx?mode=addresults"),
			'U_FORMEL'						=> append_sid("./formel.$phpEx"),
			'U_FORMEL_RESULTS'				=> append_sid("./formel.$phpEx?mode=results"),
			'L_FORMEL_RACE'					=> $user->lang['formel_racename'],
			'L_FORMEL_QUALI'				=> $user->lang['formel_current_quali'],
			'L_FORMEL_RESULT'				=> $user->lang['formel_current_result'],
			'L_RESULTS_ADD'					=> $user->lang['formel_results_add'],
			'L_FORMEL_RESULTS_TITLE'		=> $user->lang['formel_results_title'],
			'L_FORMEL_TITLE'				=> $user->lang['formel_title'],
			'L_FORMEL_RESULTS_TITLE_EXP'	=> $user->lang['formel_results_title_exp']
		));
	break;
		
	case 'addresults':

		// Set template vars
		$page_title = $user->lang['formel_title'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'	=> append_sid("./formel.$phpEx?mode=results"),
			'FORUM_NAME'	=> $user->lang['formel_results_title'],
		));
		
		// Check URL hijacker . Access only for formel moderators or admins
		if ( $user->data['user_id'] <> $formel_mod_id && $is_admin <> 1)
		{
			$auth_msg = sprintf($user->lang['formel_mod_access_denied'], '<a href="' . append_sid("formel.$phpEx") . '" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
			trigger_error($auth_msg);
		}
		
		// Check buttons & data
		$results		= request_var('result'			,	''	);
		$addresult		= request_var('addresult'		,	''	);
		$addeditresult	= request_var('addeditresult'	,	''	);
		$editresult		= request_var('editresult'		,	''	);
		$addquali		= request_var('addquali'		,	''	);
		$editquali		= request_var('editquali'		,	''	);
		$quali			= request_var('quali'			,	''	);
		$reset			= request_var('reset'			,	''	);
		$resetquali		= request_var('resetquali'		,	''	);
		$resetresult	= request_var('resetresult'		,	''	);
		$race_id		= request_var('race_id'			,	0	);

		// Init some vars
		$quali_array	= array();
		$result_array	= array();
		
		// Reset a quali
		if ( $resetquali && $race_id <> 0 ) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			$sql_ary = array(
				'race_quali'		=> 0
			);

			$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
				WHERE race_id = $race_id";
			$db->sql_query($sql);
			
			add_log('mod', $user->data['user_id'], 'LOG_FORMEL_QUALI_DELETED', $race_id);
			$tipp_msg = sprintf($user->lang['formel_results_deleted'], '<a href="'.append_sid("formel.$phpEx?mode=results").'" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
			trigger_error($tipp_msg);
		}
		
		// Reset a result
		if ( $resetresult && $race_id <> 0 ) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			// Delete all WM points for this race
			$sql = 'DELETE 
				FROM ' . FORMEL_WM_TABLE . " 
				WHERE wm_race = $race_id";
			$db->sql_query($sql);

			// Delete the race result for this race
			$sql_ary = array(
				'race_result'	=> 0
			);

			$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
				WHERE race_id = $race_id";
			$db->sql_query($sql);
			
			// Delete all gathered tip points for this race
			$sql_ary = array(
				'tipp_points'	=> 0
			);

			$sql = 'UPDATE ' . FORMEL_TIPPS_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
				WHERE tipp_race = $race_id";
			$db->sql_query($sql);

			// Pull out a success message
			add_log('user', $user->data['user_id'], 'LOG_FORMEL_RESULT_DELETED', $race_id);
			$tipp_msg = sprintf($user->lang['formel_results_deleted'], '<a href="'.append_sid("formel.$phpEx?mode=results").'" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
			trigger_error($tipp_msg);
		}

		if ( ( $reset || $resetresult || $resetquali ) && $race_id == 0 ) 
		{
			$reset_msg = sprintf($user->lang['formel_results_error'], '<a href="'.append_sid("formel.$phpEx?mode=results").'" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
			trigger_error($reset_msg);
		}
		
		// Add a quali
		if ( $addquali ) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			if ( $race_id <> 0 ) 
			{
				//We have 11 Teams with 2 cars each --> 22 drivers
				for ($i = 0; $i < 22; $i++) 
				{
					$value = request_var('place' . ( $i + 1 ), 0);
					if (checkarrayforvalue($value,$quali_array)) 
					{
						add_log('user', $user->data['user_id'], 'LOG_FORMEL_QUALI_NOT_VALID', $race_id);
						$quali_msg = sprintf($user->lang['formel_results_double'], '<a href="javascript:history.back()" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
						trigger_error($quali_msg);
					}
					$quali_array[$i] = $value;
				}
				$new_quali = implode(",",$quali_array);
				$sql_ary = array(
					'race_quali'	=> $new_quali
				);

				$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
					WHERE race_id = $race_id";
				$db->sql_query($sql);

				add_log('user', $user->data['user_id'], 'LOG_FORMEL_QUALI_ADDED', $race_id);
				$quali_msg = sprintf($user->lang['formel_results_accepted'], '<a href="'.append_sid("formel.$phpEx?mode=results").'" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
				trigger_error($quali_msg);
			}
		}
		
		// Add a result
		if ( $addresult || $addeditresult ) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			if ( $race_id <> 0 ) 
			{
				if ( $addeditresult ) 
				{
					$sql = 'DELETE 
						FROM ' . FORMEL_WM_TABLE . " 
						WHERE wm_race = $race_id";
					$db->sql_query($sql);
				}
				
				for ($i = 0; $i < 8; $i++) 
				{
					$value = request_var('place' . ( $i + 1 ), 0);
					if (checkarrayforvalue($value,$result_array)) 
					{
						add_log('user', $user->data['user_id'], 'LOG_FORMEL_RESULT_NOT_VALID', $race_id);
						$result_msg = sprintf($user->lang['formel_results_double'], '<a href="javascript:history.back()" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
						trigger_error($result_msg);
					}
					$result_array[$i] = $value;
				}
				
				$result_array[8] = request_var('place9' , 0);	//[8] --> fastest driver
				$result_array[9] = request_var('place10' , 0);	//[9] --> tired count
				$new_result = implode(",",$result_array);
				$sql_ary = array(
					'race_result'	=> $new_result
				);

				$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
					WHERE race_id = $race_id";
				$db->sql_query($sql);				
				
				// START points calc
				// Get tipp data and calc user points
				$sql = 'SELECT * 
					FROM ' . FORMEL_TIPPS_TABLE . " 
					WHERE tipp_race = '" . $db->sql_escape($race_id) . "'";
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result)) 
				{
					$user_tipp_points = 0;
					$current_user = $row['tipp_user'];
					$current_tipp_array = explode(',',$row['tipp_result']);
					$temp_results_array = array();
					for ( $i=0; $i < count($current_tipp_array)-2; $i++ ) 
					{
						$temp_results_array[$i] = $result_array[$i];
					}
					for ( $i=0; $i < count($current_tipp_array)-2; $i++ ) 
					{
						if ( $current_tipp_array[$i] <> '0' ) 
						{
							if ( checkarrayforvalue($current_tipp_array[$i],$temp_results_array) ) 
							{
								$user_tipp_points += $formel_config['points_mentioned'];
								if ( $current_tipp_array[$i] == $result_array[$i] ) 
								{
									$user_tipp_points += $formel_config['points_placed'];
								}
							}
						}
					}
					if ( $current_tipp_array[8] == $result_array[8] && $current_tipp_array[8] <> 0) 
					{
						$user_tipp_points += $formel_config['points_fastest'];
					}
					if ( $current_tipp_array[9] == $result_array[9] ) 
					{
						$user_tipp_points += $formel_config['points_tired'];
					}
					
					$sql_ary = array(
						'tipp_points'	=> $user_tipp_points
					);

					$sql = 'UPDATE ' . FORMEL_TIPPS_TABLE . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
						WHERE tipp_race = $race_id 
						AND tipp_user = $current_user";
					$update = $db->sql_query($sql);
				}
				$db->sql_freeresult($result);
				
				// Calc wm points
				// Get drivers data
				$sql = 'SELECT * 
					FROM ' . FORMEL_DRIVERS_TABLE;
				$result = $db->sql_query($sql);

				while ( $row = $db->sql_fetchrow($result) ) 
				{
					$teams[$row['driver_id']] = $row['driver_team'];
				}
				$db->sql_freeresult($result);
				$wm = array();
				$wm[0] = 10;	// 10 Point for first place
				$wm[1] = 8;		// 8 Points for second place 
				for ( $i=2; $i < 8; $i++ ) 
				{
					$wm[$i] = ( 8 - $i );
				}
				for ( $i=0; $i < count($result_array)-2; $i++ ) 
				{
					$current_driver = $result_array[$i];
					if ( $current_driver <> '0' ) 
					{
						$current_team 	= $teams[$current_driver];
						$wm_points 		= $wm[$i];
						$sql_ary = array(
							'wm_race'	=> $race_id,
							'wm_driver'	=> $current_driver,
							'wm_team'	=> $current_team,
							'wm_points'	=> $wm_points
						);

						$db->sql_query('INSERT INTO ' . FORMEL_WM_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
					}
				}
				// END points calc

				add_log('user', $user->data['user_id'], 'LOG_FORMEL_RESULT_ADDED', $race_id);
				$result_msg = sprintf($user->lang['formel_results_accepted'], '<a href="'.append_sid("formel.$phpEx?mode=results").'" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
				trigger_error($result_msg);
			}
		}
		
		// Load add/edit quali
		if ( ( $quali || $editquali ) && $race_id <> 0 ) 
		{
			if ( $editquali ) 
			{
				// Get the race
				$sql = 'SELECT * 
					FROM ' . FORMEL_RACES_TABLE . " 
						WHERE race_id = '" . $db->sql_escape($race_id) . "'";
				$result = $db->sql_query($sql);

				$row = $db->sql_fetchrow($result);
				$quali_array = explode(',',$row['race_quali']);
				$db->sql_freeresult($result);
			}
			
			// Fetch all drivers
			$sql = 'SELECT * 
				FROM ' . FORMEL_DRIVERS_TABLE . ' 
				ORDER BY driver_name ASC';
			$result = $db->sql_query($sql);

			$counter=1;
			while ($row = $db->sql_fetchrow($result)) 
			{
				$drivers[$counter] = $row;
				$counter++;
			}
			$db->sql_freeresult($result);
			$drivers[0]['driver_id'] = '0';
			$drivers[0]['driver_name'] = $user->lang['formel_define'];
			
			//We have 11 Teams with 2 cars each --> 22 drivers
			for ($i = 0; $i < 22; $i++) 
			{
				$position = ($i == 0) ? $user->lang['formel_pole'] : $i+1 . '. ' . $user->lang['formel_place'];
				$box_name = 'place' . ($i+1);
				$drivercombo = '<select name="' . $box_name . '" size="1">';
				for ($k = 0; $k < count($drivers); $k++) 
				{
					$this_driver_id = $drivers[$k]['driver_id'];
					$this_driver_name = $drivers[$k]['driver_name'];
					if (isset($quali_array[$i]))
					{
						$selected = ( $this_driver_id == $quali_array[$i]) ? 'selected' : '';
					}
					else
					{
						$selected = '';
					}
					$drivercombo .= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
				}
				$drivercombo .= '</select>';
				$template->assign_block_vars('qualirow', array(
					'L_PLACE'		=> $position,
					'DRIVERCOMBO'	=> $drivercombo)
				);
			}
			$template->assign_block_vars('quali', array(
				'L_TITLE'	=> $user->lang['formel_results_qualititle'],
				'L_ADD'		=> $user->lang['formel_results_add'])
			);
		}	

		// Load add or edit result
		if ( ( $results || $editresult ) && $race_id <> 0 ) 
		{
			if ( $editresult ) 
			{
				// Get the race
				$sql = 'SELECT * 
					FROM ' . FORMEL_RACES_TABLE . " 
					WHERE race_id = '" . $db->sql_escape($race_id) . "'";
				$result = $db->sql_query($sql);

				$row = $db->sql_fetchrow($result);
				$result_array = explode(',',$row['race_result']);
				$db->sql_freeresult($result);
			}
			
			// Fetch all drivers
			$sql = 'SELECT * 
				FROM ' . FORMEL_DRIVERS_TABLE . ' 
				ORDER BY driver_name ASC';
			$result = $db->sql_query($sql);

			$counter=1;
			while ($row = $db->sql_fetchrow($result)) 
			{
				$drivers[$counter] = $row;
				$counter++;
			}
			$db->sql_freeresult($result);
			$drivers[0]['driver_id'] = '0';
			$drivers[0]['driver_name'] = $user->lang['formel_define'];
			for ($i = 0; $i < 8; $i++) 
			{
				$position = ($i == 0) ? $user->lang['formel_race_winner'] : $i+1 . '. ' . $user->lang['formel_place'];
				$box_name = 'place' . ($i+1);
				$drivercombo = '<select name="' . $box_name . '" size="1">';
				for ($k = 0; $k < count($drivers); $k++) 
				{
					$this_driver_id = $drivers[$k]['driver_id'];
					$this_driver_name = $drivers[$k]['driver_name'];
					if (isset($result_array[$i]))
					{
						$selected = ( $this_driver_id == $result_array[$i]) ? 'selected' : '';
					}
					else
					{
						$selected = '';
					}
					$drivercombo .= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
				}
				$drivercombo .= '</select>';
				$template->assign_block_vars('resultrow', array(
					'L_PLACE' 		=> $position,
					'DRIVERCOMBO' 	=> $drivercombo)
				);
			}
			$drivercombo_pace = '<select name="place9" size="1">';
			for ($k = 0; $k < count($drivers); $k++) 
			{
				$this_driver_id = $drivers[$k]['driver_id'];
				$this_driver_name = $drivers[$k]['driver_name'];
				if (isset($result_array[8]))
				{
					$selected = ( $this_driver_id == $result_array[8]) ? 'selected' : '';
				}
				else
				{
					$selected = '';
				}
				$drivercombo_pace .= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
			}
			$drivercombo_pace .= '</select>';
			$combo_tired = '<select name="place10" size="1">';
			
			//We have 11 Teams with 2 cars each --> 22 drivers
			for ($k = 0; $k < 23; $k++) 
			{
				if (isset($result_array[9]))
				{
					$selected = ( $k == $result_array[9]) ? 'selected' : '';
				}
				else
				{
					$selected = '';
				}			
				$combo_tired .= '<option value="' . $k . '" ' . $selected . '>' . $k . '</option>';
			}
			$combo_tired .= '</select>';
			$modus = ( $editresult ) ? 'addeditresult' : 'addresult';
			$template->assign_block_vars('result', array(
				'L_FASTEST' 	=> $user->lang['formel_pace'],
				'PACECOMBO' 	=> $drivercombo_pace,
				'L_TIRED' 		=> $user->lang['formel_tired'],
				'MODE' 			=> $modus,
				'TIREDCOMBO' 	=> $combo_tired,
				'L_TITLE' 		=> $user->lang['formel_results_resulttitle'],
				'L_ADD' 		=> $user->lang['formel_results_add'])
			);
		}

		$template->assign_vars(array(
			'S_ADDRESULTS'					=> true,
			'S_FORM_ACTION' 				=> append_sid("./formel.$phpEx?mode=addresults"),
			'U_FORMEL' 						=> append_sid("./formel.$phpEx"),
			'U_FORMEL_RESULTS' 				=> append_sid("./formel.$phpEx?mode=results"),
			'L_FORMEL_RESULT' 				=> $user->lang['formel_current_result'],
			'RACE_ID' 						=> $race_id,
			'L_FORMEL_RESULTS_TITLE' 		=> $user->lang['formel_results_title'],
			'L_FORMEL_TITLE' 				=> $user->lang['formel_title'],
			'L_FORMEL_RESULTS_TITLE_EXP' 	=> $user->lang['formel_results_title_exp'])
		);

	break;

	case 'usertipp':

		// Set template vars
		$page_title = $user->lang['formel_title'];
		$template_html = 'formel_body.html';
		
		// Check buttons & data
		$tipp_id = request_var('tipp'	,	0	);
		$race_id = request_var('race'	,	0	);

		// Get current race and time
		$race 			= get_formel_races();
		$results		= explode(",",$race[$race_id]['race_result']);
		$current_time	= time();

		// Get current tip
		$sql = 'SELECT * 
			FROM ' . FORMEL_TIPPS_TABLE . " 
			WHERE tipp_id = '" . $db->sql_escape($tipp_id) . "'";
		$result = $db->sql_query($sql);

		$tipp_active = $db->sql_affectedrows($result);
		$tippdata = $db->sql_fetchrowset($result);
		$tipp_userdata = get_formel_userdata($tippdata[0]['tipp_user']);
		$db->sql_freeresult($result);

		// Get all drivers
		$sql = 'SELECT * 
			FROM ' . FORMEL_DRIVERS_TABLE . ' 
			ORDER BY driver_id ASC';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$driver_name[$row['driver_id']] = $row['driver_name'];
		}
		$db->sql_freeresult($result);

		// Get all tip points
		$sql = 'SELECT sum(tipp_points) AS total_points 
			FROM ' . FORMEL_TIPPS_TABLE . " 
			WHERE tipp_user = '" . $db->sql_escape($tipp_userdata['user_id']) . "'";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$tipper_all_points = $row['total_points'];
		}
		$db->sql_freeresult($result);

		// Build output
		if ($tipp_active)
		{
			$tipp_array 		= array();
			$tipper_name 		= get_username_string('username', $tipp_userdata['user_id'], $tipp_userdata['username'], $tipp_userdata['user_colour']);
			$tipp_user_colour	= get_username_string('colour', $tipp_userdata['user_id'], $tipp_userdata['username'], $tipp_userdata['user_colour']);	
			$tipper_style		= ($tipp_user_colour) ? ' style="color: ' . $tipp_user_colour . '; font-weight: bold;"' : '' ;
			$tipper_link 		= ($tipper_name <> $user->lang['GUEST']) ? '<a href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . (int) $tipp_userdata['user_id']) . '"' . $tipper_style . ' target="_blank">' . $tipper_name . '</a>' : $tipper_name;
			$tipper_points 		= $tippdata[0]['tipp_points'];
			$tipp_array 		= explode(',', $tippdata[0]['tipp_result']);
			$is_hidden			= ($race[$race_id]['race_time'] - $formel_config['deadline_offset']  <= $current_time ) ? false : true ;		

			for ($i = 0; $i < count($tipp_array) - 2; $i++)
			{
				$position 		= ($i == 0) ? $user->lang['formel_race_winner'] : $i+1 . '. ' . $user->lang['formel_place'];
				$driver_placed 	= (isset($driver_name[$tipp_array[$i]])) ? $driver_name[$tipp_array[$i]] : '';
				$driverid 		= (isset($tipp_array[$i])) ? $tipp_array[$i] : '';

				//Recalc Tipp Points for Place 1 - 8
				$single_points = 0;
				if (isset($results[$i]))
				{
					if ( ($driverid == $results[$i]) && $driverid <>0 )
					{
						$single_points += $formel_config['points_placed'];
					}
				}
				for ($j = 0; $j < count($tipp_array) - 2; $j++)
				{
					if (isset($results[$j]))
					{
						if ( ($driverid == $results[$j]) && $driverid <>0)
						{
							$single_points += $formel_config['points_mentioned'];
						}
					}
				}
				if ($single_points == 0) $single_points='';

				$template->assign_block_vars('user_drivers', array(
					'DRIVER_PLACED' 	=> ($is_hidden == true) ? $user->lang['formel_hidden'] : $driver_placed,
					'POSITION' 			=> $position,
					'SINGLE_POINTS' 	=> $single_points)
				);
			}

			$fastest_driver_name 	= (isset($driver_name[$tipp_array[8]])) ? $driver_name[$tipp_array[8]] : '';
			$tired 					= (isset($tipp_array[9])) ? $tipp_array[9] : '';

			//Recalc tip points for fastest driver and tired count
			$single_fastest = '';
			$single_tired = '';
			if (isset($results[8]) && $results[8] <> 0)
			{
				if ($tipp_array[8] == $results[8])
				{
					$single_fastest += $formel_config['points_fastest'];
				}
			}
			if (isset($results[9]))
			{
				if ($tipp_array[9] == $results[9])
				{
					$single_tired += $formel_config['points_tired'];
				}
			}
			
			$template->assign_block_vars('user_tipp', array(
				'L_POINTS' 			=> $user->lang['formel_points_won'],
				'L_ALL_POINTS' 		=> $user->lang['formel_all_points'],
				'L_FASTEST' 		=> $user->lang['formel_pace'],
				'L_TIRED' 			=> $user->lang['formel_tired'],
				'L_TIPPER' 			=> $user->lang['formel_watching_tipp'],
				'TIPPER' 			=> $tipper_link,
				'POINTS' 			=> $tipper_points,
				'ALL_POINTS' 		=> $tipper_all_points,
				'FASTEST_DRIVER' 	=> (isset($fastest_driver_name)) ? ($is_hidden == true) ? $user->lang['formel_hidden'] : $fastest_driver_name : '',
				'TIRED' 			=> (isset($tired)) ? ($is_hidden == true) ? $user->lang['formel_hidden'] : $tired : '',
				'SINGLE_FASTEST' 	=> (isset($single_fastest)) ? $single_fastest : '',
				'SINGLE_TIRED' 		=> (isset($single_tired)) ? $single_tired : '')
			);
		}
		else
		{
			$template->assign_block_vars('no_tipp', array(
				'NO_TIPP' => $user->lang['formel_tipp_not_found'])
			);
		}

		// Output global values
		$template->assign_vars(array(
			'S_USERTIPP'		=> true,
			'L_FORMEL_TITLE' => $user->lang['formel_title'],
			'L_CLOSE_WINDOW' => $user->lang['formel_close_window'])
		);
	break;
		
	case 'stats':

		// Set template vars
		$page_title = $user->lang['formel_title'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'		=> append_sid("./formel.$phpEx?mode=stats"),
			'FORUM_NAME' 		=> $user->lang['formel_stats_title'],
		));	
		
		// Check buttons & data
		$show_drivers 	= request_var('show_drivers'	,	''	);
		$show_teams 	= request_var('show_teams'		,	''	);
		
		// Show teams toplist
		if ($show_teams) 
		{
			$stat_table_title = $user->lang['formel_team_stats'];

			// Get all teams
			$teams = get_formel_teams();

			// Get all wm points and fill Top10 teams
			$sql = 'SELECT sum(wm_points) AS total_points, wm_team 
				FROM ' . FORMEL_WM_TABLE . '
				GROUP BY wm_team
				ORDER BY total_points DESC';
			$result = $db->sql_query($sql);

			$rank = $real_rank  = 0;
			$previous_points = false;
			while ($row = $db->sql_fetchrow($result)) 
			{ 
				$real_rank++; 
				if($row['total_points'] <> $previous_points) 
				{ 
					$rank = $real_rank; 
					$previous_points = $row['total_points']; 
				}
				$wm_teamname 	= $teams[$row['wm_team']]['team_name'];
				$wm_teamimg 	= $teams[$row['wm_team']]['team_img'];
				$wm_teamcar 	= $teams[$row['wm_team']]['team_car'];
				$wm_teamimg 	= ( $wm_teamimg == '' ) ? '<img src="images/formel/' . $formel_config['no_team_img'] . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />' : '<img src="images/formel/' . $wm_teamimg . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />';
				$wm_teamcar 	= ( $wm_teamcar == '' ) ? '<img src="images/formel/' . $formel_config['no_car_img']  . '" alt="" width="' . $formel_config['car_img_width']  . '" height="' . $formel_config['car_img_height']  . '" />' : '<img src="images/formel/' . $wm_teamcar . '" alt="" width="' . $formel_config['car_img_width']  . '" height="' . $formel_config['car_img_height']  . '" />';
				if ( $formel_config['show_gfx'] == 1 )
				{
					$template->assign_block_vars('top_teams_gfx', array(
						'RANK' 			=> $rank,
						'WM_TEAMNAME' 	=> $wm_teamname,
						'WM_TEAMIMG' 	=> $wm_teamimg,
						'WM_TEAMCAR' 	=> $wm_teamcar,
						'WM_POINTS' 	=> $row['total_points'])
					);
				}
				else 
				{
					$template->assign_block_vars('top_teams', array(
						'RANK' 			=> $rank,
						'WM_TEAMNAME' 	=> $wm_teamname,
						'WM_POINTS' 	=> $row['total_points'])
					);
				}
			}
			$db->sql_freeresult($result);
		}

		// Show drivers toplist
		else if ($show_drivers) 
		{
			$stat_table_title = $user->lang['formel_driver_stats'];

			// Get all data
			$teams 		= get_formel_teams();
			$drivers 	= get_formel_drivers();

			// Get all wm points and fill top10 drivers
			$sql = 'SELECT sum(wm_points) AS total_points, wm_driver, wm_team 
				FROM ' . FORMEL_WM_TABLE . '
				GROUP BY wm_driver
				ORDER BY total_points DESC';
			$result = $db->sql_query($sql);

			$rank = $real_rank  = 0;
			$previous_points = false;
			while ($row = $db->sql_fetchrow($result)) 
			{ 
				$real_rank++; 
				if($row['total_points'] <> $previous_points) 
				{ 
					$rank = $real_rank; 
					$previous_points = $row['total_points']; 
				}
				$wm_drivername 	= $drivers[$row['wm_driver']]['driver_name'];
				$wm_driverimg 	= $drivers[$row['wm_driver']]['driver_img'];
				$wm_drivercar 	= $drivers[$row['wm_driver']]['driver_car'];
				$wm_driverteam 	= $teams[$row['wm_team']]['team_img'];
				$wm_driverteam 	= ( $wm_driverteam == '' ) ? '<img src="images/formel/' . $formel_config['no_team_img'] . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />' : '<img src="images/formel/' . $wm_driverteam . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />';

				if ( $formel_config['show_gfx'] == 1 )
				{
					$template->assign_block_vars('top_drivers_gfx', array(
						'RANK' 				=> $rank,
						'WM_DRIVERNAME' 	=> $wm_drivername,
						'WM_DRIVERIMG' 		=> $wm_driverimg,
						'WM_DRIVERCAR' 		=> $wm_drivercar,
						'WM_DRIVERTEAM' 	=> $wm_driverteam,
						'WM_POINTS' 		=> $row['total_points'])
					);
				}
				else 
				{
					$template->assign_block_vars('top_drivers', array(
						'RANK' 				=> $rank,
						'WM_DRIVERNAME' 	=> $wm_drivername,
						'WM_POINTS' 		=> $row['total_points'])
					);
				}
			}
			$db->sql_freeresult($result);
		}

		// Show users toplist
		else 
		{
			$stat_table_title = $user->lang['formel_user_stats'];

			// Get all tips and fill top10
			$sql = 'SELECT sum(tipp_points) AS total_points, tipp_user 
				FROM ' . FORMEL_TIPPS_TABLE . '
				GROUP BY tipp_user
				ORDER BY total_points DESC';
			$result = $db->sql_query($sql);

			$rank = $real_rank  = 0;
			$previous_points = false;
			$alt = 'USER_AVATAR';
			while ($row = $db->sql_fetchrow($result)) 
			{ 
				$real_rank++; 
				if($row['total_points'] <> $previous_points) 
				{ 
					$rank = $real_rank; 
					$previous_points = $row['total_points']; 
				}
				$tipp_user_row			= get_formel_userdata($row['tipp_user']);
				$tipp_username_link		= get_username_string('full', $tipp_user_row['user_id'], $tipp_user_row['username'], $tipp_user_row['user_colour'] );
				$tipp_user_avatar 		= '';
				$show_avatar_switch 	= false;
				
				if ( $formel_config['show_avatar'] == 1 )
				{
					if (!empty($tipp_user_row['user_avatar']))
					{
						switch ($tipp_user_row['user_avatar_type'])
						{
							case AVATAR_UPLOAD:
								$tipp_user_avatar = $phpbb_root_path . "download/file.$phpEx?avatar=";
							break;

							case AVATAR_GALLERY:
								$tipp_user_avatar = $phpbb_root_path . $config['avatar_gallery_path'] . '/';
							break;
						}
						$tipp_user_avatar .= $tipp_user_row['user_avatar'];

						$tipp_user_avatar = '<img src="' . $tipp_user_avatar . '" width="' . $tipp_user_row['user_avatar_width'] . '" height="' . $tipp_user_row['user_avatar_height'] . '" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';
					}
					else
					{
						$tipp_user_avatar = '<img src="' . $phpbb_root_path . 'adm/images/no_avatar.gif" width="' . $config['avatar_max_width'] . '" height="' . $config['avatar_max_height'] . '" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';				
					}
					$show_avatar_switch 	= true;
				}
				
				
				$template->assign_block_vars('top_tippers', array(
					'S_AVATAR_SWITCH'		=> $show_avatar_switch,
					'TIPPER_AVATAR'			=> $tipp_user_avatar,
					'TIPPER_AVATAR_WIDTH'	=> $config['avatar_max_width'] + 10,
					'TIPPER_AVATAR_HEIGHT'	=> $config['avatar_max_height'] + 10,
					'TIPPER_NAME'			=> $tipp_username_link,
					'RANK'					=> ($rank == 1 || $rank == 2 || $rank == 3) ? "<b>" . $rank . "</b>" : $rank,
					'TIPPER_POINTS'			=> $row['total_points'])
				);
			}
			$db->sql_freeresult($result);
		}

		// Show headerbanner ?
		if ( $formel_config['show_headbanner'] )
		{
			$template->assign_block_vars('head_on', array());
		}

		$template->assign_vars(array(
			'S_STATS'				=> true,
			'S_FORM_ACTION' 		=> append_sid("./formel.$phpEx?mode=stats"),
			'U_FORMEL_STATS' 		=> append_sid("./formel.$phpEx?mode=stats"),
			'L_BUTTON_USERS' 		=> $user->lang['formel_user_stats'],
			'L_BUTTON_DRIVERS' 		=> $user->lang['formel_driver_stats'],
			'L_BUTTON_TEAMS' 		=> $user->lang['formel_team_stats'],
			'L_FORMEL_TITLE' 		=> $user->lang['formel_title'],
			'L_FORMEL_TOP_POINTS'	=> $user->lang['formel_top_points'],
			'HEADER_IMG' 			=> $formel_config['headbanner3_img'],
			'HEADER_URL' 			=> $formel_config['headbanner3_url'],
			'HEADER_HEIGHT' 		=> $formel_config['head_height'],
			'HEADER_WIDTH' 			=> $formel_config['head_width'],
			'L_STAT_TABLE_TITLE' 	=> $stat_table_title,
			'U_FORMEL' 				=> append_sid("./formel.$phpEx"),
			'U_BACK_TO_TIPP' 		=> append_sid("./formel.$phpEx"),
			'L_BACK_TO_TIPP' 		=> $user->lang['formel_back_to_tipp'],
			'L_FORMEL_STATS_TITLE' 	=> $user->lang['formel_stats_title'])
		);
	break;
		
	case 'rules':

		// Set template vars
		$page_title = $user->lang['formel_title'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'		=> append_sid("./formel.$phpEx?mode=rules"),
			'FORUM_NAME' 		=> $user->lang['formel_rules_title'],
		));	
		
		// Build rules
		$points_mentioned 	= $formel_config['points_mentioned'];
		$points_placed 		= $formel_config['points_placed'];
		$points_fastest 	= $formel_config['points_fastest'];
		$points_tired 		= $formel_config['points_tired'];

		$point 				= $user->lang['formel_rules_point'];
		$points 			= $user->lang['formel_rules_points'];

		if ( $points_mentioned == '1' ) 
		{
			$points_mentioned .= ' ' . $point;
		}
		else 
		{
			$points_mentioned .= ' ' . $points;
		}

		if ( $points_placed == '1' ) 
		{
			$points_placed .= ' ' . $point;
		}
		else 
		{
			$points_placed .= ' ' . $points;
		}

		if ( $points_fastest == '1' ) 
		{
			$points_fastest .= ' ' . $point;
		}
		else 
		{
			$points_fastest .= ' ' . $points;
		}

		if ( $points_tired == '1' ) 
		{
			$points_tired .= ' ' . $point;
		}
		else 
		{
			$points_tired .= ' ' . $points;
		}

		$points_total = 8 * ( $points_mentioned + $points_placed ) + $points_fastest + $points_tired;
		if ( $points_total == '1' ) 
		{
			$points_total .= ' ' . $point;
		}
		else 
		{
			$points_total .= ' ' . $points;
		}

		$rules_mentioned 	= sprintf($user->lang['formel_rules_mentioned'] 	, $points_mentioned);
		$rules_placed 		= sprintf($user->lang['formel_rules_placed']		, $points_placed);
		$rules_fastest 		= sprintf($user->lang['formel_rules_fastest'] 		, $points_fastest);
		$rules_tired 		= sprintf($user->lang['formel_rules_tired'] 		, $points_tired);
		$rules_total 		= sprintf($user->lang['formel_rules_total'] 		, $points_total);

		// Show headerbanner ?
		if ( $formel_config['show_headbanner'] )
		{
			$template->assign_block_vars('head_on', array());
		}

		$template->assign_vars(array(
			'S_RULES'					=> true,
			'L_FORMEL_RULES_TITLE' 		=> $user->lang['formel_rules_title'],
			'L_FORMEL_RULES_GEN' 		=> $user->lang['formel_rules_general'],
			'FORMEL_RULES_GEN' 			=> $user->lang['formel_rules_gen_exp'],
			'L_FORMEL_RULES_POINTS' 	=> $user->lang['formel_rules_score'],
			'HEADER_IMG' 				=> $formel_config['headbanner2_img'],
			'HEADER_URL' 				=> $formel_config['headbanner2_url'],
			'HEADER_HEIGHT' 			=> $formel_config['head_height'],
			'HEADER_WIDTH' 				=> $formel_config['head_width'],
			'FORMEL_RULES_MENTIONED' 	=> $rules_mentioned,
			'FORMEL_RULES_PLACED' 		=> $rules_placed,
			'FORMEL_RULES_FASTEST' 		=> $rules_fastest,
			'FORMEL_RULES_TIRED' 		=> $rules_tired,
			'FORMEL_RULES_TOTAL' 		=> $rules_total,
			'L_FORMEL_TITLE' 			=> $user->lang['formel_title'],
			'U_FORMEL' 					=> append_sid("./formel.$phpEx"),
			'U_FORMEL_RULES' 			=> append_sid("./formel.$phpEx?mode=rules"),
			'L_BACK_TO_TIPP' 			=> $user->lang['formel_back_to_tipp'],
			'L_FORMEL_STATS_TITLE' 		=> $user->lang['formel_stats_title'])
		);
	break;
		
	default:
		$auth_msg = sprintf($user->lang['formel_error_mode'], '<a href="' . append_sid("formel.$phpEx") . '" class="gen">', '</a>', '<a href="'.append_sid("index.$phpEx").'" class="gen">', '</a>');
		trigger_error($auth_msg);
	break;
}

// Output the page
page_header($page_title);

$template->set_filenames(array(
	'body' => $template_html)
);
page_footer();

?>
