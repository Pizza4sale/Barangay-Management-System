
<?php include 'conn.php'; 

/* $pop1 = "SELECT voter FROM `tbl_faq` where purpose ='population' ";
$pop2 = mysqli_query($conn, $pop1);  
 while($pop11 = mysqli_fetch_array($pop2)) 
  { $pop = $pop11['voter']; }
*/

$sqlz1 = "SELECT count(*) as alll FROM tbl_resident ";
$processQueryz1= $conn->query($sqlz1);
while ($resultQuerz1 = $processQueryz1->fetch_assoc())
  { $Regpopulation = $resultQuerz1['alll']; } 


$sqlz2 = "SELECT count(*) as voterr FROM tbl_resident where voter ='Registered Voter'";
$processQueryz2= $conn->query($sqlz2);
while ($resultQuerz2 = $processQueryz2->fetch_assoc())
  { $reg = $resultQuerz2['voterr']; } 

$sqlz3 = "SELECT count(*) as nonvoterr FROM tbl_resident where voter ='Not Registered Voter'";
$processQueryz3= $conn->query($sqlz3);
while ($resultQuerz3 = $processQueryz3->fetch_assoc())
  { $nonreg = $resultQuerz3['nonvoterr']; } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href='https://fonts.googleapis.com/css?family=Alata' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">
  <link rel="icon" href="assets/img/milawid logo.png" type="image/gif" sizes="16x16">
  <title>Capstone/Official Milawid - Home</title>
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
   <link rel="stylesheet" href="css/covidcases.css" />
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/slick.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/indexnavbares.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About Milawid</a></li>
          <li><a class="nav-link scrollto" href="#services">Barangay Services</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Barangay Portfolio</a></li>  
          <li><a class="nav-link scrollto " href="#faq">Barangay FAQ's</a></li>      
          <li><a class="nav-link scrollto" href="#team">Our Officials</a></li>
          <li><a class="nav-link scrollto" href="user/index.php" >Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      
    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center" >
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active" >
        <div class="carousel-container" style="height: 20%" >
          <br><br>
          <h2 class="animate__animated animate__fadeInDown"><img src="assets/img/milawid logo.png" style="width: 10%" class="img-fluid animated" alt=""> WELCOME TO <span>BARANGAY MILAWID</span> </h2>
          <p class="animate__animated fanimate__adeInUp">Sitio Pinagbudhian, Purok 2 Panukulan, Quezon <br> Open Hours of Barangay: Monday to Friday (8AM - 5PM) <br> brgymilawid@gmail.com/09123456789</p>
          
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
    <main id="main">
       <section id="features" class="features">
 <div class="row">
<div class="col-lg-3 order-2 order-lg-1 mt-10 mt-lg-1" style="padding-left:35px;">
         <div class="tab-pane active show" id="tab-1" >
            <div class="row">
              <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0">
                <h4><em><b>Barangay Updates</b></em></h4>
                <p class="fst-italic">
                  
                </p>
                 
                  <?php $querys= "SELECT * FROM `tbl_brgy` ORDER BY brgy_id DESC LIMIT 4 ";
                         $results = mysqli_query($conn, $querys);  
                        while($rows = mysqli_fetch_array($results))  
                         {  $title = $rows['brgy_title'];?>
                         <ul style="width:90%">   <li><i  class="bi bi-magic"style="color:orange"></i>

                          <p style="display: inline-block;word-break: break-word;font-size: 14px; "><b><?php echo $title; ?></b><br> <small style="font-size: 12px;"> Date posted:  <?php echo $rows['posted_date']; ?></small> </li> 
                         <em style="font-size: 13px; ">
                           <?php
                           $idd = $rows['brgy_id'];
                           $string = substr($rows['brgy_details'],0,100);
                          
                             echo $string."...";?> <a href="news-details.php?id=<?Php echo $idd; ?>" style="font-size: 14px;">Read More</a>
                         </em>
                      <?php  }?>
                       </ul>
              </div>

            </div>
          </div>
