<?php

require_once 'connect.php';

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

         <h2>Registration</h2>

         <form action="insert.php" method="post" name="registration" id="registration">
            <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="user-name">
                     <label for="firstName">Name : </label>
                     <input type="text" id="firstName" placeholder="Enter Your Name" name="firstname">
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="user-email">
                     <label for="email">Email : </label>
                     <input type="email" id="email" placeholder="Enter Your Email" name="email">&nbsp;&nbsp;
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="gender">
                     <label for="genderName">Gender : </label>
                     <fieldset>
                        <label for="gender_1" class="gender-select">
                           <input type="radio" id="gender_1" name="gender" value="male" checked> Male
                        </label>
                        <label for="gender_2" class="gender-select">
                           <input type="radio" id="gender_2" name="gender" value="female"> Female
                        </label>
                        <label for="gender"> </label>
                     </fieldset>
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="marital">
                     <label for="maritial-status" id="dropdown-label" class="question">Marital status:</label>
                     <select id="maritial-status" class="maritial-status" name="maritial-status">
                        <option value disabled selected>-Please select-</option>
                        <option value="Married">Married</option>
                        <option value="Unmarried">Unmarried</option>
                     </select>
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="marriage" id="marriage">
                     <label for="marriage-date" name="marriage-date">Marriage Date : </label>
                     <input type="text" id="marriage-date" name="marriage_date">
                     <!-- <input type="date" class="marriage-date" id="marriage-date" name="marriage_date"> -->
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="salary">
                     <label for="salary">Salary : </label>
                     <input type="text" id="salary" placeholder="PLease enter your salary" name="salary">
                  </div>
               </div>


               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="country">
                     <label id="dropdown-label" for="country-list" class="question">Country : </label>
                     <select name="country-list" id="country-list" class="country-list">
                        <option value disabled selected>-Please select-</option>

                        <?php

                        while ($row = mysqli_fetch_array($result_all_country)) {
                        ?>

                           <option value="<?php echo $row['id']; ?>"> <?php echo $row['country_name'];  ?>
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
                  <div class="about">
                     <label for="about">About : </label>
                     <textarea rows="3" name="about"> </textarea>
                  </div>
               </div>


               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="hobby">
                     <label for="hobby">Hobbies : </label>

                     <?php

                     while ($row_hobby = mysqli_fetch_array($result_all_hobbies)) {
                     ?>
                        <label name="semantic-checkbox" class="hobby-select" name="hobby-list">
                           <input type="checkbox" name="hobby[]" class="hobby" id="hobby" value="<?php echo $row_hobby['hobbies']; ?>">
                           <?php echo $row_hobby['hobbies']; ?>
                        </label>
                     <?php
                     }

                     ?>
                  </div>
               </div>

               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="status">
                     <label id="dropdown-label" class="question" for="status">Status : </label>
                     <select id="dropdown" name="status">
                        <option value selected disabled>-Please select-</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                     </select>
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                  <div id="submit-btn" class="submit-btn">
                     <input type="submit" value="Submit" id="submit" name="submit" />
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
               required: true,
               // function(element)
               // {
               //       return $("input.select:checked").length > 0;
               // },
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

      // dependent dropdown box - country and state
      $("#country-list").on('change', function() {
         var country_id = $(this).val();
         if (country_id) {
            $.ajax({
               type: "POST",
               url: "getState.php",
               data: "country_id=" + country_id,
               success: function(data) {
                  $("#state-list").html(data);
               }
            });
         } else {
            $("#state-list").html("<option>Select country first</option>");
         }
      });

      var country_id = $("#country-list").val();
      var state = $("#state-list").val();
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
               $("#state-list").html(data);
            }
         });
      } else {
         $("#state-list").html("<option>Select country first</option>");
      }

      // maritial status - diable marriage date
      $("#maritial-status").change(function() {
         var maritial_status = $(this).val();
         if (maritial_status == "Unmarried") {
            // $("#marriage-date").prop("readonly", true);
            // $( "#marriage-date" ).datepicker( "option", "disabled", true );
            $("#marriage").hide();
            $("#marriage-date").val("");
         } else {
            // $("#marriage-date").prop("readonly", false);
            // $( "#marriage-date" ).datepicker( "option", "disabled", false );
            $("#marriage").show();
         }

      });

      // unique email id - Email check on Textbox
      $("#email").blur(function() {
         var email = $(this).val();
         checkEmail(email);
      });

      // unique email id function
      function checkEmail(email) {
         $.ajax({
            type: "POST",
            url: "checkEmail.php",
            data: "email=" + email,
            success: function(response) {
               if (response == "") {
                  $("#email_error").remove();
                  $("#email").after("<span id='email_error' class='text-danger'>" + response +
                     "</span>");
                  return true;
               } else {
                  $("#email_error").remove();
                  $("#email").after("<span id='email_error' class='text-danger'>" + response +
                     "</span>");
                  return false;
               }

            }
         });
      }
   });
</script>