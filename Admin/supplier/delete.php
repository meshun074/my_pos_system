<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
		$user = $_SESSION['username'];
		$query = '';
		$products = mysqli_query($db, "SELECT * FROM products WHERE deleted='FALSE' AND supplier_id='$id'");

		
		if(mysqli_num_rows($products) == 0){
			$query = "DELETE FROM supplier WHERE supplier_id='$id'"; 
			if(mysqli_query($db, $query)==true){
				$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Supplier $id deleted')";
				$insert = mysqli_query($db,$logs);
				header("location: supplier.php?deleted");
			}else{
				$query = "UPDATE supplier SET deleted='TRUE' WHERE supplier_id='$id'"; 
				$bin = mysqli_query($db, $query);
				if($bin== true){
					$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Supplier $id Deleted')";
					$insert = mysqli_query($db,$logs);
					header("location: supplier.php?deleted");
				}else{
					header("location: supplier.php?undelete");
				}
			}
		}else{			
			header("location: supplier.php?undelete");			
		}
    }	