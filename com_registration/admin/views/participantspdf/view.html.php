<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

// require(JPATH_COMPONENT_ADMINISTRATOR.DS."models".DS."participants.php");
// require(JPATH_COMPONENT_ADMINISTRATOR.DS."models".DS."event.php");
require(JPATH_LIBRARIES.'/tcpdf/tcpdf.php');

class ParticipantsPdf extends TCPDF {

    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        
        // Header
        $w = array(7, 40, 50, 20,60, 10, 15);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        $i=1;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $i, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, "$row->name $row->surname", 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row->email, 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row->phone, 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row->address, 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 6, $row->pttk, 'LR', 0, 'C', $fill);
            $this->Cell($w[6], 6, ($row->paid == 0) ? "-" : "tak", 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill=!$fill;
            $i++;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

class TmpParticipantStruct {
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $address;
    public $pttk;
    public $paid;
}

class RegistrationViewParticipantsPdf
{
    function display()
    {

        $event_id = JRequest::getVar('event_id');
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__registration_participants'));
        $query->where('event_id = ' . $event_id);
        $db->setQuery($query);
        $participants = $db->loadObjectList();

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__registration_events'));
        $query->where('id = ' . $event_id);
        $db->setQuery($query);
        $event = $db->loadObject();
        // print_r($event);

        $pdf_tool = new ParticipantsPdf();
        $pdf_tool->SetLeftMargin(2);
        $pdf_tool->SetRightMargin(2);
        $pdf_tool->setFont("freesans", "B", 8);

        $pdf_tool->AddPage();
        $body = "
Nazwa imprezy: $event->name<br>
Data imprezy: $event->event_date<br>
Dodatkowe informacje: $event->extra_info<br><br>
        ";

        $pdf_tool->writeHTML($body, true, 0, true, true);
        $pdf_tool->SetTitle("Lista uczestników - Kajaki");
        $header = array('No', 'Imię i nazwisko', 'Email', 'Telefon', 'Adres', 'PTTK', 'Wpisowe');

        $pdf_tool->ColoredTable($header, $participants);

        $pdf_tool->Output('uczestnicy.pdf', 'I');
        die();
    }
}
?>
