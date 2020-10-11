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
		$email = $_POST['email'];

		//Getting the name and making it into a correct format
		function formatName($name){
			$name = strtolower($name);
			$name = str_replace(" ", "_", $name);
			$name[0] = strtoupper($name[0]);
			return $name;
		}

		// Getting the email and making it into a correct format
		function formatEmail($email){
			$email = str_replace(" ", "", $email);
			return $email;
		}

		$name = formatName($name);
		$email = formatEmail($email);
		// Getting all the names entered already
		$allNames = $_POST['names'];
		// Making an array with all the values
		$array = explode(" ", $allNames);

		// This loop makes the associative array with the names as the key and email as the value
		for ($i=0; $i < count($array); $i+=2) {	
			$agenda[$array[$i]] = $array[$i+1];
		}
		
		// Checks if both variables have values
		if(!empty($name) && !empty($email)){
			$agenda[$name] = $email;
		}elseif (empty($name) || $name == ""){
			echo "<p><b style='color:red'>Error!</b>No name detected</p>";
		}

		// Shows all the contacts
		foreach ($agenda as $key => $value) {
			echo "$key: $value <br>";
			$allNames = $allNames."$key $value ";
		}
		// Hidden input has all the names
		echo "<input type='hidden' name='names' value='$allNames'>";
		
	?>
	</form>
</body>
</html>