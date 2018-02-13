<?php 
$ini_array = parse_ini_file("../db.ini");

$servername = $ini_array["servername"];
$username = $ini_array["username"];
$password = $ini_array["password"];
$dbname = $ini_array["dbname"];
$tablename = $ini_array["tablename"];

	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM " . $tablename . " WHERE id=" . $_POST["id"];

if ($conn->query($sql) === TRUE) {
	echo $_POST["id"] . " element deleted successfully<br>";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
?>