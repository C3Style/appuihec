<?php
/*------------------------------------------------------------------------
defined('_JEXEC') or die;
JHTML::_( 'behavior.mootools' );
$document = &JFactory::getDocument();
$document->addScript(JURI::base().'modules/mod_rizlogin/js/jquery.min.js');
$document->addScript(JURI::base().'modules/mod_rizlogin/js/jquery-ui.min.js');
$document->addScript(JURI::base().'modules/mod_rizlogin/js/side-bar.js');
// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');
$params->def('greeting', 1);