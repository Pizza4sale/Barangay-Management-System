
<?php 
include 'conn.php';

if(isset($_POST['permitsave'])){

  $sql1 = "SELECT num FROM tbl_increments WHERE type= 'permit' ";
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

  $new="2022BPR-".$n;

if($_POST['radio'] =="Others"){
	$typee = $_POST['others'];
}else{
	$typee = $_POST['radio'];
}

    $qry = "INSERT INTO `tbl_permit`(`permit_num`, `fname`, `mname`, `lname`,`tin_no`, `phone_num`, `tel_num`, `corponame`, `business_name`, `bus_tin`, `bus_address`, `ownership`, `capital_breakdown`,status)VALUES('".$new."','".$_POST['name']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['tinn']."','".$_POST['phone']."','".$_POST['telnum']."','".$_POST['corponame']."','".$_POST['busname']."','".$_POST['btin']."','".$_POST['busaddress']."','".$typee."','".$_POST['breakdown']."','NEW')";
	  $updd = $conn->query($qry);
  date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

    $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
   $sa1 = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate) VALUES('permit','".$new."','".$formated_DATETIME."','Active','NEW','".$expire."')";
  $updd1 = $conn->query($sa1);


       $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'permit' ";
       $updd = $conn->query($upd_incre);


 		header("Location:businesspermit.php?idper={$new}");


  }
    ?>
