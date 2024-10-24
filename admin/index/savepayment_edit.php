<?php 

include 'include/conn.php';
date_default_timezone_set('Asia/Manila');
$curdate = date('Y-m-d H:i:s');



// START OF BARANGAY CLEARANCE - NEW APPLICATION
 if($_POST['from'] == "clearance"){

if($_POST['oldcnum'] =="A"){
   $sql1 = "SELECT *  FROM tbl_brgyclearance WHERE ctrl_num='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$new="PaymentRef_".$_POST['cnum'];
  $filename1 = $_FILES['photo']['name'];

if($filename1 !=""){
   // name of the uploaded file
    $filename = $new."__".$_FILES['photo']['name'];
    // destination of the file on the server
    $destination = '../../user/pages/payment/' . $filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['photo']['tmp_name'];
    $size = $_FILES['photo']['size'];
    
    if (!in_array($extension, ['jpg','png','JPG','jpeg'])) {
      ?>
        <script>
           alert("You file extension must be .jpg for image");
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
                
          $upd2 = "UPDATE `tbl_payments` SET typee ='".$_POST['purpose']."',payment_type='".$_POST['type']."',amount='".$_POST['amount']."',refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."',dateprocessed=CURDATE(), photoupload='".$filename."' WHERE cnum='".$_POST['cnum']."' ";
          $insnew1=$conn->query($upd2);

          $upd="UPDATE `tbl_brgyclearance` SET photoupload ='".$filename."' where ctrl_num='".$_POST['cnum']."' ";
          $upnew=$conn->query($upd);

          $url = $_POST['redirect_url'] ?? '';

          if (empty($url)) {
            $url = "clearance2.php?cnum={$_POST['cnum']}&from=clearance&newcnum={$_POST['cnum']}";
          }
        header("Location: $url"); 
        } 
      }
    }else{

  $upd2 = "UPDATE `tbl_payments` SET typee ='".$_POST['purpose']."',payment_type='".$_POST['type']."',amount='".$_POST['amount']."',refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."',dateprocessed=CURDATE(), photoupload ='-' WHERE cnum='".$_POST['cnum']."' ";
  $insnew1=$conn->query($upd2);

 $url = $_POST['redirect_url'] ?? '';

  if (empty($url)) {
    $url = "clearance2.php?cnum={$_POST['cnum']}&from=clearance&newcnum={$_POST['cnum']}";
  }
 header("Location: $url"); 
    }


}
}


// START OF BUSINESS PERMIT - NEW APPLICATION
elseif($_POST['from'] == "permit"){

 $sql1 = "SELECT * FROM tbl_permit WHERE reqnum ='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$s = "SELECT count(cnum) from tbl_payments where cnum ='".$_POST['cnum']."'";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET  typee ='permit', payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);

}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
 }
   $url = $_POST['redirect_url'] ?? '';

  if (empty($url)) {
    $url = "permit2.php?cnum={$_POST['cnum']}&from=permit";
  }
 header("Location: $url"); 
}


// START OF RESIDENCY - NEW APPLICATION
 elseif($_POST['from'] == "residency"){

   $sql1 = "SELECT *  FROM tbl_residency WHERE res_ctrl='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['res_lname'].", ".$resultQuery['res_name']; $name = strtoupper($n); }

$s = "SELECT count(cnum) from tbl_payments where cnum ='".$_POST['cnum']."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{

  $update ="UPDATE `tbl_payments` SET  typee ='residency', payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."', status='VERIFIED_PAID' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
} 
$url = $_POST['redirect_url'] ?? '';

  if (empty($url)) {
    $url = "residence2.php?cnum={$_POST['cnum']}&from=residency";
  }
 header("Location: $url"); 
}

// START OF SOLO PARENT - NEW APPLICATION
 elseif($_POST['from'] == "soloparent"){

   $sql1 = "SELECT *  FROM tbl_soloparent WHERE reqnum='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$s = "SELECT count(cnum) from tbl_payments where cnum ='".$_POST['cnum']."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count != 0)
{
  $update ="UPDATE `tbl_payments` SET  typee ='soloparent', payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('soloparent','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
}
$url = $_POST['redirect_url'] ?? '';

  if (empty($url)) {
    $url = "soloparent_edit.php?cnum={$_POST['cnum']}&from=soloparent";
  }
 header("Location: $url"); 
}

// START OF INDIGENCY - NEW APPLICATION
 elseif($_POST['from'] == "indigency"){

   $sql1 = "SELECT *  FROM tbl_indigency WHERE reqnum='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$s = "SELECT count(cnum) from tbl_payments where cnum ='".$_POST['cnum']."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET  payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."', status='VERIFIED_PAID' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('soloparent','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
}

  $url = $_POST['redirect_url'] ?? '';

  if (empty($url)) {
    $url = "indigency_edit.php?cnum={$_POST['cnum']}&from=indigency";
  }
 header("Location: $url"); 
}

// START OF LOW INCOME - NEW APPLICATION
 elseif($_POST['from'] == "lowincome"){

   $sql1 = "SELECT *  FROM tbl_lowincome WHERE reqnum='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$s = "SELECT count(cnum) from tbl_payments where cnum ='".$_POST['cnum']."'  ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET  payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('soloparent','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
}
 $url = $_POST['redirect_url'] ?? '';

  if (empty($url)) {
    $url = "lowincome_edit.php?cnum={$_POST['cnum']}&from=lowincome";
  }
 header("Location: $url");  
}
?>