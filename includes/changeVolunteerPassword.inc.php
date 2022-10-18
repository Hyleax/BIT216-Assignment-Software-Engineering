<?php
session_start();

// check if user accessed this file by regular means
if (isset($_POST['changePassword-btn'])){

    // require is used when the file is mandatory for the application
    require 'connection.php';
    require 'volunteerFunctions.inc.php';

    // collecting the variables from registerVolunteer.php
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    
    // check if fields are empty
    if (checkPasswordFieldsEmpty($oldPassword, $newPassword, $confirmPassword)){
        header("Location: ../changeVolunteerPassword.php?error=emptyfields");
        exit();
    }

     // check if password is equal to users password in the DB
    if (checkPasswordInDB($con, $oldPassword)){
        header("Location: ../changeVolunteerPassword.php?error=passwordwrong");
        exit();
    }   

     // check if the new password is too weak
    if (testPasswordStrength($newPassword)){
        header("Location: ../changeVolunteerPassword.php?error=passwordtooweak");
        exit();
    }

     // check if the newPassword and confirmPasword match
     if (confirmPassword($newPassword, $confirmPassword)){
        header("Location: ../changeVolunteerPassword.php?error=passwordnotequal");
        exit();
    }

     //change Password
     changePassword($con, $newPassword);
}

else {
    header("Location: ../editVolunteerProfile.php");
}

?>