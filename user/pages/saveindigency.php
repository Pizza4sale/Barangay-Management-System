
<?php 
include 'conn.php';
session_start();
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];

if(isset($_POST['finish'])){

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
$new=date('Y')."RQTIY-".$n;

  $datetoday = date('Y-m-d H:i:s');
  $datetoday1 = date('m-d');
  $dateyear1 = date('Y');
  
   $aa =  date("m-d", strtotime($_POST['bday']));

   if($datetoday1 >=  $aa){
    $aa1 =  date("Y", strtotime($_POST['bday']));

    $age = $dateyear1 - $aa1;
   }else{
      $aa1 =  date("Y", strtotime($_POST['bday']));

    $age = ($dateyear1 - $aa1)- 1;
   }

if($_FILES['attached']!=""){

   $filename = $new."-".$_FILES['attached']['name'];

    // destination of the file on the server
    $destination = 'file/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['attached']['tmp_name'];
    $size = $_FILES['attached']['size'];

     if (!in_array($extension, ['pdf','PDF','JPG','JPEG','PNG','jpg','jpeg','png'])) {
      ?>
        <script>
           alert("You file extension must be 'pdf','PDF','JPG','JPEG','PNG','jpg','jpeg','png' for file");
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
              $filename1 = $filename;
        }
   }
 }else{
  $filename1="";
 }


$address = $_POST['street']." Barangay Milawid, Panukulan, Quezon";

   $qry = "INSERT INTO `tbl_indigency`(`reqnum`, `fname`, `mname`, `lname`, `age`, `marital`, `address`, `status`, `pay_status`, `datetimereq`, `fromuser`,phonenumber,bday,uploadreq,photoupload,datereleased,captain, old_ctrl, date_rel) VALUES ('".$new."' ,'".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$age."','".$_POST['civil']."','".$address."','0','NEW','".$formated_DATETIME."', '".$uname."','".$_POST['number']."','".$_POST['bday']."','".$filename1."', 'N/A','', '','', '')";
   $updd = $conn->query($qry);
         
   $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
   $sa = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate,fromuser,oldcnum,datedeleted) VALUES('indigency','".$new."','".$formated_DATETIME."','Active','PENDING','".$expire."','".$uname."','','')";
      $conn->query($sa);

   $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'request' ";
   $updd = $conn->query($upd_incre);
   // header("Location:service_number_indigency.php?idres={$new}");

}

require_once __DIR__ . '/payment/adyen.php';

  $full_name = implode(' ',
    [
      $_POST['fname'] ?? '',
      $_POST['lname'] ?? '',
    ]
  );

  $cnum = $new;

  $result = adyen($full_name, 'indigency', '/user/pages/service_number_indigency.php', $new);

  header('Location: ' . $result['action']['url']);
    ?>


