<?php
defined('_JEXEC') or die('Restricted access');



class RegistrationController extends JControllerLegacy
{
    protected $default_view = 'events';
    public function display($cachable = false, $urlparams = array())
    {

      $view   = $this->input->get('view', 'events');
      $layout = $this->input->get('layout', 'default');

      

      return parent::display();
    }
}