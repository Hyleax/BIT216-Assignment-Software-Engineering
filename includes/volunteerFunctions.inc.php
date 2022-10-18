<?php

/**
 * 
 *  FUNCTIONS FOR VOLUNTEER REGISTRATION
 * 
 */
// check if register volunteer input fields are empty
function volunteerRegistrationEmpty($username, $fullName, $phoneNumber, $occupation,$birthdate, $email, $password, $confirmPassword){
    $result;
    if (empty($username) || empty($fullName) || 
        empty($phoneNumber) || empty($occupation) ||
        empty($birthdate) || empty($email) || 
        empty($password) || empty($confirmPassword)) {
            $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//  check if password and confirmPassword are the same
function confirmPassword($password, $confirmPassword){
    $result;
    if ($password !== $confirmPassword){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// check if a password is strong enough
function testPasswordStrength($password){
    $passwordIsWeak;
    if (strlen($password) <= 8){
        $passwordIsWeak = true;
    }
    else{
        $passwordIsWeak = false;
    }
    return $passwordIsWeak;
}

// check if a given email is valid
function testEmailValid($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

// check if a user is old enough to be a volunteer
function checkVolunteerAge($birthdate){
    $result;

    // get system date
    $systemDate = date('Y-m-d');
    $systemDate = explode('-', $systemDate);
    $systemYear = $systemDate[0];
   

    $birthdateArray = date($birthdate);
    $birthdateArray = explode('-', $birthdate);
    $birthYear = $birthdateArray[0];

    $age = $systemDate[0] - $birthdateArray[0];

    if ($age < 16){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;  
}

// check if a given username exists in the DB
function testVolunteerUsernameExists($con, $username){
    $sql = "SELECT username FROM volunteer WHERE username=?";
    
    // initializes a prepared statement
        $stmt = mysqli_stmt_init($con);
            
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../registerVolunteer.php?error=sqlerror");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
                
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
                
        else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
}

// creates a volunteer and adds them to the DB
function createVolunteer($con, $username, $fullName, $phoneNumber, $occupation,$birthdate, $email, $password, $confirmPassword){
    $sql = "INSERT INTO volunteer (volunteerID, username, password, fullname, phoneNum, occupation, dateOfBirth, email) VALUES (?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../registerVolunteer.php?error=sqlerror");
        exit();
    }
    else {

        // gemerate uniqueID and use it as volunteerID
        $volunteerID = uniqid();

        // hash password to prevent hackers from uncovering it
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                        
        mysqli_stmt_bind_param($stmt,
            "ssssssss", $volunteerID, $username,
            $hashedPassword, $fullName, $phoneNumber, 
            $occupation, $birthdate, $email);
            mysqli_stmt_execute($stmt);
                        
            header("Location: ../volunteerRegistrationSuccess.html?volunteerregistration=success");
            exit();
    }
}

/**
 * 
 * FUNCTIONS FOR EDITING VOLUNTEER PROFILE
 * 
 * 
 */

 // check if fields are empty
 function checkEditVolunteerProfileEmpty($fullName, $phoneNumber, $occupation, $birthdate, $email){
    $result;

    if (empty($fullName) || empty($phoneNumber) || empty($occupation) || empty($birthdate) || empty($email)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
 }


 // update volunteer profile
 function updateVolunteerInformation($conn, $fullName, $phoneNumber, $occupation, $birthdate, $email){
    $sql = "UPDATE volunteer SET fullname=?, phoneNum=?, occupation=?, dateOfBirth=?, email=? WHERE username = '".$_SESSION['username']."'";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../editVolunteerProfile.php?error=sqlerror");
        exit();
    }
    else {                        
        mysqli_stmt_bind_param($stmt,
            "sssss", $fullName, $phoneNumber, 
            $occupation, $birthdate, $email);
            mysqli_stmt_execute($stmt);
                        
            header("Location: ../volunteerProfile.php?editprofile=success");
            exit();
    }
 }



 /**
  * FUNCTIONS FOR CHANGING VOLUNTEER PASSWORD 
 *
  */
  // check if fields in change volunteer password are empty
  function checkPasswordFieldsEmpty($oldPassword, $newPassword, $confirmPassword){
    $result;
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
  }


  // check if user has the same password in the DB
  function checkPasswordInDB($conn, $oldPassword){
    $status;
    $sql = "SELECT * FROM volunteer WHERE username = '".$_SESSION['username']."'";
    $result = mysqli_query($conn, $sql);
    $volunteerData = mysqli_fetch_assoc($result);
    $hashedDBPassword = $volunteerData['password'];
    if (!password_verify($oldPassword, $hashedDBPassword)){
        $status = true;
    }
    else{
        $status = false;
    }
    return $status;
  }


  // change a users password
  function changePassword($conn, $newPassword){
    $sql = "UPDATE volunteer SET password=? WHERE username = '".$_SESSION['username']."'";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../changePassword.php?error=sqlerror");
        exit();
    }
    else {

        // hash password to prevent hackers from uncovering it
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                        
        mysqli_stmt_bind_param($stmt,
            "s", $hashedPassword);
            mysqli_stmt_execute($stmt);
                        
            header("Location: ../volunteerProfile.php?changepassword=success");
            exit();
    }
  }