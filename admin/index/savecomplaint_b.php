<?php 
include 'include/conn.php';

 $sql1 = "SELECT num FROM tbl_increments WHERE type= 'complaint' ";
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
  $formated_DATETIME = date('Y-m-d H:i:s');

  $formated_DATETIME2 = date('Y-m-d');

$n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
$new=date("Y")."ADMINCO-".$n;

 $filename1 =$_FILES['fileupload']['name'];
    // name of the uploaded file
if($filename1 !=""){

    $filename = $new."-".$_FILES['fileupload']['name'];
    $destination = '../../user/pages/file/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['fileupload']['tmp_name'];
    $size = $_FILES['fileupload']['size'];

    if (!in_array($extension, ['pdf','JPG','JPEG','jpg','jpeg','png','PNG','m4a','mp4'])) {
      echo " Uplpoaded file is not successful. Please check the file extension. PDF File Only!";
    }else{
      if (move_uploaded_file($file, $destination)) {
            $ins = "INSERT INTO `tbl_complaint`(`com_ctrl`, `from`, `emailadd`, `phoneno`, `to`, `dateincident`, `address`, `details`,status,upload,datereceived) VALUES ('".$new."','".$_POST['cname']."','".$_POST['email']."','".$_POST['pnum']."','".$_POST['rname']."','".$_POST['datee']."','".$_POST['address']."','".$_POST['details']."','OPEN','".$filename."','".$formated_DATETIME2."')";
            $insert = $conn->query($ins);
        }
    }
}else{

   $ins = "INSERT INTO `tbl_complaint`(`com_ctrl`, `from`, `emailadd`, `phoneno`, `to`, `dateincident`, `address`, `details`,status,upload,datereceived) VALUES ('".$new."','".$_POST['cname']."','".$_POST['email']."','".$_POST['pnum']."','".$_POST['rname']."','".$_POST['datee']."','".$_POST['address']."','".$_POST['details']."','OPEN','-','".$formated_DATETIME2."')";
            $insert = $conn->query($ins);
}


if($insert){

    $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'complaint' ";
       $updd = $conn->query($upd_incre);
?>
 <script>
    alert("Your complaint have successfully sent. Please wait for our official to contact you for further details. Thank you");
    window.location.replace("complain_file.php");
 </script>
 <?php } ?>