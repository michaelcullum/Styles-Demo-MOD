<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/styledemo/
* @version: $Id: index.php, v 1.0.1 2010/11/25 10:11:25 leviatan21 Exp $
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

if (!$styledemo->settings['sd_mod'] || (!$user->data['is_registered'] && !$styledemo->settings['sd_guest'])/** || $user->data['is_bot'] **/)
{
	trigger_error('NOT_AUTHORISED');
}

if (request_var('ajax', 0))
{
	return $styledemo->style_details($styledemo->style, $ajax = true);
}

$styledemo->set_template();

?>