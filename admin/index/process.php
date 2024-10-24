<?php
include 'include/conn.php';
   date_default_timezone_set('Asia/Manila');
    $datetoday = date('Y-m-d H:i:s');

if($_GET['type'] =="notokay"){
	$del1 = "UPDATE `tbl_complaint` SET status='DECLINE' ,datereceived='".$datetoday."' WHERE reqnum='".$_GET['cnum']."' ";
	$updd = $conn->query($del1);
$delw = "DELETE FROM `tbl_request` WHERE cnum='".$_GET['cnum']."' ";
$updd = $conn->query($delw);

header("Location:notif.php");

}elseif($_GET['type'] =="okay"){

$sql1 = "SELECT *  FROM tbl_increments WHERE type= 'complaint' ";
$processQuery1 = $conn->query($sql1);
 while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 
  if($req_num >=10){  $nn = 3;   }else{  $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
  $cnum1 = $_POST['cnum'];
  $cnum2 ="2022CO-".$n;

	$del1 = "UPDATE `tbl_complaint` SET status='OPEN', com_ctrl='".$cnum2."',datereceived='".$datetoday."' WHERE reqnum='".$_GET['cnum']."' ";
	$updd = $conn->query($del1);

	$delw = "DELETE FROM `tbl_request` WHERE cnum='".$_GET['cnum']."' ";
	$updd = $conn->query($delw);

	$upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'complaint' ";
   $updd = $conn->query($upd_incre);

	header("Location:create_report.php?cnum={$cnum2}");
}elseif($_GET['type'] =="submitt"){

$up = "UPDATE `tbl_complaint` SET captain='wait' where com_ctrl='".$_GET['cnum']."' ";
$upp = $conn->query($up);

header("Location:complain_file.php");
}

elseif($_GET['type'] =="caseclose"){

$up = "UPDATE `tbl_complaint` SET `status`='CLOSED',captain='okay',`date_closed`='".$datetoday."' where com_ctrl='".$_GET['cnum']."' ";
$upp = $conn->query($up);

header("Location:complain_file.php");
}

elseif($_GET['type'] =="pbrgy"){

$up = "UPDATE `tbl_brgyclearance` SET `status`='OLD',captain='okay' where ctrl_num='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='brgyclearance'  ";
$upp2 = $conn->query($del);


header("Location:clearance_file.php");
}
elseif($_GET['type'] =="ppermit"){

$up = "UPDATE `tbl_permit` SET `status`='OLD',captain='okay' where permit_num='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='permit'  ";
$upp2 = $conn->query($del);

header("Location:permit_file.php");
}
elseif($_GET['type'] =="presi"){

$up = "UPDATE `tbl_residency` SET `status`='OLD',captain='okay' where res_ctrl='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='residency'  ";
$upp2 = $conn->query($del);

header("Location:residency_file.php");
}

elseif($_GET['type'] =="psolo"){

$up = "UPDATE `tbl_soloparent` SET `status`='OLD', captain='okay' where reqnum='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='soloparent'  ";
$upp2 = $conn->query($del);

header("Location:soloparentfile.php");
}
elseif($_GET['type'] =="psolo"){

$up = "UPDATE `tbl_soloparent` SET `status`='OLD', captain='okay' where reqnum='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='soloparent'  ";
$upp2 = $conn->query($del);

header("Location:soloparentfile.php");
}
elseif($_GET['type'] =="pindi"){

$up = "UPDATE `tbl_indigency` SET `status`='OLD', captain='okay' where reqnum='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='indigency'  ";
$upp2 = $conn->query($del);

header("Location:indigencyfile.php");
}
elseif($_GET['type'] =="plow"){

$up = "UPDATE `tbl_lowincome` SET `status`='OLD', captain='okay' where reqnum='".$_GET['cnum']."' ";
$upp = $conn->query($up);

$del ="DELETE FROM `tbl_request` WHERE `cnum` = '".$_GET['cnum2']."' and type='lowincome'  ";
$upp2 = $conn->query($del);

header("Location:lowincomefile.php");
}

?>