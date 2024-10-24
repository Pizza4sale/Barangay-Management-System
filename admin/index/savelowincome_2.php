
<?php 
include 'include/conn.php';
session_start();

   date_default_timezone_set('Asia/Manila');
   $formated_DATETIME = date('Y-m-d H:i:s');

$sql1 = "SELECT num FROM tbl_increments WHERE type= 'lowincome' ";
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

  $datetoday = date('Y-m-d H:i:s');
  $datetoday1 = date('m-d');
  $dateyear1 = date('Y');
  
   $aa =  date("m-d", strtotime($_POST['bday']));

   if($datetoday1 >=  $aa){
    $aa1 =  date("Y", strtotime($_POST['bday']));

    $age = $dateyear1 - $aa1;
   }else{
      $aa1 =  date("Y", strtotime($_POST['bday']));

    $age = ($dateyear1 - $aa1)- 1;
   }

  $new=date("Y")."ADMINLI-".$n;

$address = $_POST['street']." Barangay Milawid, Panukulan, Quezon";

   $qry = "INSERT INTO `tbl_lowincome`(`reqnum`, `fname`, `mname`, `lname`, `age`, `marital`, `address`, `status`, `pay_status`, `datetimereq`,phonenumber,work,monthly_income,workadd,bday,datereleased) VALUES ('".$new."' ,'".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$age."','".$_POST['civil']."','".$address."','OLD','NEW','".$formated_DATETIME."','".$_POST['number']."','".$_POST['work']."','".$_POST['monthly']."','".$_POST['workadd']."','".$_POST['bday']."','".$formated_DATETIME."')";
   $updd = $conn->query($qry);
         

   $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'lowincome' ";
   $updd = $conn->query($upd_incre);
      header("Location:payment_ref.php?cnum={$new}&from=lowincome");

    ?>


