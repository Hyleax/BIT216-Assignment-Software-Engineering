<?php

require 'connection.php';

// SQL statements for both resource and volunteer tables
$queryResource = "SELECT * FROM resource INNER JOIN school ON resource.schoolID = school.schoolID;";
$queryTutorial = "SELECT * FROM tutorial INNER JOIN school ON tutorial.schoolID = school.schoolID;";

// querying the resource and volunteer tables
$resourceResult =  mysqli_query($con, $queryResource);
$tutorialResult =  mysqli_query($con, $queryTutorial);

// initializing array to store both tutorial and resource requests
$combinedRequestsArray  = array();

// first store resource requests
while ($row = mysqli_fetch_assoc($resourceResult)){
    $combinedRequestsArray[] = $row;
}

// then store tutorial requests
while ($row = mysqli_fetch_assoc($tutorialResult)){
    $combinedRequestsArray[] = $row;
}

// return the response in JSON format
echo json_encode($combinedRequestsArray);

