<?php
require 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_picture'])) {
	$picture_name = $_POST['delete_picture'];
	echo "Picture to delete: " . htmlspecialchars($picture_name);

	$sql = "DELETE FROM pictures WHERE name = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $picture_name);

	if ($stmt->execute()) {
		echo "Picture deleted successfully!";
	} else {
		echo "Error deleting picture: " . $stmt->error;
	}

	$stmt->close();
	$conn->close();

	header("Location: display_data.php");
	exit();
} else {
	echo "Invalid request!";
}
?>
