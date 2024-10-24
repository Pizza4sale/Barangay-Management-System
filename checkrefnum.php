<?php
# create database connection
include'conn.php';
if(!empty($_POST["ref"])) {
  $query = "SELECT * FROM tbl_payments WHERE refnum='".$_POST["ref"]."'";
  $result = mysqli_query($conn,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='color:red'> Reference Number Already Exist.</span>";
    echo "<script>$('#subm').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:red'></span>";
  }
}
?>