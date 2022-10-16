<?php
session_start();

include("connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(!empty($username) && !empty($password)){
        $querySA = "select * from schooladministrator WHERE username='$username'";
        $queryV = "select * from volunteer WHERE username='$username'";
        $resultSA = mysqli_query($con, $querySA);
        $resultV = mysqli_query($con, $queryV);

        if($resultSA){
            
            if($resultSA && mysqli_num_rows($resultSA) > 0){
                $user_data = mysqli_fetch_assoc($resultSA);
            
                if($user_data["password"] === $password && $user_data["position"] === "Super Admin"){
                    $_SESSION["username"] = $user_data["username"];
                    //change to the super admin page
                    header("location: test.html");
                    die;
                }
                else if($user_data["password"] === $password && $user_data["position"] !== "Super Admin"){
                    $_SESSION["username"] = $user_data["username"];
                    //change to the school admin page
                    header("location: test.html");
                    die;
                }
            }
        }
        if($resultV){
            
            if($resultV && mysqli_num_rows($resultV) > 0){
                $user_data = mysqli_fetch_assoc($resultV);

                if($user_data["password"] === $password){
                    $_SESSION["username"] = $user_data["username"];
                    //change to the volunteer page
                    header("location: test1.html");
                    die;
                }
            }
        }
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("Please enter valid Username")';
        echo '</script>';
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
                    <img src="images/ColTeach.png" alt="ColTeach logo" style="width: 50%;display: block; height: 50%; margin-left: auto; margin-right: auto;">
                    <h1 class="text-success text-center my-5">LOGIN</h1>
                    <div class="card-text">
                        <form>
                            <div class="form-group">
                                <label for="exmapleInputEmail1"> Username</label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-sm"
                                    id="exmapleInputEmail1"/>
                            </div>

                            <div class="form-group">
                                <label for="exmapleInputPassword1"> Password</label>
                                <input 
                                    type="password" 
                                    class="form-control form-control-sm"
                                    id="exmapleInputPassword1"/>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
