<?php
include 'conn.php';
date_default_timezone_set('Asia/Manila');
$dateprocess = date('Y-m-d H:i:s');


//CLEARANCE CASH PAYMENT
if($_GET['from'] == "newclearancecash"){
$sql1 = "SELECT *  FROM tbl_brgyclearance WHERE reqnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('clearance','cash','0' ,'-', '-','".$dateprocess."','".$_GET['id']."','".$name."','Active','-') ";
  $insnew2=$conn->query($upd);

  $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_GET['id']."'  ";
  $upnewx=$conn->query($updx);

  $upd="UPDATE `tbl_brgyclearance` SET photoupload ='N/A' where reqnum='".$_GET['id']."' ";
  $upnew=$conn->query($upd);

if($insnew2){
?>
       <script>
            alert("You have successfully add your payment.");
           window.location.replace("clearancehistory.php");
       </script>
<?php 
}else{
   ?>
       <script>
            alert("Registration of payment is not successful. Please try again");
           window.location.replace("clearancehistory.php");
       </script>
<?php
}
}

// PERMIT CASH PAYMENT
if($_GET['from'] == "newpermitcash"){

$sql1 = "SELECT *  FROM tbl_permit WHERE reqnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('permit','cash','0' ,'-', '-','".$dateprocess."','".$_GET['id']."','".$name."','Active','-') ";
  $insnew2=$conn->query($upd);

  $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_GET['id']."'  ";
  $upnewx=$conn->query($updx);

  $upd="UPDATE `tbl_permit` SET photoupload ='N/A' where reqnum='".$_GET['id']."' ";
  $upnew=$conn->query($upd);

if($insnew2){
?>
       <script>
            alert("You have successfully add your payment.");
           window.location.replace("permithistory.php");
       </script>
<?php 
}else{
   ?>
       <script>
            alert("Registration of payment is not successful. Please try again");
           window.location.replace("permithistory.php");
       </script>
<?php
}
}

// RESIDENCE CASH PAYMENT
if($_GET['from'] == "newresidencecash"){

$sql1 = "SELECT *  FROM tbl_residency WHERE reqnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $n=$resultQuery['res_lname'].", ".$resultQuery['res_name']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('residency','cash','0' ,'-', '-','".$dateprocess."','".$_GET['id']."','".$name."','Active','-') ";
  $insnew2=$conn->query($upd);

  $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_GET['id']."'  ";
  $upnewx=$conn->query($updx);

  $upd="UPDATE `tbl_residency` SET photoupload ='N/A' where reqnum='".$_GET['id']."' ";
  $upnew=$conn->query($upd);

if($insnew2){
?>
       <script>
            alert("You have successfully add your payment.");
           window.location.replace("residencehistory.php");
       </script>
<?php 
}else{
   ?>
       <script>
            alert("Registration of payment is not successful. Please try again");
           window.location.replace("residencehistory.php");
       </script>
<?php
}
}


// LOW INCOME CASH PAYMENT
if($_GET['from'] == "newlowincomecash"){

$sql1 = "SELECT *  FROM tbl_lowincome WHERE reqnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('lowincome','cash','0' ,'-', '-','".$dateprocess."','".$_GET['id']."','".$name."','Active','-') ";
  $insnew2=$conn->query($upd);

  $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_GET['id']."'  ";
  $upnewx=$conn->query($updx);

  $upd="UPDATE `tbl_lowincome` SET photoupload ='N/A' where reqnum='".$_GET['id']."' ";
  $upnew=$conn->query($upd);

if($insnew2){
?>
       <script>
            alert("You have successfully add your payment.");
           window.location.replace("lowincomehistory.php");
       </script>
<?php 
}else{
   ?>
       <script>
            alert("Registration of payment is not successful. Please try again");
           window.location.replace("lowincomehistory.php");
       </script>
<?php
}
}

// SOLO PARENT CASH PAYMENT
if($_GET['from'] == "newsolocash"){

$sql1 = "SELECT *  FROM tbl_soloparent WHERE reqnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('soloparent','cash','0' ,'-', '-','".$dateprocess."','".$_GET['id']."','".$name."','Active','-') ";
  $insnew2=$conn->query($upd);

  $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_GET['id']."'  ";
  $upnewx=$conn->query($updx);

  $upd="UPDATE `tbl_soloparent` SET photoupload ='N/A' where reqnum='".$_GET['id']."' ";
  $upnew=$conn->query($upd);

if($insnew2){
?>
       <script>
            alert("You have successfully add your payment.");
           window.location.replace("soloparenthistory.php");
       </script>
<?php 
}else{
   ?>
       <script>
            alert("Registration of payment is not successful. Please try again");
           window.location.replace("soloparenthistory.php");
       </script>
<?php
}
}

// INDIGENCY CASH PAYMENT
if($_GET['from'] == "newindigencycash"){

$sql1 = "SELECT *  FROM tbl_indigency WHERE reqnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('indigency','cash','0' ,'-', '-','".$dateprocess."','".$_GET['id']."','".$name."','Active','-') ";
  $insnew2=$conn->query($upd);

  $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_GET['id']."'  ";
  $upnewx=$conn->query($updx);

  $upd="UPDATE `tbl_indigency` SET photoupload ='N/A' where reqnum='".$_GET['id']."' ";
  $upnew=$conn->query($upd);

if($insnew2){
?>
       <script>
            alert("You have successfully add your payment.");
           window.location.replace("indigencyhistory.php");
       </script>
<?php 
}else{
   ?>
       <script>
            alert("Registration of payment is not successful. Please try again");
           window.location.replace("indigencyhistory.php");
       </script>
<?php
}
}
?>