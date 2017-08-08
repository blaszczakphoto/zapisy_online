<?php

defined('_JEXEC') or die('Restricted access');
JLoader::register('ConfirmationMailer', JPATH_COMPONENT_ADMINISTRATOR . '/mailers/confirmation_mailer.php');
JLoader::register('NotifyAdminMailer', JPATH_COMPONENT_ADMINISTRATOR . '/mailers/notify_admin_mailer.php');
JLoader::register('RegistrationForm', JPATH_COMPONENT . '/forms/registration_form.php');

class RegistrationControllerRegistration extends JControllerLegacy
{
  function send($cachable = false, $urlparams = false)
  {
    JSession::checkToken() or die( JText::_( 'Invalid Token' ) );

    $form = new RegistrationForm();
    $post = $form->getSanitizedPostData();
    $hash = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
    $post["activation_hash"] = $hash;
    $event_id = $post["event_id"];

    if ($form->isFormValid()) {
      $model = $this->getModel('participant');
      $model->store($post);
      
      $event_model = $this->getModel('event');
      $event = $event_model->getItemById($event_id);
      $confirmation_mailer = new ConfirmationMailer($post, $event);
      $confirmation_mailer->send();
    }

    $link = JRoute::_("index.php?option=com_registration&task=registrationformsent.display&event_id=$event_id", false);
    $this->setRedirect($link);
  }

  function activate() {
    $jinput = JFactory::getApplication()->input;
    $activation_hash = $jinput->get->getString('hash');
    if ($activation_hash == "") {
        JRequest::setVar('layout', "failure");
        return parent::display();
    }

    $participant_model = $this->getModel('participant');
    $participant = $participant_model->getByActivationHash($activation_hash);

    if ($participant){
      $participant_model->activate($participant->id);

      JRequest::setVar('layout', "success");
      JRequest::setVar('event_id', $participant->event_id);
      $event_model = $this->getModel('event');
      $event = $event_model->getItemById($participant->event_id);

      $notify_admin_mailer = new NotifyAdminMailer($participant, $event);
      $notify_admin_mailer->send();

      $view = $this->getView('registration', 'html');
      $view->setModel($this->getModel('event'), false);
    }
    else {
      JRequest::setVar('layout', "failure");
    }
    parent::display();
  }

  
  // function to run email tests in browser.
  function test_confirmation_mailer() {
    $post = array(
      "name" => "Mariusz", 
      "surname" => "Błaszczak", 
      "email" => "mariusz.blaszczak@gmail.com", 
      "phone" => "887680333",
      "activation_hash" => "fsdfdsf7asd89f7sad98"
    );
    $participant_id = 1;
    $event = new stdClass();
    $event->name = "Kajaki po Omulwi";
    $event->event_date = "2017-07-27";
    $event->event_date_end = "2017-07-29";
    $event->extra_info = "Zbiórka pod Ratuszem w Olsztynie o 9:00";
    $event->places = "10";
    $event->link = "http://www.wp.pl/";
    $event->registration_date = "2017-07-27";
    $event->registration_fee   = "1";

    $confirmation_mailer = new ConfirmationMailer($post, $event);
    $confirmation_mailer->send();
  }

  function test_notify_admin_mailer() {
    $participant = new stdClass();
    $participant->name = "Anna";
    $participant->surname = "Błaszczak";
    $participant->pttk = "448877";
    $participant->phone = "+48 887 680 333";
    $participant->email = "adwoskina@gmail.com";
    $participant->address = "Herdera 26/2 10-691 Olsztyn";

    $event = new stdClass();
    $event->name = "Kajaki po Omulwi";
    $event->event_date = "2017-07-27";
    $event->event_date_end = "2017-07-29";
    $event->extra_info = "Zbiórka pod Ratuszem w Olsztynie o 9:00";
    $event->places = "10";
    $event->link = "http://www.wp.pl/";
    $event->registration_date = "2017-07-27";
    $event->registration_fee   = "1";

    $notify_admin_mailer = new NotifyAdminMailer($participant, $event);
    $notify_admin_mailer->send();
  }

  function test_confirmation_and_notify_admin_mailer() {
    $this->test_confirmation_mailer();
    $this->test_notify_admin_mailer();
  }

  function test_success_page() {
    $view = $this->getView('registration', 'html');
    $participant_model = $this->getModel('participant');
    $participant = $participant_model->getByActivationHash("abcd");
    $view->setModel($this->getModel('event'), false);
    JRequest::setVar('layout', "success");
    JRequest::setVar('event_id', $participant->event_id);
    parent::display();
  }

  function test_failure_page() {
    JRequest::setVar('layout', "failure");
    parent::display();
  }
}