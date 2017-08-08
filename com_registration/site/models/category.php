<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationModelCategory extends JModelLegacy
{
  function getById($id) {

    $db = JFactory::getDBO();
    $t_categories = $db->quoteName('#__categories');
    $id = (int) $id;
    $query = 
    "SELECT *
    FROM $t_categories
    WHERE `id` = $id
    LIMIT 1
    ";
    $db->setQuery($query);
    return $db->loadObject();
  }
}