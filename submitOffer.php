<?php
session_start();
include("includes/connection.php");
include("includes/profile.inc.php");

//get volunteer ID
$query = "SELECT * FROM volunteer WHERE username = '".$_SESSION['username']."';";
$result = mysqli_query($con, $query);
$volunteerID;

if($result){
  if($result && mysqli_num_rows($result) > 0){
    $volunteer = mysqli_fetch_assoc($result);
    $volunteerID = $volunteer["volunteerID"];
  }
}

//get request ID
$requestID = $_POST['requestType'];

//resource varialbe
$requireNum;
$description;
$type;

//tutorial varialble
$tutorialDate;
$studentLevel;
$studentNum;

$queryR = "SELECT * FROM resource WHERE requestID = '".$_POST['requestType']."';";
$queryT = "SELECT * FROM tutorial WHERE requestID = '".$_POST['requestType']."';";

$resultR = mysqli_query($con, $queryR);
$resultT = mysqli_query($con, $queryT);

// if resource request is selected
if($resultR){
  if($resultR && mysqli_num_rows($resultR) > 0){
    $resource = mysqli_fetch_assoc($resultR);
    $requireNum = $resource["requireNum"];
    $description = $resource["description"];
    $type = $resource["resourceType"];
  }
}

//if tutorial request is selected
if($resultT){
  if($resultT && mysqli_num_rows($resultT) > 0){
    $tutorial = mysqli_fetch_assoc($resultT);
    $tutorialDate = $tutorial["tutorialDate"];
    $studentLevel = $tutorial["studentLevel"];
    $studentNum = $tutorial["studentNum"];
    $type = "";
  }
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
                    <a class="nav-link" href="submitNewRequest.html">View Requests</a>
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

      <!--Profile Information container-->
      <main class="container-sm mb-5 rounded w-50 p-3 d-flex flex-column align-items-center">    
        
        <form class="text-light" action = "includes/submitOffer.inc.php" method = "POST">
          <h2 class="text-light fw-bold bg-dark py-2 px-3 rounded-pill">Request ID: <?php echo $requestID?></h2>
          <input type="hidden" id="requestID" name="requestID" value="<?php echo $requestID?>"/>
    
          <div 
                class=" bg-dark rounded px-5 pt-5 text-light shadow p-3"
                style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"    
            >
                <?php if($type <> ""){ ?>
                  <h5 class='mb-4'>Description:<span class='text-success' id='birthday-el'> <?php echo $description?> </span></h5>
                  
                  <h5 class='mb-4'>Resource Type:<span class='text-success' id='type' name='type'> <?php echo $type?></span></h5>
                  <input type="hidden" id="type" name="type" value="<?php echo $type?>"/>

                  <h5 class='mb-4'>Require Number of Resource:<span class='text-success' id='birthday-el'> <?php echo $requireNum?></span>

                  <h5 class='mb-4'>Remark: <span class='text-success' id='birthday-el'><input type='text' id='remark' name='remark'/></span>
                  <?php }

                  else{ ?>
                    <h5 class='mb-4'>Tutorial Date & Time:<span class='text-success' id='birthday-el'> <?php echo $tutorialDate?></span></h5>

                    <h5 class='mb-4'>Student Level:<span class='text-success' id='birthday-el'> <?php echo $studentLevel?></span></h5>
                    <input type="hidden" id="studentLevel" name="studentLevel" value="<?php echo $studentLevel?>"/>

                    <h5 class='mb-4'>Number of Student:<span class='text-success' id='birthday-el'> <?php echo $studentNum?></span></h5>

                    <h5 class='mb-4'>Remark: <span class='text-success' id='birthday-el'><input type='text' id='remark' name='remark'/></span></h5>
                  <?php } ?>
                  
            </div>



          <div class="d-flex justify-content-center pt-4 pb-3">
            <button 
              type="submit"
              class="btn btn-success gradient-custom-4 text-body form-control"
              id="submitOffer_btn"
              name = "submitOffer_btn">
                Submit
            </button>


            
              <span id="redirecting-message"></span>
                  </div>
          </form>
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
