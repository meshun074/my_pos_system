<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
        $user = $_SESSION['username'];
		$query = "UPDATE users SET deleted='FALSE' WHERE id = '$id'"; 
    	$result = mysqli_query($db, $query);
    	if($result == true){
    		$insert 	= "INSERT INTO logs (username,purpose) VALUES('$user','User $id restored')";
 			mysqli_query($db,$insert);
			header("location: user.php?restore");
    	}else{
    		header("location: user.php?unrestore");
    	}
    }	