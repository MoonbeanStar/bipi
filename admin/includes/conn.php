<?php
	$conn = new mysqli('localhost', 'root', '', 'eborrow');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>