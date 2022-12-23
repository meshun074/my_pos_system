<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';  
	  	$query = "SELECT products.product_name, products.images,products.product_size,sales_product.price, sales_product.product_quantity, products.unit_per_price,sales_product.status FROM sales_product,products WHERE sales_product.product_id=products.product_id AND receipt_no = '".$_POST["id"]."' ";  
	  	$result = mysqli_query($db, $query);  

	  	echo '<div class="row row-cols-1 row-cols-md-3 g-4 p-2 h-100 overflow-auto" >';
	  	while($row = mysqli_fetch_array($result)){			
			$output .= '<div class="col m-2">
			<div class="card h-100">
			<img width="170" height="170" src="../../images/'.$row["images"].'" class="card-img-top" alt="...">
			   <div class="card-body">
		   		<p>  					
					Name: <strong>'.$row["product_name"].'</strong> <br>
					Size : <strong>'.$row["product_size"].'</strong> <br>  
					Price ₵: <strong>'.$row["price"].'</strong>  <br>
					Stocks :  <strong>'.$row["product_quantity"].'</strong><br> 
					Unit : <strong>'.$row["unit_per_price"].'</strong> <br>  
					Status : <strong>'.$row["status"].'</strong> 
				</p> 
				</div>
				</div>
				</div>';  
	  }  
	  $output .= '  
	  </div>	 
	  ';
	  echo $output;  
 	}  
?>
 