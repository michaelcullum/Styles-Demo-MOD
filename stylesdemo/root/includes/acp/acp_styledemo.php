<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/includes/acp/
* @version: $Id: acp_styledemo.php, v 1.0.1 2010/11/25 10:11:25 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
*
**/

/**
* @ignore
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
**/
class acp_styledemo
{
	var $u_action;

	function main($id, $mode)
	{
		global $user;

		$user->add_lang('mods/mod_styledemo');

		$this->tpl_name = 'acp_styledemo';
		$this->page_title = 'ACP_CAT_STYLES';

		$action = request_var('action', '');
		$style_id = request_var('style_id', 0);

		switch ($mode)
		{
			default:
			case 'settings':
				$this->settings();
			break;

			case 'style':
				// Execute overall actions
				switch ($action)
				{
					case 'edit':
						if ($style_id)
						{
							return $this->edit_style($style_id);
						}
					break;
				}

				$this->frontend('style');
			break;

		}
	}

	/**
	* Display details
	**/
	function settings()
	{
		global $template, $db, $config, $user, $cache, $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_styledemo.' . $phpEx);
		$styledemo = new style_demo();

		$this->page_title = 'ACP_SD_SETTINGS';

		$error = array();

		$update = (isset($_POST['update'])) ? true : false;

		add_form_key('acp_style_settings');

		if ($update)
		{
			if (!check_form_key('acp_style_settings'))
			{
				trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$data = array(
				'sd_mod' 				=> request_var('sd_mod', 0),
			//	'style_demo'			=> request_var('style_demo', '', true),
				'sd_hide_frame'			=> request_var('sd_hide_frame', 0),
				'sd_top_frame_height'	=> request_var('sd_top_frame_height', 0),
				'sd_style_active'		=> request_var('sd_style_active', 0),
				'sd_language_active'	=> request_var('sd_language_active', 0),
				'sd_guest' 				=> request_var('sd_guest', 0),
			);

			if ($data['sd_top_frame_height'] < 20 || $data['sd_top_frame_height'] > 200)
			{
				$error[] = $user->lang['STYLE_ERR_NO_IDS'];
			}

			if (!sizeof($error))
			{
				foreach ($data as $config_name => $config_value)
				{
					set_config($config_name, $config_value);
				}
				trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
			}
		}

		$template->assign_vars(array(
			'S_SETTINGS'	=> true,
			'L_TITLE'		=> $user->lang[$this->page_title],
			'L_EXPLAIN'		=> $user->lang[$this->page_title . '_EXPLAIN'],
			'S_ERROR_MSG'	=> (sizeof($error)) ? true : false,
			'ERROR_MSG'		=> (sizeof($error)) ? implode('<br />', $error) : '',
			'U_ACTION'		=> $this->u_action . '&amp;mode=settings',
			'U_BACK'		=> $this->u_action,
			'U_MSSTI'		=> sprintf($user->lang['SD_LINK_TO_MSSTI'], $styledemo->settings['style_demo']),
			
			'S_SD_ENABLE'			=> ($styledemo->settings['sd_mod']) ? true : false,

			'S_SD_HIDE_FRAME'		=> ($styledemo->settings['sd_hide_frame']) ? true : false,
			'S_SD_TOP_FRAME_HEIGHT'	=> $styledemo->settings['sd_top_frame_height'],
			'S_SD_STYLE_ACTIVE'		=> ($styledemo->settings['sd_style_active']) ? true : false,
			'S_SD_LANGUAGE_ACTIVE'	=> ($styledemo->settings['sd_language_active']) ? true : false,
			'S_SD_GUEST_ENABLE'		=> ($styledemo->settings['sd_guest']) ? true : false,
			)
		);
	}

	/**
	* Build Frontend with supplied options
	**/
	function frontend($mode)
	{
		global $db, $user, $template;

		$sql = "SELECT *
			FROM " . STYLES_TABLE;
		$result = $db->sql_query($sql);

		$s_options = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$s_options .= '<option value="' . $row[$mode . '_id'] . '">' . $row[$mode . '_name'] . '</option>';
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'S_FRONTEND'	=> true,
			'L_TITLE'		=> $user->lang['ACP_SD_TITLE'],
			'L_EXPLAIN'		=> $user->lang['ACP_SD_TITLE_EXPLAIN'],
			'U_ACTION'		=> $this->u_action . '&amp;action=edit' ,
			'S_OPTIONS'		=> $s_options)
		);
	}

	/**
	* Edit style data.
	*
	* @param int $style_id
	**/
	function edit_style($style_id)
	{
		global $cache, $db, $user, $template, $config, $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_styledemo.' . $phpEx);
		$styledemo = new style_demo();

		$error = array();

		$update = (isset($_POST['update'])) ? true : false;

		$this->page_title = 'ACP_SD_TITLE';

		add_form_key('acp_style_edit');

		$style_id = (int) $style_id;

		if ($update)
		{
			if (!check_form_key('acp_style_edit'))
			{
				trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$data = array(
				'style_version' => request_var('style_version', '', true),
				'phpbb_version'	=> request_var('phpbb_version', '', true),
				'author'		=> utf8_normalize_nfc(request_var('style_author', '', true)),
				'web_author'	=> request_var('style_web_author', '', true),
				'support'		=> request_var('style_support', '', true),
				'download'		=> request_var('style_download', '', true),
			);

			$error = $this->validate_data($data, array(
				'style_version'		=> array(
					'string', true, 0, 10),
				'phpbb_version'		=> array(
					'string', true, 0, 10),
				'author'			=> array('string', true, 0, 255),
				'web_author'		=> array(
					array('string', true, 0, 255),
					array('match', true, '#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i')),
				'support'			=> array(
					array('string', true, 0, 255),
					array('match', true, '#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i')),
				'download'		=> array(
					array('string', true, 0, 255),
					array('match', true, '#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i')),
			));

			if (!sizeof($error))
			{
				$sql_ary = array(
					'style_version'	=> $data['style_version'],
					'phpbb_version'	=> $data['phpbb_version'],
					'author'		=> $data['author'],
					'web_author'	=> $data['web_author'],
					'support'		=> $data['support'],
					'download'		=> $data['download'],
					'updated'		=> 1,
				);

				$sql = 'UPDATE ' . STYLES_DEMO_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
						WHERE style_id = $style_id";
				$db->sql_query($sql);

				if (!$db->sql_affectedrows())
				{
					$sql_ary['style_id'] = $style_id;

					$db->sql_return_on_error(true);
					$sql = 'INSERT INTO ' . STYLES_DEMO_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
					$db->sql_query($sql);
					$db->sql_return_on_error(false);
				}

				$cache->destroy('sql', STYLES_DEMO_TABLE);

				trigger_error($user->lang['ACP_SD_STYLE_UPDATED'] . adm_back_link($this->u_action));
			}
		}
		
		$style_data = $styledemo->style_data($style_id);

		if (!$style_data['updated'])
		{
			$installcfg = array();
			$cfg_file = $phpbb_root_path . 'styles/' . $style_data['template_path'] . "/style.cfg";
			if (@file_exists($cfg_file))
			{
				$installcfg = parse_cfg_file($cfg_file);
			}
			if (sizeof($installcfg))
			{
				if (isset($installcfg['version']))
				{
					$style_data['style_version'] = $installcfg['version'];
				}
				if (isset($installcfg['author']))
				{
					$style_data['author'] = $installcfg['author'];
				}
			}
		}

		if ($update && sizeof($error))
		{
			$style_data = array_merge($style_data, $data);
		}

		if (!$style_data)
		{
			trigger_error($user->lang['SD_NO_STYLE_DATA'] . adm_back_link($this->u_action), E_USER_WARNING);
		}

		$template->assign_vars(array(
			'S_EDIT_STYLE'	=> true,
			'L_TITLE'		=> $user->lang[$this->page_title],
			'L_EXPLAIN'		=> $user->lang[$this->page_title . '_EXPLAIN'],

			'S_ERROR_MSG'	=> (sizeof($error)) ? true : false,
			'ERROR_MSG'		=> (sizeof($error)) ? implode('<br />', $error) : '',
			'U_ACTION'		=> $this->u_action . '&amp;action=edit&amp;style_id=' . $style_id,
			'U_BACK'		=> $this->u_action,

			'S_DEFAULT_STYLE'		=> ($style_data['style_id'] == $config['default_style']) ? true : false,
			'STYLE_ID'				=> $style_data['style_id'],
			'SELECTED_TEMPLATE'		=> $style_data['template_name'],
			// 1º, add the style data from phpbb_styles
			'STYLE_NAME'			=> $style_data['style_name'],
			'STYLE_COPYRIGHT'		=> $style_data['style_copyright'],
		//	'TEMPLATE_ID'			=> $style_data['template_id'],
		//	'THEME_ID'				=> $style_data['theme_id'],
		//	'IMAGESET_ID'			=> $style_data['imageset_id'],
			// 2º, add the style data from phpbb_styles_theme
			'THEME_NAME'			=> $style_data['theme_name'],
			// 3º, add the style data from phpbb_styles_imageset
			'IMAGESET_NAME'			=> $style_data['imageset_name'],
			// 4º, add the style data from phpbb_styles_template
			'TEMPLATE_NAME'			=> $style_data['template_name'],
			'TEMPLATE_INHERIT_FROM'	=> $style_data['template_inherit_path'],
			// 5º, add the style data from phpbb_styles_demo
			'STYLE_VERSION'			=> $style_data['style_version'],
			'PHPBB_VERSION'			=> $style_data['phpbb_version'],
			'AUTHOR'				=> $style_data['author'],
			'WEB_AUTHOR'			=> $style_data['web_author'],
			'SUPPORT'				=> $style_data['support'],
			'DOWNLOAD'				=> $style_data['download'],
		));
	}

	/**
	* Data validation ...
	*
	* Based off root/includes/functions_user.php
	**/
	function validate_data($data, $val_ary)
	{
		global $user, $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

		$error = array();

		foreach ($val_ary as $var => $val_seq)
		{
			if (!is_array($val_seq[0]))
			{
				$val_seq = array($val_seq);
			}

			foreach ($val_seq as $validate)
			{
				$function = array_shift($validate);
				array_unshift($validate, $data[$var]);

				if ($result = call_user_func_array('validate_' . $function, $validate))
				{
					$error[] = (isset($user->lang[$result . '_' . strtoupper($var)])) ? $user->lang[$result . '_' . strtoupper($var)] : '<strong>' . $user->lang['SD_' . strtoupper($var)]  . ' :</strong> ' . $user->lang[$result];
				}
			}
		}

		return $error;
	}
}

?>