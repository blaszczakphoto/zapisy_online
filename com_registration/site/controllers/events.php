<?php

defined('_JEXEC') or die('Restricted access');

class RegistrationControllerEvents extends JControllerLegacy
{
  function display($cachable = false, $urlparams = false)
  {
    $view = $this->getView('events', 'html');
    $view->setLayout('default');
    $view->setModel($this->getModel('events'), true);
    $view->setModel($this->getModel('category'), false);
    $view->display();
  }
}