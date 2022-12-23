<?php 
	include('../server/connection.php');
	$alert  = array();
	if(isset($_POST['add_product'])){
		$name 		= mysqli_real_escape_string($db, $_POST['name']);
		$barcode	= mysqli_real_escape_string($db, $_POST['barcode']);
		$size		= mysqli_real_escape_string($db, $_POST['size']);
		$cprice 	= mysqli_real_escape_string($db, $_POST['cost_price']);
		$profit 	= mysqli_real_escape_string($db, $_POST['profit']);
		$sprice 	= $cprice + $profit;
		$unit		= mysqli_real_escape_string($db, $_POST['unit']);
		$min_stock	= mysqli_real_escape_string($db, $_POST['min_stock']);
		$remarks	= mysqli_real_escape_string($db, $_POST['remarks']);
		$supplier   = mysqli_real_escape_string($db, $_POST['supplier']);
	  	$image   	= $_FILES['image']['name'];
		$target   	= "../../images/".basename($_FILES['image']['name']);
        $user 		= $_SESSION['username'];

		$sql  = "INSERT INTO `products` (product_name, barcode, product_size, cost_price, profit, sell_price, unit_per_price, min_stocks, remarks, supplier_id, images) VALUES ('$name',$barcode,'$size','$cprice','$profit','$sprice','$unit','$min_stock','$remarks','$supplier','$image')";
	  	$result = mysqli_query($db, $sql);
 		if(move_uploaded_file($_FILES['image']['tmp_name'], $target) && $result == true){
 			$query 	= "INSERT INTO logs (username,purpose) VALUES('$user','Product $name Added')";
 			$insert 	= mysqli_query($db,$query);
			header('location: ../products/create_product.php?success');
	  	}else{
			array_push($alert,"There was a problem uploading the image!");
	  	}
	}
