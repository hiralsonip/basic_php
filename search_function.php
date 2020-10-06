<?php

include 'connect.php';

$limit = 4;
$output = '';

if (isset($_POST['page'])) 
{
    $page = $_POST['page'];
} 
else 
{
    $page = 1;
}

$start = ($page - 1) * $limit;


if (empty($_POST['name']) && empty($_POST['gender']) && empty($_POST['country']) && empty($_POST['state']) && empty($_POST['status'])) 
{
    $sql_search = "SELECT * FROM employee LIMIT $start, $limit";
    $sql_num_row = "SELECT * FROM employee";
    $result_num_row = mysqli_query($con, $sql_num_row);
    $total_rows = mysqli_num_rows($result_num_row);
} 
else 
{
    $whereas = array();
    $sql_search = "SELECT * FROM employee WHERE ";

    if (isset($_POST['name']) and !empty($_POST['name'])) {
        $whereas[] = "name like '%{$_POST['name']}%' ";
    }

    if (isset($_POST['gender']) and !empty($_POST['gender'])) {
        $whereas[] = "gender = '{$_POST['gender']}' ";
    }

    if (isset($_POST['country']) and !empty($_POST['country'])) {

        $country = $_POST['country'];
        // select country
        $query_country = "SELECT country_name FROM country WHERE id = '$country'";
        $result_country = mysqli_query($con, $query_country);
        $row_country = mysqli_fetch_array($result_country);
        $country_name = $row_country['country_name'];

        $whereas[] = "country = '{$country_name}' ";
    }

    if (isset($_POST['state']) and !empty($_POST['state'])) {
        $whereas[] = "state = '{$_POST['state']}' ";
    }

    if (isset($_POST['status']) and !empty($_POST['status'])) {
        $whereas[] = "status = '{$_POST['status']}' ";
    }

    foreach ($whereas as $where) {
        $sql_search .= $where . ' AND ';
    }
    $sql_search_num_row = rtrim($sql_search, "AND ");

    $result_num_row = mysqli_query($con, $sql_search_num_row);
    $total_rows = mysqli_num_rows($result_num_row);

    $sql_search = $sql_search_num_row . " LIMIT $start, $limit";
    // echo $sql_search; 
    // $result = mysqli_query($con, $sql_search);
}

$result = mysqli_query($con, $sql_search);
$count = $start + 1;
$output = '';
$output .= "<table class='tablesorter'>
            <tbody>
                <tr>
                    <th style='width:50px;'>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";
while ($row = mysqli_fetch_array($result)) 
{
    $output .= '<tr>
    <td>'. $count .'</td>
    <td>'. $row["name"] .'</td>
    <td>'. $row["email"] .'</td>
    <td>'. $row["gender"] .'</td>
    <td>'. $row["country"] .'</td>
    <td>'. $row["state"] .'</td>
    <td>'. $row["status"] .'</td>
    <td> <a href="edit.php?id='. $row["id"] .'">Edit</a> | <a href="delete.php?id='. $row["id"].'" class="delete" onclick="return confirm("Do you really want to delete this record?");">Delete</a></td>
    </tr>';
    $count++;
}

$output .= '</tbody></table><br><div align="center">';

// $sql_page_count = "SELECT * FROM employee";
// $res_page_count = mysqli_query($con, $sql_page_count);
// $total_page = mysqli_num_rows($res_page_count);
$pages = ceil($total_rows / $limit);
for ($i=1; $i <= $pages; $i++) 
{ 
    if ($i == $page) 
    {
        $output .= '<span class="pagination-links" 
                style="cursor:pointer; border: 1px solid darkgray; padding:6px; background-color: #d7d7d7;" id="'. $i .'">'. $i .'</span>';
    }
    else
    {
        $output .= '<span class="pagination-links" 
                style="cursor:pointer; border: 1px solid darkgray; padding:6px;" id="'. $i .'">'. $i .'</span>';
    }
    
}
$output .= '</div>';
echo $output;
