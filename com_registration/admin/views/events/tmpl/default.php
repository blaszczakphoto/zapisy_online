<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_registration
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_registration&view=events" method="post" id="adminForm" name="adminForm">

   <?php if (!empty( $this->sidebar)) : ?>
   <div id="j-sidebar-container" class="span2">
      <?php echo $this->sidebar; ?>
   </div>
   <div id="j-main-container" class="span10">
   <?php else : ?>
   <div id="j-main-container">
   <?php endif;?>

   <div class="row-fluid">
      <div class="span6">
         <?php echo JText::_('COM_REGISTRATIONS_FILTER'); ?>
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
         <th width="10%">
            <?php echo JHtml::_('grid.sort', 'COM_REGISTRATIONS_NAME', 'name', $listDirn, $listOrder); ?>
         </th>
         <th width="10%">
            <?php echo JHtml::_('grid.sort', 'Data imprezy', 'event_date', $listDirn, $listOrder); ?>
         </th>
         <th width="10%">
            <?php echo JHtml::_('grid.sort', 'Kiedy kończą się zapisy', 'registration_date', $listDirn, $listOrder); ?>
         </th>
         <th width="10%">Zapisani uczestnicy</th>
         <th width="5%">Pobierz PDF</th>
         <th width="2%">
            <?php echo JHtml::_('grid.sort', 'COM_REGISTRATION_PUBLISHED', 'published', $listDirn, $listOrder); ?>
         </th>
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
         <?php foreach ($this->items as $i => $row) :
            $link = JRoute::_('index.php?option=com_registration&task=event.edit&id=' . $row->id);
            $participants_link = JRoute::_('index.php?option=com_registration&view=participants&event_id=' . $row->id);
            $pdf = JRoute::_('index.php?option=com_registration&task=participants.generate_pdf&event_id=' . $row->id);
            ?>

            <tr>
               <td>
                  <?php echo $this->pagination->getRowOffset($i); ?>
               </td>
               <td>
                  <?php echo JHtml::_('grid.id', $i, $row->id); ?>
               </td>
               <td>
                  <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_REGISTRATION_EDIT_EVENT'); ?>">
                     <?php echo $row->name; ?>
                  </a>
               </td>
               <td>
                  <?php echo $row->event_date == $row->event_date_end ? $row->event_date : $row->event_date." - ".$row->event_date_end; ?>
               </td>
               <td><?php echo $row->registration_date; ?></td>
               <td>
                  <a href="<?= $participants_link ?>">Wyświetl uczestników</a>
                  (<?php echo "$row->places"; ?>/<?php echo "$row->registered"; ?>)
               </td>
               <td align="center"><a target="_blank" href="<?php echo $pdf ?>">PDF z listą uczestników</a></td>
               <td align="center">
                  <?php echo JHtml::_('jgrid.published', $row->published, $i, 'events.', true, 'cb'); ?>
               </td>
            </tr>
         <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
   </table>
   </div>
   <input type="hidden" name="task" value=""/>
   <input type="hidden" name="boxchecked" value="0"/>
   <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
   <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
   <?php echo JHtml::_('form.token'); ?>
</form>