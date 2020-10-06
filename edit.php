<?php

require_once 'connect.php';
$id = $_GET['id'];

function checkEmail($email)
{
   require 'connect.php';
   $id = $_GET['id'];
   $query_email = "SELECT email FROM employee WHERE email = '$email' AND id != '$id'";
   $result_email = mysqli_query($con, $query_email);
   $row_email = mysqli_num_rows($result_email);

   if ($row_email > 0) {
      return 0;
   } else {
      return 1;
   }
}

// get data for this id
$sql_get_all_data = "SELECT * FROM employee WHERE id = '$id'";
$result_all_data = mysqli_query($con, $sql_get_all_data);
$row_all_data = mysqli_fetch_array($result_all_data);

// select country
$sql_all_country = 'SELECT * FROM country';
$result_all_country = mysqli_query($con, $sql_all_country);

// select hobbies
$sql_all_hobbies = 'SELECT * FROM hobbies';
$result_all_hobbies = mysqli_query($con, $sql_all_hobbies);

// update data
if (isset($_POST['submit'])) {
   $name = $_POST['firstname'];
   $email = $_POST['email'];
   $gender = $_POST['gender'];
   $maritial_status = $_POST['maritial-status'];
   if ($_POST['marriage_date']) {
      $marriage_date = $_POST['marriage_date'];
      $marriage_date = date("Y-m-d", strtotime($marriage_date));
   } else {
      $marriage_date = '';
   }
   $salary = $_POST['salary'];
   $country = $_POST['country-list'];
   $state = $_POST['state-list'];
   $about = $_POST['about'];
   $hobby = $_POST['hobby']; //var_dump($hobby);
   $status = $_POST['status'];
   $hobbies = "";

   // Check unique email address
   $checkEmail = checkEmail($email);
   if ($checkEmail == 0) {
?>
      <script>
         alert('This email is already taken');
      </script>
      <?php
   } else {

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

      // convert array into string
      foreach ($hobby as $values) {
         $hobbies .=  $values . ',';
      }

      $query_update = "UPDATE employee SET name = '$name', email = '$email', gender = '$gender', maritial_status = '$maritial_status', marriage_date = '$marriage_date', salary = '$salary', country = '$country_name', state = '$state_name', about = '$about', hobby = '$hobbies', status = '$status' WHERE id = '$id'";
      $result_update = mysqli_query($con, $query_update);

      if ($result_update) {
      ?>
         <script>
            alert('Data updated successfully.');
            window.location = "search.php";
         </script>
      <?php
      } else {
      ?>
         <script>
            alert('Something wentwrong. Please try again.');
         </script>

<?php
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Practical</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="css/all.min.css" rel="stylesheet" type="text/css" />
   <link href="css/style.css" rel="stylesheet" type="text/css" />
   <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>

<body>
   <div class="practical-wrapper">
      <div class="container">
         <h2>Edit</h2>
         <form action="" method="post" name="registration" id="registration">
            <div class="row">
               <!-- First name -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="user-name">
                     <label for="firstName">Name : </label>
                     <input type="text" id="firstName" placeholder="Enter Your Name" name="firstname" value="<?php echo $row_all_data['name']; ?>">
                  </div>
               </div>

               <!-- Email -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="user-email">
                     <label for="email">Email : </label>
                     <input type="email" id="email" placeholder="Enter Your Email" name="email" value="<?php echo $row_all_data['email']; ?>">
                  </div>
               </div>

               <!-- Gender -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="gender">
                     <label for="genderName">Gender : </label>
                     <fieldset>
                        <label for="gender_1" class="gender-select">
                           <input type="radio" id="gender_1" name="gender" value="male" <?php if ($row_all_data['gender'] == 'male') {
                                                                                             echo 'checked';
                                                                                          }  ?>> Male
                        </label>
                        <label for="gender_2" class="gender-select">
                           <input type="radio" id="gender_2" name="gender" value="female" <?php if ($row_all_data['gender'] == 'female') {
                                                                                             echo 'checked';
                                                                                          }  ?>> Female
                        </label>
                        <label for="gender"> </label>
                     </fieldset>
                  </div>
               </div>

               <!-- mariial status -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="marital">
                     <label for="maritial-status" id="dropdown-label" class="question">Marital status:</label>
                     <select id="maritial-status" class="maritial-status" name="maritial-status">
                        <option value disabled selected>-Please select-</option>
                        <option value="Married" <?php if ($row_all_data['maritial_status'] == 'Married') {
                                                   echo 'selected';
                                                }  ?>>Married</option>
                        <option value="Unmarried" <?php if ($row_all_data['maritial_status'] == 'Unmarried') {
                                                      echo 'selected';
                                                   } ?>>Unmarried</option>
                     </select>
                  </div>
               </div>

               <!-- Marriage date -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="marriage" id="marriage">
                     <label for="marriage-date" name="marriage-date">Marriage Date : </label>
                     <input type="text" id="marriage-date" value="<?php echo $row_all_data['marriage_date']; ?>" name="marriage_date">
                  </div>
               </div>

               <!-- salary -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="salary">
                     <label for="salary">Salary : </label>
                     <input type="text" id="salary" placeholder="PLease enter your salary" name="salary" value="<?php echo $row_all_data['salary']; ?>">
                  </div>
               </div>

               <!-- country list -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="country">
                     <label id="dropdown-label" for="country-list" class="question">Country : </label>
                     <select name="country-list" id="country-list" class="country-list">
                        <option value disabled selected>-Please select-</option>

                        <?php

                        while ($row = mysqli_fetch_array($result_all_country)) {
                        ?>

                           <option value="<?php echo $row['id']; ?>" <?php if ($row_all_data['country'] == $row['country_name']) {
                                                                        echo 'selected';
                                                                     }  ?>> <?php echo $row['country_name'];  ?>
                           </option>

                        <?php
                        }
                        ?>

                     </select>
                  </div>
               </div>

               <!-- state list -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="state">
                     <label id="dropdown-label" for="state-list" class="question">State : </label>
                     <select id="state-list" name="state-list" class="state-list">
                        <option value disabled selected>-Please select-</option>
                     </select>
                  </div>
               </div>

               <!-- About -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="about">
                     <label for="about">About : </label>
                     <textarea rows="3" name="about"> <?php echo $row_all_data['about']; ?></textarea>
                  </div>
               </div>

               <!-- hobby -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="hobby">
                     <label for="hobby">Hobbies : </label>

                     <?php
                     $chkbox = $row_all_data['hobby'];
                     $arr = explode(",", $chkbox);

                     while ($row_hobby = mysqli_fetch_array($result_all_hobbies)) {
                     ?>
                        <label name="semantic-checkbox" class="hobby-select" name="hobby-list">
                           <input type="checkbox" name="hobby[]" class="hobby" id="hobby" value="<?php echo $row_hobby['hobbies']; ?>" <?php if (in_array($row_hobby['hobbies'], $arr)) {
                                                                                                                                          echo "checked";
                                                                                                                                       } ?>>
                           <?php echo $row_hobby['hobbies']; ?>
                        </label>
                     <?php
                     }

                     ?>
                  </div>
               </div>

               <!-- status -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="status">
                     <label id="dropdown-label" class="question" for="status">Status : </label>
                     <select id="dropdown" name="status">
                        <option value selected disabled>-Please select-</option>
                        <option value="Active" <?php if ($row_all_data['status'] == "Active") {
                                                   echo "selected";
                                                } ?>>Active</option>
                        <option value="Inactive" <?php if ($row_all_data['status'] == "Inactive") {
                                                      echo "selected";
                                                   } ?>>Inactive</option>
                     </select>
                  </div>
               </div>

               <!-- submit -->
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="submit-btn" class="submit-btn">
                     <input type="submit" value="Update" id="submit" name="submit" />
                     <input type="button" value="Back" id="button" onclick="window.location.href='search.php'" />
                  </div>
               </div>
            </div>
      </div>
   </div>
   </form>
</body>

</html>


<script>
   $(document).ready(function() {
      // datepicker for marriage date
      $(function() {
         $("#marriage-date").datepicker({
            maxDate: 0
         }); //To disable future date
      });

      // jQuery Form validation
      $("#registration").validate({
         rules: {
            'firstname': {
               required: true
            },

            'email': {
               required: true,
               email: true
            },

            'gender': {
               required: true
            },

            'maritial-status': {
               required: true
            },

            'marriage-date': {
               depends: function() {
                  var status = $("#maritial-status").val();
                  console.log(status);
                  if (status == 'Married') {
                     return true;
                  }
               }

            },

            'salary': {
               required: true
            },

            'country-list': {
               required: true
            },

            'state-list': {
               required: true
            },

            'about': {
               required: true
            },

            'hobby': {
               required: true
            },

            'status': {
               required: true
            }
         },

         messages: {
            'firstname': {
               required: "&nbsp; Please enter your first name"
            },

            'email': {
               required: "&nbsp; Please enter your email",
               email: "&nbsp; Enter valid email address"
            },

            'gender': {
               required: "&nbsp; Select gender"
            },

            'maritial-status': {
               required: "&nbsp; Select maritial status"
            },

            'marriage-date': {
               required: "&nbsp; Select marriage date"
            },

            'salary': {
               required: "&nbsp; Please enter your salary"
            },

            'country-list': {
               required: "&nbsp; Please select country"
            },

            'state-list': {
               required: "&nbsp; Please select state"
            },

            'about': {
               required: "&nbsp; Please enter this field"
            },

            'hobby': {
               required: "&nbsp; Please select hobby"
            },

            'status': {
               required: "&nbsp; Please select your status"
            },

         },

         submitHandler: function(form) {
            form.submit();
         }
      });

      // select state - while document load
      var country_id = $("#country-list").val();
      var state = "<?php echo $row_all_data['state']; ?>";
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
               // console.log(data);
               $("#state-list").html(data);
            }
         });
      }

      // dependent dropdown box - country and state
      $("#country-list").on('change', function() {
         var country_id = $(this).val();
         var state = "<?php echo $row_all_data['state']; ?>";
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
                  // console.log(data);
                  $("#state-list").html(data);
               }
            });
         } else {
            $("#state-list").html("<option>Select country first</option>");
         }

      });

      // maritial status - diable marriage date
      $("#maritial-status").change(function() {
         var maritial_status = $(this).val();
         if (maritial_status == "Unmarried") {
            //  console.log('in if');
            $("#marriage-date").prop("readonly", true);
            $("#marriage").hide();
            $("#marriage-date").val("");
         } else {
            $("#marriage-date").prop("readonly", false);
            $("#marriage").show();
         }
      });

      // disable marriage date if status is unmarried
      var maritial_status = $("#maritial-status").val();
      if (maritial_status == "Unmarried") {
         //  console.log('in if');
         $("#marriage-date").prop("readonly", true);
         $("#marriage").hide();
         $("#marriage-date").val("");
      } else {
         $("#marriage-date").prop("readonly", false);
         $("#marriage").show();
      }

      // unique email id
      $("#email").blur(function() {
         var email = $(this).val();
         var id = "<?php echo $id; ?>";
         console.log(id);
         $.ajax({
            type: "POST",
            url: "checkEmail.php",
            data: {
               email: email,
               id: id
            },
            success: function(response) {
               if (response == "") {
                  $("#email_error").remove();
                  $("#email").after("<span id='email_error' class='text-danger'>" +
                     response + "</span>");
                  return true;
               } else {
                  $("#email_error").remove();
                  $("#email").after("<span id='email_error' class='text-danger'>" +
                     response + "</span>");
                  return false;
               }

            }
         });
      });
   });
</script>