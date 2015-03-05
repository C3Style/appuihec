<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: doclink.php 1118 2010-01-13 23:38:19Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_JEXEC') or die('Restricted access');

include_once dirname(__FILE__).DS.'doclink.html.php';

global $_DOCMAN, $mainframe;

// Load classes and language
require_once($_DOCMAN->getPath('classes', 'utils'));
require_once($_DOCMAN->getPath('classes', 'file'));
require_once($_DOCMAN->getPath('classes', 'model'));
$_DOCMAN->loadLanguage('doclink');

JRequest::setVar('tmpl', 'component');

function showDoclink() {
	
	$user = JFactory::getUser();
	if(!$user->authorize('com_content', 'edit', 'content', 'all')) {
		JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
	}
	
    global $mainframe;

    $assets = JURI::root()."components/com_docman/assets";


    // add styles and scripts
    $doc =& JFactory::getDocument();
    JHTML::_('behavior.mootools');
    $doc->addStyleSheet($assets.'/css/doclink.css');
    $doc->addScript($assets.'/js/dlutils.js');
    $doc->addScript($assets.'/js/popup.js');
    $doc->addScript($assets.'/js/dialog.js');


    $rows = DOCMAN_utils::categoryArray();

    HTML_DMDoclink::showDoclink($rows);
}

function showListview(){
	$user = JFactory::getUser();
	if(!$user->authorize('com_content', 'edit', 'content', 'all')) {
		JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
	}
	
    global $_DOCMAN, $mainframe;

    $assets = JURI::root()."components/com_docman/assets";

    // add styles and scripts
    $doc =& JFactory::getDocument();
    JHTML::_('behavior.mootools');
    $doc->addStyleSheet($assets.'/css/doclink.css');
    $doc->addScript($assets.'/js/sortabletable.js');
    $doc->addScript($assets.'/js/listview.js');



    if (isset($_REQUEST['catid'])) {
        $cid =  intval($_REQUEST['catid']);
    } else {
        $cid = 0;
    }
        //get folders
        $cats = DOCMAN_Cats::getChildsByUserAccess($cid);

        //get items
        if ($cid) {
            $docs = DOCMAN_Docs::getDocsByUserAccess($cid, 'name', 'ASC', 999, 0);
        } else {
            $docs = array();
        }


        //if ($entries_cnt)
        HTML_DMDoclink::createHeader();
        HTML_DMDoclink::createFolders($cats,$cid);
        HTML_DMDoclink::createItems($docs, $cid);
        HTML_DMDoclink::createFooter();

}