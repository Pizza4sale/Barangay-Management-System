<?php
require 'conn.php';
require_once('tcpdf.php');
 $ctrl = $_GET['id'];

$query = "SELECT * FROM tbl_complaint where com_ctrl= '".$ctrl."' ";  
$result3 = mysqli_query($conn,$query);
$count3 = mysqli_num_rows($result3);

if($count3 !=0){

 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  
   $requestor_name = $row["from"];
   $address = $row["address"];
   $date_received = $row["datereceived"];
   $dateincident = $row["dateincident"];
   $details = $row["details"];
   $complainee = $row["to"];
   $ctrl = $row["com_ctrl"];
   $dateclosed = $row["date_closed"];
   $captain = $row['captain'];

}
}else{
   $requestor_name ="";
   $address = "";
   $date_received = "";
   $voter = "";
   $dateclosed="";
   $captain = '';
}


$queryx = "SELECT DISTINCT * FROM tbl_complaindetails where com_ctrl= '".$ctrl."' ";  
$result3x = mysqli_query($conn,$queryx);
$count3x = mysqli_num_rows($result3x);

if($count3x !=0){
 $result2x = mysqli_query($conn, $queryx);  
while($rowx = mysqli_fetch_array($result2x))  
 {  
   $encodedby = $rowx["encodedby"];
}
}else{
       $encodedby ="";
}



/**
 * 
 */

class PDF extends TCPDF
{
        public function Header(){
           $imageFile =K_PATH_IMAGES.'logoo.jpg';
           $imageFile2 =K_PATH_IMAGES.'logoo2.jpg';
            $this->Image($imageFile2,30,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);
            $this->Image($imageFile,150,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);
                       
            $this->Ln(2);
           
            $this->SetFont('helvetica','B','12');
            //Cell($width=, $height, $text, $boarder, $ln, $align, $fill, $link,$strech,$ignore_min_height=false,$calign=T,$valign='M')
        
           $this->SetFont('times','',13, '', true);
           $this->Cell(180,5,'REPUBLIC OF THE PHILIPPINES',0,1,'C');
           $this->Cell(180,5,'Province of Quezon',0,1,'C');
           $this->Cell(180,5,'Municipality of Panukulan',0,1,'C');
           $this->SetFont('times','',10, '', true);
            $this->Cell(180,5,'SITIO PINAGBUDHIAN, BARANGAY MILAWID',0,1,'C');
           $this->Cell(180,5,'----------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'C');
        
           
        }

        public function Footer(){
                $imageFile3 =K_PATH_IMAGES.'nosign.jpg';
                $this->Image($imageFile3, 153,259, 40, 20,'JPG','','',false,200,'',false,false,0,false,false,false);
 
                $this->SetY(-30); // Position at 15mm from bottom
                $this->Ln(5);
                $this->SetFont('times', '',12, '', true);
                $this->Cell(20,5,'',0,0,'L',0);
                $this->SetFont('times', 'B',9, '', true);
                $this->Cell(20,5,'__________________________',0,0,'C',0);
                $this->Cell(40,5,'',0,0,'L',0);
                $this->Cell(20,5,'__________________________',0,0,'C',0);
                $this->Cell(30,5,'',0,0,'L',0);
                $this->Cell(60,5,strtoupper("HON. FERDINAND T. ORBITA"),0,0,'C',0);
                $this->Ln(6);
                $this->SetFont('times', '',12, '', true);
                $this->SetFont('times', 'B',9, '', true);
                $this->Cell(20,5,'',0,0,'L',0);

                $this->Cell(20,5,'Complainant Signature',0,0,'C',0);
                $this->Cell(40,5,'',0,0,'L',0);
                $this->Cell(20,5,'Complainee Signature',0,0,'C',0);
                $this->Cell(30,5,'',0,0,'L',0);
                $this->Cell(60,5,'Barangay Chairman',0,0,'C',0);


                $this->Ln(6);
                $this->SetFont('times', '',12, '', true);
                $this->Cell(15,5,'',0,0,'L',0);
                $this->SetFont('times', 'B',9, '', true);
                $this->Cell(70,5,strtoupper("** NOT VALID W/O OFFICIAL DRY SEAL"),0,0,'L',0);


        }

}



// create new PDF document
//portrait  or landscape
$pdf = new PDF('p','mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Barangay Complaint Report');
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
$pdf->SetMargins(15,20,15);
$pdf->SetHeaderMargin(6);
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



// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->SetFont('times', 'B',20, '', true);
$pdf->SetFillColor(224,235,255);
$pdf->Ln(20);
$pdf->Cell(180,5,'BARANGAY COMPLAINT REPORT',0,0,'C',0);
$pdf->SetFont('times', 'B',12, '', true);
$pdf->Ln(10);
$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(6);
$pdf->MultiCell(30,5,"Date Recevied: ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,strtoupper($date_received),0,'L',0,0,'','',true);
$pdf->MultiCell(30,5,"Encoded By: ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,strtoupper($encodedby),0,'L',0,0,'','',true);
$pdf->Ln(7);
$pdf->MultiCell(30,5,"Reported By: ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,strtoupper($requestor_name),0,'L',0,0,'','',true);
$pdf->MultiCell(30,5,"Date Closed: ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,strtoupper($dateclosed),0,'L',0,0,'','',true);
$pdf->Ln(5);
$pdf->MultiCell(180,5,"____________________________________________________________________________________",0,'L',0,0,'','',true);
$pdf->Ln(10);

$pdf->MultiCell(40,5,"Complainee ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,": ".strtoupper($complainee),0,'L',0,0,'','',true);
$pdf->Ln(7);
$pdf->MultiCell(40,5,"Date Of Incident ",0,'L',0,0,'','',true);
$pdf->MultiCell(70,5,": ".strtoupper($dateincident),0,'L',0,0,'','',true);
$pdf->Ln(7);
$pdf->MultiCell(40,5,"Place of the Incident ",0,'L',0,0,'','',true);
$pdf->MultiCell(150,5,": ".strtoupper($address),0,'L',0,0,'','',true);
$pdf->Ln(8);
$pdf->MultiCell(40,5,"Details Of Incident : ",0,'L',0,0,'','',true);
$pdf->Ln(6);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->SetFont('times', '',9, '', true);
$pdf->MultiCell(180,5,strtoupper($details),0,'L',0,0,'','',true);

$pdf->Ln(70);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(180,6,'DEATILED ACTION REPORT (To be filled by barangay officials)',1,0,'L',1);;
$pdf->Ln(6);
$pdf->Cell(30,6,'Date',1,0,'C',0);
$pdf->Cell(50,6,'Verified by',1,0,'C',0);
$pdf->Cell(100,6,'Follow up Status / Objective Evidence',1,0,'C',0,);
$pdf->Ln(6);
$query4 = "SELECT * FROM tbl_complaindetails where com_ctrl ='".$ctrl."' ";  
 $result4 = mysqli_query($conn, $query4);  
while($row4 = mysqli_fetch_array($result4))  
 {  
   $verified = $row4["assistedby"];
   $status = $row4["action_taken"];
   $targetdate = $row4["action_date"];

$pdf->Ln(0);
$pdf->Cell(30,20,$targetdate,1,0,'C');
$pdf->Cell(50,20,$verified,1,0,'C');
$pdf->MultiCell(100,20,$status,1,'L',0,1,'');
$pdf->Ln(0);

}

$pdf->Ln(55);


$pdfname = "Complaint-".$ctrl.".pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  