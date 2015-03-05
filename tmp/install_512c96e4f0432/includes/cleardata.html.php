<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: cleardata.html.php 765 2009-01-05 20:55:57Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

if (defined('_DOCMAN_HTML_CLEARDATA')) {
    return;
} else {
    define('_DOCMAN_HTML_CLEARDATA', 1);
}

class HTML_DMClear {
    function showClearData( $rows ) {
        global $mosConfig_absolute_path;
    	?><form action="index2.php" method="post" name="adminForm">
        <?php dmHTML::adminHeading( _DML_CLEARDATA, 'cleardata' )?>

        <table class="adminlist">
          <thead>
          <tr>
            <th width="20" align="left">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows);?>);" />
            </th>
            <th width="98%" align="left">
                <?php echo _DML_CLEARDATA_ITEM;?>
            </th>
          </tr>
          </thead>
          <tbody>
          <?php
          $k = 0;
          foreach( $rows as $i => $row ){?>
            <tr class="row<?php echo $k;?>">
                <td width="20">
                    <?php echo mosHTML::idBox($i, $row->name);?>
                </td>
                <td>
                    <?php echo $row->friendlyname; ?>
                </td>
            </tr><?php
            $k = 1-$k;
          };?>
          </tbody>
        </table>
        <input type="hidden" name="option" value="com_docman" />
        <input type="hidden" name="section" value="cleardata" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo DOCMAN_token::render();?>
        </form>
        <?php include_once($mosConfig_absolute_path."/components/com_docman/footer.php");

    }
}
