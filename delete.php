<?php

include 'connect.php';

$id = $_GET['id'];

$query = "DELETE FROM employee WHERE id = '$id'";
$result = mysqli_query($con, $query);

if ($result) {
?>
    <script>
        alert("Record successfully deleted.");
        window.location = "search.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Something went wrong. Please try again.");
    </script>

<?php
}

?>