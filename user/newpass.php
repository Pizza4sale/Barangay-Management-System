<!DOCTYPE html>
<?php include 'conn.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Milawid Services</title>
      <link rel="icon" type="image/png" sizes="16x16" href="images/milawid_logo.png" />

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts-login/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css-login/style.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container" style="margin-top: -130px; height:10px">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images-login/password.png" style="width:350%" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form" style="width:70%">
                        <h2 class="form-title">Change Password</h2>

      <?php
    
      if($_GET['submitype']=="Yes"){ 

        $s = "SELECT * from tbl_user where user_id='".$_GET['userid']."' and answer1 ='".$_GET['answer1']."' and answer2 ='".$_GET['answer2']."' and position ='USER'  ";
        $result = mysqli_query($conn,$s);
        $count = mysqli_num_rows($result);

        if($count!= 0)
        { 
        ?>
                        <form method="post" >
                           <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock">&nbsp <a onclick="myFunction()"  class="badge btn-danger" style="float:right"><i class="zmdi zmdi-eye"></i></a></i></label>
                                <input type="password" name="pass" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  placeholder="Enter password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  autocomplete="off" />
                            </div>
                              <p id="demo"></p>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline">&nbsp <a onclick="myFunction2()"  class="badge btn-danger" style="float:right"><i class="zmdi zmdi-eye"></i></a></i></label>
                                <input type="password" name="re_pass"id="pass2" onkeyup="Validate()" autocomplete="off" placeholder="Repeat your password"/>
                            </div>
                            <input name="name" value="<?php echo $_GET['name']; ?>" type="hidden">
                            <input name="userid" value="<?php echo $_GET['userid']; ?>" type="hidden">
                            <div class="form-group form-button">
                         
                              <input type="submit" name="update" id="signin" class="form-submit" value="Update password"/> 
                              <input type="submit" name="back" id="signin" class="form-submit" value="Back To Login"/> 
                                
                            </div>
                        </form>

        <?php }else{ ?>
            <div class="form-group">
                <p> Ooops! It seems like you're not the owner of this account. Please <a href="forgotpass.php">try again. </a> </p>
            </div>
             <script>
                  alert ("Checking your credibility. Please wait");
            </script>
            <?php
        } }else{
          header("location:forgotpass.php");
        } 
        if(isset($_POST['back'])){
            header("location:index.php");
        }
        if(isset($_POST['update'])){
            if($_POST['re_pass'] != $_POST['pass'] ){ ?>
              <script>
                  alert ("password don't match! ");
            </script>
         <?php }else{

              $sql1 = "SELECT * FROM `tbl_user` WHERE user_id='".$_POST['userid']."'";
              $processQuery1 = $conn->query($sql1);
              while ($resultQuery = $processQuery1->fetch_assoc())
              { $pass= $resultQuery['password'];}
          if($pass == $_POST['re_pass'] ){ ?>
               <script>
                  alert (" Old password cannot be the new password! ");
            </script>
        <?php    }else{
            $update="UPDATE `tbl_user` SET `password`='".md5($_POST['re_pass'])."' WHERE user_id='".$_POST['userid']."' ";
            mysqli_query($conn,$update);
            ?>
              <script>
                  alert ("Successfully updated your password.");
                  window.location.replace("index.php");
            </script>
    <?php
       }  } }

        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("psw").value;
        var confirmPassword = document.getElementById("pass2").value;
        if (password != confirmPassword) {
           document.getElementById("demo").innerHTML = "<p style='color:red;font-size:10px'><strong>Password don't match!</strong></p>"
        }else{
             document.getElementById("demo").innerHTML = "<p style='color:lightgreen;font-size:10px'><strong>Password match!</strong></p>"
        }
    }
</script>

    <script>
function myFunction() {
  var x = document.getElementById("psw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction2() {
  var x = document.getElementById("pass2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

    <!-- JS -->
    <script src="vendor-login/jquery/jquery.min.js"></script>
    <script src="js-login/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>