</div>
<div class="col-lg-9 order-2 order-lg-1 mt-2 mt-lg-0">

    <!-- ======= Features Section ======= -->
      <div class="container">

        <ul class="nav nav-tabs row d-flex">
        <li class="nav-item col-6"  style="height: 20%" data-aos="zoom-in" data-aos-delay="200">
            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-3">
              <i class="bi bi-sun-fill"></i>
              <h4 class="d-none d-lg-block">COVID 19</h4>
            </a>
          </li>
          <li class="nav-item col-6" data-aos="zoom-in" data-aos-delay="100">
            <a  class="nav-link" data-bs-toggle="tab" href="#tab-2">
              <i class="bi bi-snapchat"></i>
              <h4 class="d-none d-lg-block">Job Announcements</h4>
            </a>
          </li>
        </ul>

        <div class="tab-content" data-aos="fade-up" style="font-size: 14px;">
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>We are looking for a qualified candidate to join our team!</h3>
                <p>
                  For more info. you may contact us here 0912910212121 or email us at brgymilawid@gmail.com.
                  Hope to hear from you soon!
                </p>
                <p class="fst-italic">
                  Here are the list of job vacancy this <?php echo date('F Y'); ?>
                </p>
                <ul>
                <?php $querys1= "SELECT * FROM `tbl_job` where status='OPEN' ";
                      $results1 = mysqli_query($conn, $querys1);  
                      while($rows1 = mysqli_fetch_array($results1))  
                         {  ?>
                        <button class="accordion"><i class="bi bi-arrow-down-short" ></i><?php echo  $rows1['job_title']; ?> <br></button>

                        <div class="panel">
                          <li>  
                          <li><i class="bi bi-circle-fill" style="font-size: 10px"></i><?php echo $rows1['job_details']; ?> </li>
                          <?php 
                                $que= "SELECT * FROM `tbl_jobquali` where job_id='".$rows1['jobid']."'  ";
                                $res = mysqli_query($conn, $que);  
                                while($ro = mysqli_fetch_array($res))  
                                   {  ?>
                            <p style="font-size: 13px" ><i style="font-size: 10px" class="bi bi-circle-half"></i> <?php echo $ro['jqualify']; ?> </p>
                          <?php } ?>  <br>
                         </div>

                    <?php } ?>
                   
                  </li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/job-searching.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div  class="tab-pane active show"  id="tab-3">
                  <div class="card" style="max-width: 1000px;height:180px; background-image:url('img/bgcovid.JPG'); background-size:cover;background-repeat: no-repeat" >
                    <br>
                    <p class="title" style="font-size: 15px;color:black"><!-- <b>Milawid Covid Count Number of cases as of</b> <br> <?php echo "Today " . date("M d,Y") . "<br><br>"; ?> --></p>
                </div>
                <br>

              <div class="row" >
               <div  class="col-lg-3 order-1 order-lg-1 mt-3 mt-lg-0">
              <div class="card" style="">
                     <p><button style="background-color: orange;"><small>Total Cases</small></button></p>
                    <p style="font-size: 25px;color:darkslategrey;" class="title"> - <?php 
                       $covid_total= "SELECT count(*) as total FROM `tbl_covid`";
                       $covidtotal = mysqli_query($conn, $covid_total);  
                       while($covidt = mysqli_fetch_array($covidtotal))  
                       { echo $covidt['total']; }
                      ?>  - </p>
               </div>
              </div>
              <div class="col-lg-3 order-1 order-lg-1 mt-3 mt-lg-0">
              <div class="card">
                     <p><button style="background-color: red;">Active Cases</button></p>
                    <p style="font-size: 25px;color:darkslategrey;" class="title">
                    - <?php 
                       $covidnn= "SELECT count(*) as new FROM `tbl_covid` where status ='NEW' ";
                       $covidnew = mysqli_query($conn, $covidnn);  
                       while($covidn = mysqli_fetch_array($covidnew))  
                       { echo $covidn['new']; }
                      ?> -</p> 
               </div>
              </div>
               <div class="col-lg-3 order-1 order-lg-1 mt-3 mt-lg-0">
              <div class="card">
                     <p><button style="background-color: green;">Recoveries</button></p>
                    <p style="font-size: 25px;color:darkslategrey;" class="title">
                     -  <?php 
                       $covid= "SELECT count(*) as recovered FROM `tbl_covid` where status ='RECOVERED' ";
                       $covidrec = mysqli_query($conn, $covid);  
                       while($covidre = mysqli_fetch_array($covidrec))  
                       { echo $reco = $covidre['recovered']; }
                      ?> -
                    </p>
               </div>
              </div>
              <div class="col-lg-3 order-1 order-lg-1 mt-3 mt-lg-0">
              <div class="card">
                     <p><button style="background-color: darkred;">Death Cases</button></p>
                    <p style="font-size: 25px;color:darkslategrey;" class="title">
                     - <?php 
                       $coviddd= "SELECT count(*) as death FROM `tbl_covid` where status ='DEATH' ";
                       $coviddeath = mysqli_query($conn, $coviddd);  
                       while($covidd = mysqli_fetch_array($coviddeath))  
                       { echo $covidd['death']; }
                      ?> -</p>
               </div>
              </div>
              </div>


               <div class="row" >
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                 <br><br>
                <img src="assets/img/covid.jpg" alt="" class="img-fluid">
                  <img src="img/covidd.jpg" alt="" class="img-fluid"><br><br><br><br>
              </div>

              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <br><br>
                 <img src="assets/img/ProtectiveMeasures1.jpg" alt=""  class="img-fluid">
              </div>
              
            </div>               
          </div>

        </div>

      </div>
    </section><!-- End Features Section -->
