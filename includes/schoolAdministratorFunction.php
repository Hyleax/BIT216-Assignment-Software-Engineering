<?php

/**
 * 
 * functions for register school
 * 
 */

//check register school input fields are empty
function emptyInputRegisterSchool($schoolName, $schoolAddress, $schoolCity){
    //if school name, address or city input fields is empty
    if(empty($schoolName) || empty($schoolAddress) || empty($schoolCity)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

//check user input for school name whether exists in DB
function schoolNameExist($con, $schoolName){
    $sql = "SELECT * FROM school WHERE schoolname = ?;";
    $stmt = mysqli_stmt_init($con);

    //initializea a prepared statement
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registerSchool.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $schoolName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//create a new school data and insert into DB
function createSchool($con, $schoolName, $schoolAddress, $schoolCity){
    //create new school information
    $sql = "INSERT INTO school (schoolID, schoolName, schoolAddress, city ) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registerSchool.php?error=stmtFailed");
        exit();
    }

    //schoolID is an auto increment key
    mysqli_stmt_bind_param($stmt, "ssss", $schoolID, $schoolName
        , $schoolAddress, $schoolCity);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //redirect user to register school admin page after created a new school
    header("location: ../redirectRegisterSA.html");
    exit();
    
}

/**
 * 
 * functions for register school admin
 * 
 */


//check register school admin input fields are empty
function emptyInputRegisterSchoolAdmin($username, $fullname, $position, $email, $password, $confirmPassword){
    if(empty($username) || empty($fullname) || empty($position) || empty($email) || empty($password) || empty($confirmPassword)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

//check the input of email
function testEmailValid($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

//check password input matches with the criteria
function testPasswordStrength($password){
    if (strlen($password) <= 8 && !(!ctype_lower($password))){
        $passwordIsWeak = true;
    }
    else{
        $passwordIsWeak = false;
    }
    return $passwordIsWeak;
}

//check the input of pasword and repeat password are the same
function confirmPassword($password, $confirmPassword){
    //$result;
    if ($password !== $confirmPassword){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//check user input for username whether exists in DB
function testSAUsernameExists($con, $username){
    $sql = "SELECT * FROM schooladministrator WHERE username = ?;";
    $stmt = mysqli_stmt_init($con);

    //initializea a prepared statement
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registerSchoolAdmin.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//create new school admin and insert into DB
function createSchoolAdmin($con, $username, $password, $fullname, $email, $phoneNum, $position){
    require "connection.php";

    //get the last schoolID from school table
    $query = "SELECT * FROM school ORDER BY schoolID DESC LIMIT 1;";
    $result = mysqli_query($con, $query);

    if($result){
        if($result && mysqli_num_rows($result) > 0){
            $school_data = mysqli_fetch_assoc($result);
        }
    }

    $schoolID = $school_data["schoolID"];

    //insert new data for schooladministrator table based on user input
    $sql = "INSERT INTO schooladministrator (username, password, fullname, email, phoneNum, staffID, position, schoolID) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../registerSchoolAdmin.php?error=stmtFailed");
        exit();
    }

    //staffID is an auto increment key
    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $password, $fullname, $email, $phoneNum, $staffID, $position, $schoolID);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //echo '<script language="javascript">';
    //echo 'alert("School Aministrator registered successfully!")';
    //echo '</script>';
    header("location: ../superAdminProfile.php?createSchoolAdmin=success");
    exit();
}


/**
 * 
 * function for change password
 */

 //check the input fields are empty
function checkPasswordInput($oldPassword, $newPassword, $newPasswordAgain){
    if(empty($oldPassword) || empty($newPassword) || empty($newPasswordAgain)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

//check the old password input is same as the password that store in the DB
function checkDBPassword($con, $oldPassword){
    $query = "SELECT * FROM schooladministrator WHERE username='".$_SESSION['username']."';";
    $result = mysqli_query($con, $query);

    $schoolAdminData = mysqli_fetch_assoc($result);

    if($oldPassword <> $schoolAdminData["password"]){
        $isTrue = true;
    }
    else{
        $isTrue = false;
    }

    return $isTrue;
}

//check password input matches with the criteria 
function checkPasswordStrength($newPassword){
    if (strlen($newPassword) <= 8 && !(!ctype_lower($newPassword))){
        $passwordIsWeak = true;
    }
    else{
        $passwordIsWeak = false;
    }
    return $passwordIsWeak;
}

//check the input of old pasword and new password are not the same
function checkSamePassword($oldPassword, $newPassword){
    if($oldPassword <> $newPassword){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

//update the schooladministrator's account password
function changePassword($con, $newPassword){
    $query = "UPDATE schoolAdministrator SET password=? WHERE username='".$_SESSION["username"]."';";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../changeSchoolAdminPassword.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $newPassword);
        mysqli_stmt_execute($stmt);

        header("location: ../schoolAdmin.php?changepassword=success");
        exit();
    }
}

/**
 * 
 * function for edit schooladministrator profile
 */

 //check the input fields are empty
function checkEditSchoolAdminProfileEmpty($fullnameSA, $phoneNumSA, $position, $email){
    if (empty($fullnameSA) || empty($phoneNumSA) || empty($position) || empty($email)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//update schooladministrator information based on user input
function updateSchoolAdminInformation($con, $fullnameSA, $phoneNumSA, $position, $emailSA){
    $sql = "UPDATE schoolAdministrator SET fullname=?, email=?, phoneNum=?, position=? WHERE username = '".$_SESSION['username']."'";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../editSchoolAdminProfile.php?error=sqlerror");
        exit();
    }
    else {                        
        mysqli_stmt_bind_param($stmt,
            "ssss", $fullnameSA, $emailSA, 
            $phoneNumSA, $position);
            mysqli_stmt_execute($stmt);
                        
            header("Location: ../schoolAdmin.php?editprofile=success");
            exit();
    }
}
