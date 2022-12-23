<?php 
	include('../server/connection.php');	
	include '../set.php';
	$success = isset($_GET['success']);
	$failure = isset($_GET['failure']);

	$sql  = "SELECT `product_id`,`product_name`,`product_size`,`unit_per_price` FROM `products` WHERE deleted='FALSE'";
	$result = mysqli_query($db, $sql);
	if(!$result->num_rows >0){
		echo '<script>swal("No Products","No available products for delivery","error");</script>';
	}
	
	$sql1  = "SELECT *FROM `supplier` WHERE deleted='FALSE'";
	$result1 = mysqli_query($db, $sql1);
	if(!$result1->num_rows >0){
		echo '<script>swal("No Suppliers","No available suppliers to make delivery","error");</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
	<style type="text/css">
		#invoice-item-table tr th{
			font-size: 12px;
		}
		ul.typeahead.dropdown-menu{
			margin-top: 0px;
		}
	</style>
</head>
<body>
	
	<div class="contain h-100">
		<?php include('../delivery/base.php');
		if($failure){
			echo '<script>swal("Unsuccessful","Customer not found!","error");</script>';
		}
		?>
		<div>
		<h1 class="ms-5 pt-2"><i class="fa-solid fa-truck-fast"></i> Record Delivery</h1>
			<hr>
			<div class="mt-1 ms-4"><label><b>New Supplier:</b></label><button class="btn-sm btn-primary border ms-2" data-bs-toggle="modal" data-bs-target=".modal"  style="padding:5px;"><span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span></button></div>
			<form method="post" id="invoice_id">
				<div class="table-responsive mt-1 ps-4 pe-4">
					<table class="table table-striped table-bordered table-sm">
						<tr>
							<td>
								<div class="row mb-1">
									<div class="col-md-4">
										<b>SUPPLIER(From)</b><br/>
										<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
										<i class="fas fa-user-tie"></i></span></div>
										<select name="supplier" id="supplier_search" class="form-control form-control-sm input-sm supplier_search" placeholder="supplier" aria-label="Default select example">
												<?php while($row1 = $result1->fetch_assoc())
												{?>
												<option <?='value="'. $row1['company_name'] . '"'?> ><?php echo $row1["company_name"]?></option>
												<?php 
												}?>
											</select></div>
									</div>
									<div class="col-md-4">
										Transaction No.
										<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
										<i class="fas fa-hands-helping"></i></span></div>
										<input type="text" name="order_no" id="order_no" class="form-control input-sm" required readonly value="<?php echo strtoupper(uniqid()) ?>"/></div>
									</div>
								</div>
								<table id="invoice-item-table" class="table table-bordered table-sm">
									<tr>
										<th>Product no</th>
										<th>Product</th>
										<th>Quantity</th>
										<th>Buy Price</th>	
										<th>Sell Price</th>
										<th>Total Cost</th>
										<th><button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm btn-xs"><i class="fas fa-plus-circle"></i> </button></th>
									</tr>
									<tr>
										<div id="add_a_deli">
										<td><span id="sr_no">1</span></td>

										<td><select name="product_name" id="product_name1" class="form-control form-control-sm input-sm product_name" placeholder="Products" aria-label="Default select example">
												<?php while($row = $result->fetch_assoc())
												{?>
												<option <?='value="'. $row['product_id'] .'"'?> ><?php echo $row["product_name"]. " - ". $row["product_size"]. " - ".$row["unit_per_price"]. " per price ";?></option>
												<?php 
												}?>
											</select>											
										</td>

										<td><input type="number" min="1" name="quantity" id="quantity1" data-srno="1" class="form-control form-control-sm input-sm quantity" placeholder="0" /></td>

										<td><input type="number" step="0.01" min="0.00" name="buy_price" id="buy_price1" data-srno="1" class="form-control form-control-sm input-sm buy_price" placeholder="Price" /></td>

										<td><input type="number" step="0.01" min="0.00" name="sell_price" id="sell_price1" data-srno="1" class="form-control form-control-sm input-sm sell_price" placeholder="Price + Profit"></td>

										<td><input type="text" name="total_amount" readonly id="total_amount1" data-srno="1" class="form-control input-sm form-control-sm total_amount" placeholder="Cost * Quantity"></td>
										</div>
									</tr>								
								</table>
							</td>
						</tr>
						<tr>
							<td align="right">
								<input type="submit" name="create_delivery" value="Submit" id="create_delivery" class="btn btn-sm admin_background btn-outline-dark me-3"/>
								<b>Grand Total:&nbsp<h4 id="final_total_amount">₵ 0.00</h4></b>
							</td>
						</tr>
					</table>
				</div>
				</form>
		</div>
	</div>
	
	
	
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/jquery/datepicker.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../../bootstrap4/js/typeahead1.js"></script>
	<script src="../delivery/javascript.js"></script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>
<?php include('../delivery/add_supplier.php');?>