</div>
</div>
    <!-- ======= About Section ======= -->
    <section id="about" class="about" >
      <div class="container" >

        <div class="section-title" data-aos="zoom-out">
          <h2>About</h2>
          <p>Who we are</p>
        </div>

        <div class="row content" data-aos="fade-up">
          <div class="col-lg-6">
            <p>
              A barangay in the municipality of Panukulan, in the province of Quezon. Its population as determined by the 2020 Census was 830. This represented 5.07% of the total population of Panukulan.
            </p>
            <ul>
              <li>Region: CALABARZON (Region IV‑A)</li>
              <li>Municipality: Panukulan </li>
              <li>Postal code: 4337</li>
            </ul>
            <div class="col-lg-6">
             <i class="bi bi-house-fill" style="color:black;font-size:30px;"></i> &nbsp Registered Population - <?php echo $Regpopulation; ?><br> 
                <i class="bi bi-person-bounding-box" style="color:black;font-size:30px;"></i>
                &nbsp Non Voters - <?php echo $nonreg; ?> Voters - <?php echo $reg; ?>
            </div>
          
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              <b>Pananaw</b> <br>
              Isang Maunlad at Tahimik at Luntiang Pamayanan na may Malusog, Maka-Diyos, Nagkakaisa at Nagtutulungang Pamayanan
            </p>
           <p>
             <b>Misyon</b> <br>
             Maipagkaloob at Maiangat ang Edukasyon upang Maigapay ang bawat tao sa kasalukuyang pamantayan ng Karunungan at Maipaunawa ang kahalagahan ng Pakakaisa para sa Kaunlarang ng Pamayanan
           </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Services</h2>
          <p>What we do offer</p>
        </div>

        <h3 class="fs-6 mb-4">Barangay Online Services</h3>

        <div class="row mb-4">
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="bi bi-pin-map" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="residency-app.php" style="font-size: 20px;" >Barangay Residency Application</a></h4>
              <p class="description"></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="bi bi-signpost" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="indigency-app.php" style="font-size: 20px;" >Certificate of Indigency</a></h4>
              <p class="description"></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="200">
              <div class="icon"><i class="bi bi-card-checklist" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="complaint-app.php" style="font-size: 20px;" >Barangay Complaints</a></h4>
              <p class="description"></p>
            </div>
          </div>
        </div>

        <h3 class="fs-6 mb-4">Barangay Services Walk-in</h3>

        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="bi bi-briefcase" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="clearance-app.php" style="font-size: 20px;" >Barangay Clearance Online Application</a></h4>
              <p class="description"></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="100">
              <div class="icon"><i class="bi bi-book" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="permit-app.php" style="font-size: 20px;" >Business Permit Online Application</a></h4>
              <p class="description"></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="bi bi-shop-window"  style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="solo-app.php" style="font-size: 20px;" >Certificate of Solo Parents</a></h4>
              <p class="description"></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="bi bi-calculator" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="lowincome-app.php" style="font-size: 20px;" >Certificate of Low Income</a></h4>
              <p class="description"></p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Portfolio</h2>
          <p>What we've done</p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-end" data-aos="fade-up">

        </ul>

        <div class="row portfolio-container" data-aos="fade-up">

        <?php $xx3= "SELECT * FROM `tbl_portfolio` ";
                $xx13 = mysqli_query($conn, $xx3);
                while($xxx13 = mysqli_fetch_array($xx13))  
           {  ?>
          <div class="col-lg-3 col-md-6 portfolio-item">
           <div class="portfolio-img"><img src="img/brgy/<?php echo $xxx13["img_port"];?> " class="img-fluid" alt=""></div>
            <div class="portfolio-info">
             <h4 style="color:white;">Barangay Portfolio</h4>
              <a href="img/brgy/<?php echo $xxx13["img_port"];?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"><i class="bx bx-plus"></i></a>
            </div>
          </div>
        <?php } ?>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

 
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </div>

        <ul class="faq-list">
          <?php $xx= "SELECT * FROM `tbl_faq` where purpose ='faq' ";
                $xx1 = mysqli_query($conn, $xx);
                while($xxx1 = mysqli_fetch_array($xx1))  
           {  ?>
          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="<?php echo "#faq".$xxx1['id']; ?>"><?php echo $xxx1['question']; ?><i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="<?php echo "faq".$xxx1['id']; ?>" class="collapse" data-bs-parent=".faq-list"><br>
              <?php echo $xxx1['answer']; ?>
             </div>
          </li>
        <?php } ?>
        </ul>

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Team</h2>
          <p>Our Hardworking Officials</p>
        </div>
       <div class="carousel clearfix" >
        <div class="carousel-view clearfix">

