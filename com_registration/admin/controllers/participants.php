<?php

defined('_JEXEC') or die('Restricted access');

require(JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."participantspdf".DIRECTORY_SEPARATOR."view.html.php");
use Joomla\Utilities\ArrayHelper;


class RegistrationControllerParticipants extends JControllerAdmin
{

    public function getModel($name = 'Participant', $prefix = 'RegistrationModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    function generate_pdf()
    {
        $pdf_view = new RegistrationViewParticipantsPdf();
        $pdf_view->display();
    }

    function paid() {
        $event_id = JRequest::getVar("event_id");
        $cid = $this->input->get('cid', array(), 'array');
        if (!is_array($cid) || count($cid) < 1) {
            JError::raiseWarning(500, JText::_($this->text_prefix . '_NO_ITEM_SELECTED'));
        }
        else {
            $model = $this->getModel();
            if ($model->paid($cid))
            {
                $this->setMessage("Wpisowe dla wybranych użytkowników zostało oznaczone jako opłacone.");
            }
            else
            {
                $this->setMessage($model->getError());
            }
        }

        $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=participants&event_id=' . $event_id, false));
    }

    function unpaid() {
        $event_id = JRequest::getVar("event_id");
        $cid = $this->input->get('cid', array(), 'array');
        if (!is_array($cid) || count($cid) < 1) {
            JError::raiseWarning(500, JText::_($this->text_prefix . '_NO_ITEM_SELECTED'));
        }
        else {
            $model = $this->getModel();
            if ($model->unpaid($cid))
            {
                $this->setMessage("Wpisowe dla wybranych użytkowników zostało oznaczone jako nieopłacone.");
            }
            else
            {
                $this->setMessage($model->getError());
            }
        }

        $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=participants&event_id=' . $event_id, false));
    }

    function delete() {
        $cid = $this->input->get('cid', array(), 'array');
        $event_id = $this->input->getCmd('event_id', null);

        if (!is_array($cid) || count($cid) < 1) {
            JError::raiseWarning(500, 'Żeby usunąć użytkownika, trzeba wcześniej go zaznaczyć');
        }
        else {
            // Get the model.
            /** @var CategoriesModelCategory $model */
            $model = $this->getModel();

            // Make sure the item ids are integers
            $cid = ArrayHelper::toInteger($cid);

            // Remove the items.
            if ($model->delete($cid)) {
                $this->setMessage(JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($cid)));
            }
            else {
                $this->setMessage($model->getError());
            }
        }
        $this->setRedirect(JRoute::_('index.php?option=com_registration&&view=participants&event_id=' . $event_id, false));
    }
}