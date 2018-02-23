<!DOCTYPE html>
<html lang="en">
<head>
	<title>Family calculator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h2 id="FamilyHeader">Family calculator</h2>
			<div class="row">
				<div class="col-xs-12 col-lg-6">
					<form action="Files/addToDatabase.php" method="post">
						<div class="form-group">
							<label for="date">Дата:</label>
							<input class="form-control" type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
						</div>
						<div class="form-group">
							<label for="price">Цена:</label> 
							<input class="form-control" type="text" id="priceToEnter" required="required" name="priceToEnter">
							<input type="hidden" name="price" id="price"/>
							<script type="text/javascript">
								document.getElementById('priceToEnter').addEventListener('input', function() {
									document.getElementById('price').value = this.value.replace(',', '.');
								});

								var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})
								findIP.then(ip => document.getElementById("ip").value = ip).catch(e => console.error(e));
								console.log(findIP);
							</script>
						</div>
						<div class="form-group">
							<lavel for="familyMember"><b>Продукция:</b></lavel>
							<select  class="form-control" id="familyMember" name="familyMember">
								<option>Остальное</option>
								<option>Мясная продукция</option>
								<option>Крупы</option>
								<option>Овощи, фрукты</option>
								<option>Молочные продукты</option>
								<option>Морские продукты</option>
								<option>Хлебобулочные изделия</option>
								<option>Сладости</option>
							</select>
						</div>
						<div class="form-group">
							<input type="hidden" name="ip" id="ip">
						</div>
						<div class="form-group">
							<input value="Подтвердить" type="submit" class="btn btn-default">
							<a href="#bottom">Спуститься вниз</a>
						</div>
					</form>
				</div>
				<!-- Delete -->
				
			</div>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>
							№
						</th>
						<th>
							Дата
						</th>
						<th>
							Цена
						</th>
						<th>
							Что купил
						</th>
					</tr>
					<?php
					$ini_array = parse_ini_file("db.ini");

					$servername = $ini_array["servername"];
					$username = $ini_array["username"];
					$password = $ini_array["password"];
					$dbname = $ini_array["dbname"];
					$tablename = $ini_array["tablename"];

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					/* изменение набора символов на utf8 */
					// $conn->set_charset("utf8");

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 

					$sql = "SELECT * FROM ". $tablename;
					$result = $conn->query($sql);

					$dates = mysqli_query($conn, "SELECT DISTINCT `date` FROM " . $tablename);
					$d = mysqli_fetch_array($dates);
					$realSum = 0;
					if ($result->num_rows > 0) {
    	// output data of each row
						while($row = $result->fetch_assoc()) {
							$realSum += floatval($row["price"]);
							?>
							<tr>
								<td><?php echo $row["id"]?></td>
								<td class="date"><?php echo $row["date"]?></td>
								<td><b><?php echo $row["price"]?></b></td>
								<td><?php echo $row["who"]?></td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td></td>
							<td><?php echo count($d)?></td>
							<td id="bottom"><b><?php echo $realSum?></b></td>
							<td><a href="#FamilyHeader">Подняться вверх</a></td>
						</tr>
						<?php

					}

					$conn->close();
					?>
				</table>
			</div>
			<div class="row">
				<div class="col-xs-12 col-lg-6">
					<form action="Files/deleteRow.php" method="post">
						id : <input  class="form-control" type="text" name="id"><br>
						<input  class="form-control" value="Удалить" class="btn btn-default" type="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>