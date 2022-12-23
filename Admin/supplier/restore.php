<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
		$user = $_SESSION['username'];	

		$query = "UPDATE supplier SET deleted='FALSE' WHERE supplier_id='$id'"; 
		$delete = mysqli_query($db, $query);
		if($delete == true){
			$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Supplier $id Restored')";
			$insert = mysqli_query($db,$logs);
			header("location: supplier.php?restore");
		}else{
			header("location: supplier.php?unrestore");
		}
		
    }	