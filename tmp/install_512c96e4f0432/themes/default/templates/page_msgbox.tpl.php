<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: page_msgbox.tpl.php 773 2009-01-08 17:38:08Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

/**
 * Default DOCman Theme
 *
 * Creator:  Joomlatools
 * Website:  http://www.joomlatools.eu/
 * Email:    support@joomlatools.eu
 * Revision: 1.4
 * Date:     February 2007
 **/

/*
* Display a msgbox  (required)
*
* This template is called when the component is down (configuration setting
* 'section is down') or when the users hasn't the necessary access permissions.
*
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template Variables :
*	$this->msg (string) : the msg to be displayed
*/
?>

<?php echo $this->plugin('stylesheet', $this->theme->path . "/css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<?php
if ($this->theme->conf->item_tooltip) :
    echo $this->plugin('overlib');
endif;

?>

<div id="dm_msgbox">
  	<p><?php echo $this->msg ?></p>
</div>