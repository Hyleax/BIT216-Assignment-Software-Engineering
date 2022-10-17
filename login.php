<?php
session_start();

require_once 'includes/connection.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //get input from user
    $username = $_POST["username"];
    $password = $_POST["password"];

    //
    if (empty($username) || empty($password)){
        header("location: login.php?error=emptyfields");
        exit();
    }

    else if(!empty($username) && !empty($password)){
        //select all data from from schooladministrator table where username is equal to username input field
        $querySA = "SELECT * FROM schooladministrator WHERE username='$username' AND position<>'Super Admin';";
        //select all data from from schooladministrator table where username is equal to username input field
        $queryV = "select * from volunteer WHERE username='$username'";

        //get school administrator data from database and store it (schooladministrator table)
        $resultSA = mysqli_query($con, $querySA);

        //get volunteer data from database and store it (volunteer table)
        $resultV = mysqli_query($con, $queryV);


        //if username and password are same as condition below
        if($username === "superadmin" && $password === "SuperAdmin"){
            //redirect user to super admin page
            header("location: superAdmin.php");
            die;
        }

        //if resultSA is true
        if($resultSA){
            //if resultSA is true and the number of data row is more than 0
            if($resultSA && mysqli_num_rows($resultSA) > 0){
                //fetch the data and store is user_data
                $user_data = mysqli_fetch_assoc($resultSA);
            
                //if user_data's password equal password input and position not equal to Super Admin
                if($user_data["password"] === $password){
                        $_SESSION["username"] = $user_data["username"];
                        //change to the school admin page
                        header("location: schoolAdmin.php");
                        die;
                }
                else {
                    header("location: login.php?error=incorrectpassword");
                    die;
                }
            }
        }
        //if resultV is true
        if($resultV){
            //if resultV is true and the number of data row is more than 0
            if($resultV && mysqli_num_rows($resultV) > 0){
                $user_data = mysqli_fetch_assoc($resultV);

                $hashedDBPassword = $user_data["password"];
                //if user_data's password equal password input
                if(password_verify($password, $hashedDBPassword)){
                    $_SESSION["username"] = $user_data["username"];
                    //change to the volunteer page
                    header("location: volunteerProfile.php");
                    die;
                }
                else {
                    header("location: login.php?error=incorrectpassword&username=$username");
                    die;
                }
            }
        }    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="css/login.css"/>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" />
        <link
            href="https://fonts.googleapis.com/css?family=Roboto"
            rel="stylesheet" />
        <link 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
            crossorigin="anonymous"/>
        <title>Login</title>
    </head>

    <body>
        <div class="global-container">
            <div class="card login-form">
                <div class="card-body">
                    <a href="index.php">
                        <img src="images/ColTeach.png" alt="ColTeach logo" style="width: 50%;display: block; height: 50%; margin-left: auto; margin-right: auto;">
                    </a>
                    <h1 class="text-success text-center my-5">LOGIN</h1>
                    <div class="card-text">
                        <form id="loginForm" method="POST" action="login.php">
                            <div class="form-group">
                                <label for="exmapleInputEmail1"> Username</label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-sm"
                                    id="loginUsername"
                                    name="username"
                                <?php if (isset($_GET["username"])) {?>
                                    value = "<?php echo $_GET["username"] ?>"
                                <?php } ?>
                                />
                            </div>

                            <div class="form-group">
                                <label for="exmapleInputPassword1"> Password</label>
                                <a href="#" style="float: right; font-size: 12px">Forgot Password?</a>
                                <input 
                                    type="password" 
                                    class="form-control form-control-sm"
                                    id="loginPassword"
                                    name="password"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
                            <div class = "d-flex justify-content-center text-danger fw-bold mt-3">
                            <?php
                                if (isset($_GET["error"])){
                                    if ($_GET["error"] === "emptyfields"){
                                        echo "<p>Please fill up all fields</p>";
                                    }
                                    else if ($_GET["error"] === "incorrectpassword"){
                                        echo "<p>Password is incorrect!</p>";
                                    }
                                }
                            ?>
                            </div>
                            <div class="signup">
                                Don't have an account? <a href="registerVolunteer.php">Create One</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
