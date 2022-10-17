<?php
require 'connection.php';
//THIS file can be used by BOTH VOLUNTEER AND SCHOOL ADMIN

// this variable will differ depending if a user is a volunteer or school admin
$userType;
$data = array();

// variables for volunteer
$fullName;
$birthdate;
$occupation;
$email;
$phoneNumber;
$age;

// variables for school admin


// check if username is in the volunteer table 
$volunteerQuery = "SELECT * FROM volunteer WHERE username = '".$_SESSION['username']."'";
$volunteerResult = mysqli_query($con, $volunteerQuery);



if (mysqli_num_rows($volunteerResult) > 0) {
    while($row = mysqli_fetch_assoc($volunteerResult)) {
        $data[] = $row;
    }

    foreach($data as $v){
        $fullName = $v['fullname'];
        $birthdate = $v['dateOfBirth'];
        $occupation = $v['occupation'];
        $email = $v['email'];
        $phoneNumber = $v['phoneNum'];
    }

    // get system date
    $systemDate = date('Y-m-d');
    $systemDate = explode('-', $systemDate);
    $systemYear = $systemDate[0];
   

    $birthdateArray = date($birthdate);
    $birthdateArray = explode('-', $birthdate);
    $birthYear = $birthdateArray[0];

    $age = $systemDate[0] - $birthdateArray[0];
    
    $userType = "Volunteer 💜";
}




//else check if the username is in the school admin table




