<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/includes/
* @version: $Id: functions_styledemo.php, v 1.0.1 2010/11/25 10:11:25 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
**/

/**
* @ignore
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* style_demo class
**/
class style_demo
{
	var $settings = array();

	var $style = 0;
	var $styles = '';

	var $lang = '';
	var $langs = '';

	/**
	* Constructor
	*
	* @return style_demo
	**/
	function style_demo()
	{
		global $user, $table_prefix, $config, $phpEx;

		// Table names
	//	define('STYLES_DEMO_TABLE', $table_prefix . 'styles_demo');

		// Some default values
		$this->settings = array(
			'sd_index'				=> "./" . $user->page['page_name'],
			'sd_mod'				=> (isset($config['sd_mod']))				? $config['sd_mod']					: true,
			'style_demo'			=> (isset($config['style_demo']))			? $config['style_demo']				: '1.0.1',
			'sd_hide_frame'			=> (isset($config['sd_hide_frame']))		? $config['sd_hide_frame']			: true,
			'sd_top_frame_height'	=> (isset($config['sd_top_frame_height']))	? $config['sd_top_frame_height']	: 80,
			'sd_style_active'		=> (isset($config['sd_style_active']))		? $config['sd_style_active']		: true,
			'sd_language_active'	=> (isset($config['sd_language_active']))	? $config['sd_language_active']		: true,
			'sd_guest'				=> (isset($config['sd_guest']))				? $config['sd_guest']				: true,
		);
	}

	/**
	* Initialize common variables
	**/
	function setup()
	{
		global $user;

		// Get default values
		$this->style = $this->request_var('style');
		$this->lang  = $this->request_var('lang');

		// Dropdown oprions
		$this->styles = $this->get_available_styles($this->style, (bool) $this->settings['sd_style_active']);
		$this->langs  = $this->get_available_language($this->lang);

		// Set default values
		$user->data['user_style'] = $this->style;
		$user->data['user_lang']  = $this->lang;

		// Now it's time for this
		$user->setup('mods/mod_styledemo');
	}

	/**
	* request_var
	* Used to get and set a variable
	*
	* @param mix	$var
	* @return mix
	**/
	function request_var($var = 'style')
	{
		global $user, $config;

		$var = trim($var);
		$mode = request_var('mode', '');
		$default = ($var == 'style') ? 0: '';

		// Same as session line 788
		$cookie_expire = time() + (($config['max_autologin_time']) ? 86400 * (int) $config['max_autologin_time'] : 31536000);
		$cookie_name_var = "sd{$var}";

		// First we try param
		$default = request_var($var, $default);

		// If we have no param, lets try with cookies
		if (!$default && $mode != 'no_cookies')
		{
			$default = basename(request_var($config['cookie_name'] . '_' . $cookie_name_var, $default, false, true));
		}

		// If we have nothing yet, use the user default values
		if (!$default)
		{
			$default = ($var == 'style') ? $user->data['user_style'] : $user->data['user_lang'];
		}

		// Save the value into a cookie
		$user->set_cookie($cookie_name_var, $default, $cookie_expire);

		if ($mode == 'no_cookies')
		{
			redirect(append_sid($this->settings['sd_index']));
		}

		return $default;
	}

	/**
	* Build the styles dropdown
	*
	* @param string		$default	default style
	* @param bolean		$all		true/false
	* @return html code
	**/
	function get_available_styles($default = '', $all = false)
	{
		$style_options = style_select($default, $all);

		if (substr_count($style_options, '<option') > 1)
		{
			return $style_options;
		}

		return '';
	}

	/**
	* Get Style details
	**/
	function style_details($style_id, $ajax = false)
	{
		$style_data = $this->style_data($style_id);

		if ($style_data)
		{
			global $template;

			$style_data_html = array();
			foreach ($style_data as $field => $data)
			{
				$style_data_html[strtoupper($field)] = $data;
			}
			$style_data_html['STYLE_LINK'] = append_sid($this->settings['sd_index'], array('style' => $style_id));

			$template->assign_block_vars('style_data', $style_data_html);

			if ($ajax)
			{
				$this->display('ajax', $ajax);
			}
		}
		return;
	}

