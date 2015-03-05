<?php
/**
 * @version   $Id: requirements.php 50440 2012-03-05 15:51:41Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

$errors = array();
if (version_compare(PHP_VERSION, '5.2.8') < 0) {
	$errors[] = 'Needs a minimum PHP version of 5.2.8.  You are running PHP version ' . PHP_VERSION;
}

$jversion = new JVersion();
if (!$jversion->isCompatible('2.5')) {
	$errors[] = 'RokSprocket will only run on Joomla! version 2.5 or greater ';
}


if (!empty($errors)) return $errors;

return true;
