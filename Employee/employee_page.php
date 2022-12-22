<?php
include('server/connection.php');
if (!isset($_SESSION['username'])) {
	header('location: index.php');
}
$added = isset($_GET['added']);
$undelete = isset($_GET['undelete']);
$updated = isset($_GET['updates']);
$deleted = isset($_GET['delete']);
$error = isset($_GET['error']);
$failure = isset($_GET['failure']);
$logout = isset($_GET['logout']);
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
					<?php include('alert.php'); ?>
					<div class="row h-100">
						<div class="col-12 col-md-6 text-white" style="background-color: #1b1464; ">
							<div class="row h-100 ">
								<div class="col-12 col-md-6 pe-1 text-center">
									<div class="row text-center p-1 pe-0">
										<div class="col-6 col-md-12"><img src="../images/sunstar1.png" alt="..." class="align-end" style="width: 5rem; height: 4rem;"></div>
										<div class="col-6 col-md-12"><strong><i class="fa-solid fa-store"></i> SGBR Hardware Store</strong></div>
									</div>
								</div>
								<div class="col-12 col-md-6 pe-1">
									<table class="table-responsive-sm mt-md-3">
										<tbody>
											<tr >
												<td valign="baseline"><small>User :<small></td>
												<td valign="baseline"><small>
														<p class="ps-2 "><i class="fas fa-user-shield"></i> <?php echo $row['position'];
																										}
																									}
																								} ?></p><small></td>
											</tr>
											<tr >
												<td valign="baseline"><small class="pt-1">Date:<small></td>
												<td valign="baseline"><small>
														<p class="ps-2 mb-0 "><i class="fas fa-calendar-alt"></i> <span id='time'></span></p><small></td>
											</tr>
										</tbody>
									</table>
								</div>

				
								<div class="col-12 ">
									<div class="mt-1 mb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
											<input class="form-control"  type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();" />
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="mt-0" id="product_area" class="table-responsive-sm mt-2">
										<table class="w-100 table-striped font-weight-bold" style="color: #1b1464; cursor: pointer;" id="table1">
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
								<div class="row p-0 ps-3">
									<div class="col p-0 mt-1 ms-1 ">
										<table class="table-sm table-borderless w-100">
											<tbody>
												<tr>
													<td class="w-25 p-1">
														<button id="buttons" onclick="window.location.href='employee/profile.php'" style="background-color: #1b1464; " class="btn btn-secondary border w-100 rounded-pill"><i class="fas fa-user-circle"></i> My Profile</button>

													</td>
													<td class="w-25">
														<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border w-100 rounded-pill" /> <i class="fas fa-sign-out-alt"></i> Logout</button>
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
														<button id="buttons" onclick="window.location.href='employee/inventory.php'" style="background-color: #1b1464; " class="btn btn-secondary border w-100 rounded-pill"><i class="fas fa-box-open"></i> Inventory</button>
													</td>
													<td class="w-25">
														<button id="buttons" onclick="window.location.href='employee/cashflow.php'" style="background-color: #1b1464; " class="btn btn-secondary border w-100 rounded-pill"><i class="fas fa-money-bill-wave"></i> Sales</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

							</div>



						</div>
						<div class="col-12 col-md-6 text-white" style="background-color: #1b1464; ">
							<div class="col-12 mt-1">
								<div class="header_price border p-0 pb-5 m-0">
									<h5 class="ps-2 pt-1">Grand Total</h5>
									<p class="pb-0 me-2 mb-2" style="float: right; font-size: 30px;" id="totalValue">₵ 0.00</p>
								</div>
							</div>
							<div class="col-12">
								<table class="table-responsive-sm mt-2">
									<tbody>
										<tr>
											<td valign="baseline"><input type="hidden" id="uname" value="<?php echo $user; ?>" /><small><strong>Customer Name <i class="fa-solid fa-magnifying-glass"></i></strong> <small></td>
											<td valign="baseline"><small>
													<div class="content p-0 ms-2 me-2"><input type="text" class=" form-control-sm customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer" /></div>
												</small></td>

											<td valign="baseline"><button id="new_customer" class="btn-sm btn-primary border"  data-bs-toggle="modal" data-bs-target=".bd-example-modal-md" style="padding-top: 1px; padding-bottom: 2px;"><span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-12">
								<div id="price_column" class="m-2 table-responsive-sm selected-product">
									<form method="POST" action="">
										<table class="table-striped w-100 font-weight-bold" style="cursor: pointer; color: #1b1464; " id="table2">
											<thead>
												<tr class='text-center'  >
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
							</div>
							<div class="col">
								<div class="text-white">
									<table class="table-responsive-sm mt-2 w-100">
										<tbody>
											<tr>
												<small>
													<td class="w-25">
														Total ₵: <span id="totalValue1">0.00</span>
													</td>
													<td class="w-25">
														Discount ₵: <input class="text-right  w-50" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount">
													</td>

													<!--                        checkbox for credit-->
													<td class="w-25">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" class="form-check-input" value="0" id="check" name="check">On Credit
															</label>
														</div>

													</td>
													<td class="w-25">
														<!--                dropdown for depos-->
														<div class="input-group ">
															<select class="custom-select" id="depo" style="color: #1b1464; ">
																<option selected>Achimfo</option>
																<option value="Jhs Depo">Abokyia</option>
																<option value="KG">Sewum</option>
															</select>
														</div>
													</td>
												</small>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col p-0 mt-1  ">
										<table class="table-sm table-borderless w-100">
											<tbody>
												<tr>

													<td class="w-50">
													<button id="buttons" style="background-color: #1b1464; " type="button" name='enter' class="Enter btn btn-secondary border w-100"><i class="fas fa-handshake"></i> Finish</button>
													</td>
													<td class="w-50">
													<button id="buttons" type="button"  class="cancel btn btn-danger border w-100 "><i class="fas fa-ban"></i> Cancel</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
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
						</div>
					</div>
				</div>
			</div>