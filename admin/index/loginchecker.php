<?php
	//15 2 2015
session_start();
include 'include/conn.php';
$uname = $_REQUEST["uname"];
//$password = md5(trim($_REQUEST["pass"]));
$password = trim($_REQUEST["pass"]);
$getqry = "SELECT * FROM tbl_user WHERE username = '".$uname."' AND password = '".$password."'  and position !='USER'";
$getres = $conn->query($getqry);
$resultQuery = $getres->fetch_assoc();

$s = "SELECT * from tbl_user where username='".$uname."' and password='".$password."' and position !='USER'   ";
$result = mysqli_query($conn,$s);
$count = mysqli_num_rows($result);

if($count!= 0)
{
  
  $position = $resultQuery['position'];
  $emp_name = $resultQuery['name'];
  $username = $resultQuery['username'];
  $user_id = $resultQuery['user_id'];

    $_SESSION["uname01"] =$resultQuery['username'];
    $_SESSION["empname"]= $resultQuery['name'];

    $_SESSION["user_id"] = $resultQuery['user_id'];
    $_SESSION["userpos"] = $resultQuery['position'];
    header("location:dashboard.php"); 

}
else
{
 ?>
 <script>
  alert("Login Failed!");
  window.location.replace('index.php');
</script> 
<?php

}

?>