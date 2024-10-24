<?php
include 'include/conn.php';
      date_default_timezone_set('Asia/Manila');
    $dat= date('Y-m-d H:i:s');


if($_GET['type'] =="recovered"){

$upd = "UPDATE `tbl_covid` SET status='RECOVERED', date_end='".$dat."' where covid_id = '".$_GET['id']."' " ;
 $updd = $conn->query($upd);
 header("Location:covid.php"); 

}elseif($_GET['type'] =="death"){

$upd = "UPDATE `tbl_covid` SET status='DEATH' , date_end='".$dat."' where covid_id = '".$_GET['id']."' " ;
 $updd = $conn->query($upd);
 header("Location:covid.php"); 
}



?>