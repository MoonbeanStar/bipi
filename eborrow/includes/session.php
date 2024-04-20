<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['employee'])){
		$sql = "SELECT * FROM employees WHERE id = '".$_SESSION['employee']."'";
		$query = $conn->query($sql);
		$employee = $query->fetch_assoc();
	}

?>