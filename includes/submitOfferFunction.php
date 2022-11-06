<?php

function addOffer($con, $remark, $volunteerID, $requestID, $type){
    $systemDate = date('Y-m-d H:i:s');
    $status = "PENDING";
    

    //insert a new offer details
    $sql = "INSERT INTO offer (offerStatus, offerID, offerDate, remarks, volunteerID, requestID) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../submitOffer.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $status, $offerID, $systemDate, $remark, $volunteerID, $requestID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../volunteerProfile.php?submitOffer=success");
    exit();
}
