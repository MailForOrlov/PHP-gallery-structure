<?php
require 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Fetch all galleries and their pictures
$sql = "SELECT g.name AS gallery_name, p.name AS picture_name, p.date_of_creation AS date_of_creation, p.size, p.price FROM pictures p LEFT JOIN galleries g ON p.gallery_id = g.id ORDER BY g.name, p.name";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
echo "<h1>Gallery List</h1>";
$current_gallery = "";
while ($row = $result->fetch_assoc()) {
		$gallery_name = $row['gallery_name'] ?? 'No Gallery';
		if ($current_gallery != $gallery_name) { 
			if ($current_gallery != "") echo "<hr>"; // Separates galleries visually
		$current_gallery = $gallery_name;
		echo "<h2>" . htmlspecialchars($current_gallery) . "</h2>";
		echo "<form action='delete.php' method='POST'>";
		echo "<input type='hidden' name='delete_gallery' value='" . htmlspecialchars($current_gallery) . "'>";
		echo "<button type='submit'>Delete Gallery</button>";
		echo "</form><hr>";
	}
	
	echo "<p>Picture: " . htmlspecialchars($row['picture_name'] ?? '') . " | Date: " . htmlspecialchars($row['date_of_creation'] ?? '') . " | Size: " . htmlspecialchars($row['size'] ?? '') . " | Price: $" . htmlspecialchars($row['price'] ?? '') . "</p>";
	echo "<form action='delete.php' method='POST'>";
	echo "<input type='hidden' name='delete_picture' value='" . htmlspecialchars($row['picture_name'] ?? '') . "'>";
	echo "<button type='submit'>Delete Picture</button>";
        echo "</form>";
	}
} else {
	echo "No galleries or pictures found.";
	}
$conn->close();
?>
