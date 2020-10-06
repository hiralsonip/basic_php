<?php

require 'connect.php';
$email = $_POST['email'];

// unique email id check for - Edit page
if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $query_email = "SELECT email FROM employee WHERE email = '$email' AND id != '$id'";
}
// unique email id check for - Insert page
else {
    $query_email = "SELECT email FROM employee WHERE email = '$email'";
}

$result_email = mysqli_query($con, $query_email);
$row_email = mysqli_num_rows($result_email);

if ($row_email > 0) {
    echo "This email is already taken";
} else {
    echo "";
}
