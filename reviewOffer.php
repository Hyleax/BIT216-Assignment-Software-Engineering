<?php
session_start();
include("includes/connection.php");
include("includes/profile.inc.php");

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

      <h1 class="display-1 text-center mt-2 fw-bold">REVIEW OFFER</h1>
      
    <form method="POST" action="volunteerDetails.php">
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
                        <th scope="col">Offer ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Offer Date</th>
                        <th scope="col">Remark</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($_POST["detailsR"])){
                            $sqlR = "SELECT * FROM offer WHERE requestID = '".$_POST['resourceValue']."';";
                            $resultR = mysqli_query($con, $sqlR);
                        
                            if($resultR && mysqli_num_rows($resultR) > 0){
                                while($row = mysqli_fetch_assoc($resultR)){
                                ?>
                                <tr>
                                    <td><?php echo $row["offerID"];?></td>
                                    <td><?php echo $row["offerStatus"];?></td>
                                    <td><?php echo $row["offerDate"];?></td>
                                    <td><?php echo $row["remarks"];?></td>
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm px-3" id="volunteerBtn" name="volunteerBtn">
                                            Volunteer Details
                                        </button>
                                        <input type="hidden" id="volunteerDetails" name="volunteerDetails" value="<?php echo $row["volunteerID"];?>"/>
                                        <input type="hidden" id="offerID" name="offerID" value="<?php echo $row["offerID"];?>"/>
                                        <input type="hidden" id="offerDate" name="offerDate" value="<?php echo $row["offerDate"];?>"/>
                                        <input type="hidden" id="remarks" name="remarks" value="<?php echo $row["remarks"];?>"/>
                                        <input type="hidden" id="requestID" name="requestID" value="<?php echo $_POST["resourceValue"];?>"/>
                                    </td>
                                </tr>
                                
                          <?php  
                          }
                        }
                        else if($resultR && mysqli_num_rows($resultR) > 0){
                          ?>
                          <h5>No Offer</h5>
                        <?php
                        }
                    }
                    else if(isset($_POST["detailsT"])){
                        $sqlT = "SELECT * FROM offer WHERE requestID = '".$_POST['tutorialValue']."';";
                        $resultT = mysqli_query($con, $sqlT);

                        if($resultT && mysqli_num_rows($resultT) > 0){
                            while($row = mysqli_fetch_assoc($resultT)){
                            ?>
                            <tr>
                                <td><?php echo $row["offerID"];?></td>
                                <td><?php echo $row["offerStatus"];?></td>
                                <td><?php echo $row["offerDate"];?></td>
                                <td><?php echo $row["remarks"];?></td>
                                <td>
                                    <button type="submit" class="btn btn-danger btn-sm px-3" id="volunteerBtn" name="volunteerBtn">
                                        Volunteer Details
                                    </button>
                                    <input type="hidden" id="volunteerDetails" name="volunteerDetails" value="<?php echo $row["volunteerID"];?>"/>
                                    <input type="hidden" id="offerID" name="offerID" value="<?php echo $row["offerID"];?>"/>
                                    <input type="hidden" id="offerDate" name="offerDate" value="<?php echo $row["offerDate"];?>"/>
                                    <input type="hidden" id="remarks" name="remarks" value="<?php echo $row["remarks"];?>"/>
                                    <input type="hidden" id="requestID" name="requestID" value="<?php echo $_POST["resourceValue"];?>"/>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                        else if($resultT && mysqli_num_rows($resultT) == 0){
                          ?>
                          <h5>No Offer</h5>
                        <?php
                        }
                    }
                    ?>
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
