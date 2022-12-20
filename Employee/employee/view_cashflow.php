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
			echo " <div class='card'>
			<div class='card-header'>
			Sales No: ".$id."
			</div>
			<div class='card-body'>
			  <h5 class='card-title'> Customer: ".$first_row['firstname']." ".$first_row['lastname']." <br>
			  Sale Point: ".$first_row['sales_office']." <br>
			  Status&nbsp &nbsp &nbsp   :    ".$first_row['status']."</h5>";
		}
		

	  	while($row = mysqli_fetch_array($result)){

			$output .= '  
	  			<div class="table-responsive">  
		   		<table class="w-100"> 
				<tbody>';
		   	$output .= '
			   <tr>  
					<th width="25%"><label>Product </label></th>
					<th width="25%"><label>Price </label></th>
					<th width="25%"><label>Stocks </label></th>
					<th width="25%"><label>Total </label></th>    
				</tr>
				<tr> 
					<td width="25%"><strong>'.$row["product_name"].'</strong></td>  
					<td width="25%"><strong>₵ '.$row["price"].'</strong></td>
					<td width="25%"><strong>'.$row["product_quantity"].'</strong></td>					
					<td width="25%"><strong>₵ '.$row["product_quantity"]*$row["price"].' </td>
				</tr>';  
	  }  
	  $output .= " 
	  </tbody> 
		   </table>  
	  		</div> 
			  </div>
			</div> 
	  ";
	  echo $output;  
 	}
