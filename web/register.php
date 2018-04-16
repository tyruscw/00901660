<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
if(!empty($_POST["register-user"])) {
	/* Form Required Field Validation */
	/*foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}*/
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirm_password']){ 
	$error_message = 'Passwords should be same<br>'; 
	}

	/* Email Validation */
	if(!isset($error_message)) {
		if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
		$error_message = "Invalid Email Address";
		}
	}

	if(!isset($error_message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "INSERT INTO userAccounts (userFirstName, userLastName, userPassword, userEmail, orgID) VALUES
		('" . ($_POST["firstName"]) . "', '" . ($_POST["lastName"]) . "', '" . ($_POST["password"]) . "', '" . $_POST["userEmail"] . "',  '" . $_POST["org"] . "')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "You have registered successfully!";	
			echo "<script type='text/javascript'>alert('$success_message');</script>";
			unset($_POST);
			header("location: login.php");
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	}
}
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<title>AttendTrack Registration Form</title>
<style>
body{
	width:610px;
	font-family:calibri;
}
.error-message {
	padding: 7px 10px;
	background: #fff1f2;
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	padding: 7px 10px;
	background: #cae0c4;
	border: #c3d0b5 1px solid;
	color: #027506;
	border-radius: 4px;
}
.demo-table {
	background: #d9eeff;
	width: 100%;
	border-spacing: initial;
	margin: 2px 0px;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
	border-radius: 4px;
	padding: 20px 40px;
}
.demo-table td {
	padding: 15px 0px;
}
.demoInputBox {
	padding: 10px 30px;
	border: #a9a9a9 1px solid;
	border-radius: 4px;
}
.btnRegister {
	padding: 10px 30px;
	background-color: #3367b2;
	border: 0;
	color: #FFF;
	cursor: pointer;
	border-radius: 4px;
	margin-left: 10px;
}
</style>
</head>
<body>
<form name="frmRegistration" method="post" action="">
<table border="0" width="500" align="center" class="demo-table">
<?php if(!empty($success_message)) { ?>	
<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
<?php } ?>
<?php if(!empty($error_message)) { ?>	
<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
<?php } ?>
<tr>
<td>First Name</td>
<td><input type="text" class="demoInputBox" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" class="demoInputBox" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" class="demoInputBox" name="password" value=""></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" class="demoInputBox" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"></td>
</tr>
<tr>
<td>School</td>
<td><select id="school" name="school">
<option value=''>------- Select --------</option>
           <?php
            ini_set('display_errors', 'On');
error_reporting(E_ALL);
            $host="attend-db-instance.cliabium00b4.us-east-2.rds.amazonaws.com";
			$port=3306;
			$socket="";
			$user="tyruscw";
			$password="Nightsky1!";
			$dbname="attend_db";
            $link=mysqli_connect($host, $user, $password, $dbname, $port, $socket) or die ("Error connecting to mysql server: ".mysqli_error());
            
            $dbname = 'attend_db';
            mysqli_select_db($link, $dbname) or die ("Error selecting specified database on mysql server: ".mysqli_error());
            
            $query="SELECT * FROM school";
            $result=mysqli_query($link, $query) or die ("Query to get data from firsttable failed: ".mysqli_error());
            
			if(mysqli_num_rows($result) > 0) {
            while ($row=mysqli_fetch_array($result)) {
				//var_dump($row);
			//echo $row['schoolID'];
          echo "<option value='".$row['schoolID']."'>".$row['schoolName']."</option>";
            
            }
			}
            ?> 
    
        </select>
        
    </form>
</td>
</tr>
<tr>
<td>Organization</td>
<td><select id="org" name="org">
        <option value="default">Please select a school</option>
        </select>
 
    </form>
</td>
</tr>
<tr>
<td><input type="submit" name="register-user" value="Register" class="btnRegister"></td>
</tr>
</table>
</form>
<?php
           /* ini_set('display_errors', 'On');
error_reporting(E_ALL);
            $host="attend-db-instance.cliabium00b4.us-east-2.rds.amazonaws.com";
			$port=3306;
			$socket="";
			$user="tyruscw";
			$password="Nightsky1!";
			$dbname="attend_db";
            $link=mysqli_connect($host, $user, $password, $dbname, $port, $socket) or die ("Error connecting to mysql server: ".mysqli_error());
            
            $dbname = 'attend_db';
            mysqli_select_db($link, $dbname) or die ("Error selecting specified database on mysql server: ".mysqli_error());
            
            $orgquery="SELECT orgName FROM organization";
            $orgresult=mysqli_query($link, $orgquery) or die ("Query to get data from firsttable failed: ".mysqli_error());
            
            while ($orgrow=mysqli_fetch_array($orgresult)) {
            $orgName=$orgrow["orgName"];
                echo "<option>
                    $orgName
                </option>";
            
            }*/
                
            ?>
</body></html>