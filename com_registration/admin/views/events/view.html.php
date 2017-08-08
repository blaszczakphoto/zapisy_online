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
class RegistrationViewEvents extends JViewLegacy
{
   /**
    *
    * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
    *
    * @return  void
    */
   function display($tpl = null)
   {
      // Get application
      $app = JFactory::getApplication();
      $context = "registration.list.admin.event";

      // Get data from the model
      $this->items = $this->get('Items');
      $this->pagination = $this->get('Pagination');
      $this->state = $this->get('State');
      $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'name', 'cmd');
      $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
      $this->filterForm = $this->get('FilterForm');
      $this->activeFilters = $this->get('ActiveFilters');

      // What Access Permissions does this user have? What can (s)he do?
      $this->canDo = RegistrationHelper::getActions();

      // Check for errors.
      if (count($errors = $this->get('Errors'))) {
         JError::raiseError(500, implode('<br />', $errors));

         return false;
      }


      // Set the submenu
      RegistrationHelper::addSubmenu('events');
      $this->sidebar = JHtmlSidebar::render();

      // Set the toolbar and number of found items
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
      //You can find other classic backend actions
      // in the administrator/includes/toolbar.php file of your Joomla installation.

      $title = JText::_('COM_REGISTRATION_MANAGER_EVENTS');

      if ($this->pagination->total) {
         $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
      }

      JToolBarHelper::title($title, 'event');

      if ($this->canDo->get('core.create'))
      {
         JToolBarHelper::addNew('event.add', 'JTOOLBAR_NEW');
      }
      if ($this->canDo->get('core.edit'))
      {
         JToolBarHelper::editList('event.edit', 'JTOOLBAR_EDIT');
      }
      //if ($this->canDo->get('core.edit.state'))
      {
         JToolbarHelper::publish('events.publish', 'JTOOLBAR_PUBLISH', true);
         JToolbarHelper::unpublish('events.unpublish', 'JTOOLBAR_UNPUBLISH', true);
      }

      if ($this->state->get('filter.published') == -2 && $this->canDo->get('core.delete'))
      {
         JToolbarHelper::deleteList('', 'events.delete', 'JTOOLBAR_EMPTY_TRASH');
      } else//if ($this->canDo->get('core.edit.state'))
      {
         JToolbarHelper::trash('events.trash');
      }

      if ($this->canDo->get('core.admin'))
      {
         JToolBarHelper::divider();
         $help_url  = 'https://blaszczakphoto.gitbooks.io/pttk-zapisy-online-poradnik/content/';
         JToolbarHelper::help( 'Poradnik wideo do obsługi komponentu Zapisy Online', false, $help_url );
         JToolBarHelper::preferences('com_registration');
      }
   }

   /**
    * Method to set up the document properties
    *
    * @return void
    */
   protected function setDocument()
   {
      $document = JFactory::getDocument();
      $document->setTitle(JText::_('COM_REGISTRATION_ADMINISTRATION'));
   }
}