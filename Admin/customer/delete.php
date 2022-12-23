<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
        $user = $_SESSION['username'];
		$query = "DELETE FROM customer WHERE customer_id = '$id'"; 
    	if(mysqli_query($db, $query)==true){
    		$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Customer $id deleted')";
 			$insert = mysqli_query($db,$logs);
			header("location: customer.php?deleted");
    	}else{
			$query = "UPDATE customer SET deleted='TRUE' WHERE customer_id = '$id'"; 
			if(mysqli_query($db, $query)==true){
				$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Customer $id deleted')";
				$insert = mysqli_query($db,$logs);
				header("location: customer.php?deleted");
			}else{ 
				header("location: customer.php?undelete");
			}
		}
    }	