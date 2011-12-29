<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/styledemo/
* @version: $Id: index.php, v 1.0.2 2011/01/24 11:01:24 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
**/

/**
* @ignore
**/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_styledemo.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
/** Not yet
$user->setup();
**/
$styledemo = new style_demo();

$styledemo->setup();

if (!$styledemo->settings['sd_mod'])
{
	// Default message
	$message = 'NOT_AUTHORISED';

	// Message for bots 
	if ($user->data['is_bot'])
	{
		send_status_line(503, 'Service Unavailable');
	}
	// Is board disabled ?
	if ($config['board_disable'])
	{
		$message = 'BOARD_DISABLE';
	}
	// Is style demo disabled for guests
	if (!$user->data['is_registered'] && !$styledemo->settings['sd_guest'])
	{
		$message = (isset($user->lang['SD_LOGIN_EXPLAIN'])) ? $user->lang['SD_LOGIN_EXPLAIN'] : $message;
	}
	// Is style demo disabled 
	else
	{
		$message = (!$styledemo->settings['sd_mod']) ? 'SD_DISABLE' : $message;
	}

	trigger_error($message);
}

if (request_var('ajax', 0))
{
	return $styledemo->style_details($styledemo->style, $ajax = true);
}

$styledemo->set_template();

?>