<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationModelEvents extends JModelLegacy
{
   function getItems($catid) {
    $catid = (int) $catid;

    $db = JFactory::getDBO();
    $t_events = $db->quoteName('#__registration_events', 'e');
    $t_participants = $db->quoteName('#__registration_participants', 'p');

    $query = 
    "SELECT e.id, e.name, e.places, (e.places - count(p.id)) as free_places, count(p.id) as registred,
    e.event_date,e.event_date_end, e.registration_date, e.extra_info, e.link, e.published, e.ordering, e.catid, e.registration_fee
    FROM $t_events
    LEFT JOIN $t_participants ON e.id = p.event_id  AND (p.activation_hash = '' OR p.activation_hash IS NULL)
    WHERE e.published = 1
    AND e.catid = $catid
    GROUP BY e.id
    ORDER BY e.event_date
    ";

    $db->setQuery($query);
    return $db->loadObjectList();
   }
}