<?php
defined('_JEXEC') or die;

abstract class AbstractMailerPresenter
{
  public function getSenderEmail() {
    return $this->params()->get('sender_email');
  }

  public function getSenderName() {
    return $this->params()->get('sender_name');
  }

  public function getEmailBody() {
    return $this->fillTemplateWithValues($this->getEmailBodyTemplate());
  }

  public function getEmailSubject() {
    return $this->fillTemplateWithValues($this->getEmailSubjectTemplate());
  }

  protected function fillTemplateWithValues($template) {
    return str_replace($this->tokens(), $this->tokens_replacements(), $template);
  }

  protected function params() {
    return JComponentHelper::getParams('com_registration');
  }

  protected function getEventDate() {
    if ($this->event->event_date == $this->event->event_date_end) {
      return $this->event->event_date;
    } else {
      $start = $this->event->event_date;
      $end = $this->event->event_date_end;
      return "$start - $end";
    }
  }

  protected function getPaymentDetails() {
    return ($this->event->registration_fee != 0) ? $this->params()->get("bank_details_email") : "";
  }

  protected function getExtraInfo() {
    return strip_tags(str_replace("</p>", "\n", $this->event->extra_info));
  } 

  protected function getEmailFooter() {
    return $this->params()->get('email_footer');
  } 
}
