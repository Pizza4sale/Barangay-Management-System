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
                    <div class="signin-form" style="width:60%">
                        <h2 class="form-title">Forgot Password</h2>
      <?php
    
      if(isset($_POST['forgot'])){
        
        $s = "SELECT * from tbl_user where emailadd='".$_POST['email']."' and bday='".$_POST['bday']."' and position ='USER' ";
        $result = mysqli_query($conn,$s);
        $count = mysqli_num_rows($result);

        if($count!= 0)
        { 
            $getres = $conn->query($s);
            $resultQuery = $getres->fetch_assoc();
            ?>
                        <form method="GET" action="newpass.php" >

                            <div class="form-group">
                                  <p><b> SECURITY QUESTIONS</b> </p>

                                <p style="font-size: 13px;color:black">1. <?php echo $resultQuery['question1']; ?></p>
                                <input type="text" name="answer1" autocomplete='off' id="your_name" placeholder="Enter your Answer"/>
                            </div>
                            <div class="form-group">
                                <p style="font-size: 13px;color:black">2. <?php echo $resultQuery['question2']; ?>.</p>
                                <input type="text" name="answer2" autocomplete='off' id="your_name" placeholder="Enter your Answer"/>
                            </div>
                             
                            <input name="name" value="<?php echo $resultQuery['name']; ?>" type="hidden">
                            <input name="userid" value="<?php echo $resultQuery['user_id']; ?>" type="hidden">
                            <input name="question1" value="<?php echo $resultQuery['question1']; ?>" type="hidden">
                            <input name="question2" value="<?php echo $resultQuery['question2']; ?>" type="hidden">

                            <div class="form-group form-button">
                              <p> Is this your account? <b> <?php echo $resultQuery['name']; ?></b> </p>
                              <input type="submit" name="submitype" id="signin" class="form-submit" value="No"/>
                              <input type="submit" name="submitype" id="signin" class="form-submit" value="Yes"/> 
                            </div>
                        </form>
        <?php 
    }else{
            echo "<h3>Account does not exist</h3>";
            echo " <a href='forgotpass.php' class='signup-image-link' >Try Again</a>";
        }
      }else{ ?>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="your_name" autocomplete='off'  placeholder="Email Address"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-cake"></i></label>
                                <input type="date" name="bday" id="your_name" placeholder="Email Address"/>
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="forgot" id="signin" class="form-submit" value="Verify Account"/> 
                            </div>
  
                            <div class="form-group">
                                 <a href="index.php" class="signup-image-link" >Back To Login</a>
                            </div>
                        </form>
    <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- JS -->
    <script src="vendor-login/jquery/jquery.min.js"></script>
    <script src="js-login/main.js"></script>
</body>
</html>