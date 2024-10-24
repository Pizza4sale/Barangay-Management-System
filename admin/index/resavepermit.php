<?php 

include 'include/conn.php';

if(isset($_POST['save'])){
  if($_POST['purpo']=="permit"){

    $sql1 = "SELECT num FROM tbl_increments WHERE type= 'permit' ";
  $processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 

  if($req_num >=10){  $nn = 3; }else{ $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);

  $new=date("Y")."ADMINBP-".$n;

  date_default_timezone_set('Asia/Manila');
  $formated_DATETIME = date('Y-m-d H:i:s');
  $datee = date('Y-m-d H:i:s');


$upd = "UPDATE `tbl_permit` SET `fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."',`tin_no`='".$_POST['tin']."',`phone_num`='".$_POST['phone']."',`tel_num`='".$_POST['tel']."',`corponame`='".$_POST['corponame']."',`business_name`='".$_POST['busname']."',`bus_tin`='".$_POST['bustin']."',`bus_address`='".$_POST['busadd']."',`ownership`='".$_POST['owner']."',`capital_breakdown`='".$_POST['capital']."', permit_num='".$new."' , captain='okay' WHERE reqnum='".$_POST['cnumm']."' ";
  $insnew=$conn->query($upd);

  if($insnew){ 
      $upd3 = "UPDATE tbl_increments  SET num =num + 1  WHERE type= 'permit' ";
      $insnew3=$conn->query($upd3);

      $upd3x = "UPDATE tbl_request SET status ='For Releasing' WHERE type= 'permit' and cnum ='".$_POST['cnumm']."' ";
    $insnew3x=$conn->query($upd3x);

      $update ="UPDATE `tbl_payments` SET cnum = '".$new."' WHERE cnum='".$_POST['cnumm']."' ";
      $insnew2=$conn->query($update);

      echo "<script>window.open('pdf/generatepermit.php?id=". $new ."'); window.location.href = 'notif.php'</script>";
      // header("Location:notif.php");
  }
}

}
?>