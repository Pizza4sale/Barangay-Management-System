<?php 

include 'include/conn.php';


  date_default_timezone_set('Asia/Manila');
  $formated_DATETIME = date('Y-m-d H:i:s');
  $datee = date('Y-m-d H:i:s');
  $datetoday = date('Y-m-d H:i:s');
  $datetoday1 = date('m-d');
  $dateyear1 = date('Y');

  $sql1 = "SELECT num FROM tbl_increments WHERE type= 'indigency' ";
$processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 

if($req_num >=10){
  $nn = 3;
}else{
  $nn=3;
}

$n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
$new=date('Y')."ADMINIY-".$n;

  
   $aa =  date("m-d", strtotime($_POST['bday']));

   if($datetoday1 >=  $aa){
    $aa1 =  date("Y", strtotime($_POST['bday']));

    $age = $dateyear1 - $aa1;
   }else{
      $aa1 =  date("Y", strtotime($_POST['bday']));

    $age = ($dateyear1 - $aa1)- 1;
   }

$upd = "UPDATE `tbl_indigency` SET `fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."',`phonenumber`='".$_POST['number']."',`address`='".$_POST['address']."',`bday`='".$_POST['bday']."',`age`='".$age."',`marital`='".$_POST['civil']."', pay_status='OLD' , reqnum='".$new."', old_ctrl = '".$_POST['cnumm']."', captain='wait' WHERE reqnum='".$_POST['cnumm']."' ";
  $insnew=$conn->query($upd);



  if($insnew){ 

     $upd3x = "UPDATE tbl_request SET status ='For Releasing' WHERE type= 'indigency' and cnum ='".$_POST['cnumm']."' ";
     $insnew3x=$conn->query($upd3x);

     $update ="UPDATE `tbl_payments` SET cnum = '".$new."' WHERE cnum='".$_POST['cnumm']."' ";
     $insnew2=$conn->query($update);

     $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'indigency' ";
     $updd = $conn->query($upd_incre);

     header("Location:indigencyfile.php");

  }


?>