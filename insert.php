<?php

require 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $maritial_status = $_POST['maritial-status'];
    if (!empty($_POST['marriage_date'])) {
        $marriage_date = $_POST['marriage_date'];
        $marriage_date = date("Y-m-d", strtotime($marriage_date));
    } else {
        $marriage_date = '';
    }
    // echo $marriage_date; 
    $salary = $_POST['salary'];
    $country = $_POST['country-list'];
    $state = $_POST['state-list'];
    $about = $_POST['about'];
    $hobby = $_POST['hobby']; //var_dump($hobby);
    $status = $_POST['status'];
    $hobbies = "";

    $checkEmail = checkEmail($email);
    if ($checkEmail == 0) {
?>
        <script>
            alert('This email is already taken');
            window.history.back();
        </script>
        <?php
    } else {

        // convert array into string
        foreach ($hobby as $values) {
            $hobbies .=  $values . ',';
        }

        // select country
        $query_country = "SELECT country_name FROM country WHERE id = '$country'";
        $result_country = mysqli_query($con, $query_country);
        $row_country = mysqli_fetch_array($result_country);
        $country_name = $row_country['country_name'];

        // select state
        $query_state = "SELECT state_name FROM state WHERE state_name = '$state'";
        $result_state = mysqli_query($con, $query_state);
        $row_state = mysqli_fetch_array($result_state);
        $state_name = $row_state['state_name'];

        $query = "INSERT INTO employee (name, email, gender, maritial_status, marriage_date, salary, country, state, about, hobby, status) VALUES ('$name', '$email', '$gender', '$maritial_status', '$marriage_date',  '$salary', '$country_name', '$state_name', '$about', '$hobbies', '$status')";
        $result = mysqli_query($con, $query);

        if ($result) {
        ?>

            <script>
                alert('Record successfully inserted');
                window.location = 'search.php';
            </script>

        <?php
        } else {
        ?>
            <script>
                alert('Something went wrong. Please try again');
                window.history.back();
            </script>

<?php
        }
    }
}

function checkEmail($email)
{
    require 'connect.php';
    $query_email = "SELECT email FROM employee WHERE email = '$email'";
    $result_email = mysqli_query($con, $query_email);
    $row_email = mysqli_num_rows($result_email);

    if ($row_email > 0) {
        return 0;
        // echo "This email is already taken";
        // return false;
    } else {
        return 1;
        // echo "";
        // return true;
    }
}

?>