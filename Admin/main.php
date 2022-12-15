<?php 
	include('server/connection.php');
	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
	$added = isset($_GET['added']);
	$error = isset($_GET['error']);
	$undelete = isset($_GET['undelete']);
	$updated = '';
	$deleted = '';
	$failure = isset($_GET['failure']);
	
	$query 	= "SELECT * FROM `customer`";
	$show	= mysqli_query($db,$query);
	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
		$sql = "SELECT position FROM users WHERE username='$user'";
		$result	= mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
</head>
<body>
	<div class="h-100 bg-dark" id="container">
		<div id="header">
			<?php include('alert.php'); ?>
			<div>
				<img class="img-fluid m-2 w-100" src="images/louisville.png"/>
			</div>
			<div class="text-white mt-0 ml-5">
				<table class="table-responsive-sm">
					<tbody>
						<tr>
							<td valign="baseline"><small>User Logged on:</small></td>
							<td valign="baseline"><small><p class="pt-3 ml-5"><i class="fas fa-user-shield"></i> <?php echo $row['position'];}}}?></p></small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="pb-1">Date:</small></td>
							<td valign="baseline"><small><p class="p-0 ml-5"><i class="fas fa-calendar-alt">&nbsp</i><span id='time'></span></p></small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="mt-5">Customer Name:</small></td>
							<td valign="baseline"><small><div class="content p-0 ml-5"><input type="text" class="form-control form-control-sm customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer"/></small></div>
							</td>
							<td valign="baseline"><button id="new_customer" class="btn-sm btn-info border ml-2" data-toggle="modal" data-target=".bd-example-modal-md" style="padding-top: 1px; padding-bottom: 2px;"><span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span></button></td>
							
						</tr>
					</tbody>
				</table>
			</div>
			<div class="header_price border p-0">
				<h5>Grand Total</h5>
				<p class="pb-0 mr-2" style="float: right; font-size: 40px;" id="totalValue">GHS 0.00</p>
			</div>
		</div>
		<div id="content" class="mr-2">
			<div id="price_column" class="m-2 table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar-a">
				<form method="POST" action="">
				<table class="table-striped w-100 font-weight-bold" style="cursor: pointer;" id="table2">
					<thead>
						<tr class='text-center'>
							<th>Barcode</th>
							<th>Description</th>
							<th>Price</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Sub.Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tableData">
					</tbody>
				</table>
				</form>
			</div>
			<div id="table_buttons">
				<button id="buttons" type="button" name='enter' class="Enter btn btn-secondary border ml-2"><i class="fas fa-handshake"></i> Finish</button>
				<div class="">
				<small>
					<ul class="text-white justify-content-center">
						<li class="d-flex mb-0">Total (GHS): <p id="totalValue1" class="mb-0 ml-5 pl-3">0.00</p></li>
						<li class="mb-0 mt-0">Discount (GHS): <input style="width: 100px" class="text-right form-control-sm" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount" ></li>
						<!-- checkbox for credit-->
                        <li>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"  value="0" id="check" name="check">On Credit
                                </label>
                            </div>
                        </li>
                        <li> <!--                dropdown for depos-->
                            <div class="input-group mb-3" style="bottom: 11%;width: 9%;float: right;right: 38%;position: absolute">
                                <select class="custom-select" id="depo">
									<option selected>Achimfo</option>
                                    <option value="Jhs Depo">Abokyia</option>
                                    <option value="KG">Sewum</option>
                                </select>
                            </div>
                        </li>
					</ul>
				</small>
				</div>
			</div>
		</div>
		<div id="sidebar">
			<div class="mt-1 ">
			<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
   				<input class="form-control" type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();"/>
   			</div></div>
			<div id="product_area" class="table-responsive-sm mt-2 table-wrapper-scroll-y my-custom-scrollbar" >
				<table class="w-100 table-striped font-weight-bold" style="cursor: pointer;" id="table1">
					<thead>
						<tr claclass='text-center'><b>
							<td>Barcode</td>
							<td>Product Name</td>
							<td>Price</td>
							<td>Size</td>														
							<td>Stocks</td>
							<!-- <td>Remarks</td> -->
						</tr></b>
						<tbody id="products">
							
						</tbody>
					</thead>
				</table>
			</div>
			<div class="w-100 mt-2" id="enter_area">
				<button id="buttons" type="button" class="cancel btn btn-secondary border"><i class="fas fa-ban"></i> Cancel</button>
				<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal"> -->
				<!-- <button type="button" class="btn btn-primary" id="print_reciept">
					Launch demo modal
					</button> -->
			</div>
		</div>
		<div id="footer" class="w-100">
			<button id="buttons" onclick="window.location.href='user/user.php'" class="btn btn-secondary border mr-2 ml-2"><i class="fas fa-users"></i> User</button>
			<button id="buttons" onclick="window.location.href='products/products.php'" class="btn btn-secondary border mr-2"><i class="fas fa-box-open"></i> Product</button>
			<button id="buttons" onclick="window.location.href='supplier/supplier.php'" class="btn btn-secondary border mr-2"><i class="fas fa-user-tie"></i> Supplier</button>
			<button id="buttons" onclick="window.location.href='customer/customer.php'" class="btn btn-secondary border mr-2"><i class="fas fa-user-friends"></i> Customer</button>
			<button id="buttons" onclick="window.location.href='logs/logs.php'" class="btn btn-secondary border mr-2"><i class="fas fa-globe"></i> Logs</button>
			<button id="buttons" onclick="window.location.href='cashflow/cashflow.php'" class="btn btn-secondary border mr-2"><i class="fas fa-money-bill-wave"></i> Cash-Flow</button>
			<button id="buttons" onclick="window.location.href='sales/sales.php'" class="btn btn-secondary border mr-2"><i class="fas fa-shopping-cart"></i> Sales</button>
			<button id="buttons" onclick="window.location.href='delivery/delivery.php'" class="btn btn-secondary border mr-2"><i class="fas fa-truck"></i> Deliveries</button>
			<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border mr-2"><i class="fas fa-sign-out-alt"></i> Logout</button> 
		</div>
	</div>
	<?php include('add.php');?>
	<?php include('../templates/js_popper.php');?>
	<script type="text/javascript" src="max.js"></script>
	<script src="../bootstrap4/js/time.js"></script>
</body>
</html> 

<!-- Modal -->
<div class="modal fade " id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered h-50 w-25" role="document">
    <div class="modal-content ">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">Print Reciept</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body w-100 justify-content-center" id="reciept">
        <h6 class="text-center font-weight-bold" >Sunstar Gold Buying & Refinery</h6>
		<h6 class="text-center font-weight-bold" >Hardware Store</h6>
		<h6 class="text-center" >No: 0243062545 / 0559433723</h6>
		<h6 class="text-center" >Loc: Achimfo, Abokyia, Sewum</h6>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='main.php'" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="print_reciept" >Print</button>
		<!-- onclick="window.location.href='main.php'" -->
      </div>
    </div>
  </div>
</div>
