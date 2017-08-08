<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_registration
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @since  0.0.1
 */
class RegistrationViewEvent extends JViewLegacy
{
   /**
    * View form
    *
    * @var         form
    */
   protected $form = null;
   protected $item;
   protected $script;
   protected $canDo;

   /**
    *
    * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
    *
    * @return  void
    */
   public function display($tpl = null)
   {
      // Get the Data
      $this->form = $this->get('Form');
      $this->item = $this->get('Item');
      $this->script = $this->get('Script');

      // What Access Permissions does this user have? What can (s)he do?
      $this->canDo = RegistrationHelper::getActions($this->item->id);

      // Check for errors.
      if (count($errors = $this->get('Errors'))) {
         JError::raiseError(500, implode('<br />', $errors));

         return false;
      }


      // Set the toolbar
      $this->addToolBar();

      // Display the template
      parent::display($tpl);

      // Set the document
      $this->setDocument();
   }

   /**
    * Add the page title and toolbar.
    *
    * @return  void
    *
    * @since   1.6
    */
   protected function addToolBar()
   {
      $input = JFactory::getApplication()->input;

      // Hide Joomla Administrator Main menu
      $input->set('hidemainmenu', true);

      $isNew = ($this->item->id == 0);

      JToolBarHelper::title($isNew ? JText::_('COM_REGISTRATION_MANAGER_EVENT_NEW')
            : JText::_('COM_REGISTRATION_MANAGER_EVENT_EDIT'), 'event');

      // Build the actions for new and existing records.
      if ($isNew)
      {
         // For new records, check the create permission.
         if ($this->canDo->get('core.create'))
         {
            JToolBarHelper::apply('event.apply', 'JTOOLBAR_APPLY');
            JToolBarHelper::save('event.save', 'JTOOLBAR_SAVE');
            JToolBarHelper::custom('event.save2new', 'save-new.png', 'save-new_f2.png',
                  'JTOOLBAR_SAVE_AND_NEW', false);
         }
         JToolBarHelper::cancel('event.cancel', 'JTOOLBAR_CANCEL');
      }
      else
      {
         if ($this->canDo->get('core.edit'))
         {
            // We can save the new record
            JToolBarHelper::apply('event.apply', 'JTOOLBAR_APPLY');
            JToolBarHelper::save('event.save', 'JTOOLBAR_SAVE');

            // We can save this record, but check the create permission to see
            // if we can return to make a new one.
            if ($this->canDo->get('core.create'))
            {
               JToolBarHelper::custom('event.save2new', 'save-new.png', 'save-new_f2.png',
                     'JTOOLBAR_SAVE_AND_NEW', false);
            }
         }
         if ($this->canDo->get('core.create'))
         {
            JToolBarHelper::custom('event.save2copy', 'save-copy.png', 'save-copy_f2.png',
                  'JTOOLBAR_SAVE_AS_COPY', false);
         }
         JToolBarHelper::cancel('event.cancel', 'JTOOLBAR_CLOSE');
      }
   }

   /**
    * Method to set up the document properties
    *
    * @return void
    */
   protected function setDocument()
   {
      $isNew = ($this->item->id < 1);
      $document = JFactory::getDocument();
      $document->setTitle($isNew ? JText::_('COM_REGISTRATION_CREATING') :
            JText::_('COM_REGISTRATION_EDITING'));
      $document->addScript(JURI::root() . $this->script);
      $document->addScript(JURI::root() . "/administrator/components/com_registration"
            . "/views/event/submitbutton.js");
      JText::script('COM_REGISTRATION_ERROR_UNACCEPTABLE');
   }
}