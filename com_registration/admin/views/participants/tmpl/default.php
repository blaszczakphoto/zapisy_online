<?php
defined('_JEXEC') or die('Restricted Access');
JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>

<form action="index.php?option=com_registration&view=participants" method="post" id="adminForm" name="adminForm">
   <div class="row-fluid">
         <div class="span6">
            Filtruj: 
            <?php
               echo JLayoutHelper::render(
                  'joomla.searchtools.default',
                  array('view' => $this)
               );
            ?>
         </div>
      </div>
   <table class="table table-striped table-hover">
      <thead>
      <tr>
         <th width="1%"><?php echo JText::_('COM_REGISTRATION_NUM'); ?></th>
         <th width="2%">
            <?php echo JHtml::_('grid.checkall'); ?>
         </th>
         <th width="30%">Imię i nazwisko</th>
         <th width="10%">Adres e-mail</th>
         <th width="10%">Telefon</th>
         <th width="10%">Adres</th>
         <th width="10%">Numert karty PTTK</th>
         <th width="10%">Data zapisu</th>
         <th width="10%">Zapłacił?</th>
         <th width="10%">Aktywowany?</th>
      </tr>
      </thead>
      <tfoot>
         <tr>
            <td colspan="5">
               <?php echo $this->pagination->getListFooter(); ?>
            </td>
         </tr>
      </tfoot>
      <tbody>
         <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) : ?>

               <tr>
                  <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                  <td><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                  <td><?php echo $row->name." ".$row->surname; ?></td>
                  <td align="center"><?php echo $row->email; ?></td>
                  <td align="center"><?php echo $row->phone; ?></td>
                  <td align="center"><?php echo $row->address; ?></td>
                  <td align="center"><?php echo $row->pttk; ?></td>
                  <td align="center"><?php echo $row->created_time; ?></td>
                  <td align="center"><?php echo ($row->paid) ? "<span style='color: green'>Tak</span>" : "<span style='color: red'>Nie</span>"; ?></td>
                  <td align="center"><?php echo ($row->activation_hash == '') ? "<span style='color: green'>Tak</span>" : "<span style='color: red'>Nie</span>"; ?></td>
               </tr>
            <?php endforeach; ?>
         <?php endif; ?>
      </tbody>
   </table>
   <input type="hidden" name="task" value=""/>
   <input type="hidden" name="boxchecked" value="0"/>
   <input type="hidden" name="event_id" value="<?php echo JRequest::getVar('event_id'); ?>" />
   <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
   <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
   <?php echo JHtml::_('form.token'); ?>
</form>