<?php

defined('_JEXEC') or die('Restricted access');

class RegistrationControllerCategories extends JControllerLegacy
{
  function display($cachable = false, $urlparams = false)
  {
    $view = $this->getView('categories', 'html');
    $view->setLayout('default');
    $view->setModel($this->getModel('categories'), true);
    $view->display();
  }
}