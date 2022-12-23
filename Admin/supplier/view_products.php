<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';
		$id = $_POST['id'];  
	  	$query = "SELECT products.product_name, products.images,products.product_size,product_delivered.sell_price, product_delivered.total_qty, products.unit_per_price,product_delivered.Total FROM products, product_delivered WHERE product_delivered.transaction_no = '$id' AND product_delivered.product_id=products.product_id";  
	  	$result = mysqli_query($db, $query);  

		echo '<div class="row row-cols-1 row-cols-md-3 g-4 p-2 h-100 overflow-auto" >';
	  	while($row = mysqli_fetch_array($result)){			
			$output .= '<div class="col m-2">
			<div class="card h-100">
			<img width="160" height="160" src="../../images/'.$row["images"].'" class="card-img-top" alt="...">
			   <div class="card-body">
		   		<p>  					
					Name: <strong>'.$row["product_name"].'</strong> <br>
					Size : <strong>'.$row["product_size"].'</strong> <br>  
					Price ₵: <strong>'.$row["sell_price"].'</strong>  <br>
					Stocks :  <strong>'.$row["total_qty"].'</strong><br> 
					Unit : <strong>'.$row["unit_per_price"].'</strong> <br>  
					Total ₵: <strong>'.$row["Total"].'</strong> 
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

<!-- <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <img src='...' class='card-img-top' alt='...'>
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div> -->