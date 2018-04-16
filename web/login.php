<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST["email"]);
      $mypassword = mysqli_real_escape_string($db,$_POST["password"]); 
      
      $sql = "SELECT userID, userFirstName, userLastName, orgID FROM userAccounts WHERE userEmail = '$myusername' and userPassword = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
	  echo $row['userID'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //$_SESSION['login_user'] = $myusername;
		 $_SESSION['login_user'] = $row['userID'];
		 $_SESSION['firstName'] = $row['userFirstName'];
		 $_SESSION['lastName'] = $row['userLastName'];
		 $_SESSION['orgID'] = $row['orgID'];
         
         header("location: event_checkin.php");
      }else {
         $error_message = "Your Login Name or Password is invalid";
		 echo "<script type='text/javascript'>alert('$error_message');</script>";
      }
   }
?>
<html>
<head>
  <title>AttendTrack</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>AttendTrack Login</h1>

<form action = "" method = "post">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="/register.php" class="btn btn-primary" role="button">Register</a>
</form>
</div>


</body>
</html>