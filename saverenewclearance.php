
<?php 
include 'conn.php';

if(isset($_POST['new11'])){

  $check= "SELECT ctrl_num FROM `tbl_brgyclearance` WHERE ctrl_num='".$_POST['ctrlnum']."' ";
  $check1 = $conn->query($check);
   $count312 = mysqli_num_rows($check1);
if($count312 !=0){ 

  $sql1 = "SELECT num FROM tbl_increments WHERE type= 'brgyclearance' ";
  $processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1;

  if($req_num >=10){ $nn = 3; }else{ $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
  $new="2022BC-".$n;
  // name of the uploaded file
    $filename1 = $new."-".$_FILES['renewfile']['name'];

    // destination of the file on the server
    $destination1 = 'admin/index/file/' . $filename1;

    // get the file extension
    $extension1 = pathinfo($filename1, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file1 = $_FILES['renewfile']['tmp_name'];
    $size1 = $_FILES['renewfile']['size'];



      if (!in_array($extension1, ['zip', 'pdf', 'docx'])) {
      ?>
        <script>
           alert("You file extension must be .jpg for image and .pdf for file");
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file1, $destination1)) { ?>
        <script>
           alert("Successfully validated. Please Proceed to the barangay for the validation of requirements.");
        </script>
 <?php 


  $sql1 = "INSERT INTO `tbl_renewal`(`type`, `oldctrl`, `newctrl`, `purpose`, `upload`, `status`) VALUES ('brgyclearance','".$_POST['ctrlnum']."','".$new."','".$_POST['purpose1']."','".$filename1."','NEW')";
  $processQuery1 = $conn->query($sql1);

  date_default_timezone_set('Asia/Manila');
    $formated_DATETIME = date('Y-m-d H:i:s');

    $expire=date('Y-m-d H:i:s', strtotime($formated_DATETIME. '+2 days'));
   $sa = "INSERT INTO `tbl_request`(`type`, `cnum`, `datesent`, `status`,request_type,expiredate,oldcnum) VALUES('brgyclearance','".$new."','".$formated_DATETIME."','Active','RENEW','".$expire."','".$_POST['ctrlnum']."')";
   $conn->query($sa);

  $sql11 = "UPDATE `tbl_increments` SET `num`='".$req_num."' WHERE type='brgyclearance' ";
  $processQuery11 = $conn->query($sql11);

     header("Location:clearancepermit.php?id={$new}");   
}
}
}else{ ?>
    <script>
           alert("The entered control number is not existing. Please Try Again");
              window.location.replace("clearance-app.php");
        </script>
<?php }
}
?>

