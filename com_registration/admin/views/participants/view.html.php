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

class RegistrationViewParticipants extends JViewLegacy
{

   function display($tpl = null) {
    $app = JFactory::getApplication();
    $context = "registration.list.admin.participant";


    $this->items    = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    $this->state      = $this->get('State');
    $this->filter_order   = $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'name', 'cmd');
    $this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
    $this->filterForm     = $this->get('FilterForm');
    $this->activeFilters  = $this->get('ActiveFilters');

    // Check for errors.
    if (count($errors = $this->get('Errors')))
    {
      JError::raiseError(500, implode('<br />', $errors));

      return false;
    }

    $this->addToolBar();

    parent::display($tpl);
    // Set the document
    $this->setDocument();
   }

   protected function addToolBar() {
      $title = 'Lista uczestników dla imprezy';

      if ($this->pagination->total) {
        $title .= " - <span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
      }
      JToolBarHelper::title($title, 'registration');
      JToolbarHelper::addNew('participant.add');
      JToolbarHelper::editList('participant.edit');
      JToolbarHelper::deleteList('', 'participants.delete');
      JToolBarHelper::custom('participants.paid', 'checkmark-circle', '', 'Wpisowe opłacone', true, true);
      JToolBarHelper::custom('participants.unpaid', 'smiley-sad', '', 'Wpisowe nieopłacone', true, true);
      JToolBarHelper::divider();
      $help_url  = 'https://blaszczakphoto.gitbooks.io/pttk-zapisy-online-poradnik/content/';
      JToolbarHelper::help( 'Poradnik wideo do obsługi komponentu Zapisy Online', false, $help_url );
      JToolBarHelper::preferences('com_registration');
  }

  protected function setDocument() {
     $document = JFactory::getDocument();
     $document->setTitle('Lista uczestników');
  }
}