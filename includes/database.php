<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "calendar_db");

	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	if(mysqli_connect_errno()){
		die("Database connection failed: " . 
			mysqli_connect_error() . 
			"(" . mysqli_connect_errno() . ")"
		);
	}
		
?>

	<?php
		$query = "SELECT * from viewDate";
		$result = mysqli_query($connection, $query);
		if(!$result) {
			die("Database query failed.");
		}
	?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		while($row=mysqli_fetch_assoc($result)){
			var_dump($row);
		}
	?>

	<?php
		mysqli_free_result($result);
	?>

</body>
</html>

<?php
	mysqli_close($connection);
?>