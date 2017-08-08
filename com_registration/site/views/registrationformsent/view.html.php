<?php
defined('_JEXEC') or die('Restricted access');
JLoader::register('RegistrationFormSentPresenter', JPATH_COMPONENT . '/presenters/registration_form_sent_presenter.php');

class RegistrationViewRegistrationFormSent extends JViewLegacy
{
    function display($tpl = null)
    {
      $jinput = JFactory::getApplication()->input;
      $event_id = $jinput->get->getInt("event_id");
      
      $event_model = $this->getModel('event');
      $event = $event_model->getItemById($event_id);
      $this->presenter = new RegistrationFormSentPresenter($event);
      parent::display($tpl);

      $layout = JRequest::getVar('layout');
      $document = JFactory::getDocument();
      $document->setTitle("Dziękujemy za rejestracje!");
    }
}
?>
