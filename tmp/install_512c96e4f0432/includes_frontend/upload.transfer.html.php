<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: upload.transfer.html.php 765 2009-01-05 20:55:57Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

if (defined('_DOCMAN_METHOD_TRANSFER_HTML')) {
    return;
} else {
    define('_DOCMAN_METHOD_TRANSFER_HTML', 1);
}

class HTML_DMUploadMethod
{
    function transferFileForm($lists)
    {
        ob_start();
        ?>
    	<form action="<?php echo sefRelToAbs($lists['action']) ; ?>" method="post" id="dm_frmupload" class="dm_form">
		<fieldset class="input">
			<p><label for="url"><?php echo _DML_REMOTEURL ?></label><br />
	   		<input name="url" type="text" id="url" value="<?php echo $lists['url'];?>" />
			<?php echo DOCMAN_Utils::mosToolTip(_DML_REMOTEURLTT . '</span>' ,_DML_REMOTEURL . ':');?></p>
			<p><label for="localfile"><?php echo _DML_LOCALNAME ;?></label><br />
	   		<input name="localfile" type="text" id="url" value="<?php echo $lists['localfile'];?>">
			<?php echo DOCMAN_Utils::mosToolTip(_DML_LOCALNAMETT . '</span>', _DML_LOCALNAME . ':');?></p>
		</fieldset>
	   	<fieldset class="dm_button">
			<input name="submit" id="dm_btn_back"   class="button" value="<?php echo _DML_BACK;?>" onclick="window.history.back()" type="button" >
			<input name="submit" id="dm_btn_submit" class="button" value="<?php echo _DML_TRANSFER;?>" type="submit" />
        </fieldset>
        <input type="hidden" name="method" value="transfer" />
        <?php echo DOCMAN_token::render();?>
        </form>
    	<?php
		$html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}
