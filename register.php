<?php
require 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $username, $hashed_password);
		if ($stmt->execute()) {
			echo "User registered successfully!";
		} else {
			echo "Error: " . $stmt->error;
		}
		$stmt->close();
	} else {
		echo "Please fill in all fields.";
	}
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0>
	<title>Register</title>
</head>
<body>
	<h2>Register</h2>
	<form action="register.php method="POST">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br>
		<button type="submit">Register</button>
	</form>
</body>
</html>

