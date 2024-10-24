<?php
require 'conn.php';
require_once('tcpdf.php');


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
                //$imageFile3 =K_PATH_IMAGES.'captain.jpg';
                //$this->Image($imageFile3, 153,259, 40, 20,'JPG','','',false,200,'',false,false,0,false,false,false);
 
                $this->SetY(-30); // Position at 15mm from bottom


        }

}



// create new PDF document
//portrait  or landscape
$pdf = new PDF('p','mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KP');
$pdf->SetTitle('Barangay Services Report');
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
$pdf->SetMargins(10,20,10);
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

$pdf->AddPage();
$pdf->SetFont('times', 'B',20, '', true);
$pdf->SetFillColor(224,235,255);
$pdf->Ln(20);
$pdf->Cell(180,5,'BARANGAY SERVICE REPORT',0,0,'C',0);
$pdf->SetFont('times', 'B',12, '', true);
$pdf->Ln(10);
$pdf->SetFont('times', '',12, '', true);
$pdf->Ln(6);

if($_GET['services'] =='brgyclearance'){
    $d = "tbl_brgyclearance";
    $fg = 'Barangay Clearance';
}elseif($_GET['services'] =='permit'){
    $d = "tbl_permit";
    $fg = 'Business Permit';
}elseif($_GET['services'] =='residency'){
    $d = "tbl_residency";
    $fg = 'Barangay Residency';
}elseif($_GET['services'] =='soloparent'){
    $d = "tbl_soloparent";
    $fg = 'Certificate of Solo Parent';
}elseif($_GET['services'] =='lowincome'){
    $d = "tbl_lowincome";
    $fg = 'Certificate of Low Income';
}elseif($_GET['services'] =='indigency'){
    $d = "tbl_indigency";
    $fg = 'Certificate of Indigency';
}


    $date_1 =date_create($_GET['from']);
    $date_from = date_format($date_1,"Y-m-d");

    $date_2 =date_create($_GET['too']);
    $date_to = date_format($date_2,"Y-m-d");

    if( $date_from ==  $date_to){
        $query4 = "SELECT * FROM $d WHERE date_rel LIKE '%".$_GET['from']."%' ORDER by date_rel DESC "; 
    }else{
        $query4 = "SELECT * FROM $d WHERE date_rel BETWEEN '".$date_from."' AND '".$date_to."' ORDER by date_rel DESC ";
    }    


$pdf->MultiCell(30,5,"Date Released: ",0,'L',0,0,'','',true);
$pdf->MultiCell(65,5,$date_from." - ".$date_to,0,'L',0,0,'','',true);
$pdf->MultiCell(120,5,"Type of Service: ".strtoupper($fg),0,'L',0,0,'','',true);
$pdf->Ln(3);
$pdf->MultiCell(180,5,"____________________________________________________________________________________",0,'L',0,0,'','',true);
$pdf->Ln(5);

$pdf->SetFont('times', '',10, '', true);
$pdf->Cell(50,8,'Control Number',1,0,'C',1);
$pdf->Cell(70,8,'Name',1,0,'C',1);
$pdf->Cell(35,8,'Date Requested',1,0,'C',1);
$pdf->Cell(35,8,'Date Released',1,0,'C',1);
$pdf->Ln(8);

 $result4 = mysqli_query($conn, $query4);  
while($row1 = mysqli_fetch_array($result4))  
 {  

if($_GET['services'] =='brgyclearance'){

    $control= $row1["ctrl_num"];
    $namee= $row1["lname"].", ".$row1["fname"]." ".$row1["mname"];

}elseif($_GET['services'] =='permit'){

    $control= $row1["permit_num"];
    $namee= $row1["lname"].", ".$row1["fname"]." ".$row1["mname"];

}elseif($_GET['services'] =='residency' ){

    $control= $row1["res_ctrl"];
    $namee= $row1["res_lname"].", ".$row1["res_name"]." ".$row1["res_mname"];

}else{ 

    $control= $row1["reqnum"];
    $namee= $row1["lname"].", ".$row1["fname"]." ".$row1["mname"];
}

$date=date_create($row1["datetimereq"]);
$datereq = date_format($date,"Y-m-d");

$date1=date_create($row1["datereleased"]);
$daterel = date_format($date1,"Y-m-d");


$pdf->Cell(50,6,$control,1,0,'C');
$pdf->Cell(70,6,$namee,1,0,'C');
$pdf->Cell(35,6,$datereq,1,0,'C');
$pdf->Cell(35,6,$daterel,1,0,'C');
$pdf->Ln(6);

}

$pdfname = "Complain-".$date_from."TO".$date_to.".pdf";
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($pdfname, 'I');


?>  