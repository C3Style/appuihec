<?php
defined('_JEXEC') or die();
$rows = $this->rows;
?>
<form name="adminForm" method="post" action="index.php?option=com_jshopping&controller=orders">
<?php print $this->tmp_html_start?>
<table class = "adminlist" width = "100%">
<thead>
   <tr>
     <th width = "20">#</th>
     <th width = "20">
       <?php echo _JSHOP_TRANSACTION?>
     </th>
     <th>
       <?php echo _JSHOP_DATE?>
     </th>
     <th>
       <?php echo _JSHOP_CODE?>
     </th>
     <th>
       <?php echo _JSHOP_STATUS?>
     </th>
     <th>
       <?php echo _JSHOP_DESCRIPTION?>
     </th>
     <th width="50"><?php print _JSHOP_ID?></th>
   </tr>
</thead>
<?php 
$i = 0; 
foreach($rows as $row){ ?>
   <tr class="row<?php echo ($i  %2);?>" >
     <td>
        <?php echo ($i+1);?>
     </td>
     <td>
        <?php print $row->transaction?> 
     </td>
     <td>
        <?php echo $row->date;?>
     </td>
     <td>
        <?php echo $row->rescode;?>
     </td>
     <td>
        <?php if ($row->status_id) echo $this->list_order_status[$row->status_id];?>
     </td>     
     <td>
        <?php foreach($row->data as $trx_data){?>
         <div class="trx_data_row">
             <?php print $trx_data->key?>: <?php print $trx_data->value?>
         </div>
        <?php }?>
     </td>
     <td>
        <?php print $row->id?> 
     </td>
   </tr>
<?php
$i++;
}?>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "boxchecked" value = "0" />
<?php print $this->tmp_html_end?>
</form>