<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: install.docman.php 776 2009-01-21 13:09:35Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

require_once( dirname(__FILE__).DIRECTORY_SEPARATOR.'install.docman.helper.php');

function com_install() 
{	
	$tasks = array('logo', 'files', 'moduleDB', 'pluginDB', 
		'upgradeTables', 'removeAdminMenuImages', 'setAdminMenuImages', 'cpanel' );
	$status = & DMStatus::getInstance();
	
	while($status->get() && $task = array_shift($tasks))
	{
		call_user_func(array('DMInstallHelper', $task));
	}

	
	echo '<ul>';
	foreach($status->getMsgs() as $msg) {
		echo '<li>'.$msg.'</li>';
	}
	echo '</ul>'; 
	return $status->get();
	
}
