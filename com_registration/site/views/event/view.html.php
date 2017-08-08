<?php
defined('_JEXEC') or die('Restricted access');
JLoader::register('RegistrationFormSentPresenter', JPATH_COMPONENT . '/presenters/registration_form_sent_presenter.php');

class RegistrationViewEvent extends JViewLegacy
{
    function display($tpl = null)
    {
      $jinput = JFactory::getApplication()->input;
      $id = $jinput->getInt('id');
      if (!$id && $event == '') { JError::raiseError(404, JText::_("Page Not Found"));}

      $model = $this->getModel();
      $this->item = $model->getItemById($id);
      if (!$this->item->id) { JError::raiseError(404, JText::_("Page Not Found"));}
      $this->sent = $jinput->getWord('sent', false);
      parent::display($tpl);

      $document = JFactory::getDocument();
      $event_name = $this->item->name;
      $document->setTitle("Imprezy turystyczne - $event_name");
    }
}
?>
