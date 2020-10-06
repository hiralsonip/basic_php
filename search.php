<?php

require 'connect.php';

// select country
$sql_all_country = 'SELECT * FROM country';
$result_all_country = mysqli_query($con, $sql_all_country);

// select hobbies
$sql_all_hobbies = 'SELECT * FROM hobbies';
$result_all_hobbies = mysqli_query($con, $sql_all_hobbies);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Search</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="css/all.min.css" rel="stylesheet" type="text/css" />
   <link href="css/style.css" rel="stylesheet" type="text/css" />
   <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>

   <script type="text/javascript" src="js/tablesorter.min.js"></script>
   <script type="text/javascript" src="js/tablesorter.widget.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/jquery.tablesorter.pager.min.css" integrity="sha512-TWYBryfpFn3IugX13ZCIYHNK3/2sZk3dyXMKp3chZL+0wRuwFr1hDqZR9Qd5SONzn+Lja10hercP2Xjuzz5O3g==" crossorigin="anonymous" />

</head>

<body>
   <div class="practical-wrapper">
      <div class="container">
         <form action="" method="post" name="search" id="search">
            <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="submit-btn" class="submit-btn">
                     <input type="button" value="Add a New" id="button" onclick="window.location.href='index.php'" />
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="user-name">
                     <label for="firstName">Name : </label>
                     <input type="text" id="firstName" placeholder="Enter Your Name" name="firstname">
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="gender">
                     <label for="email">Gender : </label>
                     <fieldset>
                        <label for="gender_3" class="gender-select">
                           <input type="radio" id="gender_3" name="gender" value=""> All
                        </label>
                        <label for="gender_1" class="gender-select">
                           <input type="radio" id="gender_1" name="gender" value="male"> Male
                        </label>
                        <label for="gender_2" class="gender-select">
                           <input type="radio" id="gender_2" name="gender" value="female"> Female
                        </label>
                     </fieldset>
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="country">
                     <label id="dropdown-label" for="country-list" class="question">Country : </label>
                     <select name="country" id="country-list" class="country-list">
                        <option value disabled selected>-Please select-</option>
                        <option value="">All</option>

                        <?php

                        while ($row_country = mysqli_fetch_array($result_all_country)) {
                        ?>

                           <option value="<?php echo $row_country['id']; ?>">
                              <?php echo $row_country['country_name'];  ?>
                           </option>

                        <?php

                        }

                        ?>

                     </select>

                  </div>
               </div>

               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="state">
                     <label id="dropdown-label" for="state-list" class="question">State : </label>
                     <select id="state-list" name="state-list" class="state-list">
                        <option value disabled selected>-Please select-</option>
                     </select>
                  </div>
               </div>

               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="status">
                     <label id="dropdown-label" class="question">Status : </label>
                     <select id="status" name="status">
                        <option value="">All</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                     </select>
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="submit-btn" class="submit-btn">
                     <input type="submit" value="Search" id="submit" name="submit" />
                  </div>

                  <div id="reset-btn" class="submit-btn">
                     <input type="reset" value="Reset" id="reset" name="reset" />
                  </div>
               </div>

         </form>
         <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="serach-table">
               <!-- Search and pagination table will print here -->
            </div>
         </div>
      </div>
   </div>
   </div>
</body>

</html>

<script>
   $(document).ready(function() {
      $("table").tablesorter();

      // reset button
      
      $("#reset").click(function () 
      { 
         $(":reset");
         $("#state-list").empty();
         $("#state-list").prop("disabled", true);
         load_data();
      });

      // searching with ajax
      $("#submit").click(function(e) {
         e.preventDefault();
         var name = $("#firstName").val();
         var gender = $("input[name='gender']:checked").val();
         var country = $("#country-list").val();
         var state = $("#state-list").val();
         var status = $("#status").val();

         $.ajax({
            type: "POST",
            url: "search_function.php",
            data: {
               name: name,
               gender: gender,
               country: country,
               state: state,
               status: status
            },
            success: function(response) {
               $(".serach-table").html(response);
            }
         });
      });

      // dependent dropdown box - country and state
      $("#country-list").on('change', function() {
         var country_id = $(this).val();
         // console.log(country_id);
         if (country_id) {
            $.ajax({
               type: "POST",
               url: "getState.php",
               data: "country_id=" + country_id,
               success: function(data) {
                  $("#state-list").prop("disabled", false);
                  $("#state-list").html('<option value="">All</option>');
                  $("#state-list").append(data);
               }
            });
         } else {
            // $("#state-list").html("<option>Select country first</option>");
            $("#state-list").empty();
            $("#state-list").prop("disabled", true);
         }
      });


      var country_id = $("#country-list").val();
      var state = "<?php
                     if (!empty($_POST['state-list'])) {
                        echo $_POST['state-list'];
                     }
                     ?>";
      console.log(state);
      if (country_id) {
         $.ajax({
            type: "POST",
            url: "getState.php",
            // data: "country_id="+country_id,
            data: {
               country_id: country_id,
               state: state
            },
            success: function(data) {
               $("#state-list").prop("disabled", false);
               $("#state-list").html('<option value="">All</option>');
               $("#state-list").append(data);
            }
         });
      } else {
         // $("#state-list").html("<option>Select country first</option>");
         $("#state-list").empty();
         $("#state-list").prop("disabled", true);
      }

      // pagination limit
      load_data();
      $(document).on("click", ".pagination-links", function () 
      {
         var page = $(this).attr("id");
         var name = $("#firstName").val();
         var gender = $("input[name='gender']:checked").val();
         var country = $("#country-list").val();
         var state = $("#state-list").val();
         var status = $("#status").val();

         $.ajax({
            type: "POST",
            url: "search_function.php",
            data: {
               name: name,
               gender: gender,
               country: country,
               state: state,
               status: status,
               page: page
            },
            success: function(response) {
               $(".serach-table").html(response);
            }
         });
      });

      function load_data(page) 
      {
         $.ajax({
            type: "POST",
            url: "search_function.php",
            data: {
               page: page
            },
            success: function(response) {
               $(".serach-table").html(response);
            }
         });
      }


   });
</script>