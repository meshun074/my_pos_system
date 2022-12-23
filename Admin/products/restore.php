<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
        $user = $_SESSION['username'];
		$query = "UPDATE `products` SET deleted='FALSE' WHERE `products`.`product_id` = $id "; 
    	$result = mysqli_query($db, $query);
    	if($result==true){
    		$logs	= "INSERT INTO logs (username,purpose) VALUES('$user','Product $id restored')";
    		$insert = mysqli_query($db,$logs);
    		header("location: products.php?restore");
    	}else{
            echo $id;
			header("location: products.php?unrestore");
    	}
    }	