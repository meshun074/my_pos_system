<?php 
include('server/connection.php');
$error		= array();

if (isset($_POST['login'])){
	$password	= mysqli_real_escape_string($db, $_POST['password']);
	$position	= mysqli_real_escape_string($db, $_POST['position']); 
	$username 	= mysqli_real_escape_string($db, $_POST['username']);
	$id = array();


	if($position == 'Employee'){
		$query 		= "SELECT * FROM users WHERE username = '$username' AND position = '$position'";
		
		$result 	= mysqli_query($db, $query);

		if($result->num_rows >0){
			$count = 0;
			while($row = $result->fetch_assoc())
			{
				$hash_pass =$row['password'];
				if(password_verify($password, $hash_pass))
				{
					$id[$count] = $row['id'];
					$count++;
				}
			}
			if($count==1)
			{
				$query 		= "SELECT * FROM users WHERE id = '$id[0]'";
				$result 	= mysqli_query($db, $query);
			}else{
				array_push($error, "Wrong username/password!");	
			}
		}

		if(mysqli_num_rows($result) == 1){
			while ($row = mysqli_fetch_assoc($result)) {

				$_SESSION['username'] = $row['username'];
				$user = $_SESSION['username'];
				$insert	= "INSERT INTO logs (username,purpose) VALUES('$user','User $user login')";
 				$logs = mysqli_query($db,$insert);
				header('location: employee_page.php');
			}
		}else{
			array_push($error, "Wrong username/password!");	
		}

	}else{

		$query 		= "SELECT * FROM users WHERE username = '$username' AND position = '$position'";
		$result 	= mysqli_query($db, $query);

		if($result->num_rows >0){
			$count = 0;
			while($row = $result->fetch_assoc())
			{
				$hash_pass =$row['password'];
				if(password_verify($password, $hash_pass))
				{
					$id[$count] = $row['id'];
					$count++;
				}
			}
			if($count==1)
			{
				$query 		= "SELECT * FROM users WHERE id = '$id[0]'";
				$result 	= mysqli_query($db, $query);
			}else{
				array_push($error, "Wrong username/password!");	
			}
		}

		if(mysqli_num_rows($result) == 1){
			while ($row = mysqli_fetch_assoc($result)) {
				$_SESSION['username'] = $row['username'];
				$user = $_SESSION['username'];
				$insert	= "INSERT INTO logs (username,purpose) VALUES('$user','User $user login')";
 				$logs = mysqli_query($db,$insert);
				header('location: main.php');
			}
		}else{
			array_push($error, "Wrong username/password!");	
		}
	}
}