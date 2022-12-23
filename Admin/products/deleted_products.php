<?php
include("../server/connection.php");
include '../set.php';
$sql = "SELECT * FROM products WHERE deleted='TRUE'";
$result	= mysqli_query($db, $sql);
$restore = isset($_GET['restore']);
$deleted = isset($_GET['deleted']);
$added  = isset($_GET['added']);
$updated = isset($_GET['updated']);
$undelete = isset($_GET['undelete']);
$unrestore = isset($_GET['unrestore']);
$error = isset($_GET['error']);
$failure = "";
?>
<!DOCTYPE html>
<html>

<head>
	<?php include('../../templates/head1.php'); ?>
</head>

<body>
	<div class="contain h-100">
		<?php include('../products/base.php'); ?>
		<?php include('../products/print.php'); ?>
		<div id="print">
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-trash-can"></i> Deleted Products</h1>
			<hr>
			<?php include('../alert.php'); ?>
			<div class="table-responsive mt-4 ps-4 pe-4" id="p">
				<table class="table table-striped  table-bordered border-warning pt-2 " id="product_table" >
					<thead class="admin_background">
						<tr>
							<th scope="col" class="column-text">Barcode</th>
							<th scope="col" class="column-text">Product Name</th>
							<th scope="col" class="column-text">Product size</th>
							<th scope="col" class="column-text">Price</th>
							<th scope="col" class="column-text">Stocks</th>
							<th scope="col" class="column-text">Unit</th>
							<th scope="col" class="column-text">Minimum Stocks</th>
							<th scope="col" class="column-text">Remarks</th>
							<th scope="col" class="column-text">Actions</th>
						</tr>
					</thead>
					<tbody class="table-hover">
						<?php
						while ($row = mysqli_fetch_assoc($result)) {
						?>
							<tr class="table-active">
								<td><?php echo $row['barcode']; ?></td>
								<td><?php echo $row['product_name']; ?></td>
								<td><?php echo $row['product_size']; ?></td>
								<td align="right">₵&nbsp<?php echo $row['sell_price']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
								<td><?php echo $row['unit_per_price']; ?></td>
								<td><?php echo $row['min_stocks']; ?></td>
								<td><?php echo $row['remarks']; ?></td>
								<td>
									<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['product_id']; ?>" class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i></button>
									<button type="button" name="restore" title="Restore" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['product_id']; ?>" class="restore btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#restoreModal" ><i class="fa-solid fa-recycle"></i></button>
								</td>

							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div align="right" class="container p-5">
				<button class="admin_background btn btn-warning" onclick="printSection('p')">Print Products</button>
			</div>
		</div>
	</div>

	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../products/restore_products.php'); ?>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
  </script>
</body>

</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-bs-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-body d-inline" id="Contact_Details"></div>
			<div class="modal-footer">
				<input type="button" class="admin_background btn btn-warning " data-bs-dismiss="modal" value="Okay">
			</div>
		</div>
	</div>
</div>
<script src="../products/javascript.js"></script>