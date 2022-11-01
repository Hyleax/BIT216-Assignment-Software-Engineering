<?php
session_start();
include ("submitOfferFunction.php");
include ("connection.php");
include("profile.inc.php");

if(isset($_POST['submitOffer_btn'])){
  //get the current volunteer's ID
  $query = "SELECT * FROM volunteer WHERE username = '".$_SESSION['username']."';";
  $result = mysqli_query($con, $query);
  $volunteerID;

  if($result){
    if($result && mysqli_num_rows($result) > 0){
      $volunteer = mysqli_fetch_assoc($result);
      $volunteerID = $volunteer["volunteerID"];
    }
  }

  
  $requestID = $_POST['requestID'];
  if(!empty($_POST['type'])){
    $type = $_POST['type'];
  }
  else{
    $type = "";
  }
  $remark = $_POST['remark'];
  

  addOffer($con, $remark, $volunteerID, $requestID, $type);
}
