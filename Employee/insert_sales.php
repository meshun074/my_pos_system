<?php include 'server/connection.php';
if (isset($_POST['product'])) {
	$user = $_SESSION['username'];
	$discount = $_POST['discount'];
	$total = $_POST['totalvalue'];
	$price = $_POST['price'];
	$product = $_POST['product'];
	$quantity = $_POST['quantity'];
	$status = $_POST['status'];
	$owes = $_POST['owes'];
	$paid = $_POST['paid'];
	$depo = $_POST['depo'];
	$reciept = array();
	$receipt_no = strtoupper(uniqid());

	$employee = mysqli_query($db, "SELECT * FROM users WHERE username='$user' AND deleted='FALSE'");
	if (mysqli_num_rows($employee) == 0) {
		echo "logout";
	} else {

		if (!isset($_POST['customer'])) {
			$customer = "non customer";
		} else {
			$customer = $_POST['customer'];
		}

		$query = '';
		$customer_id = mysqli_query($db, "SELECT customer_id FROM customer WHERE CONCAT(firstname,' ',lastname) LIKE '$customer'");

		if (mysqli_num_rows($customer_id) == 0) {
			echo "failure";
		} else {
			$cust_id 	= mysqli_fetch_array($customer_id);
			$cust_id_new = $cust_id['customer_id'];

			// $sql = "INSERT INTO sales(customer_id,username,sales_office,discount,owes,status,paid,total) VALUES('$cust_id_new','$user','$depo','$discount','$owes','$status','$paid', '$total')";
			$sql = "INSERT INTO sales(receipt_no,customer_id,username,sales_office,discount,status,total) VALUES('$receipt_no','$cust_id_new','$user','$depo','$discount','$status','$total')";
			$result = mysqli_query($db, $sql);
			$sql3 = "INSERT INTO cashflow_in(transaction_id,description,amount,username,transaction_type) VALUES('$receipt_no','product sold','$total','$user','Cash_in')";
			$result3 = mysqli_query($db, $sql3);
			if ($status == 'on credit') {
				$sql = "INSERT INTO credits(receipt_no,customer_id,username,owes,paid,balance) VALUES('$receipt_no','$cust_id_new','$user','$total','$paid','$owes')";
				$result = mysqli_query($db, $sql);
			}

			if ($result == true) {
				for ($i = 0; $i < count($product); $i++) {
					$reciept[] = $receipt_no;
				}

				for ($num = 0; $num < count($product); $num++) {
					$product_id = mysqli_real_escape_string($db, $product[$num]);
					$qtyold = mysqli_real_escape_string($db, $quantity[$num]);

					$sql1 = "SELECT quantity FROM products WHERE product_id='$product_id'";
					$result1 = mysqli_query($db, $sql1);
					$qty = mysqli_fetch_array($result1);

					$newqty = $qty['quantity'] - $qtyold;

					$sql2 = "UPDATE products SET quantity=$newqty WHERE product_id='$product_id'";
					$result2 = mysqli_query($db, $sql2);
				}

				$query1 	= "INSERT INTO logs (username,purpose) VALUES('$user','Product sold')";
				$insert 	= mysqli_query($db, $query1);

				for ($count = 0; $count < count($product); $count++) {
					$price_clean = mysqli_real_escape_string($db, $price[$count]);
					$reciept_clean = mysqli_real_escape_string($db, $reciept[$count]);
					$product_clean = mysqli_real_escape_string($db, $product[$count]);
					$quantity_clean = mysqli_real_escape_string($db, $quantity[$count]);
					if ($product_clean != '' && $quantity_clean != '' && $price_clean != '' && $reciept_clean != '') {
						$query .= "
						INSERT INTO sales_product(receipt_no,product_id,customer_id,username,sales_office,price,status,product_quantity) 
						VALUES('$reciept_clean','$product_clean','$cust_id_new','$user','$depo','$price_clean','$status','$quantity_clean');
						";
					}
				}
			} else {
				echo "failure";
			}

			if ($query != '') {
				if (mysqli_multi_query($db, $query)) {
					echo "success";
				} else {
					echo "failure";
				}
			} else {
				echo 'failure';
			}
		}
	}
}
