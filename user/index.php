<!DOCTYPE html>
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
                        <figure><img src="images-login/milawidfront.png" style="width:350%" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title"> Sign up <div class="loader"></div>  </h2>
                        <form method="POST" action="../dp.php" class="register-form" >
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="emailu" autocomplete="off" placeholder="Email Address"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"> &nbsp<a onclick="myFunction()"  class="badge btn-danger" ><i class="zmdi zmdi-eye"></i></a></i></label>
                                <input type="password" name="pass" autocomplete="off"  id="myInput" placeholder=" Password"/>
                            </div>
                            <div class="form-group">
                                 
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/> &nbsp &nbsp
                                 <a href="newaccount.php" class="form-submit" >Create Account</a>
                            </div>
        
                            <div class="form-group">
                                 <a href="forgotpass.php" class="signup-image-link" >Forgot Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
function myFunction() {
  var x = document.getElementById("myInput");
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