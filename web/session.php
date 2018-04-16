<?php
   include('config.php');
   session_start();
   
      ini_set('display_errors', 'On');
error_reporting(E_ALL);
   $user_check = $_SESSION['login_user'];
   $site_firstName = $_SESSION['firstName'];
   $site_lastName = $_SESSION['lastName'];
   $site_orgID = $_SESSION['orgID'];
   
   $ses_sql = mysqli_query($db,"select userID from userAccounts where userID = '$user_check' ");
		
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['userID'];

   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>