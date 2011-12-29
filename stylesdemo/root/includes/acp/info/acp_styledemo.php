<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/includes/acp/info
* @version: $Id: acp_styledemo.php, v 1.0.1 2010/11/25 10:11:25 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
*
**/

/**
* @package module_install
**/
class acp_styledemo_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_styledemo',
			'title'		=> 'ACP_SD_TITLE',
			'version'	=> '1.0.1',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_SD_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_MODS')),
				'style'		=> array('title' => 'ACP_SD_STYLES', 'auth' => 'acl_a_board', 'cat' => array('ACP_MODS')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>