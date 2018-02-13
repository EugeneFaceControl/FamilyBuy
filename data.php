<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$ini_array = parse_ini_file("db.ini");
$servername = $ini_array["servername"];
$username = $ini_array["username"];
$password = $ini_array["password"];
$dbname = $ini_array["dbname"];
$tablename = $ini_array["tablename"];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM " . $tablename);
$outp = "";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	if ($outp != ""){
		$outp .= ",";
	}
	$outp .= '{"Id":"' . $row["id"] . '",';
	$outp .= '"Date":"' . $row["date"] . '",';
	$outp .= '"Price":"' . $row["price"] . '",';
	$outp .= '"What":"' . $row["who"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();
	
echo($outp);
?>