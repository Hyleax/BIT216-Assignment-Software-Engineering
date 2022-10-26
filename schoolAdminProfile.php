<?php
session_start();
include("includes/connection.php");
include("includes/profile.inc.php");

//$getSchoolID = $_SESSION["schoolID"];

$sql = "SELECT * FROM school WHERE schoolID = $schoolID";
$resultSchoolID = mysqli_query($con, $sql);

if($resultSchoolID){
  if($resultSchoolID && mysqli_num_rows($resultSchoolID) > 0){
    $school_data = mysqli_fetch_assoc($resultSchoolID);
  }
}
else{
  echo "no record";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColTeach School Admin Profile</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="submitRequest.php">Submit New Request</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="reviewOffer.html">Review Offer</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="editSchoolAdminProfile.php">Update Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="changeSchoolAdminPassword.php">Change Password</a>
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
            
            if ($_GET["changepassword"] === "success"){
              echo "<h2 class = text-light>You have successfully changed your password</h2>";
            }
          }

          else if (isset($_GET["editprofile"])){
            if ($_GET["editprofile"] === "success"){
              echo "<h2 class = text-light>You have successfully changed your profile information</h2>";
            }
          }

          else if (isset($_GET['submitrequest'])){
            if ($_GET['submitrequest'] === "success"){
              echo "<h2 class = text-light>You have successfully submitted a request for aid</h2>";
            }
          }
        ?>
      <img 
        src="images/defaultProfilePhoto.png" 
        alt="profile picture" 
        width="250px"
        class="img-fluid mb-2"
        id="profile-pic"
        >
        <h2 class="bg-dark mt-2 p-2 px-4 rounded-pill" style="color:  #FFA500;"><?php echo $userType?></h2>
      </div>


      <!--Profile Information container-->
      <main class="container-sm mb-5 rounded w-50 p-3 d-flex flex-column align-items-center">    
        <h2 class="text-light fw-bold bg-dark py-2 px-3 rounded-pill"><?php echo $_SESSION["username"]; ?></h2> 
        <a href="editSchoolAdminProfile.php" class="mb-2 text-light">Edit Profile</a>
            <div 
                class=" bg-dark rounded px-5 pt-5 text-light shadow p-3"
                style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"    
            >
                <h5 class="mb-4">Full Name: 
                    <span class="text-success" id="fullname-el" name="fullname"><?php echo $fullnameSA; ?></span>
                </h5>

                <h5 class="mb-4">Your School: 
                    <span class="text-success" id="schoolName-el" name="schoolName"><?php echo $school_data["schoolName"]; ?></span>
                </h5>

                <h5 class="mb-4">Position: 
                    <span class="text-success" id="position-el" name="position"><?php echo $position; ?></span>
                </h5>

                <h5 class="mb-4">Email Address:
                    <span class="text-success" id="email-el" name="email"><?php echo $emailSA; ?></span>
                </h5>

                <h5 class="mb-4">Phone Number: 
                    <span class="text-success" id="phoneNum-el" name="phoneNum"><?php echo $phoneNumSA; ?></span>
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
