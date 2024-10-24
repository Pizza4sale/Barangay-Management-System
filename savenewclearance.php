<?php 

include 'conn.php';
$sql1 = "SELECT num FROM tbl_increments WHERE type= 'brgyclearance' ";
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

  $new="2022BC-".$n;
  // name of the uploaded file
    $filename = $new."-".$_FILES['attached2']['name'];
    // destination of the file on the server
    $destination = 'admin/index/file/'.$filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['attached2']['tmp_name'];
    $size = $_FILES['attached2']['size'];

     if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
      ?>
        <script>
           alert("You file extension must be .jpg for image and .pdf for file");
           window.location.replace("clearance-app.php");
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
                echo "File uploaded successfully";

    date_default_timezone_set('Asia/Manila');
    $datetoday = date('Y-m-d H:i:s');

   $qryd = "INSERT INTO `tbl_brgyclearance`(`fname`, `mname`, `lname`, `address`, `pbirth`, `bday`, `age`, `gender`, `civil`, `length`, `company`, `purpose`, `voter`, `status`,ctrl_num,fileupload) VALUES ('".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['address']."','".$_POST['pbirth']."','".$_POST['bdate']."','".$_POST['age']."','".$_POST['gender']."','".$_POST['civil']."','".$_POST['length']."','".$_POST['company']."','".$_POST['purpose']."','".$_POST['voter']."','NEW','".$new."','".$filename."')";
  $insnew=$conn->query($qryd);

  if($insnew){
        date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

    $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
   $sa = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate) VALUES('brgyclearance','".$new."','".$formated_DATETIME."','Active','NEW','".$expire."')";
      $conn->query($sa);
  }
  
       header("Location:clearancepermit.php?id={$new}"); 

     }
       $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'brgyclearance' ";
       $updd = $conn->query($upd_incre);
  }


?>