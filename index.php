<?php

if(isset($_POST['send']) && $_POST['send'] == 'send'){
	
	$servername = "localhost";
	$username = "test";
	$password = "t3st3r123";
	$dbname = "test";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		
	$user = strip_tags(trim($_POST['user']));
	$pwd = hash("sha256", strip_tags(trim($_POST['pwd'])));
	print_r($pwd);
	$q = "select login_id from bb_eksam_login where password = '$pwd' and username = '$user';";
	$result = $conn->query($q);
	if ($result->num_rows > 0) {
		$id= $result->fetch_assoc()['login_id'];
		
		session_start();
		$_SESSION['sessionId'] = time();
		$_SESSION['username'] = $user;
		$_SESSION['user_id'] = $id;
		$_SESSION['loginStatus'] = "L0G!N";
		
		header('Location:page.php');
	}else{
		echo "<script>alert('Try again!');</script>";
	}
	$conn->close();
}
?>
<!DOCTYPE html>
<html lang="et" xml:lang="et" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<title>Eksam Brokan, AK11</title>
		<style type="text/css">
			
		</style>
	</head>
	<body>
		<form method='post' action='#'>
			<h3>Login</h3>
			<input type='text' name='user' id='user' placeholder='Username...' required>
			<br><br>
			<input type='password' name='pwd' id='pwd' placeholder='Password...' required>
			<br><br>
			<input type='submit' name='send' id='send' value='send'>
		</form>
	</body>
</html>