<?php

include('../server/connection.php');
$error = array();
$alert = array();

if (isset($_POST['upload_product'])) {
	$target = $_FILES['file']['tmp_name'];
	$user = $_SESSION['username'];
	$add = '';

	if ($_FILES['file']['name']) {
		$filename = explode(".", $_FILES['file']['name']);

		if ($filename[1] == 'csv') {
			$handle = fopen($target, "r");
			fgets($handle);
			while ($data = fgetcsv($handle, 10000, ",")) {
				$barcode 		= mysqli_real_escape_string($db, $data[0]);
				$product_name 	= mysqli_real_escape_string($db, $data[1]);
				$product_size	= mysqli_real_escape_string($db, $data[2]);
				$supplier		= mysqli_real_escape_string($db, $data[3]);
				$buy_price		= mysqli_real_escape_string($db, $data[4]);
				$profit 		= mysqli_real_escape_string($db, $data[5]);
				$unit	 		= mysqli_real_escape_string($db, $data[6]);
				$min_stocks		= mysqli_real_escape_string($db, $data[7]);
				$remarks		= mysqli_real_escape_string($db, $data[8]);
				$sell_price 	= $buy_price + $profit;

				$query1 = "SELECT quantity FROM products WHERE product_no='$barcode'";
				$select = mysqli_query($db, $query1);

				if (mysqli_num_rows($select) > 0) {

					array_push($error, "Product already exist!");
				} else {
					$query1 = "SELECT supplier_id FROM supplier WHERE company_name='$supplier'";
					$select = mysqli_query($db, $query1);
					if (mysqli_num_rows($select) == 1) {
						$row = mysqli_fetch_assoc($select);
						$supplier_id = $row['supplier_id'];
						if (isset($supplier_id)) {
							$add = "INSERT INTO `products` (product_name, barcode, product_size, cost_price, profit, sell_price, unit_per_price, min_stocks, remarks, supplier_id) VALUES ('$product_name',$barcode,'$product_size','$buy_price','$profit','$sell_price','$unit','$min_stocks','$remarks','$supplier_id')";
							mysqli_query($db, $add);
						} else {
							array_push($error, "Supplier not Found!");
						}
					} else {
						array_push($error, "Supplier not Found!");
					}
				}
			}

			if (move_uploaded_file($_FILES['file']['tmp_name'], '../../csv_files/' . basename($target)) == true) {
				array_push($alert, "Successfully Imported!");
				fclose($handle);
				$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','CSV product files Added')";
				mysqli_query($db, $logs);
				header('location: ../products/products.php?success="1"');
			} else {
				array_push($error, "Something went wrong!");
			}
		} else {
			array_push($error, "CSV file is required!");
			// header('location: ../products/products.php?success="1"');
		}
	}
}
