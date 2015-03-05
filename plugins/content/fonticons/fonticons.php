<?php
/*
 * Fonticons: Fancy, Retinaized Icons for Joomla
 * @version	$Id: fonticons.php 1.0
 * @date 10/23/2012
 * @sikumbang
 * @site http://www.templateplazza.com
 * @package		Joomla 2.5.x
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
*/
 
// no direct access
defined('_JEXEC') or die;
jimport( 'joomla.event.plugin' );
class plgContentFonticons extends JPlugin 
{
	protected $_pluginbase = 'plugins/content/fonticons/';	
	
	function plgContentFonticons(&$subject, $params){
		parent::__construct( $subject, $params );
 	}
	
	function onContentPrepare( $context, &$row, &$params, $limitstart=0 )
	{

		// Get Plugin info
		$param = $this->params;
		
		$icomoon =  $this->params->get('icomoon', '1');
				
		$document		= &JFactory::getDocument();
		
		// call css based on defined params
		if($icomoon == 1 ) {
			$document->addStyleSheet( $this->_pluginbase.'assets/css/icomoon.css' );
		}
			
	}
}
?>