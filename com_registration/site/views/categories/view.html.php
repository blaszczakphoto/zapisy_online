<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationViewCategories extends JViewLegacy
{
    function display($tpl = null)
    {
      $document = JFactory::getDocument();
      $document->setTitle("Lista kategorii imprez turystycznych");
      
      $model = $this->getModel();
      $this->items = $model->getItems();
      parent::display($tpl);
    }
}
?>
