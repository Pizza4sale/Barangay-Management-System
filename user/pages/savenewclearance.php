<?php 

include 'conn.php';
session_start();
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];

date_default_timezone_set('Asia/Manila');
$formated_DATETIME = date('Y-m-d H:i:s');


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

  $datetoday = date('Y-m-d H:i:s');
  $datetoday1 = date('m-d');
  $dateyear1 = date('Y');
  
   $aa =  date("m-d", strtotime($_POST['bdate']));

   if($datetoday1 >=  $aa){
    $aa1 =  date("Y", strtotime($_POST['bdate']));

    $age = $dateyear1 - $aa1;
   }else{
      $aa1 =  date("Y", strtotime($_POST['bdate']));

    $age = ($dateyear1 - $aa1)- 1;
   }

  $new=date('Y')."RQTBC-".$n;

  if($_FILES['attached2'] !=""){

  // name of the uploaded file
    $filename = $new."-".$_FILES['attached2']['name'];
    // destination of the file on the server
    $destination = 'file/'.$filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['attached2']['tmp_name'];
    $size = $_FILES['attached2']['size'];

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
    date_default_timezone_set('Asia/Manila');
    $datetoday = date('Y-m-d H:i:s');

    $pbirth = '';

    if (isset($_POST['pbirth'])) {
      $pbirth = $_POST['pbirth'];
    }

   $qryd = "INSERT INTO `tbl_brgyclearance`(`fname`, `mname`, `lname`, `address`, `pbirth`, `bday`, `age`, `gender`, `civil`, `length`, `company`, `purpose`, `voter`, `status`,reqnum,ctrl_num,fileupload,photoupload,fromuser,datetimereq,datereleased, captain,date_rel) VALUES ('".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['address']."','". $pbirth ."','".$_POST['bdate']."','".$age."','".$_POST['gender']."','".$_POST['civil']."','".$_POST['length']."','".$_POST['company']."','".$_POST['purpose']."','".$_POST['voter']."','NEW','".$new."','N/A','".$filename1."','N/A','".$uname."','".$formated_DATETIME."', '', '', '')";
  $insnew=$conn->query($qryd);

  $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
  $sa = "INSERT INTO `tbl_request`(`type`,`oldcnum`, `cnum`, `datesent`, `status`,request_type,expiredate,fromuser,datedeleted) VALUES('brgyclearance','','".$new."','".$formated_DATETIME."','Active','PENDING','".$expire."','".$uname."', '')";
  $conn->query($sa);

  $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'request' ";
  $updd = $conn->query($upd_incre);
    // header("Location:service_number_clearance.php?id={$new}"); 
  
   
  // require_once __DIR__ . '/payment/adyen.php';
  
  // $full_name = implode(' ',
  //   [
  //     $_POST['fname'] ?? '',
  //     $_POST['lname'] ?? '',
  //   ]
  // );  

  // $result = adyen($full_name, 'clearance', '/user/pages/service_number_clearance.php', $new);

  // header('Location: ' . $result['action']['url']);

  header('Location: service_number_clearance.php?cnum=' . $new);
?>