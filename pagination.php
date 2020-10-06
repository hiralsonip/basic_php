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

$query = "SELECT * FROM employee LIMIT $start, $limit";
$result = mysqli_query($con, $query);
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
                    <td>'. $row["id"] .'</td>
                    <td>'. $row["name"] .'</td>
                    <td>'. $row["email"] .'</td>
                    <td>'. $row["gender"] .'</td>
                    <td>'. $row["country"] .'</td>
                    <td>'. $row["state"] .'</td>
                    <td>'. $row["status"] .'</td>
                    <td> <a href="edit.php?id='. $row["id"] .'">Edit</a> | <a href="delete.php?id='. $row["id"].'" class="delete" onclick="return confirm("Do you really want to delete this record?");">Delete</a></td>
                </tr>';
}

$output .= '</tbody></table><br><div align="center">';

$sql_page_count = "SELECT * FROM employee";
$res_page_count = mysqli_query($con, $sql_page_count);
$total_page = mysqli_num_rows($res_page_count);
$pages = ceil($total_page / $limit);
for ($i=1; $i <= $pages; $i++) 
{ 
    $output .= '<span class="pagination-links" style="cursor:pointer; border: 1px solid darkgray; padding:6px;" id="'. $i .'">'. $i .'</span>';
}
$output .= '</div>';


$previous = $page - 1;
$next = $page + 1;

echo $output;