<?php
// enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "new_admin";
$password = "A422056153a@";
$database = "ChloeDatabase";

$conn = new mysqli($servername, $username, $password, $database);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$gallery_name = $conn->real_escape_string($_POST['gallery_name']);
	$picture_name = $conn->real_escape_string($_POST['picture_name']);
	$date_of_creation = date('Y-m-d'); //default to today for now
	$size = "40x25"; //Placeholder until we add size input
	$price = 100; //Placeholder until we add price input

	//insert data into pictures table
	$sql = "INSERT INTO pictures (name, date_of_creation, size, price, gallery_id)
		VALUES ('$picture_name', '$date_of_creation', '$size', '$price', (SELECT id FROM galleries WHERE name = '$gallery_name' LIMIT 1))";

	if ($conn->query($sql) === TRUE) {
		echo "New picture added successfully!";
	} else {
		echo "Error: " . $conn->error;
	}
}
$conn->close();
?>

