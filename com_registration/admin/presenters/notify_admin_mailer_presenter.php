<?php
defined('_JEXEC') or die;
JLoader::register('AbstractMailerPresenter', JPATH_COMPONENT_ADMINISTRATOR . '/presenters/abstract_mailer_presenter.php');


class NotifyAdminMailerPresenter extends AbstractMailerPresenter
{
  function __construct($participant, $event) {
    
    $this->participant = $participant;
    $this->event = $event;
  }

  protected function getEmailBodyTemplate() {
    return $this->params()->get('notify_admin_email_template');
  }

  protected function getEmailSubjectTemplate() {
    return $this->params()->get('notify_admin_email_title');
  }

  protected function tokens() {
    return array(
      "{PARTICIPANT_NAME}",
      "{PARTICIPANT_SURNAME}",
      "{PARTICIPANT_PTTK}",
      "{PARTICIPANT_EMAIL}",
      "{PARTICIPANT_PHONE}",
      "{PARTICIPANT_ADDRESS}",
      "{ACTIVATION_URL}", 
      "{EVENT_NAME}", 
      "{EVENT_DATE}", 
      "{EVENT_REGISTRATION_FEE}", 
      "{BANK_INFO}", 
      "{EVENT_EXTRA_INFO}", 
      "{MAIL_FOOTER}"
      );
  }

  protected function tokens_replacements() {
    return array(
      $this->participant->name,
      $this->participant->surname,
      $this->participant->pttk,
      $this->participant->email,
      $this->participant->phone,
      $this->participant->address,
      $this->getActivationUrl(),
      $this->event->name,
      $this->getEventDate(),
      $this->event->registration_fee,
      $this->getPaymentDetails(),
      $this->getExtraInfo(),
      $this->params()->get('email_footer')
      );
  }

  private function getActivationUrl() {
    return "";
  }
}
