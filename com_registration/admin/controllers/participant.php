<?php

defined('_JEXEC') or die('Restricted access');

class RegistrationControllerParticipant extends JControllerForm
{
  protected $event_id;

  public function __construct($config = array())
  {
    parent::__construct($config);
    if (empty($this->event_id))
    {
      $this->event_id = $this->input->get('event_id');
    }
  }

  protected function getRedirectToListAppend() {
    $append = parent::getRedirectToListAppend();
    $append .= '&event_id=' . $this->event_id;

    return $append;
  }

  protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id') {
    $append = parent::getRedirectToItemAppend($recordId);
    $append .= '&event_id=' . $this->event_id;

    return $append;
  }

  public function batch($model = null) {
    JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

    // Set the model
    /** @var CategoriesModelCategory $model */
    $model = $this->getModel('Participant');

    // Preset the redirect
    $this->setRedirect('index.php?option=com_registration&view=participants&event_id=' . $this->event_id);

    return parent::batch($model);
  }
}