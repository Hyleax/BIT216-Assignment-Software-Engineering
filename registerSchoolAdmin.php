<?php
session_start();

include ("includes/connection.php");

$query = "SELECT * FROM school ORDER BY schoolID DESC LIMIT 1;";
$result = mysqli_query($con, $query);

if($result){
    if($result && mysqli_num_rows($result) > 0){
        $school_data = mysqli_fetch_assoc($result);
    }
}

$schoolID = $school_data["schoolID"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Administrator Registration</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
</head>
<body class="bg-success">
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
                    <a class="nav-link" href="registerSchool.php">Register New School</a>
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

<section>
  <div class="mask d-flex align-items-center mt-5">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center text-success mb-4">Register a New School Administrator</h2>
              <span id="empty-values"></span>
              <form class="text-light" action = "includes/registerSchoolAdminValidation.inc.php" method = "POST">
                <div class="form-outline mb-2">
                    <label class="form-label" for="username" id="schoolID" name="schoolID">School ID: <?php echo $schoolID ?></label>
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="username">Username</label> <span></span>
                    <input type="text" id="username" name="username" class="form-control form-control-sm" />
                </div>
                <div class="form-outline mb-2">
                    <label class="form-label" for="fullname">Full Name</label> <span></span>
                    <input type="text" id="fullname" name="fullname" class="form-control form-control-sm" />
                </div>
 
                <div class="form-outline mb-2">
                    <label class="form-label" for="position">Position</label> <span></span>
                    <input type="text" id="position" name="position" class="form-control form-control-sm" />
                </div>
                
                <div class="form-outline mb-2">
                    <label class="form-label" for="email">Email</label> <span></span>
                    <input type="email" id="email" name="email" class="form-control form-control-sm" />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="phoneNum">Phone Number</label> <span></span>
                    <input type="tel" id="phoneNum" name="phoneNum" class="form-control form-control-sm" />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="password">Password</label> <span></span>
                    <input type="password" id="password"  name="password" class="form-control form-control-sm" />
                  
                </div>
                <div class="form-outline mb-5">
                    <label class="form-label" for="confirmPassword">Repeat your password</label> <span></span>
                    <input type="password" id="confirmPassword" name = "confirmPassword" class="form-control form-control-sm" />
                </div>
                
                <div class="d-flex justify-content-center">
                  <button 
                    type="submit"
                    class="btn btn-success gradient-custom-4 text-body form-control"
                    id="registerSchoolAdmin-btn"
                    name = "registerSchoolAdmin-btn">
                      Register
                  </button>
                    <span id="redirecting-message"></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyfields"){
            echo '<script language="javascript">';
            echo 'alert("Fill in all fields!")';
            echo '</script>';
        }
        else if($_GET["error"] == "invalidEmail"){
            echo '<script language="javascript">';
            echo 'alert("Please enter a valid email address!")';
            echo '</script>';
        }
        else if($_GET["error"] == "passwordStrength"){
            echo '<script language="javascript">';
            echo 'alert("Password must be at least 8 character and ONE upper case!")';
            echo '</script>';
        }
        else if($_GET["error"] == "confirmPassword"){
            echo '<script language="javascript">';
            echo 'alert("Password and Repeat your password must be same!")';
            echo '</script>';
        }
        else if($_GET["error"] == "takenUsername"){
            echo '<script language="javascript">';
            echo 'alert("Username is taken. Please enter another username!")';
            echo '</script>';
        }
        else if($_GET["error"] == "stmtFailed"){
            echo "<p>Something went wrong, try again!</p>";
        }
        else if($_GET["error"] == "none"){
            echo '<script language="javascript">';
            echo 'alert("School registered successfully!")';
            echo '</script>';
        }
    }
?>
</section>
    
<!-- JavaScript Bundle with Popper -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
</script>
</body>
</html>
