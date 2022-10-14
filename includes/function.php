<?php

function emptyInputRegisterSchool($schoolName, $schoolAddress, $schoolCity){
    //$result;

    if(empty($schoolName) || empty($schoolAddress) || empty($schoolCity)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function schoolNameExist($con, $schoolName){
    $sql = "SELECT * FROM school WHERE schoolname = ?;";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: registerSchool.php?error=stmtFailed");
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

function createSchool($con, $schoolName, $schoolAddress, $schoolCity){
    $sql = "INSERT INTO school (schoolID, schoolName, schoolAddress, city ) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: registerSchool.php?error=stmtFailed");
        exit();
    }

    //$hashedPassword = password_hash($passwordm PASSWORD_DEFAULT);
    $schoolID = uniqid();

    mysqli_stmt_bind_param($stmt, "ssss", $schoolID, $schoolName
        , $schoolAddress, $schoolCity);

    mysqli_stmt_execute($stmt);
    //mysqli_stmt_close($stmt);

    //header("location: registerSchoolAdministrator.php");
    //exit();
    
}