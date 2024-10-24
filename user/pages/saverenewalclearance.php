<?php include 'conn.php';
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

  if($req_num >=10){  $nn = 3; }else{ $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
  $new=date('Y')."RQTBC-".$n;


  $new1="Requirements__".$new;
  $filename1 = $_FILES['attached2']['name'];


if($filename1 !=""){

   // name of the uploaded file
    $filename = $new1."__".$_FILES['attached2']['name'];
    // destination of the file on the server

  $upd1 = "UPDATE `tbl_brgyclearance` SET fileupload='".$filename."' WHERE ctrl_num='".$_POST['cnum']."' ";
  $insnew=$conn->query($upd1);

    $destination = 'file/' . $filename;
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
                  $filenamee = $filename;
        } 
      }
    }else{
      $filenamee = "N/A";
    }


  $upd1 = "UPDATE `tbl_brgyclearance` SET `fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."',`address`='".$_POST['address']."',`bday`='".$_POST['bdate']."',`age`='".$_POST['age']."',`gender`='".$_POST['gender']."',`civil`='".$_POST['civil']."',`length`='".$_POST['length']."',`company`='".$_POST['company']."',`purpose`='".$_POST['purpose']."',`voter`='".$_POST['voter']."',status='NEW', reqnum='".$new."',photoupload='N/A' WHERE ctrl_num='".$_POST['cnum']."' ";
  $conn->query($upd1);

 $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));

   $sa = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate,fromuser,oldcnum,datedeleted) VALUES('brgyclearance','".$new."','".$formated_DATETIME."','Active','RENEW','".$expire."','".$uname."','".$_POST['cnum']."','')";
      $conn->query($sa);

 $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'request' ";
       $updd = $conn->query($upd_incre);

//  header("Location:service_number_clearance.php?id={$new}"); 

//  require_once __DIR__ . '/payment/adyen.php';
  
//   $full_name = implode(' ',
//     [
//       $_POST['fname'] ?? '',
//       $_POST['lname'] ?? '',
//     ]
//   );  

  // $result = adyen($full_name, 'reclearance', '/user/pages/service_number_clearance.php', $new);

  // header('Location: ' . $result['action']['url']);

  header('Location: service_number_clearance.php?cnum=' . $new);

?>