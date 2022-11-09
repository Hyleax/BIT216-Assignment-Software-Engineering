<?php
session_start();
include("includes/connection.php");
include("includes/profile.inc.php");

//$getSchoolID = $_SESSION["schoolID"];

$birthDate;
$selectedOfferID = $_POST["offerID"];
$selectedRequestID = $_POST["requestID"];

if(isset($_POST["volunteerBtn"])){
    $query = "SELECT * FROM volunteer WHERE volunteerID = '".$_POST['volunteerDetails']."';";
    $resultV = mysqli_query($con, $query);

    if(mysqli_num_rows($resultV) > 0){
        $volunteerData = mysqli_fetch_assoc($resultV);
        $birthDate = $volunteerData["dateOfBirth"];
    }

}

$systemDate = date('Y-m-d');
$systemDate = explode('-', $systemDate);
$systemYear = $systemDate[0];


$birthdateArray = date($birthDate);
$birthdateArray = explode('-', $birthDate);
$birthYear = $birthdateArray[0];

$age = $systemDate[0] - $birthdateArray[0];
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
                    <a class="nav-link" href="viewRequestSA.php">Review Offer</a>
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
        <h2 class="text-light fw-bold bg-dark py-2 px-3 rounded-pill">Volunteer Details</h2>
            <form method="POST" action="includes/updateRequestStatus.inc.php">
                <div 
                    class=" bg-dark rounded px-5 pt-5 text-light shadow p-3"
                    style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"    
                >
                    <h5 class="mb-4">Full Name: 
                        <span class="text-success" id="fullname-el" name="fullname"><?php echo $volunteerData["fullname"]; ?></span>
                    </h5>

                    <h5 class="mb-4">Occupation: 
                        <span class="text-success" id="schoolName-el" name="schoolName"><?php echo $volunteerData["occupation"]; ?></span>
                    </h5>

                    <h5 class="mb-4">Age: 
                        <span class="text-success" id="position-el" name="position"><?php echo $age; ?></span>
                    </h5>

                    <h5 class="mb-4">Offer Date: 
                        <span class="text-success" id="position-el" name="offerDate"><?php echo $_POST["offerDate"]; ?></span>
                    </h5>

                    <h5 class="mb-4">Remarks: 
                        <span class="text-success" id="position-el" name="remarks"><?php echo $_POST["remarks"]; ?></span>
                    </h5>

                    <input type="hidden" id="offerID" name="offerID" value="<?php echo $selectedOfferID;?>"/>
                    <input type="hidden" id="requestID" name="requestID" value="<?php echo $selectedRequestID;?>"/>
                    <button type="submit" class="btn btn-danger btn-sm px-3" id="acceptBtn" name="acceptBtn">Accept</button>
                    <button type="submit" class="btn btn-danger btn-sm px-3" id="rejectBtn" name="rejectBtn">Reject</button>
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
