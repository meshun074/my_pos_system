<?php 
	include("../server/connection.php");
	include '../set.php';
	$customer_id = $_GET['customer_id'];
	$sql = "SELECT * FROM sales WHERE sales.customer_id = $customer_id";
	$result	= mysqli_query($db, $sql);
	$query = "SELECT firstname,lastname, contact_number FROM customer WHERE customer_id=$customer_id";
	$result1 = mysqli_query($db, $query);
	$result2 = mysqli_query($db, $query);
	$restore = isset($_GET['restore']);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$unrestore = isset($_GET['unrestore']);
	$error = isset($_GET['error']);
	$failure = isset($_GET['failure']);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');
	?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../customer/base2.php');
			include('../alert.php');
		?>
		<div>
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-book"></i> Customer Records</h1>
			<hr>
			<div class="card mt-2 ps-4 pe-4 ">
			<div class="admin_background card-header text-center">
			<?php $row1 = mysqli_fetch_assoc($result1);
				echo "<h3 >Customer Name: <span class='text-white'>".$row1['firstname'].'&nbsp'.$row1['lastname']."</span></h3>";
			?>
			</div>
			<div class="card-body">
			<div class="table-responsive ">
			<table class="table table-striped table-bordered table-sm" id="customer_table" style="margin-top: -22px;">
				<thead> 
					<tr>
						<th scope="col" class="column-text">Reciept No</th>
						<th scope="col" class="column-text">Cashier</th>
						<th scope="col" class="column-text">Total Value</th>
						<th scope="col" class="column-text">Date</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['receipt_no'];?></td>
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['total'];?></td>
						<td><?php echo date('d M Y, g:i A', strtotime($row["date"]));?></td>
						<td>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['receipt_no'];?>" class="btn btn-success btn-xs view_sales"><i class="fas fa-eye"></i></button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			</div>
			</div>
			<div class="admin_background card-footer text-center text-white">
				<?php echo $row1['contact_number']?>
			</div>
			</div>
			
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../customer/javascript.js"></script>	
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
