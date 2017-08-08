<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationModelParticipant extends JModelLegacy
{
  function store($itemData) {
    $db = JFactory::getDbo();

    $participant = new stdClass();
    $participant->event_id = (int) $itemData['event_id'];
    $participant->name = $itemData['name'];
    $participant->surname = $itemData['surname'];
    $participant->email = $itemData['email'];
    $participant->phone = $itemData['phone'];
    $participant->address = $itemData['address'];
    $participant->pttk = $itemData['pttk'];
    $participant->activation_hash = $itemData['activation_hash'];
    $participant->paid = 0;
    $participant->published = 0;

    return $db->insertObject('#__registration_participants', $participant);
  }

  function getByActivationHash($activation_hash) {
    $db = JFactory::getDBO();
    $activation_hash = $db->quote($activation_hash);
    $t_participants = $db->quoteName('#__registration_participants', 'p');

    $query = 
    "SELECT p.*
    FROM $t_participants
    WHERE p.activation_hash = $activation_hash
    LIMIT 1
    ";

    $db->setQuery($query);
    return $db->loadObject();
  }

  function activate($id) {
    $object = new stdClass();
    $object->id = $id;
    $object->activation_hash = '';
    $object->published = 1;
    $result = JFactory::getDbo()->updateObject('#__registration_participants', $object, 'id');
  }
}