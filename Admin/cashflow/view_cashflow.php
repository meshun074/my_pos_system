<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';  
	  	$query = "SELECT * FROM cashflow WHERE transaction_id = '".$_POST["id"]."'";  
	  	$result = mysqli_query($db, $query);  

		if(mysqli_num_rows($result) == 0)
		{
			$query = "SELECT * FROM cashflow_in WHERE transaction_id = '".$_POST["id"]."'";  
	  		$result = mysqli_query($db, $query);
			if(mysqli_num_rows($result) == 0)
			{
				$query = "SELECT * FROM cashflow_sales_ret WHERE transaction_id = '".$_POST["id"]."'";  
				$result = mysqli_query($db, $query);
			}
		}
	  	while($row = mysqli_fetch_array($result)){
	  		$output .= '  
	  			<div class="table-responsive w-100">  
		   		<table class="w-100">';   
		   	$output .= '
		   		<tr>  				   
					 <td><label>Transaction ID :</label></td>  
					 <td><strong>'.$row["transaction_id"].'</strong></td>  
				</tr>
				<tr>  
					 <td><label>Purpose :</label></td>  
					 <td><strong>'.$row["description"].'</strong></td>  
				</tr>
				
				<tr>
					<td><label>Amount :</label></td>  
					<td><strong>GHS'.$row["amount"].'</strong></td> 
				</tr>
				<tr>
					<td><label>Transaction</label></td>  
					<td><strong>'.$row["transaction_type"].'</strong></td> 
				</tr>
				<tr>
					<td><label>Date</label></td>  
					<td><strong>'.$row["transaction_date"].'</strong></td> 
				</tr>
				<tr>';  
	  }  
	  $output .= '  
		   </table>  
	  		</div>  
	  ';
	  echo $output;  
 	}  
?>
 