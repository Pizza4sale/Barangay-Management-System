<?php 


include 'include/conn.php';
date_default_timezone_set('Asia/Manila');
$curdate = date('Y-m-d H:i:s');
$formated_DATETIME = date('Y-m-d H:i:s');


// START OF BARANGAY CLEARANCE - NEW APPLICATION
 if($_POST['from'] == "clearance"){

if($_POST['oldcnum'] =="A"){
   $sql1 = "SELECT *  FROM tbl_brgyclearance WHERE ctrl_num='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}


$new="PaymentRef_".$_POST['idnum'];
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
            window.location.href = "notif.php";
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
      
        } 
      }
    }else{
      $filename="Cash";
    }

   $sqlz = "SELECT *  FROM tbl_payments WHERE cnum='".$_POST['cnum']."'  ";
   $processQueryz = $conn->query($sqlz);
   while ($resultQuerz = $processQueryz->fetch_assoc())
          { $n=$resultQuerz['cnum']; }
if($n == $_POST['cnum']){

  $updd = "UPDATE `tbl_payments` SET payment_type='".$_POST['type']."', amount='".$_POST['amount']."',refnum='".$_POST['refnum']."',photoupload='".$filename."',datepaid= '".$_POST['datepaid']."', dateprocessed = CURDATE() where cnum='".$_POST['cnum']."' ";
 $insnews=$conn->query($updd);

   $upd2="UPDATE `tbl_brgyclearance` SET photoupload ='".$filename."' where reqnum='".$_POST['cnum']."' ";
  $upnew=$conn->query($upd2);

}else{
  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,photoupload) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW','".$filename."') ";
  $insnew=$conn->query($upd);

     $upd="UPDATE `tbl_brgyclearance` SET photoupload ='".$filename."' where reqnum='".$_POST['idnum']."' ";
  $upnew=$conn->query($upd);
}

 header("Location:clearance2.php?cnum={$_POST['cnum']}&from=clearance&newcnum={$_POST['cnum']}"); 
}
}elseif($_POST['from'] == "reclearance"){

// END OF BARANGAY CLEARANCE RENEWAL APPLICATION

$sql1 = "SELECT *  FROM tbl_increments WHERE type= 'brgyclearance' ";
$processQuery1 = $conn->query($sql1);
 while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

  $req_num=$num+1; 
  if($req_num >=10){  $nn = 3;   }else{  $nn=3; }

  $n = str_pad($req_num,$nn, '0', STR_PAD_LEFT);
  $cnum1 = $_POST['cnum'];
  $cnum2 ="2022BC-".$n;

  $sql22 = "SELECT *  FROM tbl_brgyclearance WHERE ctrl_num='".$cnum1."'  ";
          $processQuery22 = $conn->query($sql22);
          while ($resultQuery2 = $processQuery22->fetch_assoc())
          { $n= $resultQuery2['lname'].", ".$resultQuery2['fname']; $name22 = strtoupper($n);}

$new="PaymentRef_".$cnum2;
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
           window.location.href = "notif.php";
        </script>
    <?php  
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
          
          $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,oldcnum,photoupload) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$cnum2."','".$name22."','RENEWAL','".$_POST['cnum']."','".$filename."') ";
          $insnew=$conn->query($upd);

          $sqlw = "INSERT INTO `tbl_renewal`(`type`, `oldctrl`, `newctrl`, `purpose`, `upload`, `status`,datereleased) VALUES ('brgyclearance','".$cnum1."','".$cnum2."','-','-','RELEASED','".$formated_DATETIME."')";
          $processQueryw = $conn->query($sqlw);

          $upd2 = "UPDATE `tbl_brgyclearance` SET ctrl_num ='".$cnum2."' WHERE ctrl_num='".$cnum1."' ";
          $insnew1=$conn->query($upd2);
          
           header("Location:oldclearance.php?cnum={$cnum2}&from=clearance&newcnum={$cnum2}&fromwhere=homefilec"); 
        } 
      }
    }else{
        
         $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status,oldcnum,photoupload) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$cnum2."','".$name22."','RENEWAL','".$_POST['cnum']."','-') ";
          $insnew=$conn->query($upd);

          $sqlw = "INSERT INTO `tbl_renewal`(`type`, `oldctrl`, `newctrl`, `purpose`, `upload`, `status`,datereleased) VALUES ('brgyclearance','".$cnum1."','".$cnum2."','-','-','RELEASED','".$formated_DATETIME."')";
          $processQueryw = $conn->query($sqlw);

          $upd2 = "UPDATE `tbl_brgyclearance` SET ctrl_num ='".$cnum2."' WHERE ctrl_num='".$cnum1."' ";
          $insnew1=$conn->query($upd2);


           header("Location:oldclearance.php?cnum={$cnum2}&from=clearance&newcnum={$cnum2}&fromwhere=homefilec"); 
    }

 
}


// END OF BARANGAY CLEARANCE


