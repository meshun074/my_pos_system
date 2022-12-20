<?php 
	include("../cashflow/add.php");
	include("../server/connection.php");
	include '../set.php';
	$user = $_SESSION['username'];
	// $sql = "SELECT * FROM cashflow WHERE username='$user' ORDER BY transaction_id ASC ";
	$sql = "SELECT transaction_id, description, amount, transaction_date FROM cashflow_in WHERE username='$user' ORDER BY transaction_date ASC";
	$result	= mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../employee/base3.php');
		?>
		<div>
			<h1 class="ms-4 pt-2"><i class="fas fa-money-bill-alt"></i> Cash Management</h1>
			<hr>
			<div class="table-responsive mt-2 p-3">
			<table class="table table-striped" id="cashflow_table" style="margin-top: -22px;">
				<thead>
					<tr>
						<th scope="col" class="column-text">Transaction No.</th>
						<th scope="col" class="column-text">Purpose</th>
						<th scope="col" class="column-text">Amount</th>
						<th scope="col" class="column-text">Date</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
					<?php 
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['transaction_id'];?></td>
						<td><?php echo $row['description'];?></td>
						<td>₵&nbsp<?php echo number_format($row['amount']);?></td>
						<td><?php echo date('d M Y, g:i A', strtotime($row['transaction_date']));?></td>
						<td>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px; background-color: #1b1464;' id="<?php echo $row['transaction_id'];?>" class="btn btn-default btn-sm view_data text-white"><i class="fas fa-eye fa-lg"></i></button>
						</td>
					</tr>
					<?php } ?>
			</table>
			</div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#cashflow_table').dataTable();
		})
	</script>
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-bs-backdrop="static" data-bs-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default" style="background-color: #1b1464; color:aliceblue" data-bs-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script>
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_cashflow.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#Contact_Details').html(data);  
					$('#dataModal').modal('show');  
				}  
			});  
		}            
	});   
 });  

</script>