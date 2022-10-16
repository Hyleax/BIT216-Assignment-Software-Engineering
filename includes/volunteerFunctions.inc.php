<?php

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
    if (strlen($password) <= 8 && !(!ctype_lower($password))){
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

// check if a given username exists in the DB
function testUsernameExists($conn, $username){
    $sql = "SELECT username FROM volunteer WHERE username=?";
    
    // initializes a prepared statement
        $stmt = mysqli_stmt_init($conn);
            
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
function createVolunteer($conn, $username, $fullName, $phoneNumber, $occupation,$birthdate, $email, $password, $confirmPassword){
    $sql = "INSERT INTO volunteer (volunteerID, username, password, fullName, phoneNumber, occupation, dateOfBirth, email) VALUES (?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);

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