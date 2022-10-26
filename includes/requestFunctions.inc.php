<?php
/**
 * 
 * FUNCTIONS FOR REQUESTS
 * 
 */

 // TUTORIAL REQUEST VALIDATION

// check if tutorial request inputs are empty
function tutorialReqInputEmpty($tutorialDescription, $tutorialTime, $studentLevel, $noOfStudents){
    $result;
    if (empty($tutorialDescription) || empty($tutorialTime) 
        || $studentLevel === "Select student level..." || empty($studentLevel)){
        $result = true;    
    }

    else {
        $result = false;
    }

    return $result;
}

// check if given time is not less than 3 days
function tutorialTimeInvalid($tutorialTime){
    $result;
    $tutorialDate = strtotime($tutorialTime);
    $systemDate = strtotime(date('Y-m-d'));
    $seconds = $tutorialDate - $systemDate;
    if ($seconds < (86400 * 3)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


// check if no of students is invalid
function numberIsInvalid($input){
    $result;
    if (is_numeric($input)){
        $result = false;
    }
    else {
        $result = true;
    }
    return $result;
}

// create a tutorial request and store it in the DB
function createTutorialRequest($con, $staffID, $schoolID, $tutorialDescription, $tutorialTime, $studentLevel, $noOfStudents){
    $sql = "INSERT INTO tutorial (requestID, requestDate, description, requestStatus, staffID, schoolID, studentLevel, studentNum, tutorialDate) VALUES (?,?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../submitRequest.php?error=sqlerror");
        exit();
    }
    else {

        $requestID = uniqid();
        $requestDate = date('Y-m-d');
        $requestStatus = "NEW";
                        
        mysqli_stmt_bind_param($stmt,
            "sssssssss",$requestID, $requestDate, $tutorialDescription,
            $requestStatus, $staffID, $schoolID, $studentLevel, 
            $noOfStudents, $tutorialTime);
            mysqli_stmt_execute($stmt);
                        
            header("Location: ../schoolAdminProfile.php?submitrequest=success");
            exit();
    }
}


// RESOURCE REQUEST VALIDATION

// check if resource requests inputs are empty
function resourceReqInputEmpty($resourceDescription, $resourceType, $noOfResources){
    $result;
    if (empty($resourceDescription)|| $resourceType === "Select resource type..." || empty($noOfResources)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


// create a resource request and store it in the DB
function createResourceRequest($con, $staffID, $schoolID, $resourceDescription, $resourceType, $noOfResources){
    $sql = "INSERT INTO resource (requestID, requestDate, description, requestStatus, staffID, schoolID, resourceType, requireNum) VALUES (?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../submitRequest.php?error=sqlerror");
        exit();
    }
    else {

        $requestID = uniqid();
        $requestDate = date('Y-m-d');
        $requestStatus = "NEW";
                        
        mysqli_stmt_bind_param($stmt,
            "ssssssss",$requestID, $requestDate, $resourceDescription,
            $requestStatus, $staffID, $schoolID, $resourceType, $noOfResources);
            mysqli_stmt_execute($stmt);
                        
            header("Location: ../schoolAdminProfile.php?submitrequest=success");
            exit();
    }
}