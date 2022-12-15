<?php 
	include('server/connection.php');
	// if(isset($_POST['submit']))
	if(isset($_FILES['image']['name'])){
		$user 		= $_POST['user'];
		$fname 		= $_POST['fname'];
		$lname 		= $_POST['lname'];
		$address	= $_POST['address'];
		$number		= $_POST['number'];
	  	$image   	= $_FILES['image']['name'];
		$target   	= "images/".basename($_FILES['image']['name']);
		
		$sql  = "INSERT INTO customer (firstname,lastname,address,contact_number,image) VALUES ('$fname','$lname','$address','$number','$image')";
	  	$result = mysqli_query($db, $sql);
 		if(move_uploaded_file($_FILES['image']['tmp_name'], $target) && $result == true){
 			$query 	= "INSERT INTO logs (username,purpose,logs_time) VALUES('$user','Customer $fname Added',CURRENT_TIMESTAMP)";
 			$insert 	= mysqli_query($db,$query);
			// header('location: main.php?username='.$user.'&added');
			echo "cus_added";
	  	}else{
			$msg = "Something went wrong!";
	  	}
	}
	
	?>
