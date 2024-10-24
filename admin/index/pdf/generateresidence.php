<?php
require 'conn.php';
require_once('tcpdf.php');
 $ctrl = $_GET['id'];

$query = "SELECT * FROM tbl_residency where res_ctrl= '".$ctrl."' ";  
$result3 = mysqli_query($conn,$query);
$count3 = mysqli_num_rows($result3);

if($count3 !=0){
// `ctrl_num`, `fname`, `mname`, `lname`, `address`, `pbirth`, `bday`, `age`, `gender`, `civil`, `length`, `company`, `purpose`, `voter`, `status`
 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  
   $requestor_name = $row["res_lname"]." , ".$row["res_name"]." ".$row["res_mname"];
   $address = $row["res_purok"]." ".$row["res_bgy"]." Municipality of Panukulan, Province of Quezon";
   $civil = $row["civil"];
   $voter2 = $row["voter"];

if($voter2 == "Not Registered Voter"){
    $voter="non-registered voter";
}else{
    $voter="registered voter";
}

    
    date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

   if($row["captain"] =='okay' && $row["datereleased"]==""){
    $datee = date('Y-m-d');
    $upd="UPDATE `tbl_residency` SET datereleased ='".$formated_DATETIME."' , date_rel='".$datee."' where res_ctrl='".$ctrl."' ";
   $upnew=$conn->query($upd);
   }
   if($row["captain"] =='okay' ){
    $imageFile3 =K_PATH_IMAGES.'captain.jpg';
   }else{
    $imageFile3 =K_PATH_IMAGES.'nosign.jpg';
   }


}
}else{
   $requestor_name ="";
   $address = "";
   $civil = "";
   $voter = "";
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
                $this->SetY(-15); // Position at 15mm from bottom
                $this->Ln(5);
                $this->SetFont('times','B','10');
                $this->Cell(180,5,'MN-003-F05 REV.03',0,1,'R');

        }

}



// create new PDF document
//portrait  or landscape
$pdf = new PDF('p','mm', 'letter', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Barangay Residence');
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
$pdf->Cell(180,5,'CERTIFICATE OF RESIDENCY',0,0,'C',0);
$pdf->SetFont('times', 'B',12, '', true);
$pdf->Ln(18);
$pdf->Cell(180,5,'TO WHOM IT MAY CONCERN',0,0,'L',0);

$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(10);
$pdf->Cell(8,5,'',0,0,'L',0);
$pdf->MultiCell(39,5,"This is to certify that",0,'L',0,0,'','',true);
$pdf->SetFont('times', 'B',10, '', true);
$pdf->MultiCell(80,5,strtoupper($requestor_name),0,'C',0,0,'','',true);
$pdf->SetFont('times', '',12, '', true);
$pdf->MultiCell(130,5,"of legal age ".$civil.", Filipino",0,'L',0,0,'','',true);
$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(7);
$pdf->MultiCell(190,5,"citizen and a ".$voter." whose specimen signatures appears below, is a PERMANENT RESIDENT",0,'L',0,0,'','',true);

$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(7);
$pdf->MultiCell(180,5,"of this Barangay Milawid Sitio Pinagbudhian, Quezon. Based on records of this office, he/she has been",0,'L',0,0,'','',true);
$pdf->Ln(7);
$pdf->MultiCell(170,10,"residing at ".$address,0,'L',0,0,'','',true);

$pdf->Ln(15);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->MultiCell(10,5,"This",0,'L',0,0,'','',true);
$pdf->SetFont('times', 'B',12, '', true);
$pdf->MultiCell(37,5,"CERTIFICATION",0,'L',0,0,'','',true);
$pdf->SetFont('times', '',12, '', true);
$pdf->MultiCell(165,5,"is being issued upon the request of the above-named person for",0,'L',0,0,'','',true);
$pdf->Ln(6);
$pdf->MultiCell(165,5,"whatever legal purpose it may serve.",0,'L',0,0,'','',true);
   date_default_timezone_set('Asia/Manila');
   $formated_DATETIME = date('dS');
     $formated_monthyer = date('F, Y');
$pdf->Ln(10);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->MultiCell(20,5,"Issued this ",0,'L',0,0,'','',true);
$pdf->MultiCell(150,5,$formated_DATETIME." day of ".$formated_monthyer." at Barangay Milawid, Sitio Pinagbudhian Quezon Province.",0,'L',0,0,'','',true);
 
$pdf->Ln(25);
$pdf->SetFont('times', '',12, '', true);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(35,5,'__________________________',0,0,'C',0);
$pdf->Cell(40,5,'',0,0,'L',0);
$queray = "SELECT DISTINCT * FROM tbl_org where org_pos ='Brgy. Captain' ";  
$result2a = mysqli_query($conn, $queray);  
while($rowx = mysqli_fetch_array($result2a))  
{
   $pdf->Image($imageFile3, 120,132, 40, 20,'JPG','','',false,200,'',false,false,0,false,false,false);
   $pdf->Cell(60,5,' HON. '.strtoupper($rowx['org_name']),0,0,'C',0);
}

$pdf->Ln(6);
$pdf->SetFont('times', '',12, '', true);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(20,5,'',0,0,'L',0);

$pdf->Cell(35,5,'Specimen Signature',0,0,'C',0);
$pdf->Cell(40,5,'',0,0,'L',0);
$pdf->Cell(60,5,'Barangay Chairman',0,0,'C',0);


$pdf->Ln(10);
$pdf->SetFont('times', '',12, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(70,5,strtoupper("** NOT VALID W/O OFFICIAL DRY SEAL"),0,0,'L',0);


$pdfname = "Residency-".$ctrl.".pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  