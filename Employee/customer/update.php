<?php
	include('../server/connection.php');
	$alert		= array();
  	if(isset($_POST['update_customer'])){
		$target   	= "../images/".basename($_FILES['image']['name']);
	  	$image    	= $_FILES['image']['name'];
	  	$id       	= $_POST['id'];
	  	$fname 		= mysqli_real_escape_string($db, $_POST['fname']);	
	  	$lname 	 	= mysqli_real_escape_string($db, $_POST['lname']);
	  	$address	= mysqli_real_escape_string($db, $_POST['address']);
	  	$number   	= mysqli_real_escape_string($db, $_POST['number']);
		$username	= $_SESSION['username'];

		if (!empty($image)){
			$sql  = "UPDATE customer SET firstname='$fname',lastname='$lname',address='$address',contact_number='$number',image='$image' WHERE customer_id = '$id'";
		  	mysqli_query($db, $sql);
			$sql1 	= "INSERT INTO logs (username,purpose) VALUES('$username','Customer $fname updated')";
			$insert = mysqli_query($db,$sql1);
		  	if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
		  		$msg = "Image successfully uploaded!";		  		
 				header('location: ../customer/customer.php?updated');
		  	}
			
		}else{
		  	$sql  = "UPDATE customer SET firstname='$fname',lastname='$lname',address='$address',contact_number='$number' WHERE customer_id = '$id'";
		  	mysqli_query($db, $sql);
		  	$msg = "Image successfully uploaded!";
		  	$sql1 	= "INSERT INTO logs (username,purpose) VALUES('$username','Customer $fname updated')";
			$insert = mysqli_query($db,$sql1);
 			header('location: ../customer/customer.php?updated');
		}
		  		array_push($alert,"There was a problem uploading the image!");
  	}		