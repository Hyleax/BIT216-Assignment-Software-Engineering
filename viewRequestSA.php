<?php
session_start();
include("includes/connection.php");
include("includes/profile.inc.php");

$query = "SELECT * FROM resource WHERE staffID = $staffID ORDER BY requestDate, requestStatus ASC;";
$result = mysqli_query($con, $query);
$requestR = mysqli_query($con, $query);


$query2 = "SELECT * FROM tutorial WHERE staffID = $staffID ORDER BY requestDate, requestStatus ASC;";
$result2 = mysqli_query($con, $query2);
$requestT = mysqli_query($con, $query2);

/*if(isset($_POST["resourceID"])){
  header("location: reviewOffer.php");
  
}*/
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

      <h1 class="display-1 text-center mt-2 fw-bold">MY REQUEST</h1>
      <div class="d-flex justify-content-center">
        <div class="sort-btns-container gap-5 mt-3 mb-3">
          <form method="POST">
              <button type="submit" class="btn btn-md btn-danger mx-2" id="resourceBtn" name="resourceBtn">Resource</button>
              <button type="submit" class="btn btn-md btn-danger mx-2" id="tutorialBtn" name="tutorialBtn">Tutorial</button>
          </form>
        </div>
      </div>
      
  <form method="POST" action="reviewOffer.php">
      <section class="intro">
  <div class="bg-image h-100" >
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless mb-0">
                    <thead>
                      <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Request Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Request Date</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(isset($_POST["resourceBtn"])){
                        if(mysqli_num_rows($requestR) > 0){
                          while($row = mysqli_fetch_assoc($requestR)){
                            ?>
                            <tr>
                              <td><?php echo $row["requestID"];?></td>
                              <td><?php echo $row["resourceType"];?></td>
                              <td><?php echo $row["requestStatus"];?></td>
                              <td><?php echo $row["requestDate"];?></td>
                              <td>
                                
                                <button type="submit" class="btn btn-danger btn-sm px-3" id="detailsR" name="detailsR" value="<?php echo $row["requestID"];?>">
                                  View Details
                                </button>
                                
                              </td>
                            </tr>
                          <?php  
                          }
                        }
                      }
                      if(isset($_POST["tutorialBtn"])){
                        if(mysqli_num_rows($requestT) > 0){
                          while($row = mysqli_fetch_assoc($requestT)){
                            ?>
                            <tr>
                              <td><?php echo $row["requestID"];?></td>
                              <td>Tutorial</td>
                              <td><?php echo $row["requestStatus"];?></td>
                              <td><?php echo $row["requestDate"];?></td>
                              <td>
                              
                                <button type="submit" class="btn btn-danger btn-sm px-3" id="detailsT" name="detailsT" value="<?php echo $row["requestID"];?>">
                                  View Details
                                </button>
                                
                              </td>
                            </tr>
                            <?php
                          }
                        }
                      }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>

      <!--REQUEST CARDS-->
      <div class="container-fluid request-container mt-3">
                

        </div>


      <!--Profile Information container-->
      <main class="container-sm mb-5 rounded w-50 p-3 d-flex flex-column align-items-center">    
        
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
