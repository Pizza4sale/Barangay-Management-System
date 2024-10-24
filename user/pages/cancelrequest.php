<?php 

include 'conn.php';
session_start();
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];

date_default_timezone_set('Asia/Manila');
$dateprocess = date('Y-m-d H:i:s');

   $sql1 = "SELECT * FROM tbl_request WHERE cnum='".$_GET['id']."'  ";
   $processQuery1 = $conn->query($sql1);
   while ($resultQuery = $processQuery1->fetch_assoc())
   { $type=$resultQuery['type']; }


$upd = "UPDATE `tbl_request` SET `status`='Cancelled by Requestor',expiredate='-',`datedeleted`='".$dateprocess."',request_type='OLDEST',`fromuser`='".$uname."'
         WHERE cnum='".$_GET['id']."' ";
$upnew=$conn->query($upd);

if($type=="brgyclearance"){
	$del="DELETE FROM `tbl_brgyclearance` WHERE reqnum ='".$_GET['id']."' ";
	$delnewc=$conn->query($del);

if($delnewc){

   $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`,type) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','CLEARANCE') ";
   $insnew=$conn->query($inset);

   $delpc="DELETE FROM `tbl_payments` WHERE cnum ='".$_GET['id']."' ";
   $delpc1=$conn->query($delpc);
   ?>
    <script>
       alert("You have successfully cancelled a request");
       window.location.replace("clearancehistory.php");
    </script>
    <?php }
}elseif($type=="permit"){

   $del="DELETE FROM `tbl_permit` WHERE reqnum ='".$_GET['id']."' ";
   $delnewp=$conn->query($del);

if($delnewp){

    $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`,type ) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','PERMIT') ";
    $insnew=$conn->query($inset);

   $delpc="DELETE FROM `tbl_payments` WHERE cnum ='".$_GET['id']."' ";
   $delpc1=$conn->query($delpc);
?>
 <script>
    alert("You have successfully cancelled a request");
    window.location.replace("permithistory.php");
 </script>
 <?php }

}elseif($type=="residency"){

$del="DELETE FROM `tbl_residency` WHERE reqnum ='".$_GET['id']."' ";
   $delnewco=$conn->query($del);

if($delnewco){
    $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`,type ) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','RESIDENCY') ";
    $insnew=$conn->query($inset);
?>
 <script>
    alert("You have successfully cancelled a request");
    window.location.replace("residencehistory.php");
 </script>

<?php  }
}elseif($type=="renewclearance"){

}elseif($type=="complaints"){

   $del="DELETE FROM `tbl_complaint` WHERE reqnum ='".$_GET['id']."' ";
   $delnewco=$conn->query($del);

if($delnewco){
    $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`, type) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','COMPLAINT') ";
    $insnew=$conn->query($inset);
?>
 <script>
    alert("You have successfully cancelled a request");
    window.location.replace("complainthistory.php");
 </script>

<?php  } }elseif($type=="lowincome"){

   $del="DELETE FROM `tbl_lowincome` WHERE reqnum ='".$_GET['id']."' ";
   $delnewco=$conn->query($del);

if($delnewco){
    $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`, type) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','LOWINCOME') ";
    $insnew=$conn->query($inset);
?>
 <script>
    alert("You have successfully cancelled a request");
    window.location.replace("lowincomehistory.php");
 </script>

<?php  } } elseif($type=="soloparent"){

   $del="DELETE FROM `tbl_soloparent` WHERE reqnum ='".$_GET['id']."' ";
   $delnewco=$conn->query($del);

if($delnewco){
    $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`, type) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','SOLOPARENT') ";
    $insnew=$conn->query($inset);
?>
 <script>
    alert("You have successfully cancelled a request");
    window.location.replace("soloparenthistory.php");
 </script>

<?php  } } elseif($type=="indigency"){

   $del="DELETE FROM `tbl_indigency` WHERE reqnum ='".$_GET['id']."' ";
   $delnewco=$conn->query($del);

if($delnewco){
    $inset = "INSERT INTO `tbl_cancelledreq`( `reqnum`, `fromuser`, `datetimeproc`, `remarks`, type) 
              VALUES ('".$_GET['id']."', '".$uname."','".$dateprocess."','CANCELLED BY ".$uname."','INDIGENCY') ";
    $insnew=$conn->query($inset);
?>
 <script>
    alert("You have successfully cancelled a request");
    window.location.replace("indigencyhistory.php");
 </script>

<?php  } } ?>



