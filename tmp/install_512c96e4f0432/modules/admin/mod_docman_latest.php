<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: mod_docman_latest.php 765 2009-01-05 20:55:57Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

global $_DOCMAN;
$_DOCMAN->setType(_DM_TYPE_MODULE);
$_DOCMAN->loadLanguage('modules');
require_once($_DOCMAN->getPath('classes', 'utils'));

$query = "SELECT id, dmname, approved, published, catid, dmdate_published"
     . "\n FROM #__docman"
     . "\n ORDER BY dmdate_published DESC";
$limit = $params->get('limit', 10);
$database->setQuery( $query, 0, $limit );
$rows = $database->loadObjectList();

?>
<table class="adminlist">
	<tr>
	    <th><?php echo _DML_MOD_LAST_TITLE;?></th>
        <th><?php echo _DML_MOD_DATE_ADDED;?></th>
	</tr><?php
    if (!count($rows)) echo '<tr><td>' . _DML_MOD_LAST_NODOCUMENTS . '</td></tr>';
    foreach ($rows as $row) {
        ?>
    	<tr>
    	    <td><a href="index2.php?option=com_docman&amp;section=documents&task=edit&amp;cid[]=<?php echo $row->id ?>"><?php echo $row->dmname;?></a>
    	    <?php if ($row->approved == '0') echo "(not approved)";?>
    	    <?php if ($row->published == '0') echo "(not published)";?>
    	    </td>
    	    <td align="right"><?php echo $row->dmdate_published;?></td>
    	</tr><?php
    }?>
    <tr><th colspan="2"><?php DOCMAN_Utils::getModuleButtons( $name ) ?></th></tr>
</table>