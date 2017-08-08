<?php
defined('_JEXEC') or die;
JLoader::register('AbstractMailerPresenter', JPATH_COMPONENT_ADMINISTRATOR . '/presenters/abstract_mailer_presenter.php');


class ConfirmationMailerPresenter extends AbstractMailerPresenter
{
  function __construct($post, $event) {
    $this->post = $post;
    $this->event = $event;
  }
 
  public function getParticipantEmail() {
    return $this->post["email"];
  }

  protected function getEmailBodyTemplate() {
    return $this->params()->get('confirmation_email_template');
  }

  protected function getEmailSubjectTemplate() {
    return $this->params()->get('confirmation_email_subject');
  }

  protected function tokens() {
    return array(
      "{PARTICIPANT_NAME}", 
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
      $this->getParticipantName(),
      $this->getActivationUrl(),
      $this->event->name,
      $this->getEventDate(),
      $this->event->registration_fee,
      $this->getPaymentDetails(),
      $this->getExtraInfo(),
      $this->getEmailFooter()
      );
  }

  private function getParticipantName() {
    return $this->post["name"];
  }

  private function getActivationUrl() {
    $hash = $this->post["activation_hash"];
    return JURI::base(). "index.php?option=com_registration&task=registration.activate&hash=$hash";
  }
}
