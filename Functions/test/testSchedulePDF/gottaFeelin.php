<?php
require('/fpdf.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

function Header()
{
    $this->SetFont('Times','B',15);
    // Move to the right
    
    $this->Cell(30,10,'MBLX, Inc./MLBX Resources');
    // Line break
    $this->Ln(20);
    $this->Cell(20,10, 'Origin Schedule');
    $this->Ln(20);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',6);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B',8);
    // Header
    $w = array(30, 24, 35, 8.4, 30.8, 11.2, 30, 25, 20, 30, 35, 30.8, 35, 35, 16.8);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
        $this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
        $this->Cell($w[5],6,$row[5],'LR',0,'C',$fill);
        $this->Cell($w[6],6,$row[6],'LR',0,'C',$fill);
        $this->Cell($w[7],6,$row[7],'LR',0,'C',$fill);
        $this->Cell($w[8],6,$row[8],'LR',0,'C',$fill);
        $this->Cell($w[9],6,$row[9],'LR',0,'C',$fill);
        $this->Cell($w[10],6,$row[10],'LR',0,'C',$fill);
        $this->Cell($w[11],6,$row[11],'LR',0,'C',$fill);
        $this->Cell($w[12],6,$row[12],'LR',0,'C',$fill);
        $this->Cell($w[13],6,$row[13],'LR',0,'C',$fill);
        $this->Cell($w[14],6,$row[14],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF('L','mm','A3');
// Column headings
$pdf->AliasNbPages();
$header = array('Booking Company', 'Booking Number', 'Customer', 'Qty', 'Commodities', 'Tons', 'Agent', 'Vessel', 'ETA', 'Wharf', 'Stevedore', 'Destination', 'Terminal', 'Services', 'Status');
// Data loading
$data = $pdf->LoadData('./bookings.txt');
$pdf->SetFont('Times','',8);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>