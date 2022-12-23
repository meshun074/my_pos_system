<?php 
	include("../server/connection.php");
	include '../set.php';
	
	$sql = "SELECT * FROM supplier WHERE deleted='TRUE'";
	$result	= mysqli_query($db, $sql);
	$restore = isset($_GET['restore']);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$unrestore = isset($_GET['unrestore']);
	$error = '';
	$failure = "";
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
		<?php include('../supplier/base.php');?>
		<div>
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-user-xmark"></i> Deleted Suppliers</h1>
			<hr>
			<?php include('../alert.php');?>
			<div class="table-responsive mt-4 ps-4 pe-4" id="su">
			<table class="table table-striped table-bordered" id="supplier_table">
				<thead class="admin_background">
					<tr>
						<th scope="col" class="column-text">Supplier ID</th>
						<th scope="col" class="column-text">Company Name</th>
						<th scope="col" class="column-text">Supplier Name</th>
						<th scope="col" class="column-text">Address</th>
						<th scope="col" class="column-text">Contact Number</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_array($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['supplier_id'];?></td>
						<td><a href="supplier_details.php?id=<?php echo $row['supplier_id'];?>"><?php echo $row['company_name'];?></a></td>
						<td><?php echo $row['firstname'].'&nbsp'.$row['lastname'];?></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['contact_number'];?></td>
						<td>							
							<button type="button" name="view" value="View" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['supplier_id'];?>" class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i></button>
							<button type="button" name="restore" title="Restore" value="Restore" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['supplier_id'];?>"  class="restore btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#restoreModal" ><i class="fa-solid fa-recycle"></i></button>
						</td>
					</tr>
					<?php } ?>
				</tbody> 
			</table>
			</div>
            <div align="right" class="container p-5">
                <button  class="admin_background btn btn-outline-dark" onclick="printSection('su')">Print Suppliers</button>
            </div>
		</div>
	</div>
	<?php include('../supplier/view_modal.php');?>
	<?php include('../supplier/restore_supplier.php');?>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../supplier/script.js"></script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>	
</body>
</html>

