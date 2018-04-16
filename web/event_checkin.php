<?php
   include('session.php');
   ini_set('display_errors', 'On');
   error_reporting(E_ALL);
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
</head>

<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="/event_list.php">Event List</a>
    </li>
	    <li class="nav-item">
      <a class="nav-link" href="/event_list_attended.php">Attendence List</a>
    </li>
		    <li class="nav-item">
      <a class="nav-link" href="/event_checkin.php">Check In</a>
    </li>
	    <li class="nav-item">
      <a class="nav-link" href="/logout.php">Logout</a>
    </li>
  </ul>

</nav>

<?php
//$sql = "select * from event left join LEFT JOIN organization ON event.orgID = organization.orgID WHERE organization.orgID = 'site_orgID'";
       ini_set('display_errors', 'On');
error_reporting(E_ALL);
  echo "<br>";
  
  
  //$sql = "SELECT eventName, eventDate, eventStartTime, TIME_FORMAT(eventStartTime), eventEndTime, FROM event LEFT JOIN organization ON event.orgID = organization.orgID WHERE organization.orgID = 'site_orgID'";
	$sql = "SELECT eventID, eventName, eventDate, eventStartTime, eventEndTime, TIME_FORMAT(eventStartTime, '%r'),eventStartCheckInTime
 ,timediff(TIME_FORMAT(eventStartTime, '%T'),TIME_FORMAT(now(), '%T')),
 TIME_FORMAT(now(), '%T')
FROM event LEFT JOIN organization ON event.orgID = organization.orgID 
where timediff(TIME_FORMAT(eventStartTime, '%T'),TIME_FORMAT(now(), '%T')) 
between 0 and eventStartCheckInTime and event.orgID = 'site_orgID' and 
eventDate = DATE(NOW()) 
and ((TIME_FORMAT(now(), '%T') < TIME_FORMAT(eventEndTime, '%T')))
OR ((TIME_FORMAT(now(), '%T') between TIME_FORMAT(eventStartTime, '%r') and TIME_FORMAT(eventEndTime, '%T'))) and eventDate = curdate()";
  $result = $db->query($sql);
  $count = mysqli_num_rows($result);
  if($count != 0)
  {
	  header("location: event_list.php");
  
 
echo "<div class='container'>";
$result2 = mysqli_query($db,$sql);
$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
$id = $row2["eventID"];
$name = $row2["eventName"];
$date = $row2["eventDate"];
$time = $row2["TIME_FORMAT(eventStartTime, '%r')"];
echo $name;
echo "<p>There is currently an event available for check-in: "  . $name  . " on "  . $date  . " at "  . $time  . "</p>";


if($_SERVER["REQUEST_METHOD"] == "POST") {
	echo "Page is called via a POST method";
$sql3 = "INSERT INTO userAccounts_has_event (userAccounts_userID, event_eventID, userAttended, userCheckInTime) VALUES ('$user_check', '$id', '1', TIME_FORMAT(now(), '%T'))";
	//$result3 = mysqli_query($db,$sql3);
	if (mysqli_query($db, $sql3)) {
    echo "Checked in!";
} else {
    echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
}
}
			
			echo "<form action = '' method = 'post'>";
			echo "<button type='submit' class='btn btn-primary'>Check In</button>";
			echo "</form>";
  }
  else
  {
	  echo "<div class='container'>";
	  echo "<p>There are currently no events available for check-in.</p>";
  }
  ?>

</div>
</body>
</html>