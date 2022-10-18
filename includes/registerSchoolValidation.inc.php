<?php
include "connection.php";
//include "function.php";

if(isset($_POST["registerSchool-btn"])){
    $schoolName = $_POST["schoolName"];
    $schoolAddress = $_POST["schoolAddress"];
    $schoolCity = $_POST["schoolCity"];

    require 'connection.php';
    require 'schoolAdministratorFunction.php';

    if(emptyInputRegisterSchool($schoolName, $schoolAddress, $schoolCity) != false){
        //if is empty return back to registerSchool page
        header("location: ../registerSchool.php?error=emptyInput&schoolName=".$schoolName."&schoolAddress=".$schoolAddress."&schoolCity=".$schoolCity);
        exit();
    }

    if(schoolNameExist($con, $schoolName) != false){
        //if is empty return back to registerSchool page
        header("location: ../registerSchool.php?error=schoolNameTaken&schoolAddress=".$schoolAddress."&schoolCity=".$schoolCity);
        exit();
    }

    createSchool($con, $schoolName, $schoolAddress, $schoolCity);
    
}
else{
    header("location: ../registerSchool.php");
}
