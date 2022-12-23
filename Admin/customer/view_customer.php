<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';  
	  	$query = "SELECT * FROM customer WHERE customer_id = '".$_POST["id"]."'";  
	  	$result = mysqli_query($db, $query);  

	  	while($row = mysqli_fetch_array($result)){
			echo "<div class='card mb-3' >
			<div class='row g-0'>
			<div class='col-md-4  mt-2'>";
			echo "<img width='150' height='150' style='border:1px; border-radius:2px' src='../../images/".$row['image']."'>";
			echo "</div>";
			$output .= '  
				<div class="col-md-8">
				<div class="card-body"> 
	  			<div class="table-responsive">  
		   		<table class="w-100">';   
		   	$output .= '
		   		<tr>  
					 <td width="50%"><label>Customer Name :</label></td>  
					 <td width="50%"><strong>'.$row["firstname"].'&nbsp'.$row['lastname'].'</strong></td>  
				</tr>
				<tr>  
					 <td width="50%"><label>Address :</label></td>  
					 <td width="50%"><strong>'.$row["address"].'</strong></td>  
				</tr>
				<tr>
					<td width="50%"><label>Contact Number :</label></td>  
					<td width="50%"><strong>'.$row["contact_number"].'</strong></td> 
				</tr>
				<tr>';  
	  }  
	  $output .= '  
		   </table>  
	  		</div>
			  </div>
			  </div>
			</div>
		  </div>  
	  ';
	  echo $output;  
 	}  
?>
 