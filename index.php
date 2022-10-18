<?php
    session_start();
    include "includes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColTeach Home Page</title>
    <!-- CSS only -->
<link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous"
>
</head>
<body class="bg-light">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/ColTeach.png"
                    alt="ColTeach logo"
                    class="img-fluid"
                    style="width: 180px;">
            </a>
          <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            </ul>
            <form class="d-flex">

            <?php
                // need to find some way to determine which profile page to show

                if (isset($_SESSION["username"])){
                    include "includes/profile.inc.php";
                    
                    // if user is super admin
                    if ($userType === "Super Admin 💙"){
                        echo "<a href=\"superAdminProfile.php\" class= \"btn btn-outline-success btn-lg px-3 mx-3 form-control \">Profile</a>";
                    }

                    if ($userType === "School Admin 🧡"){
                        echo "<a href=\"schoolAdminProfile.php\" class= \"btn btn-outline-success btn-lg px-3 mx-3 form-control \">Profile</a>";
                    }
                    if ($userType === "Volunteer 💜"){
                        echo "<a href=\"volunteerProfile.php\" class= \"btn btn-outline-success btn-lg px-3 mx-3 form-control \">Profile</a>";
                    }
                    
                    echo "<a href=\"includes/logout.inc.php\" class= \"btn btn-outline-success btn-lg px-3 mx-3 form-control \">Logout</a>";
                }   

                else {
                    echo "<a href=\"login.php\" class= \"btn btn-outline-success btn-lg px-3 mx-3 form-control \">Login</a>";
                    echo "<a href=\"registerVolunteer.php\" class=\"btn btn-outline-success btn-lg px-3 mx-3 form-control\">Register</a>";
                }
                
            ?>
            </form>
          </div>
        </div>
      </nav>
      

      

         <!--Carousel-->
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner bg-dark">
            <div class="carousel-item text-center">
                <img src="images/carousel1.JPG" class="d-block w-100" alt="carousel-1">
            </div>
            <div class="carousel-item text-center">
                <img src="images/carousel2.JPG" class="d-block w-100" alt="carousel-2">
            </div>
            <div class="carousel-item text-center">
                <img src="images/carousel3.JPG" class="d-block w-100" alt="carousel-3">
            </div>
            <div class="carousel-item active text-center">
                <img src="images/carousel4.JPG" class="d-block w-100" alt="carousel-4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <br><br><br><br><br>

      <!--ABOUT US-->
      <div class="container-sm">
        <h1 class="text-success text-center my-5"><u>Who We Are</u></h1>
        <div class="row">
            <div class="col-sm-6">
                <img class="img-fluid" src="images/whoWeArePhoto.JPG" alt="help university">
            </div>
            <div class="col-sm-6 bg-light">
                <p>
                    <b class="text-success">Collab Teaching(ColTeach)</b> is a non-profit organization that seeks to help students that have been
                     financially affected by the COVID-19 pandemic to catch up on lost learning.
                </p>
                <br>
                <p>
                    ColTeach was established on September 2022 after two Malaysian university students 
                    spotted issues relating to education within the B-40 category They noticed that students were now behind on they're learning
                    due to being financially affected by the pandemic.
                </p>
                <br>
                <p>
                    As a result, these 2 students decided to create a web application for their assignment which would allow
                    students who are underprivilliged to obtain either resources needed for digital learning or tutoring provided by
                    volunteers, through the student's respectives schools.
                </p>
            </div>
        </div>
      </div>
      <br><br><br><br><br>
      
      
      <!--LOCATION-->
      <div class="container-fluid bg-dark py-4">
        <div class="container-sm">
            <h1 class="text-success text-center my-5"><u>Location</u></h1>
            <div class="text-center">
                <img class="img-fluid pb-3" src="images/helpUni.webp" alt="help university" style="width: 800px;">
                <div class="text-light text-center">
                    <p>We are located at <b class="text-success">HELP University</b></p>
                    <p>No. 15, Jalan Sri Semantan 1,<br>Jalan Semantan, Bukit Damansara,<br>50490 Kuala Lumpur</p>
                </div>
                
            </div>
          </div>
      </div>

      
      <br><br><br>


      <!--FOUNDERS-->
      <div class="container-sm">
        <h1 class="text-success text-center my-5"><u>Our Founders</u></h1>
        <div class="row pb-5">
            <div class="col-md-6">
                <div class="text-center bg-dark text-light py-5 px-3">
                    <h2>Chan Yew Loong</h2>
                <div class="row">
                    <div class="col-sm-4">
                        <b class="text-success">age:</b><br>21
                    </div> 
                    <div class="col-sm-4">
                        <b class="text-success">Major:</b><br>Information Technology
                    </div> 
                    <div class="col-sm-4">
                        <b class="text-success">Hobbies:</b><br>gaming, watching Shows
                    </div> 
                </div>
                <br><br><br>
                <div class="row">
                    <p>
                        a hardworking software developer who can do anything if he puts his mind to it.
                        He possesses a fantastic work ethic and is always willing to help someone in need.
                        He is also professional and knows when and how to get the job done.
                    </p>
                </div>
                <br><br>
                <div class="row">
                    <p>
                        <i>
                            Success is often achieved by those who don't know that failure is inevitable. 
                        </i>
                        <br>
                        - <b class="text-success">Chan Yew Loong</b>, 2022
                    </p>
                </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <img  class="img-fluid" src="images/yewPic.jpg" alt="Picture of Norman" style="width: 462px">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="text-center bg-dark text-light py-5 px-3">
                    <h2>Norman Yap Teik-Wei</h2>
                <div class="row">
                    <div class="col-sm-4">
                        <b class="text-success">age:</b><br>21
                    </div> 
                    <div class="col-sm-4">
                        <b class="text-success">Major:</b><br>Information Technology
                    </div> 
                    <div class="col-sm-4">
                        <b class="text-success">Hobbies:</b><br>playing guitar, playing futsal
                    </div> 
                </div>
                <br><br><br>
                <div class="row">
                    <p>
                        a lazy but witty university student who aspires to be a software engineer in order to contribute his skills to society
                    </p>
                </div>
                <br><br>
                <div class="row">
                    <p>
                        <i>
                            Knowledge is power, Power is Pain, If you do not understand, the teacher can explain
                        </i>
                        <br>
                        - <b class="text-success">Norman Yap</b>, 2022
                    </p>
                </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <img  class="img-fluid" src="images/normanPic.jpg" alt="Picture of Norman" style="width: 462px;">
            </div>
        </div>
    </div>
      </div>
    <br><br><br><br><br>
      
      <!--FOOTER-->
      <footer class="bg-dark text-center text-lg-start text-light py-4">
        <!-- Copyright -->
        <div class="text-center p-3">
          © 2022 Copyright:
          <a class="text-success" href="https://ColTeach.com.my/"><b>ColTeach.com.my</b></a>
        </div>
        <!-- Copyright -->
      </footer>
      


      <!-- JavaScript Bundle with Popper -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
</script>
</body>
</html> 