<?php
	$conn = new mysqli('localhost', 'root', 'SJGagtaG5t!i2_8n', 'pentatech_intern_2024');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>