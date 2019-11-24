
<!DOCTYPE html>
<html>
<head>
	<title>website101</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style/styles.css">
</head>
<body>
	<div class="container">
		<aside class="aside">
			<form class="login" method="post">
				<label><b>Username</b></label>
				<input class="form" type="text" placeholder="Username" name="usernm" required autofocus="autofocus" tabindex="1">

				<label><b>Password</b></label>
				<input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="2">

				<button type="submit" class="button" name="login" tabindex="3">Log in</button>
				<a href="forgotpwd.php" id="mdp_forgot" tabindex="4">Forgot your password</a>
				<br/>
				<br/>
				<br/>
				<div class="strike">
					<span>New to the website?</span>
				</div>
			</form>
			<button class="button" id="button_new" onclick="location.href='register.php'" tabindex="5">Sign up here</button>
		</aside>
	</div>
</body>
</html>

<?php
start_session();
include_once('./config/dbconnect.php');
/*$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$email = $_GET['email'];
$password = $_POST['passwd'];
$authen_user = $conn->prepare("SELECT email  FROM users where email = :email ");
$authen_user->bindValue(':email', $email);
$authen_user->execute();
if ($ver->rowCount() > 0){
	$up = $conn->prepare("UPDATE User SET Verify='1' WHERE email = :email");
	$up->bindValue(':email', $email);
	$up->execute();
}*/
$username = $_GET['usernm'];
$email = $_GET['email'];
try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$result = $conn->prepare("SELECT email, passwd FROM User WHERE email = :email AND passwd = :passwd");
	//$result = $conn->prepare('SELECT email, password');
	$result->bindParam(':username', $username);
	$result->bindParam(':email', $email);
	$result->execute();
	$n =1;
} catch
(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
if (n == 1)
	header('location:http://localhost:8080/home.php');

/*if ($username && $hash && !empty($username) && !empty($hash)) {
	foreach ($select_username as $user_row) {
		if ($user_row['username'] = $username) {
			$username_found = 1;
		}
	}
	foreach ($select_hash as $hash_row) {
		if (($pwd = $_POST['passwd']) == $password) {
			$hash_found = 1;
		}
	}
	if ($username_found === 1 && $hash_found === 1) {
		$update_table->bindParam(':active', $hash_md5);
		$update_table->execute();
		header('location:http://127.0.0.1:8080/files/index.php');
	}
}*/
?>

<?php
$msg = ""; 
if(isset($_POST['login'])) {
	$username = trim($_POST['usernm']);
	$password = trim($_POST['passwd']);
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	if($username != "" && $password != "") {
		try {
			$query = "SELECT * FROM User WHERE username = :username and passwd=:passwd";
			$stmt = $conn->prepare($query);
			$stmt->bindParam('username', $username, PDO::PARAM_STR);
			$stmt->bindValue('password', $password, PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($count == 1 && !empty($row)) {
				/******************** Your code ***********************/
				$_SESSION['sess_user_id']   = $row['uid'];
				$_SESSION['sess_user_name'] = $row['username'];
				$_SESSION['sess_name'] = $row['name'];

			}
			else {
				$msg = "Invalid username and password!";
			}
		} catch (PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
	}
	else {
		$msg = "Both fields are required!";
	}
}
?>


