<?php
   define('DB_SERVER', 'attend-db-instance.cliabium00b4.us-east-2.rds.amazonaws.com');
   define('DB_USERNAME', 'tyruscw');
   define('DB_PASSWORD', 'Nightsky1!');
   define('DB_DATABASE', 'attend_db');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   function getConnstring() {
 $con = mysqli_connect($this->DB_SERVER, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_DATABASE) or die("Connection failed: " . mysqli_connect_error());
?>