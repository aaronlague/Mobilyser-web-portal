<?php /*?><?php

// If the form was submitted, scrub the input (server-side validation)
// see below in the html for the client-side validation using jQuery

$name = '';
$gender = '';
$address = '';
$email = '';
$username = '';
$password = '';
$output = '';

if($_POST) {
  // collect all input and trim to remove leading and trailing whitespaces
  $name = trim($_POST['name']);
  $gender = trim($_POST['gender']);
  $address = trim($_POST['address']);
  $email = trim($_POST['email']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  $errors = array();
  
  // Validate the input
  if (strlen($name) == 0)
    array_push($errors, "Please enter your name-x");

  if (!(strcmp($gender, "Male") || strcmp($gender, "Female") || strcmp($gender, "Other"))) 
    array_push($errors, "Please specify your gender");
  
  if (strlen($address) == 0) 
    array_push($errors, "Please specify your address");
    
  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    array_push($errors, "Please specify a valid email address");
    
  if (strlen($username) == 0)
    array_push($errors, "Please enter a valid username");
    
  if (strlen($password) < 5)
    array_push($errors, "Please enter a password. Passwords must contain at least 5 characters.");
    
  // If no errors were found, proceed with storing the user input
  if (count($errors) == 0) {
    array_push($errors, "No errors were found. Thanks!");
  }
  
  //Prepare errors for output
  $output = '';
  foreach($errors as $val) {
    $output .= "<p class='output'>$val</p>";
  }
  
}

?><?php */?>

<html>
<head>
    <!-- Define some CSS -->
  <style type="text/css">
    .label {width:100px;text-align:right;float:left;padding-right:10px;font-weight:bold;}
    #register-form label.error, .output {color:#FB3A3A;font-weight:bold;}
  </style>
  
  <!-- Load jQuery and the validate plugin -->
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        // Specify the validation rules
        rules: {
            name: "required",
            gender: "required",
            address: "required",
            email: {
                required: true,
                email: true
            },
            username: "required",
            password: {
                required: true,
                minlength: 5
            }
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your name",
            gender: "Please specify your gender",
            address: "Please enter your address",
            email: "Please enter a valid email address",
            username: "Please enter a valid username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
</head>
<body>
  <?php echo $output; ?>
  <!--  The form that will be parsed by jQuery before submit  -->
  <form action="./" method="post" id="register-form" novalidate="novalidate">
  
    <div class="label">Name</div><input type="text" id="name" name="name" value="" /><br />
    <div class="label">Gender</div><select id="gender" name="gender" />
                                      <option value="Female">Female</option>
                                      <option value="Male">Male</option>
                                      <option value="Other">Other</option>
                                   </select><br />
    <div class="label">Address</div><input type="text" id="address" name="address" value="" /><br />
    <div class="label">Email</div><input type="text" id="email" name="email" value="" /><br />
    <div class="label">Username</div><input type="text" id="username" name="username" value="" /><br />
    <div class="label">Password</div><input type="password" id="password" name="password" /><br />
    <div style="margin-left:140px;"><input type="submit" name="submit" value="Submit" /></div>
    
  </form>



  
</body>
</html>
<!--old filter select boxes-->
<div class="col-lg-2" style="margin-left:-20px!important;">
<div class="btn-group select select-block mbl">
  <button class="btn dropdown-toggle clearfix btn-sm btn-warning" data-toggle="dropdown"> <span class="filter-option pull-left">
  <div id="ctype-selected">Select call type</div>
  </span>&nbsp;<span class="caret"></span></button>
  <span class="dropdown-arrow"></span>
  <input type="hidden" name="calltype" id="calltype" value="A" />
  <ul class="dropdown-menu" role="menu" style="max-height: 200px; overflow-y: auto; min-height: 108px;">
    <li id="ctype_0" onClick="ctype_data(0, 'Select call type');" rel="A" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Select call type</span></a></li>
    <li id="ctype_A" onClick="ctype_data('A', 'All calls');" rel="A" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">All calls</span></a></li>
    <li id="ctype_P" onClick="ctype_data('P', 'Personal');" rel="P" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Personal</span></a></li>
    <li id="ctype_W" onClick="ctype_data('W', 'Work');" rel="W" class="ctype"><a tabindex="-1" href="#" class="opt"><span class="pull-left">Work</span></a></li>
  </ul>
</div>
</div>

<div class="col-lg-2" style="margin-left:-20px!important;">
<div class="btn-group select select-block mbl">
  <button class="btn dropdown-toggle clearfix btn-sm btn-warning" data-toggle="dropdown"> <span class="filter-option pull-left">
  <div id="btype-selected">Select</div>
  </span>&nbsp;<span class="caret"></span></button>
  <span class="dropdown-arrow"></span>
  <input type="hidden" name="billtype" id="billtype" value="0" />
  <ul class="dropdown-menu" role="menu" style="max-height: 200px; overflow-y: auto; min-height: 108px;">
    <?php echo $bill_upload_data; ?>
  </ul>
</div>
</div>
