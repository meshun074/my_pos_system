<?php 
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM customer WHERE deleted='FALSE' ORDER BY customer_id ASC ";
	$result	= mysqli_query($db, $sql);
	$deleted = isset($_GET['deleted']);
	$restore = isset($_GET['restore']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$unrestore = isset($_GET['unrestore']);
	$failure = "";
	$error = "";
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
			include('../customer/base.php');
			include('../alert.php');
		?>
		<div >
			<h1 class="ms-5 pt-2"><i class="fas fa-user-friends"></i> Customer Management</h1>
			<hr>
			<div class="table-responsive mt-4 ps-4 pe-4" id="cus">
			<table class="table table-striped table-bordered" id="customer_table" style="margin-top: -22px;">
				<thead class="admin_background"> 
					<tr>
						<th scope="col" class="column-text">NO</th>
						<th scope="col" class="column-text">Customer Name</th>
						<th scope="col" class="column-text">Address</th>
						<th scope="col" class="column-text">Contact Number</th>
						<th scope="col" class="column-text">Actions</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						$num = 1;
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><a href="customer_sales.php?customer_id=<?php echo $row['customer_id'];?>"><?php echo $num;?></a></td>
						<td><?php echo $row['firstname'].'&nbsp'.$row['lastname'];?></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['contact_number'];?></td>
						<td>
							<a name="edit" title="Edit" style='font-size:10px; border-radius:5px;padding:4px;' href="update_customer.php?id=<?php echo $row['customer_id'];?>" class="btn btn-info btn-xs"><i class="fas fa-user-edit"></i></a>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['customer_id'];?>" class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i></button>
							<button type="button" name="delete" title="Delete" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['customer_id'];?>"  class="delete btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Delete"><i class="fas fa-trash"></i></button>
						</td>
					</tr>
					<?php
					$num++;
				 } ?>
				</tbody>
			</table>

			</div>
            <div align="right" class="container p-3 pe-5">
                <button  class="admin_background btn btn-outline-dark" onclick="printSection('cus')">Print Customers</button>
            </div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../customer/delete_customer.php');?>
	<script src="../customer/javascript.js"></script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>	
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-bs-backdrop="static" data-bs-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default btn-success" data-bs-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
