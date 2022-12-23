<?php include('../server/connection.php');
if (isset($_GET['id'])) {
	$id	= $_GET['id'];
	$user = $_SESSION['username'];
	$query = "DELETE FROM users WHERE id = '$id'";
	if (mysqli_query($db, $query) == true) {
		$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','User $id Deleted')";
		$insert = mysqli_query($db, $logs);
		header("location: user.php?deleted");
	} else {
		$query = "UPDATE users SET deleted='TRUE' WHERE id = '$id'";
		$result = mysqli_query($db, $query);
		if ($result == true) {
			$insert 	= "INSERT INTO logs (username,purpose) VALUES('$user','User $id Deleted')";
			mysqli_query($db, $insert);
			header("location: user.php?deleted");
		} else {
			header("location: user.php?undelete");
		}
	}
}
