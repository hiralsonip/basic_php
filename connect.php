<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbDatabase = 'solwin';

$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);

if (!$con) {
    die(mysqli_error($con));
}
