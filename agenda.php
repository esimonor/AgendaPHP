<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
</head>
<body>
	<?php
	if ($_POST["nombre"] != "") {
		$username = $_POST["nombre"];
		$_SESSION['user'] = $username;
		echo "<h1>Agenda of ".$_SESSION['user']."</h1>";
	}else{
		echo "<h1>Agenda of ".$_SESSION['user']."</h1>";
	}
	?>
	
	<form action="agenda.php" method="POST">
		<span>Name: </span><input type="text" name="name">
		<span>Email: </span><input type="text" name="email">

		<input type="submit" value="Add contact">
		<br>
	<?php
		$name = $_POST['name'];
		$name = strtolower($name);
		$name[0] = strtoupper($name[0]);
		$email = $_POST['email'];
		$allNames = $_POST['names'];
		$array = explode(" ", $allNames);
		// "Nombre correo@gmail.com nombre2 correo2@gmail.com"
		// $array[0] = Nombre $array[1] = correo@gmail.com

		// $agenda[$array[0](Nombre) ] = $array[1](correo@gmail.com)
		// $agenda['Nombre'] => correo@gmail.com
		// Nombre => correo@gmail.com
		for ($i=0; $i < count($array); $i+=2) {
			if ($i+1 > count($array)) {
				print_r($agenda);
			}else{
			$agenda[$array[$i]] = $array[$i+1];
			}
		}
		
		if(!empty($name) && !empty($email)){
			$agenda[$name] = $email;
		}

		if(empty($name) || $name == ""){
			echo "<p><b style='color:red'>Error!</b>No name detected</p>";
		}
		if(empty($email) || $email == ""){
			echo "<p><b style='color:red'>Error!</b>No email detected</p>";
		}

		foreach ($agenda as $key => $value) {
			echo "$key: $value <br>";
			$allNames = $allNames."$key $value ";
		}
		echo "<input type='hidden' name='names' value='$allNames'>";
	?>
	</form>
</body>
</html>