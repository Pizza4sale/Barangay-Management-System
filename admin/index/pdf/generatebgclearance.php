<?php
require 'conn.php';
require_once('tcpdf.php');
 $ctrl = $_GET['id'];
 date_default_timezone_set('Asia/Manila');
$formated_DATETIME = date('Y-m-d H:i:s');


$query = "SELECT * FROM tbl_brgyclearance where ctrl_num = '".$ctrl."' ";  
$result3 = mysqli_query($conn,$query);
$count3 = mysqli_num_rows($result3);

if($count3 !=0){
 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  
   $requestor_name = $row["lname"]." , ".$row["fname"]." ".$row["mname"];
   $address = $row["address"];
   $age = $row["age"];
   $gender = $row["gender"];
   $civil = $row["civil"];
   $length = $row["length"];
   $company = $row["company"];
   $purpose = $row["purpose"];
   $ctrl_num = $row["ctrl_num"];
   $voter = $row["voter"];
   $dd = date_create($row["bday"]);
   $bday =date_format($dd,"F d, Y");

   if($row["captain"] =='okay' && $row["datereleased"]==""){
   $datee = date('Y-m-d');
   $upd="UPDATE `tbl_brgyclearance` SET datereleased ='".$formated_DATETIME."', date_rel='".$datee."' where ctrl_num='".$ctrl."' ";
   $upnew=$conn->query($upd);
   }
   if($row["captain"] =='okay' ){
    $imageFile3 =K_PATH_IMAGES.'captain.jpg';
   }else{
    $imageFile3 =K_PATH_IMAGES.'nosign.jpg';
   }
}
}else{
     $requestor_name = "";
     $address="";
     $bday="";
     $age = "";
     $gender="";
}


/**
 * 
 */

class PDF extends TCPDF
{
        public function Header(){
           $imageFile =K_PATH_IMAGES.'logoo.jpg';
           $imageFile2 =K_PATH_IMAGES.'logoo2.jpg';
           $this->Image($imageFile2,35,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);
            $this->Image($imageFile,150,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);

            $this->Ln(2);
           
            $this->SetFont('helvetica','B','12');
            //Cell($width=, $height, $text, $boarder, $ln, $align, $fill, $link,$strech,$ignore_min_height=false,$calign=T,$valign='M')
        
           $this->SetFont('times','',13, '', true);
           $this->Cell(190,5,'REPUBLIC OF THE PHILIPPINES',0,1,'C');
           $this->Cell(190,5,'Province of Quezon',0,1,'C');
           $this->Cell(190,5,'Municipality of Panukulan',0,1,'C');
           $this->SetFont('times','',10, '', true);
            $this->Cell(190,5,'SITIO PINAGBUDHIAN, BARANGAY MILAWID',0,1,'C');
           $this->Cell(190,5,'-------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'C');
           
          
           
           
        }

        public function Footer(){
                $this->SetY(-15); // Position at 15mm from bottom
                $this->Ln(5);
                $this->SetFont('times','B','10');
               // $this->Cell(180,5,'MN-003-F05 REV.03',0,1,'R');

        }

}



// create new PDF document
//portrait  or landscape
$pdf = new PDF('p','mm', 'letter', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Barangay Clearance');
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
$pdf->SetMargins(11,20,PDF_MARGIN_RIGHT);
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
$pdf->Ln(15);
$pdf->Cell(190,5,'BARANGAY CLEARANCE',0,0,'C',0);
$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(12);
$pdf->Cell(190,5,'To whom it may concern:',0,0,'L',0);

$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(8);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->MultiCell(180,5,'This is to certify that the person whose name and signature appear herein, has requested for a ',0,'L',0,0,'','',true);
$pdf->Ln(5);
$pdf->MultiCell(190,5,'BARANGAY CLEARANCE from this office with the following information:',0,'L',0,0,'','',true);
$pdf->Ln(10);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'NAME',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$requestor_name),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'ADDRESS',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->MultiCell(120,10,strtoupper(": ".$address),0,'L',0,0,'','',true);
$pdf->Ln(10);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'DATE OF BIRTH',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(100,5,strtoupper(": ".$bday),0,0,'L',0);
$pdf->Cell(30,30,'',1,0,'L',0);
$pdf->SetFont('times', '',11, '', true);
$pdf->Ln(6);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'AGE',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(60,5,strtoupper(": ".$age),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'GENDER',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$gender),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'CIVIL STATUS',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'b',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$civil),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'LENGTH OF STAY',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$length." YEAR(/S)"),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'COMPANY',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$company),0,0,'L',0);

$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'PURPOSE',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$purpose),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'REMARKS',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(100,5,strtoupper(": NO RECORD ON FILE"),0,0,'L',0);
$pdf->Cell(30,2,'_______________',0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'ISSUED ON',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
   date_default_timezone_set('Asia/Manila');
   $formated_DATETIME = date('Y-m-d');
$pdf->Cell(100,5,strtoupper(": ".$formated_DATETIME),0,0,'L',0);
$pdf->Cell(30,2,'Signature',0,0,'C',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'ISSUED AT',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": BARANGAY MILAWID, SITIO PINAGBUDHIAN"),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->Cell(15,5,'CONTROL #',0,0,'L',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$ctrl_num),0,0,'L',0);

if($voter =="yes"){
    $fine = "** REGISTERED VOTER";
}else{
    $fine = "** NOT REGISTERED VOTER";
}

$pdf->Ln(10);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(60,5,strtoupper($fine),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(12,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(70,5,'',0,0,'L',0);
$pdf->Cell(60,5,strtoupper("APPROVED FOR ISSUE"),0,0,'L',0);

$pdf->Ln(10);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(70,5,strtoupper("NOT VALID W/O OFFICIAL DRY SEAL"),0,0,'L',0);

$query = "SELECT DISTINCT * FROM tbl_org where org_pos='Secretary' ";  
 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  
  $pdf->Cell(35,5,strtoupper($row["org_name"]),0,0,'C',0);
}
$query = "SELECT DISTINCT * FROM tbl_org where org_pos='Brgy. Captain' ";  
 $result2 = mysqli_query($conn, $query);  
while($rowx = mysqli_fetch_array($result2))  
 {  
$pdf->Image($imageFile3, 150,160, 40, 20,'JPG','','',false,200,'',false,false,0,false,false,false);
 $pdf->Cell(75,5,"HON. ".strtoupper($rowx['org_name']),0,0,'C',0);

}

$pdf->Cell(10,5,'',0,0,'L',0);



$pdf->Ln(4);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(70,5,'',0,0,'L',0);

$pdf->Cell(35,10,'Barangay Secretary',0,0,'C',0);
$pdf->Cell(10,1,'',0,0,'L',0);
$pdf->Cell(50,10,'Barangay Chairman',0,0,'C',0);




$pdfname = "BGClearance-".$ctrl.".pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  