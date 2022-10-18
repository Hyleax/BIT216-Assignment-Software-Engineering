
<?php
  session_start();
  require_once 'includes/profile.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColTeach Volunteer Profile</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="css/volunteerProfile.css">
</head>

<body style="background-color: #008B8B;">
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
                <li class="nav-item active">
                    <a class="nav-link" href="viewRequests.php">View Requests</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="volunteerProfile.php">Profile</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="editVolunteerProfile.php">Update Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="changeVolunteerPassword.php">Change Password</a>
                </li>
            </ul>

            <div class="nav-item dropdown text-light me-3">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Options
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark">
                    <li><a class="dropdown-item" href="includes/logout.inc.php">Log out</a></li>
                  </ul>
            </div>

          </div>
        </div>
      </nav>


      <!--Profile picture container-->
      <div 
        class="d-flex flex-column align-items-center pt-5"
        id="picture-container"
        >
        <?php
                if (isset($_GET["changepassword"])){
                  
                  if ($_GET["changepassword"] == "success"){
                    echo "<h2 class = text-light>You have successfully changed your password</h2>";
                  }
                }

                else if (isset($_GET["editprofile"])){
                  if ($_GET["editprofile"] === "success"){
                    echo "<h2 class = text-light>You have successfully changed your profile information</h2>";
                  }
                }
        ?>

          <img 
            src="images/defaultProfilePhoto.png" 
            alt="profile picture" 
            width="300px"
            class="rounded img-fluid mb-4"
            id="profile-pic"
            >
            <h2 class="bg-dark mt-2 p-2 px-4 rounded-pill " style="color:  #A020F0;"><?php echo $userType?></h2>
      </div>


      <!--Profile Information container-->
      <main class="container-sm mb-5 rounded w-50 p-3 d-flex flex-column align-items-center">    
        <h2 class="text-light fw-bold bg-dark py-2 px-3 rounded-pill"><?php echo $fullName ?></h2> 
        <a href="editVolunteerProfile.php" class="mb-2 text-light">Edit Profile</a>
            <div 
                class=" bg-dark rounded px-5 pt-5 text-light shadow p-3"
                style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"    
            >
                <h5 class="mb-4">Birthday: 
                    <span class="text-success" id="birthday-el"><?php echo $birthdate ?></span>
                </h5>
                <h5 class="mb-4">Age: 
                    <span class="text-success" id="age-el"><?php echo $age ?></span>
                </h5>
                <h5 class="mb-4">Occupation: 
                    <span class="text-success" id="occupation-el"><?php echo $occupation ?></span>
                </h5>
                <h5 class="mb-4">Email Address: 
                    <span class="text-success" id="email-el"><?php echo $email ?></span>
                </h5>
                <h5 class="mb-4">Phone Number: 
                    <span class="text-success" id="phoneNumber-el"><?php echo $phoneNumber ?></span>
                </h5>
            </div>
      </main>

      <!--FOOTER-->
      <footer class="bg-dark text-center text-lg-start text-light py-4">
        <!-- Copyright -->
        <div class="text-center p-3">
          © 2022 Copyright:
          <a class="text-success" href="https://ColTeach.com.my/"><b>ColTeach.com.my</b></a>
        </div>
        <!-- Copyright -->
      </footer>

    <script src="javascript/volunteerProfile.js"></script>

                <!-- JavaScript Bundle with Popper -->
    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
    </script>
</body>
</html>