<?php 
	include("../server/connection.php");
	include '../set.php';
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM delivery WHERE delivery.supplier_id = '$id'";
	$result	= mysqli_query($db, $sql);

	$failure = "";
	$restore = isset($_GET['restore']);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$unrestore = isset($_GET['unrestore']);
	$error = "";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php include('../supplier/base.php');?>
		<div>
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-record-vinyl"></i> Supplier Records</h1>
			<hr>
			<?php include('../alert.php');?>
			<div class="table-responsive mt-4 ps-4 pe-4">
			<table class="table table-striped table-bordered table-sm" id="supplier_table">
				<thead class="admin_background">  	 	 	
					<tr>
						<th scope="col" class="column-text">transaction_no</th>
						<th scope="col" class="column-text">username</th>
						<th scope="col" class="column-text">Total</th>
						<th scope="col" class="column-text">Date</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_array($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['transaction_no'];?></td>
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['Total'];?></td>
						<td><?php echo date('d M Y, g:i A', strtotime($row["date"]));?></td>
						<td>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['transaction_no'];?>" class="btn btn-primary btn-xs view_product"><i class="fa-solid fa-bullseye"></i></button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<button class="admin_background btn-outline-dark p-2 rounded mt-2" onclick="window.location.href='../supplier/supplier.php'"><i class="fa-solid fa-left-long"></i> Back</button>
			</div>			
		</div>		
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../supplier/delete_supplier.php');?>
	<script>
		$(document).ready(function(){
			$('#supplier_table').dataTable();
		})
	</script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>
<div id="productModal" class="modal fade bd-example-modal-md" data-bs-backdrop="static" data-bs-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="product_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default btn-success" data-bs-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script src="../supplier/script.js"></script>