<?php
	include('./config/dbconnect.php');
	$connection = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_PDO);
	$username = $_GET['username'];
	//$hash = $_GET['hash'];
	$get_username = $connection->query("SELECT username FROM User");
	//$select_hash = $connection->query("SELECT HASH FROM users WHERE username like '$username'");
	//$update_table = $connection->prepare("UPDATE users SET ACTIVE=:ACTIVE WHERE HASH='$hash'");
	$hash_md5 = hash('md5', $username);
	$username_found = 0;
	$hash_found = 0;

	
	if ($username && $hash && !empty($username) && !empty($hash)) {
		foreach ($select_username as $user_row) {
			if ($user_row['username'] = $username) {
				$username_found = 1;
			}
		}
		foreach ($select_hash as $hash_row) {
			if ($hash_row['HASH'] = $hash) {
				$hash_found = 1;
			}
		}
		if ($username_found === 1 && $hash_found === 1) {
			$update_table->bindParam(':active', $hash_md5);
			$update_table->execute();
			header('location:http://127.0.0.1:8080/files/index.php');
		}
	}
?>
