<?php
	$conn = new mysqli('localhost', 'root', 'bur1ington_1967', 'eborrow');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
$conn2 = new mysqli('localhost', 'root', 'bur1ington_1967', 'bipi_inventory');

	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	
?>