	/**
	* Get more Style details
	**/
	function style_data($style_id)
	{
		global $db;

		$style_id = (int) $style_id;
		$style_data = array(
			'style_id'				=> $style_id,
			// 1º, add the style data from phpbb_styles
			'style_name'			=> '',
			'style_copyright'		=> '',
			'template_id'			=> '',
			'theme_id'				=> '',
			'imageset_id'			=> '',
			// 2º, add the style data from phpbb_styles_theme
			'theme_name'			=> '',
			// 3º, add the style data from phpbb_styles_imageset
			'imageset_name'			=> '',
			// 4º, add the style data from phpbb_styles_template
			'template_name'			=> '',
			'template_path'			=> '',
			'template_inherit_path'	=> '',
			// 5º, add the style data from phpbb_styles_demo
			'style_version'			=> '',
			'phpbb_version'			=> '',
			'author'				=> '',
			'web_author'			=> '',
			'support'				=> '',
			'download'				=> '',
			'updated'				=> 0,
		);

		// First, update the style data from phpbb_styles
		$sql = "SELECT style_name, style_copyright, template_id, theme_id, imageset_id
			FROM " . STYLES_TABLE . "
			WHERE style_id = $style_id";
		$result = $db->sql_query($sql);
		$style_row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($style_row)
		{
			$style_data['style_name']		= $style_row['style_name'];
			$style_data['style_copyright']	= $style_row['style_copyright'];
			$style_data['template_id']		= $template_id	= $style_row['template_id'];
			$style_data['theme_id']			= $theme_id		= $style_row['theme_id'];
			$style_data['imageset_id']		= $imageset_id	= $style_row['imageset_id'];

			// Second, update the style data from phpbb_styles_theme + phpbb_styles_imageset + phpbb_styles_template
			$element_ary = array('theme' => STYLES_THEME_TABLE, 'imageset' => STYLES_IMAGESET_TABLE, 'template' => STYLES_TEMPLATE_TABLE);

			foreach ($element_ary as $element => $table)
			{
				$sql_row = ($element == 'template') ? ', template_inherit_path, template_path' : '';

				$sql = "SELECT {$element}_id, {$element}_name $sql_row
					FROM $table
					WHERE {$element}_id = " . ${$element . '_id'};
				$result = $db->sql_query($sql);
				$element_row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if ($element_row)
				{
					$style_data[$element . '_name'] = $element_row[$element . '_name'];
					$style_data['template_path'] = (isset($element_row['template_path']) && !empty($element_row['template_path'])) ? $element_row['template_path'] : '';
					$style_data['template_inherit_path'] = (isset($element_row['template_inherit_path']) && !empty($element_row['template_inherit_path'])) ? $element_row['template_inherit_path'] : '';
				}
			}

			// Finally, update the style data from phpbb_styles_demo
			$sql = "SELECT style_version, phpbb_version, author, web_author, support, download, updated 
				FROM " . STYLES_DEMO_TABLE . "
				WHERE style_id = $style_id";
			$result = $db->sql_query($sql);
			$demo_row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if ($demo_row)
			{
				foreach ($demo_row as $demo_data => $demo_value)
				{
					$style_data[$demo_data] = $demo_value;
				}
			}
		}
		unset($style_row, $element_row, $demo_row);

		return $style_data;
	}

	/**
	* Build the language dropdown
	*
	* @param string		$default	default language
	* @return html code
	**/
	function get_available_language($default)
	{
		if ($this->settings['sd_language_active'])
		{
			$language_options = language_select($default);

			if (substr_count($language_options, '<option') > 1)
			{
				return $language_options;
			}
		}

		return '';
	}

	/**
	* Enter description here...
	**/
	function set_template()
	{
		global $user, $template, $phpbb_root_path, $phpEx;

		// Parameters
		$panel = request_var('panel', '');

		switch ($panel)
		{
			default :
				// The following assigns all _common_ variables that may be used at any point in a template.
				$template->assign_vars(array(
					'S_HIDE_FRAME'		=> (bool) $this->settings['sd_hide_frame'],
					'S_FRAME_HEIGHT'	=> (int) $this->settings['sd_top_frame_height'],
					'U_SD_INDEX_TOP'	=> append_sid($this->settings['sd_index'], array('panel' => 'top', 'style' => $this->style, 'lang' => $this->lang)),
					'U_SD_INDEX_MID'	=> append_sid($this->settings['sd_index'], array('panel' => 'midbar')),
					'U_SD_INDEX_BOTTOM'	=> append_sid($this->settings['sd_index'], array('panel' => 'bottom', 'style' => $this->style, 'lang' => $this->lang)),
				));

				$this->display('frameset');
			break;

			case 'bottom':
				redirect(append_sid("{$phpbb_root_path}index.$phpEx", array('sd' => 1, 'style' => $this->style, 'lang' => $this->lang)));
			break;

			case 'midbar':
				// The following assigns all _common_ variables that may be used at any point in a template.
				$template->assign_vars(array(
					'S_FRAME_HEIGHT'	=> (int) $this->settings['sd_top_frame_height'],
				));

				$this->display('midbar');
			break;

			case 'top':
				// The following assigns all _common_ variables that may be used at any point in a template.
				$template->assign_vars(array(
					'S_LOGO'			=> (@file_exists('./images/site_logo.gif')) ? true : false,
					'S_STYLES_OPTIONS'	=> $this->styles,
					'S_LANGS_OPTIONS'	=> $this->langs,
					'STYLE_DETAILS'		=> $this->style_details($this->style),
				));

			//	$this->style_details($this->style);

				$this->display('top');
			break;
		}
	}

	function display($panel = '')
	{
		global $template, $user, $config, $phpbb_root_path, $phpEx;

		// application/xhtml+xml not used because of IE
		header('Content-type: text/html; charset=UTF-8');

		header('Cache-Control: private, no-cache="set-cookie"');
		header('Expires: 0');
		header('Pragma: no-cache');

		// Set custom template for admin area
		$template->set_custom_template($phpbb_root_path . 'styledemo', 'sd');

		// the stylesdemo template is never stored in the database
		$user->theme['template_storedb'] = false;

		// The following assigns all _common_ variables that may be used at any point in a template.
		$template->assign_vars(array(
			'S_CONTENT_ENCODING'	=> 'UTF-8',
			'S_CONTENT_DIRECTION'	=> $user->lang['DIRECTION'],
			'S_USER_LANG'			=> $user->lang['USER_LANG'],
			'SITENAME'				=> $config['sitename'],
			'SITE_DESCRIPTION'		=> $config['site_desc'],
			'PAGE_TITLE'			=> $user->lang['SD_TITLE'],

			'S_PANEL'				=> $panel,
			// Don't use append_sid()
			'U_SD_INDEX'			=> $this->settings['sd_index'],
			'UA_SD_INDEX'			=> addslashes($this->settings['sd_index']),
		));

		$template->set_filenames(array(
			'body' => 'styledemo_body.html',
		));

		$template->display('body');

		garbage_collection();
		exit_handler();
	}
}

?>