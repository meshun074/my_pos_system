<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';  
	  	$query = "SELECT * FROM draw_invest_flow WHERE id = '".$_POST["id"]."'";  
	  	$result = mysqli_query($db, $query);  

	  	while($row = mysqli_fetch_array($result)){
	  		$output .= '  
	  			<div class="table-responsive w-100">  
		   		<table class="w-100">';   
		   	$output .= '
		   		<tr>  				   
					 <td><label>Transaction ID :</label></td>  
					 <td><strong>'.$row["transaction_type"].'</strong></td>  
				</tr>
				<tr>  
					 <td><label>Purpose :</label></td>  
					 <td><strong>'.$row["purpose"].'</strong></td>  
				</tr>
				
				<tr>
					<td><label>Amount :</label></td>  
					<td><strong>GHS'.$row["amount"].'</strong></td> 
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
 