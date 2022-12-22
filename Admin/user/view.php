<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';  
	  	$query = "SELECT * FROM users WHERE id = '".$_POST["id"]."'";  
	  	$result = mysqli_query($db, $query);  

	  	while($row = mysqli_fetch_array($result)){
			echo " <div class='card mb-3' style='max-width: 540px;'>
			<div class='row g-0'>
			  <div class='col-md-4'>
				<img src='../../images/".$row['image']."' style='height: 12rem; width:auto' class='img-fluid rounded-start' alt='...'>
			</div>
			<div class='col-md-8'>
			<div class='card-body'>";
			$output .= '  
	  			<div class="table-responsive">  
		   		<table class=" table table-borderless w-100">';   
		   	$output .= '
		   		<tr>  
					 <td ><label>Name :</label></td>  
					 <td ><strong>'.$row["firstname"].'&nbsp'.$row['lastname'].'</strong></td>  
				</tr>
				<tr>  
					 <td ><label>Phone Number :</label></td>  
					 <td ><strong>'.$row["contact_number"].'</strong></td>  
				</tr>
				<tr>
					<td ><label>Position :</label></td>  
					<td ><strong>'.$row["position"].'</strong></td> 
				</tr>';  
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

