<?php
   include('session.php');
      ini_set('display_errors', 'On');
error_reporting(E_ALL);
  // echo $login_session;
      //echo $user_check;
   //echo $site_firstName;
   //echo $site_lastName;
   //echo $site_orgID;

?>
<html>
<head>
  <title>AttendTrack User Hub</title>
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
      <a class="nav-link" href="/event_list">Event List</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/logout.php">Logout</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/submit_absence.php">Submit Absence</a>
    </li>
	      <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Admin
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/create_event.php">Create Event</a>
        <a class="dropdown-item" href="/list_users.php">List Users</a>
      </div>
    </li>
  </ul>

</nav>

 <?php
       ini_set('display_errors', 'On');
error_reporting(E_ALL);
  echo "<br>";
  
  
  $sql = "SELECT * FROM userAccounts LEFT JOIN organization ON userAccounts.orgID = organization.orgID WHERE organization.orgID = 'site_orgID'";
  $result = $db->query($sql);
		
	echo "<div class='container'>";
		echo "<div class='row-fluid'>";
		
			echo "<div class='col-xs-6'>";
			echo "<div class='table-responsive'>";
			
				echo "<table class='table table-hover table-inverse'>";
				
				echo "<tr>";
				echo "<th>First Name</th>";
				echo "<th>Last Name</th>";
				echo "<th>Email Address</th>";
				echo "</tr>";
		  
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
							
						echo "<tr>";
						echo "<td>" . $row["userFirstName"] . "</td>";
						echo "<td>" . $row["userLastName"] . "</td>";
						echo "<td>" . $row["userEmail"] . "</td>";
						echo "</tr>";			
					}
				} else {
					echo "0 results";
				}
				
				echo "</table>";
				
			echo "</div>";
			echo "</div>";
			?>

</body>
</html>