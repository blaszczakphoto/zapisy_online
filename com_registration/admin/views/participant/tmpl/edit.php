<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_registration
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
?>
<script>
   jQuery(document).ready(function () {
      var event_id = jQuery("input[type=hidden][name=event_id]").val();
      jQuery("select#jform_event_id option[value="+event_id+"]").attr("selected", "selected");
   });
</script>
<form action="<?php echo JRoute::_('index.php?option=com_registration&view=participant&layout=edit&id=' . (int)$this->item->id); ?>"
      method="post" name="adminForm" id="adminForm">
   <div class="form-horizontal">
      <?php foreach ($this->form->getFieldsets() as $name => $fieldset): ?>
         <fieldset class="adminform">
            <legend><?php echo JText::_($fieldset->label); ?></legend>
            <div class="row-fluid">
               <div class="span12">
                  <?php foreach ($this->form->getFieldset($name) as $field): ?>
                     <div class="control-group">
                        <div class="control-label"><?php echo $field->label; ?></div>
                        <div class="controls"><?php echo $field->input; ?></div>
                     </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </fieldset>
      <?php endforeach; ?>
   </div>
   <input type="hidden" name="task" value="event.edit"/>
   <input type="hidden" name="event_id" value="<?php echo JRequest::getVar('event_id'); ?>" />
   <?php echo JHtml::_('form.token'); ?>
</form>