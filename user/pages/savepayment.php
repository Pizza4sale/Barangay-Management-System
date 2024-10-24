<?php 

include 'conn.php';
date_default_timezone_set('Asia/Manila');
$dateprocess = date('Y-m-d H:i:s');

if($_POST['payment'] != "1"){

// CLEARANCE PAYMENT ONLINE
if($_POST['from'] == "newclearanceol"){

   $sql1 = "SELECT *  FROM tbl_brgyclearance WHERE reqnum='".$_POST['idnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['idnum'];

$inset = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('clearance','".$_POST['payment']."','".$_POST['pay']."' ,'".$_POST['refnum']."', '".$_POST['pdate']."','".$dateprocess."','".$_POST['idnum']."','".$name."','NEW','N/A' ) ";
$insnew=$conn->query($inset);

$upd="UPDATE `tbl_brgyclearance` SET photoupload ='N/A' where reqnum='".$_POST['idnum']."' ";
$upnew=$conn->query($upd);


$updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_POST['idnum']."' ";
$upnewx=$conn->query($updx);

if($insnew){
    if($upnew){
            ?>
                   <script>
                        alert("You have successfully add your payment.");
                       window.location.replace("clearancehistory.php");
                   </script>
            <?php 
            }}else{
               ?>
                   <script>
                        alert("Registration of payment is not successful. Please try again");
                       window.location.replace("clearancehistory.php");
                   </script>
            <?php
            }
}


// PERMIT PAYMENT ONLINE
if($_POST['from'] == "newpermitol"){

   $sql1 = "SELECT *  FROM tbl_permit WHERE reqnum='".$_POST['idnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['idnum'];

$inset = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('permit','".$_POST['payment']."','".$_POST['pay']."' ,'".$_POST['refnum']."', '".$_POST['pdate']."','".$dateprocess."','".$_POST['idnum']."','".$name."','NEW','N/A' ) ";
$insnew=$conn->query($inset);

$upd="UPDATE `tbl_permit` SET photoupload ='N/A' where reqnum='".$_POST['idnum']."' ";
$upnew=$conn->query($upd);

$updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_POST['idnum']."' ";
$upnewx=$conn->query($updx);

if($insnew){
    if($upnew){ ?>
                   <script>
                        alert("You have successfully add your payment.");
                        window.location.replace("permithistory.php");
                   </script>
            <?php 
            }}else{
               ?>
                   <script>
                        alert("Registration of payment is not successful. Please try again");
                        window.location.replace("permithistory.php");
                   </script>
            <?php
            }
 } 

// RESIDENCE PAYMENT ONLINE
if($_POST['from'] == "newresidenceol"){

   $sql1 = "SELECT *  FROM tbl_residency WHERE reqnum='".$_POST['idnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['res_lname'].", ".$resultQuery['res_name']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['idnum'];

$inset = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('residence','".$_POST['payment']."','".$_POST['pay']."' ,'".$_POST['refnum']."', '".$_POST['pdate']."','".$dateprocess."','".$_POST['idnum']."','".$name."','NEW','N/A' ) ";
$insnew=$conn->query($inset);

$upd="UPDATE `tbl_residency` SET photoupload ='N/A' where reqnum='".$_POST['idnum']."' ";
$upnew=$conn->query($upd);
              
$updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_POST['idnum']."' ";
$upnewx=$conn->query($updx);


            if($insnew){
               if($upnew){
            ?>
                   <script>
                        alert("You have successfully add your payment.");
                        window.location.replace("residencehistory.php");
                   </script>
            <?php 
            }}else{
               ?>
                   <script>
                        alert("Registration of payment is not successful. Please try again");
                        window.location.replace("residencehistory.php");
                   </script>
            <?php
        }
    } 


// LOW INCOME PAYMENT ONLINE
if($_POST['from'] == "newlowincomeol"){

   $sql1 = "SELECT *  FROM tbl_lowincome WHERE reqnum='".$_POST['idnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['idnum'];
$filename ="N/A";

$inset = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('lowincome','".$_POST['payment']."','".$_POST['pay']."' ,'".$_POST['refnum']."', '".$_POST['pdate']."','".$dateprocess."','".$_POST['idnum']."','".$name."','NEW','".$filename."' ) ";
$insnew=$conn->query($inset);
              
              $upd="UPDATE `tbl_lowincome` SET photoupload ='N/A' where reqnum='".$_POST['idnum']."' ";
              $upnew=$conn->query($upd);
              
              $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_POST['idnum']."' ";
              $upnewx=$conn->query($updx);


            if($insnew){
               if($upnew){
            ?>
                   <script>
                        alert("You have successfully add your payment.");
                        window.location.replace("lowincomehistory.php");
                   </script>
            <?php 
            }}else{
               ?>
                   <script>
                        alert("Registration of payment is not successful. Please try again");
                        window.location.replace("lowincomehistory.php");
                   </script>
            <?php
        }
    } 


// SOLO PARENT PAYMENT ONLINE
if($_POST['from'] == "newsolool"){

   $sql1 = "SELECT *  FROM tbl_soloparent WHERE reqnum='".$_POST['idnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['idnum'];
$filename="N/A";

$inset = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('soloparent','".$_POST['payment']."','".$_POST['pay']."' ,'".$_POST['refnum']."', '".$_POST['pdate']."','".$dateprocess."','".$_POST['idnum']."','".$name."','NEW','".$filename."' ) ";
$insnew=$conn->query($inset);
              
              $upd="UPDATE `tbl_soloparent` SET photoupload ='N/A' where reqnum='".$_POST['idnum']."' ";
              $upnew=$conn->query($upd);
              
              $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_POST['idnum']."' ";
              $upnewx=$conn->query($updx);


            if($insnew){
               if($upnew){
            ?>
                   <script>
                        alert("You have successfully add your payment.");
                        window.location.replace("soloparenthistory.php");
                   </script>
            <?php 
            }}else{
               ?>
                   <script>
                        alert("Registration of payment is not successful. Please try again");
                        window.location.replace("soloparenthistory.php");
                   </script>
            <?php
            }
    } 

// INDIGENCY PAYMENT ONLINE
if($_POST['from'] == "newindigencyol"){

   $sql1 = "SELECT *  FROM tbl_indigency WHERE reqnum='".$_POST['idnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['idnum'];
$filename ="N/A";

$inset = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('indigency','".$_POST['payment']."','".$_POST['pay']."' ,'".$_POST['refnum']."', '".$_POST['pdate']."','".$dateprocess."','".$_POST['idnum']."','".$name."','NEW','".$filename."' ) ";
$insnew=$conn->query($inset);
              
              $upd="UPDATE `tbl_indigency` SET photoupload ='N/A' where reqnum='".$_POST['idnum']."' ";
              $upnew=$conn->query($upd);
              
              $updx="UPDATE `tbl_request` SET request_type ='NEW' where cnum='".$_POST['idnum']."' ";
              $upnewx=$conn->query($updx);


            if($insnew){
               if($upnew){
            ?>
                   <script>
                        alert("You have successfully add your payment.");
                        window.location.replace("indigencyhistory.php");
                   </script>
            <?php 
            }}else{
               ?>
                   <script>
                        alert("Registration of payment is not successful. Please try again");
                        window.location.replace("indigencyhistory.php");
                   </script>
            <?php
            }
    }


}else{
    
             header("Location:addpayment.php?id={$_POST['idnum']}&from={$_POST['from']}&error=x");
             ?>
                   <script>
                        alert("Please select mode of payment first");
                   </script>
            <?php
}
?>