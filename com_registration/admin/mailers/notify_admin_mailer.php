<?php
defined('_JEXEC') or die;
JLoader::register('NotifyAdminMailerPresenter', JPATH_COMPONENT_ADMINISTRATOR.'/presenters/notify_admin_mailer_presenter.php');

class NotifyAdminMailer
{
  function __construct($participant, $event) {
    $this->presenter = new NotifyAdminMailerPresenter($participant, $event);
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
    $this->mailer->addRecipient($this->presenter->getSenderEmail());
    $this->mailer->setSubject($this->presenter->getEmailSubject());
    $this->mailer->setBody($this->presenter->getEmailBody());
  }
}
