<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: page_docdetails.tpl.php 774 2009-01-19 09:54:47Z mathias $
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

/* Display the document details page(required)
*
* This template is called when u user preform a details operation on a document.
*
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Preformatted html variables :
*	$this->html->docdetails (string)(fetched from : documents/document.tpl.php)
*/

?>

<?php echo defined('_DM_J15') ? '' : $this->plugin('javascript', $this->theme->path . "js/theme.js") ?>
<?php echo $this->plugin('stylesheet', $this->theme->path . "css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<?php echo $this->html->menu; ?>


<?php echo $this->html->docdetails ?>