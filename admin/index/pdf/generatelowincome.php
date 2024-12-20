<?php
require 'conn.php';
require_once('tcpdf.php');
 $ctrl = $_GET['id'];

$query = "SELECT * FROM tbl_lowincome where reqnum= '".$ctrl."' ";  
$result3 = mysqli_query($conn,$query);
$count3 = mysqli_num_rows($result3);

if($count3 !=0){
 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  
   $requestor_name = $row["lname"]." , ".$row["fname"]." ".$row["mname"];
   $age = $row["age"];
   $civil = $row["marital"];
   $address = $row["address"];


   date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

   if($row["captain"] =='okay' && $row["datereleased"]==""){
$datee = date('Y-m-d');
    $upd="UPDATE `tbl_lowincome` SET datereleased ='".$formated_DATETIME."' , date_rel='".$datee."' where reqnum='".$ctrl."' ";
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

}

/**
 * 
 */

class PDF extends TCPDF
{
        public function Header(){
           $imageFile =K_PATH_IMAGES.'logoo.jpg';
           $imageFile2 =K_PATH_IMAGES.'logoo2.jpg';
           $this->Image($imageFile,30,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);
          //  $this->Image($imageFile,150,5,25,'','JPG','','T',false,300,'',false,false,0,false,false,false);

            $this->Ln(2);
           
            $this->SetFont('helvetica','B','12');
            //Cell($width=, $height, $text, $boarder, $ln, $align, $fill, $link,$strech,$ignore_min_height=false,$calign=T,$valign='M')
        
           $this->SetFont('times','',12, '', true);
           $this->Cell(180,5,'Republic of the Philippines',0,1,'C');
           $this->Cell(180,5,'Province of Quezon',0,1,'C');
           $this->Cell(180,5,'MUNICIPALITY OF PANUKULAN',0,1,'C');
           $this->Cell(180,5,'BARANGAY MILAWID',0,1,'C');
            $this->Ln(5);
           $this->SetFont('times','B',13, '', true);
           $this->Cell(180,5,'*****OFFICE OF THE BARANGAY CAPTAIN*****',0,1,'C');

           $this->Ln(2);
           $this->SetFont('times','B',12, '', true);
           $this->Cell(180,5,'___________________________________________________________________________________',0,1,'C');

             $this->Ln(6);
           $this->SetFont('times','B',12, '', true);
           $this->Cell(180,5,'*CERTIFICATE OF LOW INCOME*',0,1,'C');
           
          
           
           
        }

        public function Footer(){
                $this->SetY(-15); // Position at 15mm from bottom
                $this->Ln(5);
                $this->SetFont('times','B','10');

        }

}



// create new PDF document
//portrait  or landscape
$pdf = new PDF('p','mm', 'letter', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Certificate of Low Income');
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
$pdf->Ln(25);

$pdf->SetFont('times', '',13, '', true);
$pdf->Ln(18);
$pdf->Cell(8,5,'',0,0,'L',0);
$pdf->Cell(180,5,'TO WHOM IT MAY CONCERN:',0,0,'L',0);

$pdf->SetFont('times', '',13, '', true);
$pdf->Ln(10);
$pdf->Cell(8,5,'',0,0,'L',0);
$pdf->MultiCell(160,5,"      This is to CERTIFY that ". strtoupper($requestor_name)." , ".$age." years old, ".$civil." , Filipino and resident of  ".$address.". This further certify that the above named posseses good moral and a law abiding citizen but unfortunately she belong to the poor family in our community.",0,'J',0,0,'','',true);


   date_default_timezone_set('Asia/Manila');
   $formated_DATETIME = date('dS');
     $formated_monthyer = date('F, Y');
$pdf->Ln(30);
$pdf->Cell(8,5,'',0,0,'L',0);
$pdf->MultiCell(160,5,"         This certification is being issued upon the request of " .$requestor_name." for any legal purposes it may serve.",0,'L',0,0,'','',true);


$pdf->Ln(25);
$pdf->Cell(8,5,'',0,0,'L',0);
$pdf->MultiCell(160,5,"         Issued this ".$formated_DATETIME." day of ".$formated_monthyer." at Barangay Milawid, Panukulan, Quezon." ,0,'L',0,0,'','',true);


$pdf->Ln(25);
$pdf->SetFont('times', '',12, '', true);
$pdf->Cell(35,5,'Issued by: ',0,0,'L',0);
$pdf->Ln(10);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',12, '', true);
$queray = "SELECT * FROM tbl_org where org_pos ='Secretary' ";  
$result2a = mysqli_query($conn, $queray);  
while($rowx = mysqli_fetch_array($result2a))  
{   
    $pdf->Cell(35,5,strtoupper($rowx['org_name']),0,0,'C',0);
}
$pdf->Ln(6);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(35,5,'Barangay Secretary',0,0,'C',0);

$pdf->Ln(15);
$pdf->SetFont('times', '',12, '', true);
$pdf->Cell(100,5,' ',0,0,'L',0);
$pdf->Cell(35,5,'Noted by; ',0,0,'L',0);
$pdf->Ln(10);
$pdf->Cell(125,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',12, '', true);
$queray = "SELECT DISTINCT * FROM tbl_org where org_pos ='Brgy. Captain' ";  
$result2a = mysqli_query($conn, $queray);  
while($rowx = mysqli_fetch_array($result2a))  
{   
    $pdf->Image($imageFile3, 140,180, 40, 20,'JPG','','',false,200,'',false,false,0,false,false,false);
    $pdf->Cell(35,5,strtoupper($rowx['org_name']),0,0,'C',0);
}
$pdf->Ln(6);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(105,5,'',0,0,'L',0);
$pdf->Cell(35,5,'Barangay Captain',0,0,'C',0);



$pdf->Ln(30);
$pdf->SetFont('times', '',12, '', true);
$pdf->Cell(15,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',9, '', true);
$pdf->Cell(70,5,strtoupper("** THIS IS NOT VALID WITHOUT OFFICIAL DRY SEAL"),0,0,'L',0);


$pdfname = "Residency-".$ctrl.".pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  