<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/language/en/mods :: [en][English]
* @version: $Id: mod_styledemo.php, v 1.0.2 2011/01/24 11:01:24 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
*
**/

/**
* DO NOT CHANGE
**/
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
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// UMIL Installer
	'INSTALLER_TITLE'				=> 'Style Demo',
	'INSTALLER_TITLE_EXPLAIN'		=> 'Welcome to the <strong>Style Demo</strong> Installation menu',

// ACP 
	'SD_LINK_TO_MSSTI'				=> 'Style Demo MOD, version %s by <a href="http://www.mssti.com/phpbb3" onclick="window.open(this.href);return false;">mssti</a>',

	'ACP_SD_TITLE'					=> 'Style Demo',
	'ACP_SD_TITLE_EXPLAIN'			=> 'Here you can manage the available styles on your board. You may alter existing styles data for the “Style Demo MOD”, note that this data do not interferer with the phpBB styles data. The current default style is noted by the presence of an asterisk (*).',
	'ACP_SD_SETTINGS'				=> 'Style Demo settings',
	'ACP_SD_SETTINGS_EXPLAIN'		=> 'Here you can adjust the basic settings of the “Style Demo MOD”.',
// ACP Settings
	'ACP_SD_DISABLE'				=> 'Disable',
	'ACP_SD_DISABLE_EXPLAIN'		=> 'This will make the “Style Demo MOD” unavailable to every body. ',
	'ACP_SD_HIDE_FRAME'				=> 'Hide frame',
	'ACP_SD_HIDE_FRAME_EXPLAIN'		=> 'Disable the “Collapse/Expand” view bar.',
	'ACP_SD_TOPFRAME_HEIGHT'		=> 'Frame height',
	'ACP_SD_TOPFRAME_HEIGHT_EXPLAIN'=> 'Default height of the top frame.',
	'ACP_SD_STYLE_ACTIVE'			=> 'Available styles',
	'ACP_SD_STYLE_ACTIVE_EXPLAIN'	=> 'Display all ( Activated and Deactivated ) installed styles, or only Activated styles.',
	'ACP_SD_LANGUAGE_ACTIVE'		=> 'Available languages',
	'ACP_SD_LANGUAGE_ACTIVE_EXPLAIN'=> 'Display a selector with all installed languages.<br />Note: styles must have installed  “imagesets” from each language',
	'ACP_SD_GUESTS_ACTIVE'			=> 'Guests',
	'ACP_SD_GUESTS_ACTIVE_EXPLAIN'	=> 'Disable to non registered users.',
	'ACP_SD_BASIS_OPTIONS'			=> 'Basis Options',
	'ACP_SD_SELECTED_STYLE'			=> 'Selected Style',
	'ACP_SD_SELECT_STYLE'			=> 'Select style',
	'ACP_SD_IDENTIFIER'				=> 'Identification number',
	'ACP_SD_STYLE_NAME'				=> 'Style name',
	'ACP_SD_STYLE_VERSION'			=> 'Style version',
	'ACP_SD_STYLE_VERSION_EXPLAIN'	=> 'Version of the style',
	'ACP_SD_PHPBB_VERSION'			=> 'phpBB version',
	'ACP_SD_PHPBB_VERSION_EXPLAIN'	=> 'Version of phpBB for it was designed',
	'ACP_SD_STYLE_AUTHOR'			=> 'Style author',
	'ACP_SD_STYLE_AUTHOR_EXPLAIN'	=> 'Author’s name or nickname',
	'ACP_SD_WEB_AUTHOR'				=> 'Author’s URL',
	'ACP_SD_WEB_AUTHOR_EXPLAIN'		=> 'Link to the author’s web or to their phpBB profile',
	'ACP_SD_SUPPORT'				=> 'Support URL',
	'ACP_SD_SUPPORT_EXPLAIN'		=> 'Link to a support site',
	'ACP_SD_DOWNLOAD'				=> 'Download URL',
	'ACP_SD_DOWNLOAD_EXPLAIN'		=> 'Link for download this style',
	'ACP_SD_LINK_EXPLAIN'			=> 'Full URL (including the protocol, i.e.: <samp>http://</samp>) to the destination location that clicking this will take the user, e.g.: <samp>http://www.phpbb.com/</samp>',
	'ACP_SD_STYLE_UPDATED'			=> 'Style updated successfully.',
// Common
	'SD_COPYRIGHT'			=> 'Copyright',
	'SD_INHERITING_FROM'	=> 'Inherits from',
	'SD_STYLE_TEMPLATE'		=> 'Template',
	'SD_STYLE_THEME'		=> 'Theme',
	'SD_STYLE_IMAGESET'		=> 'Imageset',
// Script
	'SD_TITLE'				=> 'Style Demo',
	'SD_SELECT_STYLE'		=> 'Select style',
	'SD_STYLE_NAME'			=> 'Style name',
	'SD_STYLE_VERSION'		=> 'Style version',
	'SD_PHPBB_VERSION'		=> 'phpBB version',
	'SD_STYLE_AUTHOR'		=> 'Author',
	'SD_SUPPORT'			=> 'Support',
	'SD_DOWNLOAD'			=> 'Download',
	'SD_COLLAPSE_VIEW'		=> 'Collapse view',
	'SD_EXPAND_VIEW'		=> 'Expand view',
	'SD_PREVIOUS'			=> 'Previous',
	'SD_NEXT'				=> 'Next',
	'SD_DEFAULT_LANG'		=> 'Default language',
	'SD_DELETE_COOKIES'		=> 'Delete cookies',
	'SD_LINK_REMOTE'		=> 'Link off-site',
// Errors
	'WRONG_DATA'		=> 'The website address has to be a valid URL, including the protocol. For example http://www.example.com/.',
	'TOO_LONG'			=> 'The value you entered is too long.',
	'TOO_SHORT'			=> 'The value you entered is too short.',
	'SD_NO_STYLE_DATA'	=> 'Cannot find style data.',
	'SD_NOFRAMES'		=> 'Sorry, but your browser does not seem to support frames',
	'SD_AJAX_DISABLED'	=> '<strong>Status:</strong> Cound not create Object. Your browser does not support AJAX (XMLHttpRequest) and was unable to process this request. Consider upgrading your browser.',
	'SD_LOGIN_EXPLAIN'	=> 'The board requires you to be registered and logged in to view “Style Demo”.',
	'SD_DISABLE'		=> 'Sorry but the “Style Demo” is currently unavailable.',
));

?>