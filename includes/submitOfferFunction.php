<?php

function addOffer($con, $remark, $volunteerID, $requestID, $type){
    $systemDate = date('Y-m-d H:i:s');
    $status = "PENDING";

    //insert a new offer details
    $sql = "INSERT INTO offer (offerStatus, offerID, offerDate, remarks, volunteerID) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../submitOffer.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $status, $offerID, $systemDate, $remark, $volunteerID);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // get the last offerID in offer table
    $lastOfferID = mysqli_insert_id($con);

    //if the request type value is empty
    if($type == ""){
        //update tutorial's offerID
        $update = "UPDATE tutorial SET offerID = ? WHERE requestID = ?;";
        $stmt2 = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt2, $update)){
            header("location: ../submitOffer.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt2, "is", $lastOfferID, $requestID);

        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
    //else if the request type value is not empty
    else{
        //update tutorial's offerID
        $update2 = "UPDATE resource SET offerID = ? WHERE requestID = ?;";
        $stmt3 = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt3, $update2)){
            header("location: ../submitOffer.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt3, "is", $lastOfferID, $requestID);

        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
    }

    header("location: ../viewRequests.php?error=success");
     exit();
    
}
