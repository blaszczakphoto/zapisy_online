<?php
defined('_JEXEC') or die;

class RegistrationFormSentPresenter
{
  function __construct($event) {
    $this->event = $event;
  }

  public function body() {
    return $this->fillTemplateWithValues($this->body_template());
  }

  private function body_template() {
    return $this->params()->get('registration_form_sent_page');
  }

  private function fillTemplateWithValues($template) {
    return str_replace($this->tokens(), $this->tokens_replacements(), $template);
  }

  private function tokens() {
    return array(
      "{EVENT_NAME}", 
      "{EVENT_DATE}", 
      "{EVENT_REGISTRATION_FEE}", 
      "{BANK_INFO}", 
      "{EVENT_EXTRA_INFO}"
      );
  }

  private function tokens_replacements() {
    return array(
      $this->event->name,
      $this->getEventDate(),
      $this->event->registration_fee,
      $this->getPaymentDetails(),
      $this->getExtraInfo()
      );
  }

  private function getExtraInfo() {
    return $this->event->extra_info;
  }

  private function getPaymentDetails() {
    return ($this->event->registration_fee != 0) ? $this->params()->get("bank_details_site") : "";
  }  

  private function getEventDate() {
    if ($this->event->event_date == $this->event->event_date_end) {
      return $this->event->event_date;
    } else {
      $start = $this->event->event_date;
      $end = $this->event->event_date_end;
      return "$start - $end";
    }
  }

  private function params() {
    return $this->params = JComponentHelper::getParams('com_registration');
  }
}
