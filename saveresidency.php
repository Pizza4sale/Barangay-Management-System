
<?php 
include 'conn.php';

if(isset($_POST['finish'])){


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

  $new="2022RQTRP-".$n;
  // name of the uploaded file
    $filename = $new."-".$_FILES['attached']['name'];

    // destination of the file on the server
    $destination = 'file/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['attached']['tmp_name'];
    $size = $_FILES['attached']['size'];

    if (!in_array($extension, ['pdf'])) {
      ?>
        <script>
           alert("You file extension must be .jpg for image and .pdf for file");
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
      
      if($_POST['voter'] =="yes"){
        $vo = "Registered Voter";
      }else{
        $vo = "Not Registered Voter";
      }
   $qry = "INSERT INTO `tbl_residency`(`res_name`, `res_mname`, `res_lname`, `res_email`, `res_number`, `res_purok`, `res_bgy`, `reqfile`,res_ctrl,civil,voter,status) VALUES ('".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['email']."','".$_POST['pnum']."','".$_POST['street']."','".$_POST['brgy']."','".$filename."','".$new."','".$_POST['civil']."','".$vo."','NEW')";
     $updd = $conn->query($qry);
        } 
    date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

    $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
   $sa = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate) VALUES('residency','".$new."','".$formated_DATETIME."','Active','NEW','".$expire."')";
      $conn->query($sa);

       $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'residency' ";
       $updd = $conn->query($upd_incre);
   header("Location:service_number_residence.php?idres={$new}");
      }

  }
    ?>