//generation of clearance paper 
elseif($_POST['from'] == "rclearance"){

   $sql1 = "SELECT *  FROM tbl_brgyclearance WHERE ctrl_num='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);

   $upd="UPDATE `tbl_brgyclearance` SET captain ='wait' where ctrl_num='".$_POST['cnum']."' ";
   $upnew=$conn->query($upd);
 
    header("Location:select_transaction.php?id={$_POST['idniya']}"); 

//payment process
}elseif($_POST['from'] == "permit"){

 $sql1 = "SELECT * FROM tbl_permit WHERE permit_num='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

$s = "SELECT * from tbl_payments where cnum ='".$_POST['cnum']."' and name='".$name."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET  payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
  header("Location:permit2.php?cnum={$_POST['cnum']}&from=permit"); 
    
}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
   header("Location:permit2.php?cnum={$_POST['cnum']}&from=permit"); 

 }
}
// genearatiion process of business permit paper
 elseif($_POST['from'] == "re_permit"){

 $sql1 = "SELECT * FROM tbl_permit WHERE permit_num='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n=$resultQuery['lname'].", ".$resultQuery['fname']; $name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
    ?>
<input type="text" value="<?php echo $_POST['cnum'];?>" id="cnum3" >
<script>
         window.open("pdf/generatepermit.php?id="+ document.getElementById('cnum3').value,'_blank');
        window.location.href = "permit_file.php";
</script>
  <?php


// payment process 
 }elseif($_POST['from'] == "residency"){

   $sql1 = "SELECT *  FROM tbl_residency WHERE res_ctrl='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['res_lname'].", ".$resultQuery['res_name'];$name = strtoupper($n);}

$s = "SELECT * from tbl_payments where cnum ='".$_POST['cnum']."' and name='".$name."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET  payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
 header("Location:residence2.php?cnum={$_POST['cnum']}&from=residency"); 
    
}else{

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);

 header("Location:residence2.php?cnum={$_POST['cnum']}&from=residency"); 
}
}

// For releasing or generation of residency paper
elseif($_POST['from'] == "residencyb"){

   $sql1 = "SELECT *  FROM tbl_residency WHERE res_ctrl='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['res_lname'].", ".$resultQuery['res_name'];$name = strtoupper($n);}

  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);

 ?>
<input type="text" value="<?php echo $_POST['cnum'];?>" id="cnum4" >
<script>
         window.open("pdf/generateresidence.php?id="+ document.getElementById('cnum4').value,'_blank');
        window.location.href = "residency_file.php";
</script>
  <?php

}


// Payment for solo parent

elseif($_POST['from'] == "soloparent"){

   $sql1 = "SELECT *  FROM tbl_soloparent WHERE reqnum='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['lname'].", ".$resultQuery['fname'];$name = strtoupper($n);}

$s = "SELECT * from tbl_payments where cnum ='".$_POST['cnum']."' and name='".$name."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET  payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
    header("Location:soloparent_edit.php?cnum={$_POST['cnum']}&from=soloparent"); 

}else{
  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
?>
      <input type="text" value="<?php echo $_POST['cnum'];?>" id="cnum" >
      <script>
            window.open("pdf/generatesoloparent.php?id="+ document.getElementById('cnum').value,'_blank');
              window.location.href = "soloparentfile.php";
      </script>
  <?php
}
}


// Payment for indigency
elseif($_POST['from'] == "indigency"){

   $sql1 = "SELECT *  FROM tbl_indigency WHERE reqnum='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['lname'].", ".$resultQuery['fname'];$name = strtoupper($n);}

$s = "SELECT * from tbl_payments where cnum ='".$_POST['cnum']."' and name='".$name."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
    header("Location:indigency_edit.php?cnum={$_POST['cnum']}&from=indigency"); 

}else{
  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);
?>
      <input type="text" value="<?php echo $_POST['cnum'];?>" id="cnum" >
      <script>
            window.open("pdf/generateindigency.php?id="+ document.getElementById('cnum').value,'_blank');
            window.location.href = "indigencyfile.php";
      </script>
  <?php
}
}


// Payment for lowincocme
elseif($_POST['from'] == "lowincome"){

   $sql1 = "SELECT *  FROM tbl_lowincome WHERE reqnum='".$_POST['cnum']."'  ";
          $processQuery1 = $conn->query($sql1);
          while ($resultQuery = $processQuery1->fetch_assoc())
          { $n = $resultQuery['lname'].", ".$resultQuery['fname'];$name = strtoupper($n);}

$s = "SELECT * from tbl_payments where cnum ='".$_POST['cnum']."' and name='".$name."' ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  $update ="UPDATE `tbl_payments` SET payment_type ='".$_POST['type']."',amount='".$_POST['amount']."' , refnum='".$_POST['refnum']."',datepaid='".$_POST['datepaid']."' ,dateprocessed = '".$curdate."' WHERE cnum='".$_POST['cnum']."' ";
   $insnew2=$conn->query($update);
    header("Location:lowincome_edit.php?cnum={$_POST['cnum']}&from=lowincocme"); 

}else{
  $upd = "INSERT INTO `tbl_payments`( `typee`, `payment_type`, `amount`, `refnum`, `datepaid`, `dateprocessed`,cnum,name,status) VALUES ('".$_POST['purpose']."','".$_POST['type']."','".$_POST['amount']."' ,'".$_POST['refnum']."', '".$_POST['datepaid']."',CURDATE(),'".$_POST['cnum']."','".$name."','NEW') ";
  $insnew=$conn->query($upd);

?>
      <input type="text" value="<?php echo $_POST['cnum'];?>" id="cnum" >
      <script>
            window.open("pdf/generatelowincome.php?id="+ document.getElementById('cnum').value,'_blank');
              window.location.href = "lowincomefile.php";
      </script>
  <?php
  
}
}

?>