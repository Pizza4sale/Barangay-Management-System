<?php 
include 'conn.php';
session_start();
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];


 $sql1 = "SELECT num FROM tbl_increments WHERE type= 'request' ";
 $processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 

if($req_num >=10){
  $nn = 3;
}else{
  $nn=3;
}

  date_default_timezone_set('Asia/Manila');
  $formated_DATETIME2 = date('Y-m-d H:i:s');

$n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
$new=date('Y')."RQTCO-".$n;

$fromname=$_POST['lname'].",".$_POST['name']." ".$_POST['mname'];
$toname=$_POST['lname1'].",".$_POST['name1']." ".$_POST['mname1'];

 $filename1 =$_FILES['fileupload']['name'];
    // name of the uploaded file
if($filename1 !=""){

    $filename = $new."-".$_FILES['fileupload']['name'];
    $destination = 'file/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['fileupload']['tmp_name'];
    $size = $_FILES['fileupload']['size'];

    if (!in_array($extension, ['pdf','JPG','JPEG','jpg','jpeg','png','PNG','m4a','mp4','mp3'])) { ?>
       <script>
    alert("Uplpoaded file is not successful. Please check the file extension. PDF File Only!");
    window.location.replace("addcomplaint.php");
 </script>
 <?php 
    }else{
      if (move_uploaded_file($file, $destination)) {
            $ins = "INSERT INTO `tbl_complaint`(`com_ctrl`, reqnum,`from`, `emailadd`, `phoneno`, `to`, `dateincident`, `address`, `details`,status,upload,datereceived,datesent,fromuser,visitsched) VALUES ('-','".$new."','".$fromname."','".$_POST['email']."','".$_POST['pnum']."','".$toname."','".$_POST['datee']."','".$_POST['address']."','".$_POST['details']."','NEW','".$filename."','-','".$formated_DATETIME2."','".$uname."','N/A')";
            $insert = $conn->query($ins);
        }
    }
}else{  

   $ins = "INSERT INTO `tbl_complaint`(`com_ctrl`,reqnum, `from`, `emailadd`, `phoneno`, `to`, `dateincident`, `address`, `details`,status,upload,datereceived,datesent,fromuser,visitsched) VALUES ('-','".$new."','".$fromname."','".$_POST['email']."','".$_POST['pnum']."','".$toname."','".$_POST['datee']."','".$_POST['address']."','".$_POST['details']."','NEW','-','-','".$formated_DATETIME2."','".$uname."','N/A')";
 $insert = $conn->query($ins);
}


if($insert){
  date_default_timezone_set('Asia/Manila');
  $formated_DATETIME = date('Y-m-d H:i:s');
  $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
  
    $sa = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate) VALUES('complaints','".$new."','".$formated_DATETIME."','Active','NEW','".$expire."')";

    $conn->query($sa);
    $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'request' ";
       $updd = $conn->query($upd_incre);
?>
 <script>
	alert("Your complaint have successfully sent. Please wait for our official to contact you for further details. Thank you");
	window.location.replace("service_number_complaint.php");
 </script>
 <?php } ?>