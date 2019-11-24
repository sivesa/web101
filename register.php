
<!DOCTYPE html>
<html>
<head>
	<title>register new user</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style/styles.css">
</head>
<body>
<div class="container">
	<aside class="aside">

		<form class="login" method="post">
			<label><b>Username</b></label>
			<input class="form" type="text" placeholder="Username" name="username" required autofocus="autofocus" tabindex="1">

			<label><b>Email</b></label>
			<input class="form" type="text" placeholder="Email address" name="email" required  tabindex="2">
			
			<label><b>Password</b></label>
			<input class="form" type="password" placeholder="Password" name="password" required tabindex="3">

			<label><b>Confirm password</b></label>
			<input class="form" type="password" placeholder="Confirm password" name="re-password" required tabindex="4">
			
			<button type="submit" class="button" tabindex="5">Sign up</button>
			<br/>
			<br/>
			<br/>
			<div class="strike">
				<span>Veteran?</span>
			</div>
			<button class="button" id="button_new" onclick="location.href='index.php'" tabindex="5">Login here</button>
		</form>
	</aside>
</div>
</body>
</html>

<?php
include_once "config/dbconnect.php";

$password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	$username_error = 1;
	$email_error = 1;
	$password_error = 1;
	
	if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
		$username_error = 0;
		$username_error_msg = "Invalid userame ";
		echo username_error_msg;
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email_error = 0;
		$email_error_msg =  "Invalid email ";
		echo $email_error_msg;
	}
    
    
	$re_password =  $_POST['re-password'];
	$password =  $_POST['password'];
	if ($re_password != $password) {
		$password_error_msg = "Passwords don't match ";
		echo $password_error_msg;
		$password_error = 0;
	}
	$password_hash =  password_hash($password, PASSWORD_DEFAULT);
	$submit = $_POST['submit'];
}

if ($username_error == 1 && $email_error == 1 && $password_error == 1) {
	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$data = [
    			'username' => $username,
    			'email' => $email,
    			'passwd' => $password,];
		$sql = $conn->prepare('INSERT INTO User (username, email, passwd ) VALUES (:username, :email, :passwd)');
		$sql->execute($data);
		
		if ($sql->rowCount() > 0) {
			//header("location:home.php");
			
		}
		//echo "User created successfully";
	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}
}
$conn = null;

?>
