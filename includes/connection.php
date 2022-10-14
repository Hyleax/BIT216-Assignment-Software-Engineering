<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "colteach";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname))
{
    die("Failed to connect!");
}