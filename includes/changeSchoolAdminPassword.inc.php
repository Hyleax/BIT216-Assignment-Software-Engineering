<?php
session_start();

// check if user accessed this file by regular means
if (isset($_POST['changePassword-btn'])){

    // require is used when the file is mandatory for the application
    require 'connection.php';
    //require 'volunteerFunctions.inc.php';
    require 'schoolAdministratorFunction.php';

    // collecting the variables from registerVolunteer.php
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    
    // check if fields are empty
    if (checkPasswordInput($oldPassword, $newPassword, $confirmPassword)){
        header("Location: ../changeSchoolAdminPassword.php?error=emptyfields");
        exit();
    }

     // check if password is equal to users password in the DB
    if (checkDBPassword($con, $oldPassword)){
        header("Location: ../changeSchoolAdminPassword.php?error=passwordwrong");
        exit();
    }   

     // check if the new password is too weak
    if (testPasswordStrength($newPassword)){
        header("Location: ../changeSchoolAdminPassword.php?error=passwordtooweak");
        exit();
    }

     // check if the newPassword and confirmPasword match
     if (confirmPassword($newPassword, $confirmPassword)){
        header("Location: ../changeSchoolAdminPassword.php?error=passwordnotequal");
        exit();
    }

     //change Password
     changePassword($con, $newPassword);
}

else {
    header("Location: ../editSchoolAdmin.php");
}

?>
