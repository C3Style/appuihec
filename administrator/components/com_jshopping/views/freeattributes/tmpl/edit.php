<?php defined('_JEXEC') or die(); ?>
<form action = "index.php?option=com_jshopping&controller=freeattributes" method = "post" name = "adminForm">
<?php print $this->tmp_html_start?>
<div class="col100">
<fieldset class="adminform">
<table class="admintable" width = "100%" >     
    <?php 
    foreach($this->languages as $lang){
    $name = "name_".$lang->language;
    ?>
     <tr>
       <td class="key">
         <?php echo _JSHOP_TITLE; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>* 
       </td>
       <td>
         <input type = "text" class = "inputbox" name = "<?php print $name?>" value = "<?php echo $this->attribut->$name?>" />
       </td>
     </tr>
    <?php } ?>
    <?php 
    foreach($this->languages as $lang){
    $description = "description_".$lang->language;
    ?>
     <tr>
       <td class="key">
         <?php echo _JSHOP_DESCRIPTION; ?> <?php if ($this->multilang) print "(".$lang->lang.")";?>
       </td>
       <td>
         <input type = "text" class = "inputbox" name = "<?php print $description?>" value = "<?php echo $this->attribut->$description?>" />
       </td>
     </tr>
    <?php } ?>
    <tr>
       <td class="key">
         <?php echo _JSHOP_REQUIRED;?>
       </td>
       <td>
         <input type="checkbox" name="required" value="1" <?php if ($this->attribut->required) print "checked";?> />
       </td>
    </tr>
    <?php if ($this->type){print $this->type;}?>
    <?php $pkey = "etemplatevar";if ($this->$pkey){print $this->$pkey;}?>
</table>
</fieldset>
</div>
<div class="clr"></div>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "id" value = "<?php echo $this->attribut->id?>" />
<?php print $this->tmp_html_end?>
</form>