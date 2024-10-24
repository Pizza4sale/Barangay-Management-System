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
        <!-- Sign up form -->
        <section class="signup" >
            <div class="container" style="margin-top: -130px; height:10px;">
                <div class="signup-content">
                    <div class="signup-form"  style="margin-top: -30px; width:100%">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="name" autocomplete='off' placeholder="First Name" required />
                                <input type="text" name="mname" id="name" autocomplete='off' placeholder="Middle Name" />
                                <input type="text" name="lname" id="name" autocomplete='off' placeholder="Last Name" required />

                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" autocomplete='off' placeholder="Email Address" required />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-cake"></i></label>
                                <input type="date" name="bday" placeholder="Birthday" required />
                            </div>

                            <div class="form-group">
                              <label for="pass"><i class="zmdi zmdi-lock"> &nbsp <a onclick="myFunction()"  class="badge btn-danger" style="float:right"><i class="zmdi zmdi-eye"></i></a></i></label>
                                <input type="password" name="pass" id="psw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  placeholder=" Enter password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required autocomplete='off' />  

                            </div>
                             
                            <p id="demo"></p>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"> &nbsp <a onclick="myFunction2()"  class="badge btn-danger" style="float:right"><i class="zmdi zmdi-eye"></i></a></i></label>
                                <input type="password" name="re_pass" id="pass2" onkeyup="Validate()" placeholder=" Repeat your password"  required />
                            </div>
                             <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-shield-security"></i></label>
                                <input type="text" style="font-size: 12px" name="question1" id="pass2" autocomplete='off' placeholder="SECURITY QUESTION # 1" required list='question' />
                                <datalist id="question">
                                    <option>What is the name of your favorite childhood friend?</option>
                                    <option>In what city or town did your mother and father meet?</option>
                                    <option>What is your favorite team?</option>
                                    <option>What was the name of your first stuffed animal?</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                 <label for="re-pass"><i class="zmdi zmdi-text-format"></i></label>
                                 <input type="text" name="answer1" autocomplete='off' placeholder="Enter your Answer"  required />
                            </div>
                             <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-shield-security"></i></label>
                                <input type="text" style="font-size: 12px" autocomplete='off' name="question2" id="pass2" placeholder="SECURITY QUESTION # 2" required list='question' />
                                <datalist id="question">
                                    <option>What was your favorite food as a child?</option>
                                    <option>Who is your childhood sports hero?</option>
                                    <option>What is your maternal grandmother's maiden name?</option>
                                    <option>What is the name of a college you applied to but didn't attend?</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                 <label for="re-pass"><i class="zmdi zmdi-text-format"></i></label>
                                 <input type="text" name="answer2" autocomplete='off'  placeholder="Enter your Answer"  required />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images-login/milawidaccount.png" alt="sing up image"></figure>
                        <a href="index.php" class="signup-image-link">I  already have an account</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
    
      if(isset($_POST['signup'])){

         $sql1 = "SELECT * FROM `tbl_user` ";
              $processQuery1 = $conn->query($sql1);
              while ($resultQuery = $processQuery1->fetch_assoc())
              { $email= $resultQuery['emailadd'];}

        if($email == $_POST['email']){ ?>
              <script>
                  alert ("Someone is already using your email. Please try different email.");
            </script>
        <?php }else{
         if($_POST['re_pass'] != $_POST['pass'] ){ ?>
              <script>
                  alert ("Password don't match! ");
            </script> 
    <?php }else{    
        $pass22 = md5(trim($_POST['re_pass']));
        $name = $_POST['lname'].",".$_POST['fname']." ".$_POST['mname'];
        $insert = "INSERT INTO `tbl_user`( `username`, `password`, `name`, `position`, `bday`, `emailadd`, `datereq`, `timereq`,question1,answer1,question2,answer2, `firstname`, `middlename`, `lastname` ) VALUES ('".$_POST['email']."','".$pass22."','".$name."','USER','".$_POST['bday']."','".$_POST['email']."',CURDATE(),CURTIME(),'".$_POST['question1']."','".$_POST['answer1']."','".$_POST['question2']."','".$_POST['answer2']."','".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."')";
        $conn->query($insert);   
             ?>
              <script>
                  alert ("Successfully created an account. Please try logging in your newly created account. Thank you!");
                  window.location.replace("index.php");
            </script>
    <?php
       } } }

?>

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