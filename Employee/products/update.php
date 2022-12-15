<?php

	include("../server/connection.php");
	$msg 		= '';
  	if(isset($_POST['update'])){
		$target   	= "../images/".basename($_FILES['images']['name']);
	  	$image    	= $_FILES['images']['name'];
	  	$id       	= $_POST['id'];
	  	$pro_name 	= mysqli_real_escape_string($db, $_POST['product_name']);
		$barcode 	= mysqli_real_escape_string($db, $_POST['barcode']);
		$pro_size 	= mysqli_real_escape_string($db, $_POST['product_size']);	
		$c_price 	 	= mysqli_real_escape_string($db, $_POST['cost_price']);
		$profit 	 	= mysqli_real_escape_string($db, $_POST['profit']);
		$price 	 	= mysqli_real_escape_string($db, $_POST['price']);
	  	$qty 		= mysqli_real_escape_string($db, $_POST['qty']);
	  	$unit   	= mysqli_real_escape_string($db, $_POST['unit']);
	  	$min_stocks = mysqli_real_escape_string($db, $_POST['min_stocks']);
	  	$remarks 	= mysqli_real_escape_string($db, $_POST['remarks']);
	  	$supplier 	= mysqli_real_escape_string($db, $_POST['supplier_id']);
	  	$username	= $_SESSION['username'];

		if (!empty($image)){
		  	$sql  = "UPDATE products SET product_name='$pro_name',barcode='$barcode',product_size='$pro_size',cost_price='$c_price',profit='$profit' ,sell_price=$price,quantity=$qty,unit_per_price='$unit',min_stocks=$min_stocks,remarks='$remarks', supplier_id='$supplier', images='$image' WHERE product_id = '$id'";
		  	mysqli_query($db, $sql);
		  	if(move_uploaded_file($_FILES['images']['tmp_name'], $target)){
		  		$sql 	= "INSERT INTO logs (username,purpose) VALUES('$username','Product $pro_name updated')";
 				$insert = mysqli_query($db,$sql);
 				header('location: ../products/products.php?updated');
 			}
		}else{
		  	$sql  = "UPDATE products SET product_name='$pro_name',barcode='$barcode',product_size='$pro_size',cost_price='$c_price',profit='$profit' ,sell_price=$price,quantity=$qty,unit_per_price='$unit',min_stocks=$min_stocks,remarks='$remarks', supplier_id='$supplier' WHERE product_id = '$id'";
		  	$result = mysqli_query($db, $sql);
 			if($result == true){
 				$query 	= "INSERT INTO logs (username,purpose) VALUES('$username','Product $pro_name updated')";
 				mysqli_query($db,$query);
 				echo $sql;
 	 			header('location: ../products/products.php?updated');
 			}
 		}
 	}