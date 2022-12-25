<?php 

$error		= array();
$alert 		= array();

if (isset($_POST['changepass'])){
	$username 	= $_SESSION['username'];
	$newpass 	= mysqli_real_escape_string($db, $_POST['newpass']);
	$confirmpass	= (mysqli_real_escape_string($db, $_POST['confirmpass']));
	
	$query 		= "SELECT * FROM users WHERE username = '$username' AND deleted='FALSE'";
	$result 	= mysqli_query($db, $query);
	$row 		= mysqli_fetch_array($result);

	if ($newpass != $confirmpass){
		array_push($error, "The Password did not match!"); 
	}
	
	if (password_verify($confirmpass, $row['password'])){
		array_push($error, "The Password is still the same!");
	}

	if (count($error) == 0){
		$newpass = password_hash($confirmpass,PASSWORD_DEFAULT);
		$sql  = "UPDATE users SET password='$newpass' WHERE username = '$username' AND deleted-'FALSE'";
		$update = mysqli_query($db ,$sql);
		array_push($alert, "Password Successfully Changed!");
	}else{

	}
}