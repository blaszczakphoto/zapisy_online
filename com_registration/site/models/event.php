<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationModelEvent extends JModelLegacy
{
   function getItemById($id) {
    $id = (int) $id;
    
    $db = JFactory::getDBO();
    $t_events = $db->quoteName('#__registration_events', 'e');
    $t_participants = $db->quoteName('#__registration_participants', 'p');
    $t_categories = $db->quoteName('#__categories', 'c');

    $query = 
    "SELECT e.id, e.name, e.places, (e.places - count(p.id)) as free_places, count(p.id) as registred,
    e.event_date, e.event_date_end, e.registration_date, e.extra_info, e.link, e.published, e.ordering, e.catid, e.registration_fee,
    c.title as category_name
    FROM $t_events
    LEFT JOIN $t_participants ON e.id = p.event_id 
    AND p.activation_hash = ''
    LEFT JOIN $t_categories ON e.catid = c.id AND c.extension = 'com_registration'
    WHERE e.id = $id
    ";

    $db->setQuery($query);
    return $db->loadObject();
   }
}