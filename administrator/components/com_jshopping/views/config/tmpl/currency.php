<?php
defined('_JEXEC') or die();
$jshopConfig = JSFactory::getConfig();
$lists = $this->lists;
JHTML::_('behavior.tooltip');
displaySubmenuConfigs('currency');
?>
<form action = "index.php?option=com_jshopping&controller=config" method = "post" name = "adminForm" enctype = "multipart/form-data">
<?php print $this->tmp_html_start?>
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="2">

<div class="col100">
<fieldset class="adminform">
    <legend><?php echo _JSHOP_CURRENCY_PARAMETERS ?></legend>
<table class="admintable">
  <tr>
    <td class="key" >
      <?php echo _JSHOP_MAIN_CURRENCY;?>
    </td>
    <td>
      <?php echo $lists['currencies'];?>
      &nbsp;&nbsp;
      <a href="index.php?option=com_jshopping&controller=currencies"><?php print _JSHOP_LIST_CURRENCY?></a>
    </td>
  </tr>
  <tr>
    <td class="key" >
      <?php echo _JSHOP_DECIMAL_COUNT;?>
    </td>
    <td>
      <input type = "text" name = "decimal_count" id = "decimal_count" value  = "<?php echo $jshopConfig->decimal_count?>" />
      <?php echo JHTML::tooltip(_JSHOP_DECIMAL_COUNT_DESCRIPTION, _JSHOP_HINT);?>
    </td>
  </tr>
  <tr>
    <td class="key" >
      <?php echo _JSHOP_DECIMAL_SYMBOL;?>
    </td>
    <td>
      <input type = "text" name = "decimal_symbol" id = "decimal_symbol" value  = "<?php echo $jshopConfig->decimal_symbol?>" />
      <?php echo JHTML::tooltip(_JSHOP_DECIMAL_SYMBOL_DESCRIPTION, _JSHOP_HINT);?>
    </td>
    <td>
    </td>
  </tr>
  <tr>
    <td class="key" >
      <?php echo _JSHOP_THOUSAND_SEPARATOR; ?>
    </td>
    <td>
      <input type = "text" name = "thousand_separator" id = "thousand_separator" value  = "<?php echo $jshopConfig->thousand_separator?>" />
      <?php echo JHTML::tooltip(_JSHOP_THOUSAND_SEPARATOR_DESCRIPTION, _JSHOP_HINT);?>
    </td>
    <td>
    </td>
  </tr>
  <tr>
    <td class="key" >
      <?php echo _JSHOP_CURRENCY_FORMAT; ?>
    </td>
    <td>
      <?php echo $lists['format_currency']; echo " ".JHTML::tooltip(_JSHOP_CURRENCY_FORMAT_DESCRIPTION, _JSHOP_HINT) ?>
    </td>
    <td>
    </td>
  </tr>
  <?php $pkey = "etemplatevar";if ($this->$pkey){print $this->$pkey;}?>
</table>
</fieldset>
</div>
<div class="clr"></div>
<?php print $this->tmp_html_end?>
</form>