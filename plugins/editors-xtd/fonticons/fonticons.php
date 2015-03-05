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

class plgButtonFonticons extends JPlugin
{
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	public function onDisplay($name)
	{
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$template = $app->getTemplate();
		
		JPluginHelper::importPlugin('content');
		$plugin = JPluginHelper::getPlugin('content', 'fonticons');
		$pluginParams = new JRegistry();
		$pluginParams->loadString($plugin->params);
		
		if ( $pluginParams->get('icomoon') ){
			$link = '../plugins/editors-xtd/fonticons/icomoon.html';
		}
		
		JHtml::_('behavior.modal');
		$button = new JObject;
		$button->set('modal', true);
		$button->set('link', $link);
		$button->set('text', JText::_('Fonticons'));
		$button->set('name', 'pagebreak');
		$button->set('options', "{handler: 'iframe', size: {x: 790, y: 355}}");
		return $button;
	}
}
?>