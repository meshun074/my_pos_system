<?php 
	include('../server/connection.php');

	if(isset($_POST['product_name'])){
		$product_id 	= json_decode($_POST['product_name']);
		$qty 		= json_decode($_POST['quantity']);
		$sell_price = json_decode($_POST['sell_price']);
		$customer 	= mysqli_real_escape_string($db,$_POST['customer']);
		$transaction_no = mysqli_real_escape_string($db,$_POST['credit_note_no']);
		$user 		= mysqli_real_escape_string($db,$_SESSION['username']);
		$total	= mysqli_real_escape_string($db,$_POST['total']);
		$transaction = array();
		$insert = '';
		$insert2 = '';
		$update = '';

		$search = "SELECT customer_id FROM customer WHERE customer_id = '$customer'";
		$show = mysqli_query($db,$search);
		$row = mysqli_fetch_array($show);
		$customer_1 = $row['customer_id'];
		
		if(mysqli_num_rows($show) == 0 || $show == false){
			echo "failure";

		}else{
			$insert3 = "INSERT INTO credit_note(sales_return_no,username,customer_id,Total) VALUES('$transaction_no','$user','$customer_1','$total')";
			$res3 = mysqli_query($db, $insert3);
			$insert2 .= "INSERT INTO cashflow_sales_ret(transaction_id,description,amount,username,transaction_type) VALUES('$transaction_no','Sales return','-$total','$user','Cash_out');";
			$res2 = mysqli_query($db, $insert2);
			$insert1 = "INSERT INTO logs (username,purpose) VALUES('$user','Received Sales return')";
			$res1 = mysqli_query($db, $insert1);
			if($res2 && $res1 && $res3 == true){
				for($count = 0; $count<count($product_id); $count++){
					$transaction[] = $transaction_no;

				}
				for($num= 0; $num < count($product_id); $num++){
					$transaction1 	= mysqli_real_escape_string($db, $transaction[$num]);
					$product_1		= mysqli_real_escape_string($db, $product_id[$num]);
					$qty_1 			= mysqli_real_escape_string($db, $qty[$num]);
					$sell_price_1 	= mysqli_real_escape_string($db, $sell_price[$num]);
					$total_1        = $qty_1 * $sell_price_1;

					$query = "SELECT product_id,quantity FROM products WHERE product_id='$product_1'";
					$result1 = mysqli_query($db, $query);
					if(mysqli_num_rows($result1)>0){
						while($row = mysqli_fetch_array($result1)){
							$newqty = $row['quantity'] + $qty_1;							
							$update .= "
							UPDATE products SET  quantity = $newqty WHERE product_id = '$product_1';";
						}

						$insert .= "
						INSERT INTO sales_return(credit_note_no,username,product_id,total_qty,sell_price,Total)
						VALUES('$transaction1','$user','$product_1','$qty_1','$sell_price_1','$total_1');";
						

					}
				}
			}
			//insert into delivery
			if($insert != ''){
				if (mysqli_multi_query($db, $insert)) {
	    			do {
			       		if ($insert = mysqli_store_result($db)) {
			            	mysqli_free_result($insert);

			            }
		        		if (mysqli_more_results($db)) {
		        		}
		    		}while (mysqli_more_results($db) && mysqli_next_result($db));
					if($update != ''){
						if (mysqli_multi_query($db, $update)) {
							do {
								   if ($insert = mysqli_store_result($db)) {
									mysqli_free_result($insert);
		
								}
								if (mysqli_more_results($db)) {
								}
							}while (mysqli_more_results($db) && mysqli_next_result($db));
							echo "success";
		
		
						}else{
							echo "failure";
						}
					}else{
						echo "failure";
					}


				}else{
					echo "failure";
				}
			}else{
				echo "failure";
			}	
		}
	}
?>
