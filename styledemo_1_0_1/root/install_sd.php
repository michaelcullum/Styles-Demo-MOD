<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/
* @version: $Id: install_sd.php, v 3.0.8 2010/11/25 10:11:25 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
**/

/**
* @ignore
**/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
if (!defined('DEBUG'))
{
	@define('DEBUG', true);
}

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/" onclick="window.open(this.href);return false;">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

$mod_data = array(
	'config'	=> 'style_demo',
	'name'		=> 'INSTALLER_TITLE',
	'version'	=> '1.0.1',
	'language'	=> 'mods/mod_styledemo',
);

// The name of the mod to be displayed during installation.
$mod_name = $mod_data['name'];

// The name of the config variable which will hold the currently installed version
$version_config_name = $mod_data['config'];

// Add the language file if one was specified
if (isset($mod_data['language']))
{
	$user->add_lang($mod_data['language']);
}
/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
* $mod_name
* 'INSTALL_' . $mod_name
* 'INSTALL_' . $mod_name . '_CONFIRM'
* 'UPDATE_' . $mod_name
* 'UPDATE_' . $mod_name . '_CONFIRM'
* 'UNINSTALL_' . $mod_name
* 'UNINSTALL_' . $mod_name . '_CONFIRM'
*/

// Logo Image
$logo_img = $phpbb_root_path . 'styledemo/images/site_logo.gif';

// The array of versions and actions within each.
$versions = array(
	// Version 1.0.0
	'1.0.0'		=> array(
		// Modules
		'module_add'	=> array(
			// First, lets add a new category named ACP_ABBCODES to ACP_CAT_POSTING
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_SD_TITLE'),
			// Frontend Module
			array('acp', 'ACP_SD_TITLE', array(
					'module_basename'	=> 'styledemo',
					'module_langname'	=> 'ACP_SD_SETTINGS',
					'module_mode'		=> 'settings',
					'module_auth'		=> 'acl_a_board',
				),
			),
			// Config Module
			array('acp', 'ACP_SD_TITLE', array(
					'module_basename'	=> 'styledemo',
					'module_langname'	=> 'ACP_SD_STYLES',
					'module_mode'		=> 'style',
					'module_auth'		=> 'acl_a_board',
				),
			),
		),

		// Config
		'config_add'	=> array(
			array('sd_mod',					(isset($config['sd_mod']))				? $config['sd_mod']					: 1),
			array('sd_guest',				(isset($config['sd_guest']))			? $config['sd_guest']				: 1),
			array('sd_hide_frame',			(isset($config['sd_hide_frame']))		? $config['sd_hide_frame']			: 1),
			array('sd_top_frame_height',	(isset($config['sd_top_frame_height']))	? $config['sd_top_frame_height']	: 80),
			array('sd_style_active',		(isset($config['sd_style_active']))		? $config['sd_style_active']		: 1),
		),

		// Add table
		'table_add'	=> array(
			array('phpbb_styles_demo', 
				array(
					'COLUMNS'		=> array(
						'style_id'		=> array('UINT',		0),
						'style_version'	=> array('VCHAR:10',	''),
						'phpbb_version'	=> array('VCHAR:10',	''),
						'author'		=> array('VCHAR:100',	''),
						'web_author'	=> array('VCHAR:255',	''),
						'support'		=> array('VCHAR:255',	''),
						'download'		=> array('VCHAR:255',	''),
						'updated'		=> array('UINT',		0),
					),
					'PRIMARY_KEY'	=> 'style_id',
					'KEYS'			=> array(
						'updated'		=> array('INDEX', 'updated'),
					),
				),
			),
		),

		/**
		* After all add/update bbcodes 
		'custom' => 'custom_end',
		**/
	),
	// No changes from 1.0.0 to 1.0.1
	'1.0.1'		=> array(),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>