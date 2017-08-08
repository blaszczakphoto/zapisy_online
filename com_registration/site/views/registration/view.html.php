<?php
defined('_JEXEC') or die('Restricted access');
JLoader::register('ActivationSuccessPresenter', JPATH_COMPONENT . '/presenters/activation_success_presenter.php');

class RegistrationViewRegistration extends JViewLegacy
{
    function display($tpl = null)
    {
      $layout = JRequest::getVar('layout');
      $this->setLayout($layout);
      
      if ($layout == 'success') {
        $event_id = JRequest::getVar('event_id');
        $event_model = $this->getModel('event');
        $event = $event_model->getItemById($event_id);
        $this->presenter = new ActivationSuccessPresenter($event);
        $layout = JRequest::getVar('layout');
        $document = JFactory::getDocument();
        $document->setTitle("Dziękujemy za rejestracje!");
      }
      parent::display($tpl);
    }
}
?>
