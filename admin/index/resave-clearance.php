<?php 
date_default_timezone_set('Asia/Manila');
$formated_DATETIME = date('Y-m-d H:i:s');
include 'include/conn.php';

if(isset($_POST['edit'])){

if($_POST['from']=="clearance_edit" || $_POST['from']=="clearance"){

  $upd2 = "UPDATE `tbl_brgyclearance` SET `fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."',`address`='".$_POST['address']."',`bday`='".$_POST['bdate']."',`age`='".$_POST['age']."',`gender`='".$_POST['gender']."',`civil`='".$_POST['civil']."',`length`='".$_POST['length']."',`company`='".$_POST['company']."',`purpose`='".$_POST['purpose']."',`voter`='".$_POST['voter']."',captain='wait' WHERE ctrl_num='".$_POST['cnumm']."' ";
  $insnew1=$conn->query($upd2);

 $upd3 = "UPDATE tbl_increments  SET num = num + 1  WHERE type= 'brgyclearance' ";
  $insnew3=$conn->query($upd3);

  if($insnew1){
  $update ="UPDATE `tbl_payments` SET cnum = '".$_POST['cnumm']."' WHERE cnum='".$_POST['cnumm']."' ";
   $insnew2=$conn->query($update);
  }



}elseif($_POST['from']=="renewclearance"){

    $sql1 = "SELECT *  FROM tbl_renewal WHERE newctrl='".$_POST['newcnum']."'  ";
    $processQuery1 = $conn->query($sql1);
    while ($resultQuery = $processQuery1->fetch_assoc())
    { $file=$resultQuery['upload']; $purp = $resultQuery['purpose']; $name = strtoupper($n);}


  $sqlw = "INSERT INTO `tbl_renewal`(`type`, `oldctrl`, `newctrl`, `purpose`, `upload`, `status`,datereleased) VALUES ('brgyclearance','".$_POST['cnumm']."','".$_POST['newcnum']."','".$purp."','".$file."','RELEASED','".$formated_DATETIME."' )";
  $processQueryw = $conn->query($sqlw);

$upd2 = "UPDATE `tbl_brgyclearance` SET `fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."',`address`='".$_POST['address']."',`bday`='".$_POST['bdate']."',`age`='".$_POST['age']."',`gender`='".$_POST['gender']."',`civil`='".$_POST['civil']."',`length`='".$_POST['length']."',`company`='".$_POST['company']."',`purpose`='".$_POST['purpose']."',`voter`='".$_POST['voter']."',status='OLD', ctrl_num='".$_POST['newcnum']."' , datereleased='".$formated_DATETIME."'  WHERE ctrl_num='".$_POST['cnumm']."' ";
  $insnew1=$conn->query($upd2);

  if($insnew1){
       ?>
      <input type="text" value="<?php echo $_POST['newcnum'];?>" id="cnum" >
      <script>
               window.open("pdf/generatebgclearance.php?id="+ document.getElementById('cnum').value);
               //window.location.href = "clearance_file.php";
      </script>
  <?php
      $sa = "DELETE FROM `tbl_request` where type='brgyclearance' and cnum='".$_POST['newcnum']."' ";
      $conn->query($sa);

        $update ="UPDATE `tbl_payments` SET cnum = '".$_POST['newcnum']."' WHERE cnum='".$_POST['cnumm']."' ";
      $insnew2=$conn->query($update);

  }
}

}




if(isset($_POST['save'])){
  if($_POST['from']=="clearance"){

$sql1 = "SELECT num FROM tbl_increments WHERE type= 'brgyclearance' ";
  $processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 

  if($req_num >=10){  $nn = 3; }else{ $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);

  $new= date("Y")."ADMINBC-".$n;


$upd = "UPDATE `tbl_brgyclearance` SET `fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."',`address`='".$_POST['address']."',`bday`='".$_POST['bdate']."',`age`='".$_POST['age']."',`gender`='".$_POST['gender']."',`civil`='".$_POST['civil']."',`length`='".$_POST['length']."',`company`='".$_POST['company']."',`purpose`='".$_POST['purpose']."',`voter`='".$_POST['voter']."',captain='okay', ctrl_num='".$new."'  WHERE reqnum='".$_POST['cnumm']."' ";
  $insnew=$conn->query($upd);

  if($insnew){ 

    $upd3 = "UPDATE tbl_increments  SET num =num + 1  WHERE type= 'brgyclearance' ";
    $insnew3=$conn->query($upd3);
   
    $upd3x = "UPDATE tbl_request SET status ='For Releasing' WHERE type= 'brgyclearance' and cnum ='".$_POST['reqnum']."' ";
    $insnew3x=$conn->query($upd3x);

   $update ="UPDATE `tbl_payments` SET cnum = '".$new."' WHERE cnum='".$_POST['cnumm']."' ";
   $insnew2=$conn->query($update);

   echo "<script>window.open('pdf/generatebgclearance.php?id=". $new ."'); window.location.href = 'notif.php'</script>";

  //  header("Location:notif.php");   
  }
}}
?>