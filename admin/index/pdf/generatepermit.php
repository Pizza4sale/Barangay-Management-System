<?php
require 'conn.php';
require_once('tcpdf.php');
 $ctrl = $_GET['id'];

$query = "SELECT * FROM tbl_permit where permit_num = '".$ctrl."' ";  
$result3 = mysqli_query($conn,$query);
$count3 = mysqli_num_rows($result3);

if($count3 !=0){
// INSERT INTO `tbl_permit`(`permit_id`, `permit_num`, `fname`, `mname`, `lname`, `tin_no`, `phone_num`, `tel_num`, `corponame`, `business_name`, `bus_tin`, `bus_address`, `ownership`, `capital_breakdown`) VALUES
 $result2 = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result2))  
 {  
   $owner_name = $row["lname"]." , ".$row["fname"]." ".$row["mname"];
   $business_name = $row["business_name"];
   $bus_address = $row["bus_address"];
   
   $ctrl_num = $row["permit_num"];

   if($row["ownership"]=="Single"){
        $typeown ="SINGLE PROPRIETOR" ;
   }else if($row["ownership"]=="cooperative"){
        $typeown ="COOPERATIVE" ;
   }else if($row["ownership"]=="partner"){
        $typeown ="PARTNERSHIP" ;
   }else{
    $typeown =$row["ownership"];
   }

    date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

   if($row["captain"] =='okay' && $row["datereleased"]==""){
    $datee = date('Y-m-d');
    $upd="UPDATE `tbl_permit` SET datereleased ='".$formated_DATETIME."'  , date_rel='".$datee."' where permit_num='".$ctrl."' ";
   $upnew=$conn->query($upd);
   }

   if($row["captain"] =='okay' ){
    $imageFile3 =K_PATH_IMAGES.'captain.jpg';
   }else{
    $imageFile3 =K_PATH_IMAGES.'nosign.jpg';
   }

}
}


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
               

        }

}



// create new PDF document
//portrait  or landscape
$pdf = new PDF('p','mm', 'letter', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Barangay Business Clearance');
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
$pdf->Ln(18);
$pdf->Cell(180,5,'BARANGAY BUSINESS CLEARANCE',0,0,'C',0);
$pdf->Ln(15);
$pdf->SetFont('times', 'B',13, '', true);
$pdf->Cell(180,5,'PERMIT NO.:  '.$ctrl_num,0,0,'L',0);

$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(10);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->MultiCell(170,5,"Pursuant to the provision of the Barangay Tax Revenue of Barangay Milawid, Sitio Pinagbudhian",0,'L',0,0,'','',true);
$pdf->Ln(5);
$pdf->MultiCell(180,5,"Quezon Province, the Business Establishment which name, address and owner's name appears below is now duly registered in this Barangay as provided for under Sec 1520 of Republic Act No. 7160, otherwise known as Local Government Code of 1991, to wit,",0,'L',0,0,'','',true);
$pdf->Ln(25);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->Cell(25,5,'TYPE OF OWNERSHIP',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$typeown),0,0,'L',0);
$pdf->Ln(8);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->Cell(25,5,'NAME OF BUSINESS',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$business_name),0,0,'L',0);
$pdf->Ln(8);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->Cell(25,5,'OWNERS NAME',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(150,5,strtoupper(": ".$owner_name),0,0,'L',0);
$pdf->Ln(8);
$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(10,5,'',0,0,'L',0);
$pdf->Cell(25,5,'BUSINESS ADDRESS',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->MultiCell(120,5,strtoupper(": ".$bus_address),0,'L',0,0,'','',true);
$pdf->Ln(20);
$pdf->SetFont('times', '',11, '', true);
$pdf->MultiCell(20,5,"Issued this ",0,'L',0,0,'','',true);
   date_default_timezone_set('Asia/Manila');
   $formated_DATETIME = date('dS');
     $formated_monthyer = date('F, Y');
$pdf->MultiCell(150,5,$formated_DATETIME." day of ".$formated_monthyer." in Barangay Milawid, Sitio Pinagbudhian Quezon Province.",0,'L',0,0,'','',true);

$pdf->Ln(20);
$pdf->SetFont('times', 'B',11, '', true);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->Cell(35,35,'',1,0,'R',0);
$pdf->Cell(85,5,'',0,0,'L',0);
$queray = "SELECT DISTINCT * FROM tbl_org where org_pos ='Brgy. Captain' ";  
$result2a = mysqli_query($conn, $queray);  
while($rowx = mysqli_fetch_array($result2a))  
{
   $pdf->Image($imageFile3, 140,145, 40, 20,'JPG','','',false,200,'',false,false,0,false,false,false);
   $pdf->Cell(30,5,' HON. '.strtoupper($rowx['org_name']),0,0,'R',0);
}

$pdf->Ln(5);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(163,5,'Barangay Chairman',0,0,'R',0);
$pdf->Ln(18);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(115,5,'__________________________',0,0,'R',0);
$pdf->Ln(4);
$pdf->SetFont('times', '',11, '', true);
$pdf->Cell(106,5,'Applicant Signature',0,0,'R',0);
$pdf->Cell(70,5,'** Not Valid without official Seal',0,0,'R',0);

$pdfname = "CAR REQUEST-".$ctrl.".pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  