<?php
include('config.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL);
if(isset($_POST['org_id'])) {
 // $sql = "select * from school where  schoolID =".mysqli_real_escape_string($db, $_POST['org_id']);
   $sql = "SELECT * FROM organization LEFT JOIN school ON organization.schoolID = school.schoolID WHERE school.schoolID =".mysqli_real_escape_string($db, $_POST['org_id']);
  $res = mysqli_query($db, $sql);
  if(mysqli_num_rows($res) > 0) {
    echo "<option value=''>------- Select --------</option>";
    while($row = mysqli_fetch_object($res)) {
      echo "<option value='".$row->schoolID."'>".$row->orgName."</option>";
    }
  }
} else {
  header('location: ./');
}
?>