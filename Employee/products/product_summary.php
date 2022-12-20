<?php 
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM products";
	$result	= mysqli_query($db, $sql);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$error = isset($_GET['error']);
	$failure = "";	
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php include('../products/base.php');?>
        <?php include('../products/print.php');?>
		<div id="print">
			<h1 class="ml-4 pt-2"><i class="fas fa-box-open"></i> Product Summary</h1>
			<hr>
			<?php include('../alert.php');?>
			<div class="table-responsive mt-4 pl-5 pr-5" id="p">
			<table class="table table-striped table-bordered" id="product_table" style="margin-top: -22px;">
				<thead>
					<tr>
						<th scope="col" class="column-text">Barcode</th>
						<th scope="col" class="column-text">Product Name</th>
						<th scope="col" class="column-text">Minimum Stocks</th>
						<th scope="col" class="column-text">Stocks</th>
						<th scope="col" class="column-text">Status</th>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['barcode'];?></td>
						<td><?php echo $row['product_name'];?></td>
						<td><?php echo $row['min_stocks'];?></td>
						<td><?php echo $row['quantity'];?></td>
						<td <?php if($row['min_stocks'] * 1.5 >= $row['quantity']){ echo 'style=" background-color: red"'; } elseif($row['min_stocks'] * 2 >= $row['quantity']){ echo 'style=" background-color: yellow"'; } else{ echo 'style=" background-color: green"'; }?> ><?php if($row['min_stocks'] * 1.4 >= $row['quantity']){ echo 'Low Quantity'; } else{ echo 'Good Qunatity'; }?></td>

					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
            <div align="right" class="container p-5">
                <button  class="btn btn-info" onclick="printSection('p')">Print Products</button>
            </div>
		</div>
	</div>

	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../products/delete_products.php');?>
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default btn-success" data-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script src="../products/javascript.js"></script>