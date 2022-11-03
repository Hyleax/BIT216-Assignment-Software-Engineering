

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
        crossorigin="anonymous"
    >
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <link rel="stylesheet" href="css/volunteerProfile.css">
    <link rel="stylesheet" href="css/viewRequests.css">
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
                <li class="nav-item active">
                    <a class="nav-link" href="viewRequests.php">View Requests</a>
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

      <h1 class="display-1 text-center mt-3 fw-bold">VIEW REQUESTS</h1>
     



        <main class="container-fluid">

            <!--SEARCH BAR-->
            <div class="px-2 align-items-center mt-4">
                <div>
                  <div class="search">
                    <i class="fa fa-search"></i>
                    <input id="searchBar" type="text" class="form-control" placeholder="Type the request type, description, school, city, request date of a request here...">
                    <button id="searchBtn" class="btn btn-success bg-success">Search</button>
                  </div>  
                </div>
            </div>

            <!--SORT BUTTONS-->
            <div class="d-flex justify-content-center">
                <div class="sort-btns-container gap-5 mt-4">
                    <p class="h4 text-center">Sort Requests by: <span id = sortText></span></p>
                    <button type="button" id="sortSchoolBtn" class="btn btn-md btn-primary mx-2">School</button>
                    <button type="button" id="sortCityBtn" class="btn btn-md btn-success mx-2">City</button>
                    <button type="button" id="sortReqDateBtn" class="btn btn-md btn-danger mx-2">Request Date</button>
                </div>
            </div>


            <!--REQUEST CARDS-->
            <div class="container-fluid request-container mt-3">
                

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

      <script src = "javascript/viewRequest.js"></script>
    
        <!-- JavaScript Bundle with Popper -->
    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous">
</script>
</body>
</html>