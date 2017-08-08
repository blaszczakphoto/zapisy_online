<?php

defined('_JEXEC') or die('Restricted access');

class RegistrationControllerRegistrationFormSent extends JControllerLegacy
{
  function display($cachable = false, $urlparams = false)
  {
    $view = $this->getView('registrationformsent', 'html');
    $view->setLayout('default');
    $view->setModel($this->getModel('event'), true);
    $view->display();
  }
}