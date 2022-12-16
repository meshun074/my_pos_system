<?php
include('server/connection.php');
if (!isset($_SESSION['username'])) {
	header('location: index.php');
}
$added = isset($_GET['added']);
$undelete = isset($_GET['undelete']);
$updated = '';
$deleted = '';
$error = "";
$failure = isset($_GET['failure']);
$query 	= "SELECT * FROM `customer`";
$show	= mysqli_query($db, $query);
if (isset($_SESSION['username'])) {
	$user = $_SESSION['username'];
	$sql = "SELECT position FROM users WHERE username='$user'";
	$result	= mysqli_query($db, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
?>
			<!DOCTYPE html>
			<html>

			<head>
				<title>SGBR Hardware Store</title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<link rel="icon" type="image/png" sizes="180x180" href="../images/sunstar1.png">
				<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css" href="../bootstrap4/css/style2.css">
				<link rel="stylesheet" href="../fontawesome-free-6.2.1-web/css/all.css" />
				<script src="../bootstrap4/jquery/sweetalert.min.js"></script>
			</head>

			<body>
				<div class="container-fluid">
					<div class="row h-75">
						<div class="col-12 col-md-6">
							<div class="row h-100">
								<div class="col-12 col-md-6 pe-1 text-center">
									<div class="row text-center p-1 pe-0">
										<div class="col-6 col-md-12"><img src="../images/sunstar1.png" alt="..." class="align-end" style="width: 5rem; height: 4rem;"></div>
										<div class="col-6 col-md-12"><strong><i class="fa-solid fa-store"></i> SGBR Hardware Store</strong></div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<table class="table-responsive-sm">
										<tbody>
											<tr>
												<td valign="baseline"><small>User Logged on:<small></td>
												<td valign="baseline"><small>
														<p class="ps-1 "><i class="fas fa-user-shield"></i> <?php echo $row['position'];
																										}
																									}
																								} ?></p><small></td>
											</tr>
											<tr>
												<td valign="baseline"><small class="pt-1">Date:<small></td>
												<td valign="baseline"><small>
														<p class="ps-1 "><i class="fas fa-calendar-alt"></i> <span id='time'></span></p><small></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-12">
									<div class="mt-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
											<input class="form-control" type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();" />
										</div>
									</div>
									<div class="mt-0" id="product_area" class="table-responsive-sm mt-2">
										<table class="w-100 table-striped font-weight-bold" style="cursor: pointer;" id="table1">
											<thead>
												<tr claclass='text-center'><b>
														<td>Barcode</td>
														<td>Product Name</td>
														<td>Price</td>
														<td>Product Size</td>
														<td>Stocks</td>
												</tr></b>
											<tbody id="products">

											</tbody>
											</thead>
										</table>
									</div>
								</div>
								<div class="row">
								<div class="col p-0 mt-1  ">
									<table class="table-sm table-borderless w-100">
										<tbody>
											<tr>
												<td class="w-25 p-1">
													<button id="buttons" onclick="window.location.href='employee/profile.php'" class="btn btn-secondary border w-100 rounded"><i class="fas fa-user-circle"></i> My Profile</button>

												</td>
												<td class="w-25">
													<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border w-100 rounded" /> <i class="fas fa-sign-out-alt"></i> Logout</button>
												</td>
												
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col p-0 mt-1  ">
									<table class="table-sm table-borderless w-100">
										<tbody>
											<tr>
												
												<td class="w-25">
													<button id="buttons" onclick="window.location.href='employee/inventory.php'" class="btn btn-secondary border w-100 rounded"><i class="fas fa-box-open"></i> Inventory</button>
												</td>
												<td class="w-25">
													<button id="buttons" onclick="window.location.href='employee/cashflow.php'" class="btn btn-secondary border w-100 rounded-pill"><i class="fas fa-money-bill-wave"></i> Sales</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								</div>

							</div>



						</div>
						<div class="col-12 col-md-6"></div>
					</div>
				</div>
				<div class="h-100 bg-dark" id="container">
					<div id="header">
						<?php include('alert.php'); ?>
						<div>
							<img class="img-fluid m-2 w-100" src="images/louisville.png" />
						</div>
						<div class="text-white mt-0 ml-5">
							<table class="table-responsive-sm">
								<tbody>
									<tr>
										<td valign="baseline"><small>User Logged on:<small></td>
										<td valign="baseline"><small>
												<p class="pt-3 ml-5"><i class="fas fa-user-shield"></i> <?php echo $row['position'];
																										// }}}
																										?></p><small></td>
									</tr>
									<tr>
										<td valign="baseline"><small class="pb-1">Date:<small></td>
										<td valign="baseline"><small>
												<p class="p-0 ml-5"><i class="fas fa-calendar-alt">&nbsp</i><span id='time'></span></p><small></td>
									</tr>
									<tr>
										<td valign="baseline"><input type="hidden" id="uname" value="<?php echo $user; ?>" /><small>Customer Name:<small></td>
										<td valign="baseline"><small>
												<div class="content p-0 ml-5"><input type="text" class="form-control form-control-sm customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer" /></div>
											</small></td>

										<td valign="baseline"><button id="new_customer" class="btn-sm btn-info border ml-2" data-toggle="modal" data-target=".bd-example-modal-md" style="padding-top: 1px; padding-bottom: 2px;"><span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span></button></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="header_price border p-0">
							<h5>Grand Total</h5>
							<p class="pb-0 mr-2 mb-2" style="float: right; font-size: 40px;" id="totalValue">GHS 0.00</p>
						</div>
					</div>
					<div id="content" class="mr-2">
						<div id="price_column" class="m-2 table-responsive-sm">
							<form method="POST" action="">
								<table class="table-striped w-100 font-weight-bold" style="cursor: pointer;" id="table2">
									<thead>
										<tr class='text-center'>
											<th>Barcode</th>
											<th>Description</th>
											<th>Price</th>
											<th>Product Size</th>
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
										<li class="d-flex mb-0">Total (GHS): <p id="totalValue1" class="mb-0 ml-5 pl-3">0.00</p>
										</li>
										<li class="mb-0 mt-0">Discount (GHS): <input style="width: 100px" class="text-right form-control-sm" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount"></li>
										<!--                        checkbox for credit-->
										<li>
											<div class="form-check">
												<label class="form-check-label">
													<input type="checkbox" class="form-check-input" value="0" id="check" name="check">On Credit
												</label>
											</div>
										</li>
										<li>
											<!--                dropdown for depos-->
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
						<div class="mt-1">
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
								<input class="form-control" type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();" />
							</div>
						</div>
						<div class="mt-0" id="product_area" class="table-responsive-sm mt-2">
							<table class="w-100 table-striped font-weight-bold" style="cursor: pointer;" id="table1">
								<thead>
									<tr claclass='text-center'><b>
											<td>Barcode</td>
											<td>Product Name</td>
											<td>Price</td>
											<td>Product Size</td>
											<td>Stocks</td>
									</tr></b>
								<tbody id="products">

								</tbody>
								</thead>
							</table>
						</div>
						<div class="w-100 mt-2" id="enter_area">
							<button id="buttons" type="button" class="cancel btn btn-secondary border"><i class="fas fa-ban"></i> Cancel</button>
						</div>
					</div>
					<div id="footer" class="w-100" align="center" style="">
						<button id="buttons" onclick="window.location.href='employee/profile.php'" class="btn btn-secondary border mr-2 ml-2"><i class="fas fa-user-circle"></i> My Profile</button>
						<button id="buttons" onclick="window.location.href='employee/inventory.php'" class="btn btn-secondary border mr-2"><i class="fas fa-box-open"></i> Inventory</button>
						<button id="buttons" onclick="window.location.href='employee/cashflow.php'" class="btn btn-secondary border mr-2"><i class="fas fa-money-bill-wave"></i> Sales</button>
						<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border mr-2" /> <i class="fas fa-sign-out-alt"></i> Logout
					</div>
				</div>
				</div>
				<?php include('add.php'); ?>
				<?php include('../templates/js_popper.php'); ?>
				<script type="text/javascript" src="script.js"></script>
				<script src="../bootstrap4/js/time.js"></script>
			</body>

			</html>

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
							<h6 class="text-center font-weight-bold">Sunstar Gold Buying & Refinery</h6>
							<h6 class="text-center font-weight-bold">Hardware Store</h6>
							<h6 class="text-center">No: 0243062545 / 0559433723</h6>
							<h6 class="text-center">Loc: Achimfo, Abokyia, Sewum</h6>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" onclick="window.location.href='employee_page.php'" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="print_reciept">Print</button>
							<!-- onclick="window.location.href='main.php'" -->
						</div>
					</div>
				</div>
			</div>