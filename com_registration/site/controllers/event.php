<?php

defined('_JEXEC') or die('Restricted access');

class RegistrationControllerEvent extends JControllerLegacy
{
  function display($cachable = false, $urlparams = false)
  {
    $view = $this->getView('event', 'html');
    $view->setLayout('default');
    $view->setModel($this->getModel('event'), true);
    $view->display();
  }
}