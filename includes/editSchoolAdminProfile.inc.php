<?php
session_start();

// check if user accessed this file by regular means
if (isset($_POST['editSchoolAdminProfile-btn'])){

    // require is used when the file is mandatory for the application
    require 'connection.php';
    require 'schoolAdministratorFunction.php';

    // collecting the variables from registerVolunteer.php
    $fullnameSA = $_POST['fullname'];
    $phoneNumSA = $_POST['phoneNumber'];
    $position = $_POST['position'];
    $emailSA = $_POST['email'];

    
    // check if fields are empty
    if (checkEditSchoolAdminProfileEmpty($fullnameSA, $phoneNumSA, $position, $emailSA)){
        header("Location: ../editSchoolAdminProfile.php?error=emptyfields");
        exit();
    }

    // check if email is valid
    if (testEmailValid($emailSA)){
        header("Location: ../editSchoolAdminProfile.php?error=emailinvalid");
        exit();
    }

    updateSchoolAdminInformation($con, $fullnameSA, $phoneNumSA, $position, $emailSA);
}

else {
    header("Location: ../editSchoolAdminProfile.php");
}

?>
