<?php
$host = 'localhost';
$dbname = 'ChloeDatabase';
$user = 'new_admin';
$pass = 'A422056153a@';

$db = new mysqli($host, $user, $pass, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}
?>
