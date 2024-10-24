<?php 

include 'include/conn.php';
date_default_timezone_set('Asia/Manila');
$dateprocess = date('Y-m-d H:i:s');

if($_POST['voter'] =="yes"){
  $vo = "registered voter";
}else{
  $vo = "not registered voter";
}

    $sql1 = "SELECT num FROM tbl_increments WHERE type= 'residency' ";
  $processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 

  if($req_num >=10){  $nn = 3; }else{ $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);

  $new=date("Y")."ADMINRP-".$n;

$sqlz = "SELECT count(*) as voterr FROM tbl_residency WHERE res_email ='".$_POST['email']."' ";
$processQueryz= $conn->query($sqlz);
while ($resultQuerz = $processQueryz->fetch_assoc())
  { $reg = $resultQuerz['voterr']; }

  if($reg <=1 ){
    if($_POST['voter'] =="yes"){
     $upd_increx = "UPDATE `tbl_faq` SET voter = voter + 1 WHERE purpose= 'voter' ";
     $upddx = $conn->query($upd_increx);
    }else{
     $upd_increx = "UPDATE `tbl_faq` SET nonvoter = nonvoter + 1 WHERE purpose= 'voter' ";
     $upddx = $conn->query($upd_increx);
    }
  } 

$upd = "UPDATE `tbl_residency` SET `res_name`='".$_POST['fname']."',`res_mname`='".$_POST['mname']."',`res_lname`='".$_POST['lname']."',`res_number`='".$_POST['phone']."',`res_purok`='".$_POST['purok']."',`res_bgy`='".$_POST['brgy']."',`civil`='".$_POST['civil']."',`voter`='".$vo."', res_ctrl='".$new."' ,`res_email`='".$_POST['email']."', captain='wait' WHERE reqnum='".$_POST['cnumm']."' ";
  $insnew=$conn->query($upd);


    $filename1 =$_FILES['fileupload']['name'];
// name of the uploaded file
  if($filename1 !=""){

    $filename = $_POST['cnumm']."-".$_FILES['fileupload']['name'];
    $destination = '../../user/pages/file/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['fileupload']['tmp_name'];
    $size = $_FILES['fileupload']['size'];

    if (!in_array($extension, ['pdf'])) {
      echo " Uplpoaded file is not successful. Please check the file extension. PDF File Only!";
    }else{
      if (move_uploaded_file($file, $destination)) {
     $upd1 = "UPDATE `tbl_residency` SET `reqfile`='".$filename."' WHERE res_ctrl='".$_POST['cnumm']."' ";
      $conn->query($upd1);
    }
    }
}
  if($insnew){ 

      $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'residency' ";
       $updd = $conn->query($upd_incre);

    $upd3x = "UPDATE tbl_request SET status ='For Releasing' WHERE type= 'residency' and cnum ='".$_POST['cnumm']."' ";
    $insnew3x=$conn->query($upd3x);

       $update ="UPDATE `tbl_payments` SET cnum = '".$new."' WHERE cnum='".$_POST['cnumm']."' ";
      $insnew2=$conn->query($update);
    header("Location:residency_file.php");
  }

?>