<?php 
   //Code for getting the data of officials

$query = "SELECT distinct * FROM tbl_org order by org_id ";  
 $result = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result))  
 {  
   $name = $row["org_name"];
   $pos = $row["org_pos"];
   $org = $row["org_pic"];
?>


          <div class="box" style="width:20%" >
            <center>
            <p> <img style="width:100px; border-radius: 45%; min-height: 100px; max-height: auto;" src="img/brgy/<?php echo $org; ?>" class="img-fluid" alt=""><br />
            </p><b> <?php echo $name; ?></b><br />
            <span><?php echo $pos; ?></span></p>
                </center>
            </div>

<?php } ?>

      </div>
  <p style="text-align:left"><i class="bi bi-arrow-left-square-fill" style="font-size:40px;color:orange"></i>  Slide left to view more </p>

    </div>

      </div>
    </section><!-- End Team Section -->


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
       <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
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
              <a href="#" class="text-white" style="font-size: 14px;">&nbsp <i class="bi bi-bell-fill"></i>&nbsp Careers &nbsp &nbsp </a>
            </li>
            <li>
             <a href="#" class="text-white" style="font-size: 14px;">&nbsp <i class="bi bi-house-door-fill"></i>&nbsp Brgy. Updates &nbsp &nbsp</a>
            </li>
            <li>
              <a href="#" class="text-white" style="font-size: 14px;">&nbsp <i class="bi bi-activity"></i>&nbsp Covid Updates &nbsp &nbsp</a>
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
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

<script src="js/jquery.min.js"></script>
<script src="js/slick.min.js"></script>
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