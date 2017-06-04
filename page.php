<?php
include("check.php");

$servername = "localhost";
$username = "test";
$password = "t3st3r123";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['user_id'];

$q = "select id, user_id, task, time from bb_eksam_task where user_id = '$user' order by time;";
$result = $conn->query($q);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "id: " . $row["id"]. " <br>Task: " . $row["task"]. "<br>Time: " . $row["time"]. "<br><br>";
	}
}else{
	echo "Nothing to show";
}
	
if(isset($_POST['msg_send']) && $_POST['msg_send'] == 'msg_send'){
	$msg = strip_tags(trim($_POST['msg']));
	$conn->query("insert into bb_eksam_task(user_id, task) values('$user', '$msg')");
	header("refresh: 0;");
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
		<div id='task'>
			<form method='post' action='#'>
				<textarea name='msg' id='msg' placeholder='Your msg...' required></textarea>
				<br><br>
				<input type='submit' name='msg_send' id='msg_send' value='msg_send'>
			</form>
		</div>
		<button><a href="exit.php">Exit</a></button>
	</body>
</html>