<?php include('../server/connection.php');

if (isset($_POST["id"])) {
	$output = '';
	$id = $_POST['id'];
	$query = "SELECT * FROM products,supplier WHERE product_id = '$id' AND products.supplier_id = supplier.supplier_id";
	$result = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($result)) {
		echo " <div class='card text-center'>
			<h5 class='card-header text-capitalize'>" . $row['product_name'] . "</h5>
			<div class='card-body'>
			<div class='card text-start' >
			<div class='row g-0'>
			  <div class='col-md-4'>
				<img src='../../images/" . $row['images'] . "' class='img-fluid rounded-start h-100' alt='...'>
			  </div>
			  <div class='col-md-8'>
				<div class='card-body'>
				  ";
		$output .= '  
				<div class="table-responsive">  
				 <table class="w-100">';
		$output .= '
			 <tr>  
				  <td width="50%"><label>Product Size :</label></td>  
				  <td width="50%"><strong>' . $row["product_size"] . '</strong></td>  
			  </tr>
			  <tr>  
				   <td width="50%"><label>Price :</label></td>  
				   <td width="50%"><strong>' . $row["sell_price"] . '</strong></td>  
			  </tr>
			  <tr>
				  <td width="50%"><label>Stocks :</label></td>  
				  <td width="50%"><strong>' . $row["quantity"] . '</strong></td> 
			  </tr>
			  <tr>  
				   <td width="50%"><label>Unit per Price :</label></td>  
				   <td width="50%"><strong>' . $row["unit_per_price"] . '</strong></td>  
			  </tr>
			  <tr>  
				   <td width="50%"><label>Minimum Stocks:</label></td>  
				   <td width="50%"><strong>' . $row["min_stocks"] . '</strong></td>  
			  </tr>
			  <tr>  
				   <td width="50%"><label>Remarks:</label></td>  
				   <td width="50%"><strong>' . $row["remarks"] . '</strong></td>  
			  </tr>
			  <tr>  
				   <td width="50%"><label>Supplier:</label></td>  
				   <td width="50%"><strong>' . $row["company_name"] . '</strong></td>  
			  </tr>';
	}
	$output .= '  
		 </table>  
			</div> 
			</div>
    </div>
  </div>
</div>
  </div>
</div> 
	';
	echo $output;
}
?>


