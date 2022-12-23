<?php 
	include("../cashflow/add.php");
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM draw_invest_flow ORDER BY transaction_date DESC ";
	$result	= mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');
    include('../print.php');
    ?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../cashflow/base.php');

		?>
		<div >
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-wallet"></i> Owners Drawings and Investments Records</h1>
			<hr>
			<div class="table-responsive mt-4 ps-4 pe-4" id="cash">
			<table class="table table-striped" id="cashflow_table" >
				<thead class="admin_background">
					<tr>
						<th scope="col" class="column-text">Username</th>
						<th scope="col" class="column-text">Transaction</th>
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
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['transaction_type'];?></td>
						<td><?php echo $row['purpose'];?></td>
						<td>GHS&nbsp<?php echo number_format($row['amount']);?></td>
						<td><?php echo date('d M Y, g:i A', strtotime($row['transaction_date']));?></td>
						<td>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['id'];?>" class="btn btn-primary btn-sm view_data"><i class="fas fa-eye fa-lg"></i></button>
						</td>
					</tr>
					<?php } ?>
			</table>
			</div>
            <div align="right" class="container p-5">
                <button  class="admin_background btn btn-outline-dark" onclick="printSection('cash')">Print Cashflow</button>
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
				<input type="button" class="admin_background btn btn-outline-dark" data-bs-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script>
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl)
	 {
      return new bootstrap.Popover(popoverTriggerEl)
	});
	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_draw_invest.php",  
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