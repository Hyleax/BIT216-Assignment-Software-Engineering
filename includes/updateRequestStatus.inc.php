<?php
session_start();

include ("connection.php");
include("profile.inc.php");

$status = "ACCEPTED";
$status2 = "REJECTED";
$status3 = "CLOSED";

if(isset($_POST["acceptBtn"])){
    //update the selected offer status to accepted
    $update = "UPDATE offer SET offerStatus = ? WHERE offerID = '".$_POST['offerID']."';";
    $stmt = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt, $update)){
        header("location: ../submitOffer.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //update the other offers to rejected
    $update2 = "UPDATE offer SET offerStatus = ? WHERE offerID != '".$_POST['offerID']."' AND requestID = '".$_POST['requestID']."';";
    $stmt2 = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt2, $update2)){
        header("location: ../submitOffer.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt2, "s", $status2);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    $queryR = "SELECT * FROM resource WHERE requestID = '".$_POST['requestID']."';";
    $resultR = mysqli_query($con, $queryR);

    $queryT = "SELECT * FROM tutorial WHERE requestID = '".$_POST['requestID']."';";
    $resultT = mysqli_query($con, $queryT);

    if($resultR && mysqli_num_rows($resultR)){
        $update3 = "UPDATE resource SET requestStatus = ? WHERE requestID = '".$_POST['requestID']."';";
        $stmt3 = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt3, $update3)){
            header("location: ../submitOffer.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt3, "s", $status3);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
    }

    if($resultT && mysqli_num_rows($resultT)){
        $update3 = "UPDATE tutorial SET requestStatus = ? WHERE requestID = '".$_POST['requestID']."';";
        $stmt3 = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt3, $update3)){
            header("location: ../submitOffer.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt3, "s", $status3);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
    }

    header("location: ../schoolAdminProfile.php?acceptOffer=success");
    exit();
}

if(isset($_POST["rejectBtn"])){
    $update4 = "UPDATE offer SET offerStatus = ? WHERE offerID = '".$_POST['offerID']."';";
    $stmt4 = mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($stmt4, $update4)){
        header("location: ../submitOffer.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt4, "s", $status2);
    mysqli_stmt_execute($stmt4);
    mysqli_stmt_close($stmt4);

    header("location: ../schoolAdminProfile.php?rejectOffer=success");
    exit();
}