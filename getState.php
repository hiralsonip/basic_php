<?php

require 'connect.php';
$country_id = $_POST['country_id'];

if ($country_id) {
    $query = "SELECT * FROM state WHERE country_id = '$country_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
?>

            <option value="<?php echo $row['state_name']; ?>" <?php if (!empty($_POST['state'])) {
                                                                    if ($_POST['state'] == $row['state_name']) {
                                                                        echo "selected";
                                                                    }
                                                                } ?>>
                <?php echo $row['state_name']; ?>
            </option>
        <?php
        }
    } else {
        ?>
        <option value="<?php //echo "State is not available" 
                        ?>">State is not available</option>
<?php
    }
}
?>