<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: mod_docman_top.php 765 2009-01-05 20:55:57Z mathias $
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

$query = "SELECT * FROM #__docman "
        ."\n ORDER BY dmcounter DESC ";
$database->setQuery( $query, 0, $params->get('limit', 10));
$rows = $database->loadObjectList();
?>

<table class="adminlist">
	<tr>
	    <th><?php echo _DML_MOD_MOST_TITLE;?></th>
        <th><?php echo _DML_MOD_MOST_HITS;?></th>
	</tr><?php
    if (!count($rows)) echo '<tr><td>' . _DML_MOD_MOST_NODOCUMENTS . '</tr></td>';
    foreach ($rows as $row) {
        ?>
    	<tr>
    	    <td><a href="#edit" onClick="submitcpform('<?php echo $row->id;?>', '<?php echo $row->id;?>')"><?php echo $row->dmname;?></a>
    	    </td>
    	    <td align="right"><?php echo $row->dmcounter;?></td>
    	</tr><?php
    }?>
    <tr><th colspan="2"><?php DOCMAN_Utils::getModuleButtons( $name ) ?></th></tr>
</table>