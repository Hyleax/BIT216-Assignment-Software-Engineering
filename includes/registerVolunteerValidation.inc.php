<?php

// check if user accessed this file by regular means
if (isset($_POST['volunteerRegister-btn'])) {
    
        // require is used when the file is mandatory for the application
        require 'dbh.inc.php';

        // collecting the variables from registerVolunteer.php
        $username = $_POST['username'];
        $fullName = $_POST['fullname'];
        $phoneNumber = $_POST['username'];
        $occupation = $_POST['occupation'];
        $birthdate = $_POST['birthdate'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $ID = 0;

        // check if fields are empty
        // headers cannot be indented
        if (empty($username) || empty($fullName) || 
            empty($phoneNumber) || empty($occupation) ||
            empty($birthdate) || empty($email) || 
            empty($password) || empty($confirmPassword)) {
                header("Location: ../registerVolunteer.php?error=emptyfields&username=".$username."&fullname=".$fullName."&phoneNumber=".$phoneNumber."&occupation=".$occupation."&birthdate=".$birthdate."&email=".$email);
                exit();
        }

        // check if email is valid
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../registerVolunteer.php?error=emailinvalid&username=".$username."&fullname=".$fullName."&phoneNumber=".$phoneNumber."&occupation=".$occupation."&birthdate=".$birthdate);
            exit();
        }

        // check if password is strong enough
        else if(strlen($password) <= 8 && !(!ctype_lower($password))) {
            header("Location: ../registerVolunteer.php?error=passworkweak&username=".$username."&fullname=".$fullName."&phoneNumber=".$phoneNumber."&occupation=".$occupation."&birthdate=".$birthdate."&email=".$email);
            exit();
        }

        // check if password and confirmPassword are the same
        else if ($password !== $confirmPassword){
            header("Location: ../registerVolunteer.php?error=passwordwrong&username=".$username."&fullname=".$fullName."&phoneNumber=".$phoneNumber."&occupation=".$occupation."&birthdate=".$birthdate."&email=".$email);
            exit();
        }

        //check if username is already taken
        else {
            $sql = "SELECT username FROM volunteer WHERE username=?";

            //initializes a statement
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../registerVolunteer.php?error=sqlerror");
                exit();
            }

            else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0){
                    header("Location: ../registerVolunteer.php?error=usernametaken&fullname=".$fullName."&phoneNumber=".$phoneNumber."&occupation=".$occupation."&birthdate=".$birthdate."&email=".$email);
                exit();
                }
                else {

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
            }
        }

        //  close statement
        mysqli_stmt_close($stmt);

        // close connection to the DB
        mysqli_close($conn);
}

// if a user does mot access the file by natural means
else {
    header("Location: ../registerVolunteer.php");
    exit();
}
