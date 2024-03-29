<?php
require_once "dbconnect.php";
try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = file_get_contents('construct.sql');
	$db = $conn->exec($sql);
	echo "Connection created successfully!\n";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
