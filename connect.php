<?php
$host = 'localhost';
$dbname = 'ChloeDatabase';
$user = 'new_admin';
$pass = 'A422056153a@';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $db->connect_error);
}
?>
