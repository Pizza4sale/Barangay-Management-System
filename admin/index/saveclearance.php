<?php 

include 'include/conn.php';
date_default_timezone_set('Asia/Manila');
$formated_DATETIME = date('Y-m-d H:i:s');

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

  $new= date("Y")."ADMINBC-".$n;
  // name of the uploaded file
  $filename1 =$_FILES['attached2']['name'];

if($filename1!=""){

    $filename = $new."-".$_FILES['attached2']['name'];
    // destination of the file on the server
    $destination = 'file/'.$filename;
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
            }
        }
    }

    $datetoday = date('Y-m-d H:i:s');
    $datetoday1 = date('Y-m-d');
    $dateyear1 = date('Y');
   $aa =  date("Y-m-d", strtotime($_POST['pbirth']));

   if($datetoday1 >=  $aa){
    $aa =  date("Y", strtotime($_POST['pbirth']));

    echo $dd = $dateyear1 - $aa;
   }


  $qryd = "INSERT INTO `tbl_brgyclearance`(`fname`, `mname`, `lname`, `address`, `pbirth`, `bday`, `age`, `gender`, `civil`, `length`, `company`, `purpose`, `voter`, `status`,ctrl_num,fileupload,fromuser,datetimereq) VALUES ('".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['address']."','".$_POST['pbirth']."','".$_POST['bdate']."','".$age."','".$_POST['gender']."','".$_POST['civil']."','".$_POST['length']."','".$_POST['company']."','".$_POST['purpose']."','".$_POST['voter']."','NEW','".$new."','".$filename."','admin','".$formated_DATETIME."')";
  $insnew=$conn->query($qryd);

  if($insnew){
        header("Location:payment_ref.php?cnum={$new}&from=rclearance&oldcnum=-&idniya={$_POST['idniya']}"); 
         $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type= 'brgyclearance' ";
       $updd = $conn->query($upd_incre);    
  }

?>