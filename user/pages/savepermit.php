
<?php 
include 'conn.php';
session_start();
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];

if(isset($_POST['permitsave'])){

  $sql1 = "SELECT num FROM tbl_increments WHERE type= 'request' ";
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

  $new=date('Y')."RQTPR-".$n;

if($_POST['owner'] =="Others"){
	$typee = $_POST['others'];
}else{
	$typee = $_POST['owner'];
}

  date_default_timezone_set('Asia/Manila');
  $formated_DATETIME = date('Y-m-d H:i:s');

  if($_FILES['filereq'] !=""){

  // name of the uploaded file
    $filename = $new."-".$_FILES['filereq']['name'];
    // destination of the file on the server
    $destination = 'file/'.$filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['filereq']['tmp_name'];
    $size = $_FILES['filereq']['size'];

      if (!in_array($extension, ['pdf','PDF','JPG','JPEG','PNG','jpg','jpeg','png'])) {
      ?>
        <script>
           alert("You file extension must be 'pdf','PDF','JPG','JPEG','PNG','jpg','jpeg','png' for file");
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
                echo "File uploaded successfully";
                $filename1 = $filename ;
     }
   }
 }else{
   $filename1 ="";
 }


  $qry = "INSERT INTO `tbl_permit`(reqnum,`permit_num`, `fname`, `mname`, `lname`,`tin_no`, `phone_num`, `tel_num`, `corponame`, `business_name`, `bus_tin`, `bus_address`, `ownership`, `capital_breakdown`,status,fromuser,photoupload,datetimereq,uploadreq, datereleased, captain,date_rel)VALUES('".$new."','-','".$_POST['name']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['tinn']."','".$_POST['phone']."','".$_POST['telnum']."','".$_POST['corponame']."','".$_POST['busname']."','".$_POST['btin']."','".$_POST['busaddress']."','".$typee."','".$_POST['breakdown']."','NEW','".$uname."','N/A','".$formated_DATETIME."','".$filename1."', '', '','')";

	$updd = $conn->query($qry);

  $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));

  $sa1 = "INSERT INTO `tbl_request`(`type`, `oldcnum`, `cnum`, `datesent`, `status`,request_type,expiredate, fromuser, datedeleted) VALUES('permit', '', '".$new."','".$formated_DATETIME."','Active','PENDING','".$expire."', '', '')";
  $updd1 = $conn->query($sa1);


  $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'request' ";
  $updd = $conn->query($upd_incre);

  

  // header("Location:service_number_permit.php?idper={$new}");
}

  // require_once __DIR__ . '/payment/adyen.php';

  // $full_name = implode(' ',
  //   [
  //     $_POST['name'] ?? '',
  //     $_POST['lname'] ?? '',
  //   ]
  // );

  $cnum = $new;

  // $result = adyen($full_name, 'permit', '/user/pages/service_number_permit.php', $cnum);

  // header('Location: ' . $result['action']['url']);

  header('Location: service_number_permit.php?cnum=' . $cnum);
?>
