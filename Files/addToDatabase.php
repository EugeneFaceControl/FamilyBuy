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
$who = $_POST["ip"];
$ipName = "";
switch ($_POST["ip"]) {
	case '192.168.0.106':
		$ipName = "Eugene Lenovo";
		break;
	case '192.168.0.107':
		$ipName = "Tanya Phone";
		break;
	case '192.168.0.103':
		$ipName = "Sergey ZTE";
		break;
	case '192.168.0.100':
		$ipName = "Eugene Phone";
		break;
	case '192.168.0.104':
		$ipName = "Sheyma PC";
		break;
	default:
		
	break;
}
if ($ipName != "") {
	$who = $who . ": " . $ipName;
}

$sql = "INSERT INTO ". $tablename . " (date, price, who, ip) VALUES ('" . $_POST["date"] . "', '" . $_POST["price"] . "', '" . $_POST["familyMember"] . "', '" . $who . "')";



if ($conn->query($sql) === TRUE) {

	echo "Добавлено:<br>";
	echo $_POST["familyMember"];
	echo "<br><br><a href='https://eugenesheyma.000webhostapp.com/". $tablename . "'>Вернуться назад</a>";
} else {

	echo "Error: " . $sql . "<br>" . $conn->error;

}

echo $_POST["name"];

echo " ";

echo $_POST["link"];

?>