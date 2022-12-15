<?php 
	include('../server/connection.php');

	if(isset($_POST['product_name'])){
		$product_id 	= json_decode($_POST['product_name']);
		$qty 		= json_decode($_POST['quantity']);
		$buy_price 	= json_decode($_POST['buy_price']);
		$sell_price = json_decode($_POST['sell_price']);
		$supplier 	= mysqli_real_escape_string($db,$_POST['supplier']);
		$transaction_no = mysqli_real_escape_string($db,$_POST['transaction_no']);
		$user 		= mysqli_real_escape_string($db,$_SESSION['username']);
		$total	= mysqli_real_escape_string($db,$_POST['total']);
		$transaction = array();
		$insert = '';
		$insert2 = '';
		$update = '';

		$search = "SELECT supplier_id FROM supplier WHERE company_name = '$supplier'";
		$show = mysqli_query($db,$search);
		$row = mysqli_fetch_array($show);
		$supplier_1 = $row['supplier_id'];
		
		if(mysqli_num_rows($show) == 0 || $show == false){
			echo "failure";

		}else{
			$insert3 = "INSERT INTO delivery(transaction_no,username,supplier_id,Total) VALUES('$transaction_no','$user','$supplier_1','$total')";
			$res3 = mysqli_query($db, $insert3);
			$insert2 .= "INSERT INTO cashflow (transaction_id,description,amount,username,transaction_type) VALUES('$transaction_no','Delivery payment','-$total','$user','Cash_out');";
			$res2 = mysqli_query($db, $insert2);
			$insert1 = "INSERT INTO logs (username,purpose) VALUES('$user','Delivery Added')";
			$res1 = mysqli_query($db, $insert1);
			if($res2 && $res1 && $res3 == true){
				for($count = 0; $count<count($product_id); $count++){
					$transaction[] = $transaction_no;

				}
				for($num= 0; $num < count($product_id); $num++){
					$transaction1 	= mysqli_real_escape_string($db, $transaction[$num]);
					$product_1		= mysqli_real_escape_string($db, $product_id[$num]);
					$qty_1 			= mysqli_real_escape_string($db, $qty[$num]);
					$buy_price_1	= mysqli_real_escape_string($db, $buy_price[$num]);
					$sell_price_1 	= mysqli_real_escape_string($db, $sell_price[$num]);
					$total_1        = $qty_1 * $sell_price_1;

					$query = "SELECT product_id,cost_price,profit,sell_price,quantity FROM products WHERE product_id='$product_1'";
					$result1 = mysqli_query($db, $query);
					if(mysqli_num_rows($result1)>0){
						while($row = mysqli_fetch_array($result1)){
							$newqty = $row['quantity'] + $qty_1;
							$newc_price = $buy_price_1;
							$news_price = $sell_price_1;
							$newprofit  = $sell_price_1 - $buy_price_1;
							$update .= "
							UPDATE products SET cost_price = $newc_price, profit=$newprofit,sell_price = $news_price,quantity = $newqty WHERE product_id = '$product_1';";
							// $update .= "UPDATE products SET cost_price = $newc_price, profit=$newprofit,sell_price = $news_price,quantity = $newqty WHERE product_id = '$product_1'";
							// $result2 = mysqli_query($db, $query1);
							// if($result2){
								// $query4 = "INSERT INTO cashflow (transaction_no,description,product_id,amount,username,transaction_type) VALUES('$transaction1','Delivery payment',$product_1,$total,$user,'Cash_out')";
								// $result4 = mysqli_query($db, $query4);
								// echo 'success';
							// }
							// else{
							// 	echo '<script>swal("Failed","Failed to update cash flow,","error");</script>';
							// 	echo 'failure';
							// }
						}

						$insert .= "
						INSERT INTO product_delivered(transaction_no,username,product_id,total_qty,buy_price,sell_price,supplier_id,Total)
						VALUES('$transaction1','$user','$product_1','$qty_1','$buy_price_1','$sell_price_1','$supplier_1','$total_1');";
						
					// }else{
					// 	$query3 = "DELETE FROM `product_delivered` WHERE `transaction_no` = $transaction_no";
					// 	$result3= mysqli_query($db, $query3);
					// 	if($result3)
					// 	{
					// 		echo '<script>swal("Failed","Failed to add delivery","error");</script>';
					// 		echo 'failure';
					// 	}
					// 	else{
					// 		echo '<script>swal("Success","Failed to update product, delivery added","error");</script>';
					// 		echo 'failure';
					// 	}
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
