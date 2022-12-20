<?php
	include("../server/connection.php");
	include '../set.php';
	$id = $_GET['transaction_no'];
	$sql = "SELECT sales_return.credit_note_no, products.barcode, products.product_name, products.product_size, sales_return.total_qty, products.unit_per_price, sales_return.sell_price, products.remarks, sales_return.Total FROM sales_return,products WHERE credit_note_no = '$id' AND sales_return.product_id = products.product_id";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result);
	$result1 = mysqli_query($db,$sql); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../employee/base6.php');
		?>
		<div class="">
			<div>
				<h1 class="ml-4 pt-2 pb-4" align="left"><i class="fas fa-truck"></i> Sales Return Records</h1>
			</div>
			<div class="table-responsive pl-5 pr-5">
			<table class="table table-sm table-striped table-bordered" id="sales_return_table" style="margin-top: -22px;">
				<thead>
					<tr>
						<td colspan="5"><h2>Credit Note No.&nbsp<span style="color: blue;"><?php echo $id;?></span></h2></td>
					</tr>
					<tr>
						<th scope="col" class="column-text">Barcode</th>
						<th scope="col" class="column-text">Product Name</th>
						<th scope="col" class="column-text">Product size</th>
						<th scope="col" class="column-text">Quantity</th>						
						<th scope="col" class="column-text">Price per Unit</th>
						<th scope="col" class="column-text">Sell Price</th>
						<th scope="col" class="column-text">Remarks</th>
						<th scope="col" class="column-text">Total</th>						
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row1 = mysqli_fetch_array($result1)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row1['barcode'];?></td>
						<td><?php echo $row1['product_name'];?></td>
						<td><?php echo $row1['product_size'];?></td>
						<td><?php echo $row1['total_qty'];?></td>
						<td><?php echo $row1['unit_per_price'];?></td>
						<td>₵<?php echo $row1['sell_price'];?></td>
						<td> <?php echo $row1['remarks'];?></td>
						<td>₵<?php echo $row1['Total'];?></td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../employee/javascript.js"></script>
</body>
</html>
