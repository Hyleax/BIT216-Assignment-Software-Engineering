<?php
session_start();

include("includes/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New School Registration</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
</head>
<body class="bg-success">
<section>
  <div class="mask d-flex align-items-center mt-5">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center text-success mb-4">Register New School</h2>
              <span id="empty-values"></span>

              <form class="text-light" action = "includes/registerSchoolValidation.inc.php" method = "POST">

                <div class="form-outline mb-2">
                    <label class="form-label" for="schoolName">School Name</label> <span></span>
                    <input type="text" id="schoolName" name="schoolName" class="form-control form-control-sm" 
                      <?php if (isset($_GET["schoolName"])) {?>
                      value = "<?php echo $_GET["schoolName"] ?>"
                      <?php } ?>
                      />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="schoolAddress">School Address</label> <span></span>
                    <input type="text" id="schoolAddress" name="schoolAddress" class="form-control form-control-sm"
                      <?php if (isset($_GET["schoolAddress"])) {?>
                      value = "<?php echo $_GET["schoolAddress"] ?>"
                      <?php } ?>
                      />
                </div>
 
                <div class="form-outline mb-2">
                    <label class="form-label" for="schoolCity">School City</label> <span></span>
                    <input type="text" id="schoolCity" name="schoolCity" class="form-control form-control-sm" 
                      <?php if (isset($_GET["schoolCity"])) {?>
                      value = "<?php echo $_GET["schoolCity"] ?>"
                      <?php } ?>
                    />
                </div>

                

                <div class="d-flex justify-content-center pt-4 pb-3">
                  <button 
                    type="submit"
                    class="btn btn-success gradient-custom-4 text-body form-control"
                    id="registerSchool-btn"
                    name = "registerSchool-btn">
                      Confirm
                  </button>


                  
                    <span id="redirecting-message"></span>
                </div>

                <div class = "d-flex justify-content-center text-danger fw-bold mt-3">
                  <?php
                      if(isset($_GET["error"])){
                          if($_GET["error"] == "emptyInput"){
                              echo "<p>Fill in all fields!</p>";
                          }
                          else if($_GET["error"] == "schoolNameTaken"){
                              echo "<p>School Name is taken! Please enter a new school name</p>";
                          }
                          else if($_GET["error"] == "stmtFailed"){
                              echo "<p>Something went wrong, try again!</p>";
                          }
                          else if($_GET["error"] == "none"){
                              echo "<p>Successfully registered a new school!</p>";
                          }
                      }
                  ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
</section>


    


<!-- JavaScript Bundle with Popper -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
</script>
</body>
</html>