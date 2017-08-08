<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationModelCategories extends JModelLegacy
{
   function getItems() {
    $db = JFactory::getDbo();
    $events_t = $db->quoteName('#__registration_events', 'e');
    $query = $db->getQuery(true);
    $query->select(array('c.title as name', 'count(e.id) as counter', 'c.id'));
    $query->from($db->quoteName('#__categories', 'c'));
    $query->join('LEFT', "$events_t ON c.id = e.catid AND e.published = 1");
    $query->where('c.extension = "com_registration"');
    $query->where('c.published = 1');
    $query->group($db->quoteName('c.id'));
    $db->setQuery($query);
    return $db->loadObjectList();
   }
}

