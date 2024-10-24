<?php
//15 2 2015
session_start();
date_default_timezone_set('Asia/Manila');
$currentdate = date('Y-m-d H:i:s');
include 'conn.php';

$uname = $_REQUEST["emailu"];
$password = stripslashes($_REQUEST['pass']);
$password = mysqli_real_escape_string($conn, $password);

//$password = $_REQUEST["pass"];

$getqry = "SELECT * FROM tbl_user WHERE username = '" . $uname . "' AND password = '" . md5($password) . "' ";
$getres = $conn->query($getqry);
$resultQuery = $getres->fetch_assoc();

$s = "SELECT * from tbl_user where username='" . $uname . "' and password='" . md5($password) . "'  ";
$result = mysqli_query($conn, $s);
$count = mysqli_num_rows($result);

if ($count != 0) {
  $position = $resultQuery['position'];
  $emp_name = $resultQuery['name'];
  $username = $resultQuery['username'];
  $user_id = $resultQuery['user_id'];

  if ($position == 'USER') {
    echo $_SESSION["uname01_2"] = $resultQuery['username'];
    echo $_SESSION["empname_2"] = $resultQuery['name'];
    echo $_SESSION["user_id_2"] = $resultQuery['user_id'];
    echo $_SESSION["userpos_2"] = $resultQuery['position'];

    header("location:user/pages/index.php");
  } elseif ($position == 'ADMIN02') {
    $_SESSION["uname01"] = $resultQuery['username'];
    $_SESSION["empname"] = $resultQuery['name'];

    $_SESSION["user_id"] = $resultQuery['user_id'];
    $_SESSION["userpos"] = $resultQuery['position'];

    header("location:admin/index/dashboard02.php");
  } elseif ($position === 'TREASURER') {
    $_SESSION["uname01"] = $resultQuery['username'];
    $_SESSION["empname"] = $resultQuery['name'];

    $_SESSION["user_id"] = $resultQuery['user_id'];
    $_SESSION["userpos"] = $resultQuery['position'];

    header("location:admin/index/dashboard-treasurer.php");
  } else {
    $_SESSION["uname01"] = $resultQuery['username'];
    $_SESSION["empname"] = $resultQuery['name'];

    $_SESSION["user_id"] = $resultQuery['user_id'];
    $_SESSION["userpos"] = $resultQuery['position'];

    header("location:admin/index/dashboard.php");
  }
} else {
?>
<script>
  alert("Login Failed!");
  window.location.replace('user/pages/index.php');
</script> 
<?php
}

?>
