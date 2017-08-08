<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationViewEvents extends JViewLegacy
{
    function display($tpl = null)
    {
      $jinput = JFactory::getApplication()->input;
      $catid = $jinput->getInt('catid');
      if (!$catid && $catid == '') { JError::raiseError(404, JText::_("Page Not Found"));}

      $model = $this->getModel();
      $category_model = $this->getModel('category');
      $this->items = $model->getItems($catid);
      $this->category = $category_model->getById($catid);
      if (!$this->category || !$this->category->id) { JError::raiseError(404, JText::_("Page Not Found"));}
      parent::display($tpl);
      
      $document = JFactory::getDocument();
      $category_title = $this->category->title;
      $document->setTitle("Lista imprez turystycznych - $category_title");
    }
}
?>
