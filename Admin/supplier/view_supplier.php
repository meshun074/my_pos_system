<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';  
	  	$query = "SELECT * FROM supplier WHERE supplier_id='".$_POST['id']."'";  
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
					 <td ><label>Company Name :</label></td>  
					 <td ><strong>'.$row["company_name"].'</strong></td>  
				</tr>
		   		<tr>  
					 <td ><label>Name :</label></td>  
					 <td ><strong>'.$row["firstname"].'&nbsp'.$row["lastname"].'</strong></td>  
				</tr>		   		
				<tr>  
					 <td ><label>Address :</label></td>  
					 <td ><strong>'.$row["address"].'</strong></td>  
				</tr>

				<tr>  
					 <td ><label>Phone Number :</label></td>  
					 <td ><strong>'.$row["contact_number"].'</strong></td>  
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
 