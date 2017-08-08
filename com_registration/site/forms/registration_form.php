<?php
defined('_JEXEC') or die('Restricted access');

class RegistrationForm
{
  function __construct() {
    $this->jinput = JFactory::getApplication()->input;
    
  }
  public function getSanitizedPostData() {
    $sanitized_data = [];
    $sanitized_data["event_id"] = $this->jinput->post->getInt("event_id");
    $sanitized_data["name"] = $this->jinput->post->getString("name");
    $sanitized_data["surname"] = $this->jinput->post->getString("surname");
    $sanitized_data["email"] = $this->jinput->post->getString("email");
    $sanitized_data["phone"] = $this->jinput->post->getString("phone");
    $sanitized_data["address"] = $this->jinput->post->getString("address");
    $sanitized_data["pttk"] = $this->jinput->post->getString("pttk");
    return $sanitized_data;
  }

  public function isFormValid() {
    $post = $this->getSanitizedPostData();
    return (
      $post && 
      $post['body'] == '' && 
      $post['event_id'] != '' && 
      $post['name'] != '' && 
      $post['surname'] != '' &&
      $post['email'] != '' && 
      $post['phone'] != ''
      );
  }
}