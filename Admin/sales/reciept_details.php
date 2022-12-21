<?php
	include("../server/connection.php");
	include '../set.php';
	$id = $_GET['reciept_id'];
	$sql = "SELECT * FROM sales_product,products,customer WHERE receipt_no = '$id' AND sales_product.product_id = products.product_id AND sales_product.customer_id = customer.customer_id";
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
			include('../sales/base2.php');
		?>
		<div>
			<div>
				<h1 class="ml-4 pt-2 pb-4" align="left"><i class="fas fa-shopping-cart"></i> Sales Records</h1>
			</div>
			<div class="table-responsive pl-5 pr-5">
			<table class="table table-striped table-bordered" id="sales_table" style="margin-top: -22px;">
				<thead>
					<tr>
						<td colspan="5"><h2>Reciept No.&nbsp<?php echo $row['receipt_no'];?></h2></td>
					</tr>
					<tr>
						<th scope="col" class="column-text">Barcode</th>
						<th scope="col" class="column-text">Product Name</th>
						<th scope="col" class="column-text">Product size</th>
						<th scope="col" class="column-text">Quantity</th>
						<th scope="col" class="column-text">Price ₵</th>											
						<th scope="col" class="column-text">Cashier</th>
						<th scope="col" class="column-text">Customer Name</th>
						<th scope="col" class="column-text">Sales Office</th>
						<th scope="col" class="column-text">Status</th>
						<th scope="col" class="column-text">Date</th>
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
						<td><?php echo $row1['product_quantity'];?></td>
						<td><?php echo $row1['price'];?></td>
						<td><?php echo $row1['username'];?></td>
						<td><?php echo $row["firstname"].'&nbsp'.$row['lastname'];?></td>
						<td><?php echo $row1['sales_office'];?></td>
						<td><?php echo $row1['status'];?></td>
						<td><?php echo $row1['date'];?></td>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#sales_table').dataTable();
			
		});
	</script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>
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