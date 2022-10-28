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
    <title>change password</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
</head>
<body style="background-color: #50C878;">
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
                    <a class="nav-link" href="viewRequests.html">View Requests</a>
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
      <img 
        src="images/defaultProfilePhoto.png" 
        alt="profile picture" 
        width="250px"
        class="img-fluid mb-2"
        id="profile-pic"
        >
        <h2 class="bg-dark mt-2 p-2 px-4 rounded-pill" style="color:  #A020F0;"><?php echo $userType?></h2>
      </div>


      <!--Profile Information container-->
      <main class="container-fluid mb-5 rounded p-3 d-flex flex-column align-items-center">    
        <h2 class="text-light fw-bold bg-dark py-2 px-3 mb-4 rounded-pill"><?php echo $fullName?></h2> 
            <div 
                class=" bg-dark rounded px-5 pt-5 text-light shadow p-3"
                style="width: 400px;"    
            >
               <form action="includes/changeVolunteerPassword.inc.php" class="fw-bold" method="POST">

                <div class="form-outline mb-4">
                    <label class="form-label" for="oldPassword">Old Password</label> <span></span>
                    <input type="password" id="oldPassword" name="oldPassword" class="form-control form-control-md" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="newPassword">New password</label> <span></span>
                    <input type="password" id="newPassword" name="newPassword" class="form-control form-control-md" />
                </div>

                <div class="form-outline mb-4 pb-2">
                    <label class="form-label" for="confirmPassword">Confirm Password</label> <span></span>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-md" />
                </div>

                <div class="d-flex justify-content-center mt-3 mb-4">
                    <button 
                      type="submit"
                      class="btn btn-success fw-bold text-light form-control"
                      id="changePassword-btn"
                      name = "changePassword-btn">
                        Change Password
                    </button>
                </div>
                <div class = "d-flex justify-content-center text-danger fw-bold mt-3">
                        <?php
                          if (isset($_GET["error"])){
                            
                            if ($_GET["error"] == "emptyfields"){
                              echo "<p>Fill in all fields!</p>";
                            }
                            
                            else if ($_GET["error"] == "passwordwrong"){
                              echo "<p>Your old password is wrong</p>";
                            }
                            
                            else if($_GET["error"] == "passwordtooweak"){
                              echo "<p>Your new password is too weak</p>";
                            }

                            else if($_GET["error"] == "passwordnotequal"){
                              echo "<p>Your passwords are not the same</p>";
                            }
                          }
                        ?>
                      </div>

               </form>
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

 <!-- JavaScript Bundle with Popper -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
</script>
</body>
</html>