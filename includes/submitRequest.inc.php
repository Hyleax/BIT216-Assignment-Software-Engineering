<?php
    session_start();
    require_once 'profile.inc.php';

    require 'connection.php';
    require 'requestFunctions.inc.php';

// check if user accessed this file by regular means
if (isset($_POST['submitRequestBtn'])){


    // variables for tutorial request
    $tutorialDescription = $_POST['tutorial-description'];
    $tutorialTime = $_POST['tutorial-time'];
    $studentLevel = $_POST['student-level'];
    $noOfStudents = $_POST['no-of-students'];

    // variables for resource request
    $resourceDescription = $_POST['resource-description'];
    $resourceType = $_POST['resource-type'];
    $noOfResources = $_POST['number-of-resources'];

    // variable to determine request type
    $requestType = $_POST['requestType'];

    // check if the request type submimtted is a tutorial or a resource request
    if ($requestType === "tutorial"){

        // check for empty input in tutorial request
        if (tutorialReqInputEmpty($tutorialDescription, $tutorialTime, $studentLevel, $noOfStudents)){
            header("Location: ../submitRequest.php?error=emptyfields&tutDesc=".$tutorialDescription."&tutTime=".$tutorialTime."&studentLvl=".$studentLevel."&noStudents=".$noOfStudents);
            exit();
        }

        // check if given time is not less than 3 days
        if (tutorialTimeInvalid($tutorialTime)){
            header("Location: ../submitRequest.php?error=timeinvalid&tutDesc=".$tutorialDescription."&studentLvl=".$studentLevel."&noStudents=".$noOfStudents);
            exit();
        }

        // check if no of students is a number
        if (numberIsInvalid($noOfStudents)){
            header("Location: ../submitRequest.php?error=numinvalid&tutDesc=".$tutorialDescription."&tutTime=".$tutorialTime."&studentLvl=".$studentLevel);
            exit();
        }

        createTutorialRequest($con, $staffID, $schoolID, $tutorialDescription, $tutorialTime, $studentLevel, $noOfStudents);

    }

    if ($requestType === 'resource'){

        // check for empty input in resource request
        if (resourceReqInputEmpty($resourceDescription, $resourceType, $noOfResources)){
            header("Location: ../submitRequest.php?error=emptyfields&resDesc=".$resourceDescription."&resType=".$resourceType."&noRes=".$noOfResources);
            exit();
        }

        // check if no of resource is valid
        if (numberIsInvalid($noOfResources)){
            header("Location: ../submitRequest.php?error=numinvalid&resDesc=".$resourceDescription."&resType=".$resourceType);
            exit();
        }

        createResourceRequest($con, $staffID, $schoolID, $resourceDescription, $resourceType, $noOfResources);
    }

      //  close statement
      mysqli_stmt_close($stmt);

      // close connection to the DB
      mysqli_close($con);
}

// if a user does mot access the file by natural means
else {
    header("Location: ../submitRequest.php");
    exit();
}
