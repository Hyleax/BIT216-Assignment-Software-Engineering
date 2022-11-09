
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
    <title>Submit Request</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="css/submitRequest.css">
    <link rel="stylesheet" href="css/volunteerProfile.css">
    <link rel="stylesheet" href="css/errorMsg.css">
</head>
<body>
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

      <h1 class="display-1 text-center mt-3 fw-bold">SUBMIT REQUEST</h1>
      <h5 class="reqText display-5 text-center"><i>Select a Request Type</i></h5>

      <div class = "d-flex justify-content-center text-danger fw-bold mt-3">
              <?php
                if (isset($_GET["error"])){
                  
                  if ($_GET["error"] == "emptyfields"){
                    echo "<p class = \"display-5\">Fill in all fields!</p>";
                  }

                  else if ($_GET["error"] == "timeinvalid"){
                    echo "<p class = \"display-5\">Please schedule a session at least 3 days in advance</p>";
                  }

                  else if ($_GET["error"] == "numinvalid"){
                    echo "<p class = \"display-5\">Please enter a valid number</p>";
                  }

                  else if ($_GET["error"] == "stulvlinvalid"){
                    echo "<p class = \"display-5\">Please select a student level</p>";
                  }

                  else if ($_GET["error"] == "restypeinvalid"){
                    echo "<p class = \"display-5\">Please select a resource type</p>";
                  }
                
                  else if($_GET["error"] == "sqlerror"){
                    echo "<p class = \"display-5\">Something went wrong, please try again</p>";
                  }
                }
              ?>
              </div>

      <!--MAIN CONTENT-->
      <form action="includes/submitRequest.inc.php" method="POST" class="100-vh">

        <!--INITIAL CONTAINER-->
        <div class="row text-center d-flex align-items-center mt-4 mx-3">
            <div class="col-sm-6 mt-3 mb-2">
                <div 
                    class="request-option-container cont-1 d-flex justify-content-center align-items-center" 
                    style="height: 500px;"
                >
                    <h1 class="display-1" for = "tutorial" >Tutorial</h1> 
                </div>
            </div>
            <div class="col-sm-6 mt-3 mb-2">
                <div 
                    class="request-option-container cont-2 d-flex justify-content-center align-items-center" 
                    style="height: 500px;"
                >
                    <h1 class="display-1" for = "resource">Resource</h1>
                </div>
            </div>
        </div>  


        <!--DISPLAY AFTER A REQUEST TYPE IS CLICKED-->
        <div class="request-container container-sm px-2">

            <!--CLICK TO GO BACK TO REQUEST TYPE SELECTION-->
            <div class="d-flex justify-content-center mx-5">
                <button 
                  class="btn btn-secondary text-light mb-5 "
                  style="height: 50px;"
                  id="backtoInitialContainerBtn"
                  name = "backtoInitialContainerBtn">
                    Back to Request Selection
                </button>
                  <span id="redirecting-message"></span>
              </div>
            

              <input id = "reqTypeSelector" type="text" name= "requestType" hidden>

            <!--DISPLAY THIS IF TUTORIAL REQUEST IS CLICKED-->
            <div class="tutorial-content-container px-5">
                <div class="row">
                     <!--tutorial description-->
                     <div class="form-group mb-2 pb-4">
                        <label class="form-label" for="tutorial-description">Tutorial Description</label> <span id = "errorMsg"></span>
                        
                        <input 
                            type="text" 
                            id="tutorial-description" 
                            class="form-control form-control-sm" 
                            placeholder="Enter tutorial description"
                            name = "tutorial-description"
                            <?php if (isset($_GET["tutDesc"])) {?>
                            value = "<?php echo $_GET["tutDesc"] ?>"
                            <?php } ?>
                        />
                
                    </div>
                
                    <!--date and time of proposed tutorial-->
                    <div class="form-group mb-2 pb-4">
                        <label class="form-label" for="tutorial-time">Tutorial Time</label>  <span id = "errorMsg"></span>
                        <input 
                            type="datetime-local" 
                            id="tutorial-time" 
                            class="form-control form-control-sm"
                            name = "tutorial-time"
                            <?php if (isset($_GET["tutTime"])) {?>
                            value = "<?php echo $_GET["tutTime"] ?>"
                            <?php } ?>
                        />
                    </div>

                    <!--student level from primary one to secondary 5-->
                    <div class="form-group mb-2 pb-4">
                        <label class="form-label" for="student-level">Student Level</label>  <span id = "errorMsg"></span>
                        <select 
                            id="student-level" 
                            class="form-control" 
                            name = "student-level"
                            <?php if (isset($_GET["studentLvl"])) {?>
                            value = "<?php echo $_GET["studentLvl"] ?>"
                            <?php } ?>
                        >
                            <option selected>Select student level...</option>
                            <option value="primary-1">primary 1</option>
                            <option value="primary-2">primary 2</option>
                            <option value="primary-3">primary 3</option>
                            <option value="primary-4">primary 4</option>
                            <option value="primary-5">primary 5</option>
                            <option value="secondary-1">secondary 1</option>
                            <option value="secondary-2">secondary 2</option>
                            <option value="secondary-3">secondary 3</option>
                            <option value="secondary-4">secondary 4</option>
                            <option value="secondary-5">secondary 5</option>
                          </select>
                    </div>

                    <!--number of expected students-->
                    <div class="form-group mb-2 pb-4">
                        <label class="form-label" for="no-of-students">Number of expected students</label>
                        <span id = "errorMsg"></span>
                        <input 
                            type="text" 
                            id="no-of-students" 
                            class="form-control form-control-sm" 
                            placeholder="e.g., 15"
                            name = no-of-students
                            <?php if (isset($_GET["noStudents"])) {?>
                            value = "<?php echo $_GET["noStudents"] ?>"
                            <?php } ?>
                        />
                    </div>
                </div>
            </div>

            <!--DISPLAY THIS IF RESOURCE REQUEST IS CLICKED-->
            <div class="resource-content-container px-5">
                    <!--Resource Description-->
                    <div class="form-group mb-2 pb-4">
                        <label class="form-label" for="resource-description">Resource Description</label>  <span id = "errorMsg"></span>
                        <input 
                            type="text" 
                            id="resource-description" 
                            class="form-control form-control-sm" 
                            placeholder="Enter resource description"
                            name = "resource-description"
                            <?php if (isset($_GET["resourceDescription"])) {?>
                            value = "<?php echo $_GET["resourceDescription"] ?>"
                            <?php } ?>
                            />
                            
                    </div>

                    <!--Resource Type-->
                    <div class="form-group mb-2 pb-4 mt-3">
                        <label class="form-label" for="resource-type">Resource Type</label>  <span id = "errorMsg"></span>
                        <select 
                            id="resource-type" 
                            class="form-control"
                            name = "resource-type"   
                            <?php if (isset($_GET["resType"])) {?>
                            value = "<?php echo $_GET["resType"] ?>"
                            <?php } ?>
                        >
                            <option selected>Select resource type...</option>
                            <option value="mobile-device">mobile device</option>
                            <option value="personal-computer">personal computer</option>
                            <option value="networking-equipment">networking equipment</option>
                          </select>
                    </div>

                    <!--Number of resources-->
                    <div class="form-group mb-2 pb-4 mt-3">
                        <label class="form-label" for="number-of-resources">Number of resources</label>  <span id = "errorMsg"></span>
                        <input 
                            type="text" 
                            id="number-of-resources" 
                            class="form-control form-control-sm" 
                            placeholder="e.g., 10"
                            name = "number-of-resources"
                            <?php if (isset($_GET["noRes"])) {?>
                            value = "<?php echo $_GET["noRes"] ?>"
                            <?php } ?>
                        />
                    </div>
            </div>

             <!--Submit Request to submitRequest.inc.php-->
             <div class="d-flex justify-content-center mt-5">
                <button 
                  class="btn btn-success fw-bold text-light mb-5 form-control form-control-sm"
                  style="height: 50px; width: 1200px;"
                  id="submitRequestBtn"
                  name = "submitRequestBtn">
                    Submit Request
                </button>
                  <span id="redirecting-message"></span>
              </div>
        </div>
      </form>


      <!--FOOTER-->
      <footer class="bg-dark text-center text-lg-start text-light py-4">
        <!-- Copyright -->
        <div class="text-center p-3">
          © 2022 Copyright:
          <a class="text-success" href="https://ColTeach.com.my/"><b>ColTeach.com.my</b></a>
        </div>
        <!-- Copyright -->
      </footer>
      


      



      <script src="javascript/submitRequest.js"></script>
    
        <!-- JavaScript Bundle with Popper -->
    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
</script>
</body>
</html>