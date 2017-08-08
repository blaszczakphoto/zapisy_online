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
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class RegistrationHelper
{
   /**
    * Configure the Linkbar.
    *
    * @return Bool
    */

   public static function addSubmenu($submenu)
   {
      JHtmlSidebar::addEntry(
            'Imprezy',
            'index.php?option=com_registration',
            $submenu == 'events'
      );

      JHtmlSidebar::addEntry(
            'Kategorie imprez',
            'index.php?option=com_categories&view=categories&extension=com_registration',
            $submenu == 'categories'
      );

      // Set some global property
      $document = JFactory::getDocument();
      $document->addStyleDeclaration('.icon-48-registration ' .
            '{background-image: url(../media/com_registration/images/tux-48x48.png);}');
      if ($submenu == 'categories')
      {
         $document->setTitle(JText::_('COM_REGISTRATION_ADMINISTRATION_CATEGORIES'));
      }
   }


   /**
    * Get the actions
    */
   public static function getActions($messageId = 0)
   {
      $result	= new JObject;

      if (empty($messageId)) {
         $assetName = 'com_registration';
      }
      else {
         $assetName = 'com_registration.message.'.(int) $messageId;
      }

      //$actions = JAccess::getActions('com_registration', 'component');
      $actions = JAccess::getActionsFromFile(
            JPATH_ADMINISTRATOR . '/components/com_registration/access.xml',
            "/access/section[@name='component']/"
      );

      if (!empty($actions))
      foreach ($actions as $action) {
         $result->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));
      }

      return $result;
   }

   public static function registrationPossible($event)
  {
    return self::is_present($event->registration_date) && ($event->places == 0 || $event->free_places != 0);
  } 

  private static function is_present($time)
  {
    $then = strtotime(($time)." 23:59");
    $today = strtotime(date("Y-m-d")." 23:59");
    return ($then >= $today);
  }

}