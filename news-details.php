
<?php include 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href='https://fonts.googleapis.com/css?family=Alata' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">
  <link rel="icon" href="assets/img/milawid logo.png" type="image/gif" sizes="16x16">
 <title>Capstone / Brgy. Update</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
 <!-- carousel -->
  <link rel="stylesheet" href="css/style2.css" />
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/slick.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    a:hover {

  border-radius: 7px;
    }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

     <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">About Milawid</a></li>
          <li><a class="nav-link scrollto " href="index.php#services">Barangay Services</a></li>
          <li><a class="nav-link scrollto " href="index.php#portfolio">Barangay Portfolio</a></li>  
           <li><a class="nav-link scrollto " href="index.php#faq">Barangay FAQ's</a></li>   
          <li><a class="nav-link scrollto" href="index.php#team">Our Officials</a></li>
          <li><a class="nav-link scrollto" href="user/index.php" >Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center" >
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active" >
        <br><br>
        <div class="carousel-container" style="height: 30%"   >
          <h2 class="animate__animated animate__fadeInDown">
         Barangay Updates <br> Check it online!</h2>
          
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->



<style >
  .row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

</style>
  <main id="main">
  

    <!-- ======= Contact Section ======= -->
    <section  class="contact">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Barangay Updates</h2>
          <p style="font-size: 25px;">
      <?php 
        $querys= "SELECT * FROM `tbl_brgy` where brgy_id='".$_GET['id']."' ORDER BY brgy_id  ";
        $results = mysqli_query($conn, $querys);  
       while($rows = mysqli_fetch_array($results))  
       {  echo $title = $rows['brgy_title'];
          $details = $rows['brgy_details'];
          $posdate = $rows['posted_date']; 
          $img = $rows['news_img']; 
       }?>
         </p>
       <small><b><?php echo "Posted Date: ".$posdate."<br>"; ?></b></small>
        </div>
        
<div class="row">
  <div class="column">
   <div style="padding-left:10px;">
      <?php echo $details; ?>
        <br><br>
        <p>Read Other Updates:  
        <?php 
        $querys= "SELECT * FROM `tbl_brgy` ORDER BY brgy_id  ";
        $results = mysqli_query($conn, $querys);  
       while($rows = mysqli_fetch_array($results))  
       {   $string = substr($rows['brgy_title'],0,50);  $idd = $rows['brgy_id']; ?> 
       <em> <a href="news-details.php?id=<?Php echo $idd; ?>" style="font-size: 14px;"><?php echo $string.", &nbsp "; ?></a></em><?php }?> </p>
  </div>
 </div>
   <div class="column">
       <center>
          <img src="admin/index/img/<?php echo $img; ?>" alt="" width="500" class="img-fluid"><br>
    </center>
  </div>
</div>
           
          </div>
      </div>
    </section><!-- End Contact Section -->




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
   <!-- Footer -->
  <footer class="text-center text-lg-start text-white" style="background-color: #191C2D;font-family: Poppins, sans-serif;font-size: 13px;" >
    <!-- Grid container -->
    <div class="container p-1">
      <!--Grid row-->
      <div class="row mt-4">
        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
          <img src="assets/img/milawid logo.png" style="width:80%" class="img-fluid animated" alt=""> 
         <p> <small></small> </p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0" style="font-size: 14px;" >
          <h5 style="color:orange">Barangay Contacts</h5>

          <ul class="list-unstyled">
            <li>
              <i class="bi bi-phone-vibrate"></i>&nbsp 0912 345 6789
            </li>
            <li>
             <i class="bi bi-envelope" ></i>&nbsp brgymilawid@gmail.com
            </li>
            <li>
             <i class="bi bi-geo-alt"></i>&nbsp Sitio Pinagbudhian, Brgy. Milawid, Panukulan Quezon
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-2  mb-md-0"  >
          <h5 style="color:orange" style="font-size: 14px;">Services</h5>
          <ul class="list-unstyled">
            <li>
              <a href="clearance-app.php" class="text-white"  style="font-size: 14px;">&nbsp &nbsp Brgy. Clearance &nbsp &nbsp</a>
            </li>
            <li>
              <a href="permit-app.php" class="text-white"  style="font-size: 14px;">&nbsp &nbsp Business Permit &nbsp &nbsp</a>
            </li>
            <li>
              <a href="residency-app.php" class="text-white"  style="font-size: 14px;">&nbsp &nbsp Brgy. Residency &nbsp &nbsp</a>
            </li>
            <li>
             <a href="complaint-app.php" class="text-white" style="font-size: 14px;">&nbsp &nbsp File Complaint &nbsp &nbsp</a>
            </li>
          </ul>
        </div>

        <!--Grid column-->
       <div class="col-3 mb-md-0">
          <h5 style="color:#191C2D">`</h5>

          <ul class="list-unstyled">
            <li>
              <a href="indigency-app.php#home" class="text-white" style="font-size: 14px;">&nbsp Certificate of Indigency &nbsp &nbsp </a>
            </li>
            <li>
             <a href="lowincome-app.php#home" class="text-white" style="font-size: 14px;">&nbsp Certificate of Low Income &nbsp &nbsp</a>
            </li>
            <li>
            <a href="solo-app.php#home" class="text-white" style="font-size: 14px;">&nbsp Certificate of Solo Parents &nbsp &nbsp</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
          <h5 style="color:orange">Announcements</h5>

          <ul class="list-unstyled">
            <li>
              <a href="index.php#home" class="text-white" style="font-size: 14px;">&nbsp <i class="bi bi-bell-fill"></i>&nbsp Careers &nbsp &nbsp </a>
            </li>
            <li>
             <a href="index.php#home" class="text-white" style="font-size: 14px;">&nbsp <i class="bi bi-house-door-fill"></i>&nbsp Brgy. Updates &nbsp &nbsp</a>
            </li>
            <li>
              <a href="index.php#home" class="text-white" style="font-size: 14px;">&nbsp <i class="bi bi-activity"></i>&nbsp Covid Updates &nbsp &nbsp</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2022 Brgy Milawid,Panukulan Quezon</a>
    </div>
    <!-- Copyright -->
  </footer>
 <!-- End Footer -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<script>
$('.carousel-view').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
</script>       