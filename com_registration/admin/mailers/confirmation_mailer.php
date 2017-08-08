<?php
defined('_JEXEC') or die;
JLoader::register('ConfirmationMailerPresenter', JPATH_COMPONENT_ADMINISTRATOR.'/presenters/confirmation_mailer_presenter.php');

class ConfirmationMailer
{
  function __construct($post, $event) {
    $this->presenter = new ConfirmationMailerPresenter($post, $event);
    $this->mailer = JFactory::getMailer();
    $this->configureEmail();
  }

  public function send() {
    $this->mailer->Send();
  }

  private function configureEmail() {
    $this->mailer->setSender(
      array($this->presenter->getSenderEmail(), $this->presenter->getSenderName())
    );
    $this->mailer->addRecipient($this->presenter->getParticipantEmail());
    $this->mailer->setSubject($this->presenter->getEmailSubject());
    $this->mailer->setBody($this->presenter->getEmailBody());
  }
}
