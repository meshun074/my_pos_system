<?php include('../server/connection.php');

	if(isset($_POST["id"])){  
		$output = '';
		$id = $_POST['id'];  
	  	$query = "SELECT  username, purpose, DAYNAME(logs_time) AS day, DATE(logs_time) AS date, TIME(logs_time) AS time FROM logs WHERE id = '$id'";  
	  	$result = mysqli_query($db, $query);  

	  	while($row = mysqli_fetch_array($result)){
	  		echo "<h1 class='d-flex text-capitalize'>".$row['username']."</h1>";
			$output .= '  
	  			<div class="table-responsive">  
		   		<table class="w-75">';
		   	$output .= '
		   		<tr>  
					 <td width="50%"><label>Activity :</label></td>  
					 <td width="50%"><strong>'.$row["purpose"].'</strong></td>  
				</tr>
				<tr>  
					 <td width="50%"><label>Date :</label></td>  
					 <td width="50%"><strong>'.date('d M Y', strtotime($row['date'])).'</strong></td>  
				</tr>
				<tr>  
					 <td width="50%"><label>Time :</label></td>  
					 <td width="50%"><strong>'.date('d M Y, g:i A', strtotime($row['time'])).'</strong></td>  
				</tr>
				<tr>  
					 <td width="50%"><label>Day :</label></td>  
					 <td width="50%"><strong>'.$row['day'].'</strong></td>  
				</tr>';  
	  }  
	  $output .= '  
		   </table>  
	  		</div>  
	  ';
	  echo $output;  
 	}  
?>
 