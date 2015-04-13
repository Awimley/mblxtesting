<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('Times', 'B', 20);

// add a page
$pdf->AddPage();



$pdf->SetFont('Times', '', 8);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
 
 <div id="titleWell" class="well well-sm" style="max-width: 75%;padding: 0px 0px 0px 0px;margin: 0 auto;">
                            <p id="tableTitleMBLX" class="text-center" style="font-family: playbold, serif;font-size: 24px;color: black;margin: 0;">MBLX, Inc./MBLX Resources</p>
                            <p id="tableTitleSchedule" class="text-center" style="font-family: playbold, serif;font-size: 18px;color: #808080;margin: 0;">Origin Schedule</p>
                        </div>
<table border="1" cellpadding="2" cellspacing="2" align="center">
 <tr>
    <th>Booking Company</th>
                            <th>Booking Number</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Commodities</th>
                            <th>Tons</th>
                            <th>Agent</th>
                            <th>Vessel</th>
                            <th>ETA</th>
                            <th>Wharf</th>
                            <th>Stevedore</th>
                            <th>Destination</th>
                            <th>Terminal</th>
                            <th>Services</th>
                            <th>Status</th>
 </tr>
 <tbody>

 <tr>
  <td>MBLX</td>
  <td>222abc</td>
  <td>Barnacle</td>
  <td>5</td>
  <td>Wide Flange Beams</td>
  <td>2</td>
  <td>Maritime Endeavors</td>
  <td>Adrianople</td>
  <td>2015-02-01</td>
  <td>Mile-105</td>
  <td>Theodore Plant</td>
  <td>Albany, MO</td>
  <td>3 Rivers Terminal</td>
  <td>B/DS/T</td>
  <td>New</td>
 </tr>
 
 <tr>
  <td>MBLX</td>
  <td>22abc</td>
  <td>Barnacle</td>
    <td>2</td> 
     <td>Wire Rods</td>
      <td>3</td> 
     <td>Maritime Endeavors</td> 
      <td>Adrianople</td>
        <td>2015-02-01</td> 
       <td>Mile-105</td> 
        <td>Theodore Plant</td> 
        <td>Albany, MO</td> 
        <td>3 Rivers Terminal</td> 
        <td>B/DS/T</td>  
        <td>New</td>
 </tr>

 <tr>
  <td>MBLX</td>
  <td>ABC234</td>
  <td>Braad</td>
    <td>3</td> 
     <td>Pipe</td> 
     <td>12</td> 
     <td>Celtic</td> 
      <td>Aeolos</td> 
       <td>2015-02-01</td>
        <td>Gulfstream Marine</td> 
         <td>Empire</td> 
         <td>Alabo Street Wharf</td> 
         <td>Kinder Morgan - Tampa</td> 
         <td>DS</td> 
         <td>En Route</td>
 </tr>
  
  <tr>
  <td>MBLX</td>
  <td>BOOKINGNUM</td>
  <td>Metal One Americaz</td>
  <td>6</td>
  <td>Billets</td>
  <td>8</td>
  <td>Navios</td>
  <td>Aquitania</td>
  <td>2015-02-01</td>
  <td>Globalplex-LM 136</td>
  <td>Kinder Morgan</td>
  <td>Albany, MO</td>
  <td>Century Tube</td>
  <td>OT/B/DS/DT</td>
  <td>New</td>
 </tr>
 
 <tr>
  <td>MBLX</td>
  <td>6677890</td>
  <td>Metal One Americaz</td>
    <td>64</td> 
     <td>Round Bars</td>
      <td>34</td> 
     <td>Celtic</td> 
      <td>Aeolos</td>
        <td>2015-02-01</td> 
       <td>Gulfstream Marine</td> 
        <td>Associated Terminals</td> 
        <td>Albertville, AL</td> 
        <td>Adams County</td> 
        <td>S/OS/B/DS/S/T</td>  
        <td>New</td>
 </tr>
 
 <tr>
  <td>MBLX</td>
  <td>ROW 3<br />COLUMN 2</td>
  <td>Metal One Americaz</td>
    <td>2</td> 
     <td>Billets</td> 
     <td>55</td> 
     <td>Celtic</td> 
      <td>Aeolos</td> 
       <td>2015-02-01</td>
        <td>Gulfstream Marine</td> 
         <td>Associated Terminals</td> 
         <td>Albertville, AL</td> 
         <td>Adams County</td> 
         <td>S/OS/B/DS/S/T</td> 
         <td>New</td>
 </tr>

 <tr>
  <td>MBLX</td>
  <td>ROW 3<br />COLUMN 2</td>
  <td>Metal One Americaz</td>
    <td>3</td> 
     <td>CRC</td> 
     <td>33</td> 
     <td>Celtic</td> 
      <td>Aeolos</td> 
       <td>2015-02-01</td>
        <td>Gulfstream Marine</td> 
         <td>Associated Terminals</td> 
         <td>Albertville, AL</td> 
         <td>Adams County</td> 
         <td>S/OS/B/DS/S/T</td> 
         <td>New</td>
 </tr>
 </tbody>
</table>
EOD;

$pdf->writeHTML($tbl, true, true, false, false, 'L');

// -----------------------------------------------------------------------------

$pdf->Output('test.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
