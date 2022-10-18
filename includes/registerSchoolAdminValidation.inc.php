<?php
include "connection.php";
include "schoolAdministratorFunction.php";

// check if user accessed this file by regular means
if (isset($_POST['registerSchoolAdmin-btn'])) {
    
        // require is used when the file is mandatory for the application
        require 'connection.php';

        // collecting the variables from registerSchoolAdmin.php
        $username = $_POST["username"];
        $fullname = $_POST["fullname"];
        $position = $_POST["position"];
        $email = $_POST["email"];
        $phoneNum = $_POST["phoneNum"];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        

        // check if fields are empty
        // headers cannot be indented
        if (emptyInputRegisterSchoolAdmin($username, $fullname, $position, $email, $password, $confirmPassword) !== false){
                header("Location: ../registerSchoolAdmin.php?error=emptyfields");
                exit();
        }

        // check if email is valid
        if (testEmailValid($email) !== false){
            header("Location: ../registerSchoolAdmin.php?error=invalidEmail");
            exit();
        }

        // check if password is strong enough
        if(testPasswordStrength($password) !== false) {
            header("Location: ../registerSchoolAdmin.php?error=passwordStrength");
            exit();
        }

        // check if password and confirmPassword are the same
        if (confirmPassword($password, $confirmPassword) !== false){
            header("Location: ../registerSchoolAdmin.php?error=confirmPassword");
            exit();
        }

        // check if username is already taken
        if (testSAUsernameExists($con, $username) !== false) {
            header("Location: ../registerSchoolAdmin.php?error=takenUsername");
            exit();
        }

        createSchoolAdmin($con, $username, $password, $fullname, $email, $phoneNum, $position);
}

// if a user does mot access the file by natural means
else {
    header("Location: ../registerSchoolAdmin.php");
    exit();
}
