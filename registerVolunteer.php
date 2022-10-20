

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColTeach Volunteer Registration</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
</head>
<body style="background: linear-gradient(to right, rgb(182, 244, 146), rgb(51, 139, 147));">
<section>
  <div class="mask d-flex align-items-center mt-5">
    <div class="container h-100">
      <a href="index.php">
                          <img src="images/ColTeach.png" alt="ColTeach logo" style="width: 50%;display: block; height: 50%; margin-left: auto; margin-right: auto;" class = "bg-dark mb-5 rounded-pill">
                      </a>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark mb-5" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center text-success mb-4">Register as a Volunteer</h2>
              <span id="empty-values"></span>

              <form class="text-light fw-bold" action = "includes/registerVolunteerValidation.inc.php" method = "POST">

                <div class="form-outline mb-2">
                    <label class="form-label" for="username">Username</label> <span></span>
                    <input 
                      type="text" 
                      id="username" 
                      name="username" 
                      class="form-control form-control-sm"

                      <?php if (isset($_GET["username"])) {?>
                      value = "<?php echo $_GET["username"] ?>"
                      <?php } ?>
                    />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="fullname">Full Name</label> <span></span>
                    <input type="text" id="fullname" name="fullname" class="form-control form-control-sm" 
                    <?php if (isset($_GET["fullname"])) {?>
                      value = "<?php echo $_GET["fullname"] ?>"
                      <?php } ?>
                    />
                </div>
 
                <div class="form-outline mb-2">
                    <label class="form-label" for="phoneNumber">Phone Number</label> <span></span>
                    <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-sm" 
                    <?php if (isset($_GET["phoneNumber"])) {?>
                      value = "<?php echo $_GET["phoneNumber"] ?>"
                      <?php } ?>
                    />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="occupation">Occupation</label> <span></span>
                    <input type="text" id="occupation" name="occupation" class="form-control form-control-sm" 
                    <?php if (isset($_GET["occupation"])) {?>
                      value = "<?php echo $_GET["occupation"] ?>"
                      <?php } ?>
                    />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="birthdate">Date of birth</label> <span></span>
                    <input type="date" id="birthdate" name="birthdate" class="form-control form-control-sm" 
                    <?php if (isset($_GET["birthdate"])) {?>
                      value = "<?php echo $_GET["birthdate"] ?>"
                      <?php } ?>
                    />
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="email">Your Email</label> <span></span>
                    <input type="email" id="email" name="email" class="form-control form-control-sm" 
                    <?php if (isset($_GET["email"])) {?>
                      value = "<?php echo $_GET["email"] ?>"
                      <?php } ?>
                    />
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
                    class="btn btn-success fw-bold text-light form-control"
                    id="volunteerRegister-btn"
                    name = "volunteerRegister-btn">
                      Register
                  </button>
                    <span id="redirecting-message"></span>
                </div>

                <div class = "d-flex justify-content-center text-danger fw-bold mt-3">
              <?php
                if (isset($_GET["error"])){
                  
                  if ($_GET["error"] == "emptyfields"){
                    echo "<p>Fill in all fields!</p>";
                  }

                  else if ($_GET["error"] == "tooyoung"){
                    echo "<p>You must be 16 years old and above to register as a volunteer</p>";
                  }
                  
                  else if ($_GET["error"] == "emailinvalid"){
                    echo "<p>Email is invalid</p>";
                  }
                  
                  else if($_GET["error"] == "passwordweak"){
                    echo "<p>Your password is too weak</p>";
                  }

                  else if($_GET["error"] == "passwordwrong"){
                    echo "<p>Password is not the same</p>";
                  }

                  else if($_GET["error"] == "usernametaken"){
                    echo "<p>This username is already taken</p>";
                  }

                  else if($_GET["error"] == "sqlerror"){
                    echo "<p>Something went wrong, please try again</p>";
                  }
                  else if($_GET["error"] == ""){
                    echo "<p>You have successfully signed up</p>";
                  }
                }
              ?>
              </div>

                <p class="text-center text-mute mt-3">Have already an account? <a href="login.php"
                    class="fw-bold text-primary"><u>Login here</u></a></p>

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