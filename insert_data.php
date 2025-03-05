<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'connect.php';
//Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$gallery_name = trim($_POST['gallery_name']);
	$picture_name = trim($_POST['picture_name']);
	$date_of_creation = trim($_POST['date_of_creation']);
	$size = trim($_POST['size']);
	$price = trim($_POST['price']);
	
	//validation
	$errors = [];

	//Validate date (YYYY-MM-DD format)
	if (!empty($date_of_creation) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_of_creation)) {
		$errors[] = "Invalid date format. Use YYYY-MM-DD.";
	}
	//Validate size (like 40x25)
	if (!preg_match('/^\d+x\d+$/', $size)) {
		$errors[] = "Invalid size format. Use format like 40x25.";
}
	//Validate price (decimal format)
	if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
		$errors[] = "Invalid price format. Use a number like 19.99.";
}

if (empty($errors)) {
	$sql = "insert INTO galleries (name)
		SELECT * FROM (SELECT ?) AS tmp 
		WHERE NOT EXISTS (
			SELECT name FROM galleries WHERE name = ?) LIMIT 1";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $gallery_name, $gallery_name);
	$stmt->execute();
	$stmt->close();
	//insert data into pictures table
	$sql = "INSERT INTO pictures (gallery_id, name, date_of_creation, size, price) VALUES
		((SELECT id FROM galleries WHERE name = ?), ?, ?, ?, ?)";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssss", $gallery_name, $picture_name, $date_of_creation, $size, $price);

	if ($stmt->execute()) {
		echo "New record added successfully!";
	} else {
		echo "Error: " . $stmt->error;
	}

	$stmt->close();
	} else {
		//show validation errors
		foreach ($errors as $error) {
			echo "<p style='color: red;'>$error</p>";
		}
	}
}


$conn->close();
?>

