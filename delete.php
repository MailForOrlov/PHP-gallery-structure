<?php
require 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST['delete_gallery'])) {
		// Delete gallery and its pictures
		$gallery_name = $conn->real_escape_string($_POST['delete_gallery']);

		//First, delete pictures tied to the gallery
		$conn->query("DELETE FROM pictures WHERE gallery_id = (SELECT id FROM galleries WHERE name = '$gallery_name')");
		//Then, delete the gallery itself
		$conn->query("DELETE FROM galleries WHERE name = '$gallery_name'");
		echo "Gallery and its pictures deleted successfully!";
	}

	if (!empty($_POST['delete_pictures'])) {
		//Delete picture by name
		$picture_name = $conn->real_escape_string($_POST['delete_picture']);
		$conn->query("DELETE FROM pictures WHERE name = '$picture_name'");
		echo "Picture deleted successfully!";
	}
}

$conn->close();

//Redirect back to dysplay_data.php
header("Location: display_data.php");
exit();
?>
