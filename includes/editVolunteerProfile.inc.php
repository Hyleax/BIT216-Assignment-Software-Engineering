<?php
session_start();

// check if user accessed this file by regular means
if (isset($_POST['editVolunteerProfile-btn'])){

    // require is used when the file is mandatory for the application
    require 'dbh.inc.php';
    require 'volunteerFunctions.inc.php';

    // collecting the variables from registerVolunteer.php
    $fullName = $_POST['fullname'];
    $phoneNumber = $_POST['phoneNumber'];
    $occupation = $_POST['occupation'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];

    
    // check if fields are empty
    if (checkEditVolunteerProfileEmpty($fullName, $phoneNumber, $occupation, $birthdate, $email)){
        header("Location: ../editVolunteerProfile.php?error=emptyfields&fullname=$fullName.phonenumber=&$phoneNumber.occupation=&$occupation.birthdate=&$birthdate.&$email");
        exit();
    }

    // check if email is valid
    if (testEmailValid($email)){
        header("Location: ../editVolunteerProfile.php?error=emailinvalid&fullname=".$fullName."&phoneNumber=".$phoneNumber."&occupation=".$occupation."&birthdate=".$birthdate);
        exit();
    }

    updateVolunteerInformation($conn, $fullName, $phoneNumber, $occupation, $birthdate, $email);
}

else {
    header("Location: ../editVolunteerProfile.php");
}

?>