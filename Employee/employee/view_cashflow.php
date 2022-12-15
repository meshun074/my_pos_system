<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';
		$id = $_POST['id'];  
	  	$query = "SELECT * FROM products,sales_product,customer WHERE sales_product.receipt_no = '$id' AND products.product_id = sales_product.product_id AND sales_product.customer_id = customer.customer_id";  
	  	$result = mysqli_query($db, $query);
		$query1 = "SELECT * FROM products,sales_product,customer WHERE sales_product.receipt_no = '$id' AND products.product_id = sales_product.product_id AND sales_product.customer_id = customer.customer_id";  
	  	$result1 = mysqli_query($db, $query1);
		$first_row = mysqli_fetch_assoc($result1);
		if ($first_row){
			echo "<h1 class='d-flex'>".$id."</h1>";
			echo "<h3 class='d-flex'>".$first_row['date']."</h3>";
			echo "<h3 class='d-flex'>".$first_row['firstname']." ".$first_row['lastname']."</h3>";
			echo "<h5 class='d-flex'>".$first_row['sales_office']."</h5>";
			echo "<h5 class='d-flex'>".$first_row['status']."</h5>";
		}
		

	  	while($row = mysqli_fetch_array($result)){

			$output .= '  
	  			<div class="table-responsive">  
		   		<table class="w-75">';
		   	$output .= '
			   <tr>  
					<th width="50%"><label>Product :</label></th>  
					<th width="50%"><strong>'.$row["product_name"].'</strong></th>  
				</tr>
				<tr>  
					 <td width="50%"><label>Price :</label></td>  
					 <td width="50%"><strong>GHS '.$row["price"].'</strong></td>  
				</tr>
				<tr>
					<td width="50%"><label>Stocks :</label></td>  
					<td width="50%"><strong>'.$row["product_quantity"].'</strong></td> 
				</tr>
				<tr>  
					 <td width="50%"><label>Total :</label></td>  
					 <td width="50%"><strong>GHS '.($row["product_quantity"]*$row["price"]).'</strong></td>  
				</tr>';  
	  }  
	  $output .= '  
		   </table>  
	  		</div>  
	  ';
	  echo $output;  
 	}  
?>
 