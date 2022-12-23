<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
        $use = $_SESSION['username'];
		$query = "UPDATE customer SET deleted='FALSE' WHERE customer_id = '$id'"; 
		if(mysqli_query($db, $query)==true){
			$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Customer $id restored')";
			$insert = mysqli_query($db,$logs);
			header("location: customer.php?restore");
		}else{ 
			header("location: customer.php?unrestore");
		}
		
    }	