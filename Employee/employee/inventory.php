<?php 
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM products";
	$result	= mysqli_query($db, $sql);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$failure = "";
	$error = '';
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php include('../employee/base2.php');?>
		<div>
			<h1 class="ms-4 pt-2"><i class="fas fa-box-open"></i> Product Management</h1>
			<hr>
			<?php include('../alert.php');?>
			<div class="table-responsive-sm p-3 ">
			<table class="table table-striped table-bordered" id="product_table" style="margin-top: -22px;">
				<thead>
					<tr>
						<th scope="col" class="column-text">Barcode</th>
						<th scope="col" class="column-text">Product Name</th>
						<th scope="col" class="column-text">Product Size</th>
						<th scope="col" class="column-text">Price</th>
						<th scope="col" class="column-text">Stocks</th>
						<th scope="col" class="column-text">Unit per Price</th>
						<th scope="col" class="column-text">Minimum Stocks</th>
						<th scope="col" class="column-text">Remarks</th>
						<th scope="col" class="column-text">Actions</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['barcode'];?></td>
						<td><?php echo $row['product_name'];?></td>
						<td><?php echo $row['product_size'];?></td>
						<td align="right">₵&nbsp<?php echo $row['sell_price'];?></td>
						<td><?php echo $row['quantity'];?></td>
						<td><?php echo $row['unit_per_price'];?></td>
						<td><?php echo $row['min_stocks'];?></td>
						<td><?php echo $row['remarks'];?></td>
						<td>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px; background-color: #1b1464;' id="<?php echo $row['product_id'];?>"  class="btn primary view_data text-white" ><i class="fas fa-eye"></i></button>
	
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script>
		$(function () {
  			$('[data-toggle="popover"]').popover()
	})
	</script>
	<?php include('../products/delete_products.php');?>
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-bs-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default" style="background-color: #1b1464; color:aliceblue " data-bs-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script src="../employee/javascript.js"></script>