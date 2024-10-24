
<?php 
include 'include/conn.php';
date_default_timezone_set('Asia/Manila');
$formated_DATETIME = date('Y-m-d H:i:s');


$sql1 = "SELECT num FROM tbl_increments WHERE type= 'residency' ";
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

  $new=date("Y")."ADMINRP-".$n;

  

      if($_POST['voter'] =="yes"){
       echo  $vo = "Registered Voter";
      }else{
        echo $vo = "Not Registered Voter";
      }

    $sqlz = "SELECT count(*) as voterr FROM tbl_residency WHERE res_email ='".$_POST['email']."' ";
$processQueryz= $conn->query($sqlz);
while ($resultQuerz = $processQueryz->fetch_assoc())
  { $reg = $resultQuerz['voterr']; }

  if($reg == 0){
    if($_POST['voter'] =='yes'){
     $upd_increx = "UPDATE `tbl_faq` SET voter = voter + 1 WHERE purpose= 'voter' ";
     $upddx = $conn->query($upd_increx);
    }else{
     $upd_increx = "UPDATE `tbl_faq` SET nonvoter = nonvoter + 1 WHERE purpose= 'voter' ";
     $upddx = $conn->query($upd_increx);
    }
  } 


   $qry = "INSERT INTO `tbl_residency`(`res_name`, `res_mname`, `res_lname`, `res_email`, `res_number`, `res_purok`, `res_bgy`, `reqfile`,res_ctrl,civil,voter,status,datereleased,fromuser) VALUES ('".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['email']."','".$_POST['pnum']."','".$_POST['street']."','".$_POST['brgy']."','N/A','".$new."','".$_POST['civil']."','".$vo."','OLD','".$formated_DATETIME."','admin')";
     $updd = $conn->query($qry);

  $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'residency' ";
  $updd = $conn->query($upd_incre);
   header("Location:payment_ref.php?cnum={$new}&from=residencyb&oldcnum=-");

    ?>


