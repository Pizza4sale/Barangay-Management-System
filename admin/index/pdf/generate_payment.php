<?php
require 'conn.php';
require_once('tcpdf.php');
date_default_timezone_set('Asia/Manila');

   
if($_GET['id'] =='0'){
    $currentdate = date('Y-m-d');
     $query = "SELECT *, sum(amount) as totalamount FROM tbl_payments ";  
     $queryxx = "SELECT * FROM tbl_payments order by datepaid ASC  "; 
}else{
    $currentdate = $_GET['from']." - ".$_GET['too'];
    $query = "SELECT *, sum(amount) as totalamount  FROM tbl_payments WHERE datepaid BETWEEN '".$_GET['from']."' AND '".$_GET['too']."' ";  
    $queryxx = "SELECT * FROM tbl_payments WHERE datepaid BETWEEN '".$_GET['from']."' AND '".$_GET['too']."' order by datepaid ASC"; 
}

/**
 * 
 */

class PDF extends TCPDF
{
        public function Header(){
            $imageFile =K_PATH_IMAGES.'logoo.jpg';
            $imageFile2 =K_PATH_IMAGES.'logoo2.jpg';
            $this->Image($imageFile2,70,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);
            $this->Image($imageFile,190,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);

            $this->Ln(2);
           
            $this->SetFont('helvetica','B','12');
            //Cell($width=, $height, $text, $boarder, $ln, $align, $fill, $link,$strech,$ignore_min_height=false,$calign=T,$valign='M')
        
            $this->SetFont('times','',13, '', true);
            $this->Cell(250,5,'REPUBLIC OF THE PHILIPPINES',0,1,'C');
            $this->Cell(250,5,'Province of Quezon',0,1,'C');
            $this->Cell(250,5,'Municipality of Panukulan',0,1,'C');
            $this->SetFont('times','',10, '', true);
            $this->Cell(250,5,'SITIO PINAGBUDHIAN, BARANGAY MILAWID',0,1,'C');
            $this->Cell(250,5,'----------------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'C');
        }

}


// create new PDF document
//portrait  or landscape
$pdf = new PDF('l','mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Barangay Payment Records');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15,40,15,8);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->AddPage();

$result3 = mysqli_query($conn,$query);
$count3 = mysqli_num_rows($result3);

if($count3 !=0){

 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  

// Add a page
// This method has several options, check the source code documentation for more information
$pdf->SetFont('times', 'B',20, '', true);
$pdf->SetFillColor(224,235,255);
$pdf->Cell(260,2,'BARANGAY PAYMENT TRANSACTION',0,0,'C',0);
$pdf->SetFont('times', 'B',12, '', true);
$pdf->Ln(10);
$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(6);
$pdf->MultiCell(30,5,"Date Today: ",0,'L',0,0,'','',true);
$pdf->MultiCell(180,5,$currentdate,0,'L',0,0,'','',true);
$pdf->MultiCell(30,5,"Total Payment: ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,number_format($row['totalamount'],2),0,'L',0,0,'','',true);
$pdf->Ln(5);
$pdf->MultiCell(180,5,"____________________________________________________________________________________",0,'L',0,0,'','',true);
$pdf->Ln(5);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(265,6,'Payment Summary Transactions',1,0,'L',1);;
$pdf->Ln(6);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(31,6,'Service',1,0,'C',0);
$pdf->Cell(37,6,'Request Number',1,0,'C',0);
$pdf->Cell(37,6,'Control Number',1,0,'C',0);
$pdf->Cell(60,6,'Account Name',1,0,'C',0);
$pdf->SetFont('times', '',8, '', true);
$pdf->Cell(20,6,'Payment Date',1,0,'C',0);
$pdf->Cell(20,6,'Payment Type',1,0,'C',0);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(40,6,'Reference Number',1,0,'C',0);
$pdf->Cell(20,6,'Amount',1,0,'C',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',10, '', true);

 $result2xx = mysqli_query($conn, $queryxx);  
while($rowx = mysqli_fetch_array($result2xx))  
 {  
$pdf->SetFont('times', '',8, '', true);
$pdf->MultiCell(31,7,strtoupper($rowx['typee']),1, 'C', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->SetFont('times', '',10, '', true);
$pdf->MultiCell(37,7,$rowx['oldcnum'],1, 'C', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->MultiCell(37,7,$rowx['cnum'],1, 'C', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->MultiCell(60,7,$rowx['name'],1, 'L', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->MultiCell(20,7,$rowx['datepaid'],1, 'C', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->MultiCell(20,7,strtoupper($rowx['payment_type']),1, 'C', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->SetFont('times', '',8, '', true);
$pdf->MultiCell(40,7,$rowx['refnum'],1, 'L', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->SetFont('times', '',10, '', true);
$pdf->MultiCell(20,7,number_format($rowx['amount'],2),1, 'C', 0, 0, '', '', true, 0, false, true,0,  'M','C');
$pdf->Ln(7);

}
}
}
 

$pdfname = "Payment Summary.pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  