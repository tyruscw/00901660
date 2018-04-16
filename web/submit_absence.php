<?php
   include('session.php');
   echo $login_session;
   ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<html>
<head>
  <title>AttendTrack - Submit Absence</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.1/combined/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.1/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Active</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/logout.php">Logout</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/submit_absence.php">Submit Absence</a>
    </li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
  <p class="navbar-text">$login_session</p>
   </ul>
   </nav>
   <div class='container'>
   <select id="event" name="event">
        
           <?php
            /*ini_set('display_errors', 'On');
error_reporting(E_ALL);
            $host="attend-db-instance.cliabium00b4.us-east-2.rds.amazonaws.com";
			$port=3306;
			$socket="";
			$user="tyruscw";
			$password="Nightsky1!";
			$dbname="attend_db";
            $link=mysqli_connect($host, $user, $password, $dbname, $port, $socket) or die ("Error connecting to mysql server: ".mysqli_error());
            */
            //$dbname = 'attend_db';
           // mysqli_select_db($db, $dbname) or die ("Error selecting specified database on mysql server: ".mysqli_error());
            
            $query = "SELECT eventName, eventDate, eventStartTime, eventEndTime FROM event LEFT JOIN organization ON event.orgID = organization.orgID WHERE organization.orgID = 'site_orgID'";
            $result=mysqli_query($db, $query) or die ("Query to get data from firsttable failed: ".mysqli_error());
            
			if(mysqli_num_rows($result) > 0) {
            while ($row=mysqli_fetch_array($result)) {
				//var_dump($row);
			//echo $row['schoolID'];
          echo "<option value='".$row['eventID']."'>".$row['eventName']."</option>";
            
            }
			}
            ?> 
    
        </select>
		<div class="form-group">
    <label for="pwd">Excuse:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
   </div>
   </body>