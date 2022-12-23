<?php
include('server/connection.php');
if (!isset($_SESSION['username'])) {
	header('location: index.php');
}
$added = isset($_GET['added']);
$error = isset($_GET['error']);
$undelete = isset($_GET['undelete']);
$updated = '';
$deleted = '';
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
				<?php include('../templates/head.php'); ?>
			</head>

			<body>
				<nav>
					<div class="container-fluid">
						<div class="row border-bottom " style="background-color: #0d0d0d; color: #D9A84E;">
							<div class="col-12 col-md-4 mt-1 "> <strong><i class="fa-solid fa-store"></i> SGBR Hardware Store</strong> </div>
							<div class="col-12 col-md-4">
								<div class="nav nav-tabs justify-content-center pt-3" id="nav-tab" role="tablist">
									<button class="nav-link active" style="color: #0d0d0d;" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
									<button class="nav-link " style=" color: #D9A84E;" id="nav-profile-tab" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-selected="false">Menu</button>
									<a class="nav-link dropdown-toggle" style=" color: #D9A84E;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										User
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="user/profile.php"><i class="fa-solid fa-id-badge"></i> User Profile</a></li>
										<li><a class="dropdown-item" href="user/user.php"><i class="fas fa-user-friends"></i> User Management</a></li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" onclick="out();" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-lg-6">
									<div class="row h-md-25">
										<div class="col">
											<table class="table-responsive-sm">
												<tbody>
													<tr>
														<td valign="baseline"><small>User :</small></td>
														<td valign="baseline"><small>
																<p class="pt-1 pt-md-2 ms-2 ms-md-5 "><i class="fas fa-user-shield"></i> <?php echo $row['position'];
																																		}
																																	}
																																} ?></p>
															</small></td>
													</tr>
													<tr>
														<td valign="baseline"><small class="pb-1">Date:</small></td>
														<td valign="baseline"><small>
																<p class="p-0 mb-1 mb-md-2 ms-2 ms-md-5"><i class="fas fa-calendar-alt"></i>&nbsp<span id='time'></span></p>
															</small></td>
													</tr>

												</tbody>
											</table>
											<div>
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
													<input class="form-control" type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();" />
												</div>
											</div>
										</div>
									</div>
									<div class="row h-md-75">
										<div class="col">

											<div id="product_area" class="table-responsive-sm mt-2 table-wrapper-scroll-y my-custom-scrollbar">
												<table class="w-100  table-striped font-weight-bold" style="cursor: pointer;" id="table1">
													<thead>
													<tbody>
														<tr>
															<td id="products" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 m-1">

															</td>
														</tr>

													</tbody>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-lg-6 pe-1 p-0">
									<div class="row h-md-25">
										<div class="col-12 mb-0 pb-0 ">
											<div class="header_price border m-0  p-0 pb-5 ">
												<h5 class="ps-2 pt-1">Grand Total</h5>
												<p class=" me-2 mb-0" style="float: right; font-size: 30px;" id="totalValue">₵ 0.00</p>
											</div>
										</div>
										<div class="col-12 ">
											<div class="col border border-dark  p-1 mt-1">
												<table class="table-responsive-sm w-md-75  ">
													<tbody>

														<tr>
															<td valign="baseline"><small class="  pe-3 ">Customer Name <i class="fa-solid fa-magnifying-glass"></i> </small></td>
															<td valign="baseline"><small>
																	<div class="content p-0 me-3"><input type="text" class=" ps-0 customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer" />
																</small>
											</div>
											</td>
											<td valign="baseline"><button id="new_customer" class="btn-sm btn-info border ml-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md" style="padding: 3px; background-color: #0d0d0d;"><span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span></button></td>

											</tr>
											</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row h-md-75">

									<div class="col-12">

										<div id="price_column" class="m-0 mt-1 table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar-a ">
											<form method="POST" action="">
												<table class="table-striped w-100 h-100 font-weight-bold" style="cursor: pointer;" id="table2">
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
									</div>

									<div class="col-12 ">
										<div class="col border border-dark mt-1 p-1">
											<table class=" table-responsive-sm w-100 ">
												<tbody>
													<td>Total ₵: <span id="totalValue1" class="mb-0 ml-5 pl-3">0.00</span>
													</td>
													<td>Discount ₵: <input class="text-right w-50 w-md-25" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount"></td>
													<!-- checkbox for credit-->
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" class="form-check-input" value="0" id="check" name="check">On Credit
															</label>
														</div>
													</td>
													<td>
														<!--                dropdown for depos-->
														<div class="input-group "><span class="pe-1"> Branch: </span> 
															<select class="custom-select" id="depo">
																<option selected>Achimfo</option>
																<option value="Jhs Depo">Abokyia</option>
																<option value="KG">Sewum</option>
															</select>
														</div>
													</td>
												</tbody>
											</table>
										</div>

										<div class="col p-0 mt-1  ">
											<table class="table table-borderless">
												<tbody>
													<tr>
														<td class="p-0">
															<button id="buttons" type="button" name='enter' class="Enter btn btn-outline-dark border  w-100" style="background-color: #0d0d0d; color: #D9A84E;"><i class="fas fa-handshake"></i> Finish</button>

														</td>
														<td class="p-0 "><button id="buttons" type="button" class="cancel btn btn-outline-dark border w-100" style="background-color: #0d0d0d; color: #D9A84E;"><i class="fas fa-ban"></i> Cancel</button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				</div>
				</div>



				<?php include('add.php'); ?>
				<?php include('../templates/js_popper.php'); ?>
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
						<div class="modal-body w-100 justify-content-center p-0 pe-1 ps-1" id="reciept">
							<h6 class="text-center font-weight-bold">Sunstar Gold Buying & Refinery</h6>
							<h6 class="text-center font-weight-bold">Hardware Store</h6>
							<h6 class="text-center">No: 0243062545 / 0559433723</h6>
							<h6 class="text-center">Loc: Achimfo, Abokyia, Sewum</h6>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" onclick="window.location.href='main.php'" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="print_reciept">Print</button>
							<!-- onclick="window.location.href='main.php'" -->
						</div>
					</div>
				</div>
			</div>


			<!-- offcanvas -->
			<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
				<div class="offcanvas-header pb-2 pt-2" style="background-color: #0d0d0d; color: #D9A84E;">
					<h5 class="offcanvas-title  " id="offcanvasExampleLabel"><i class="fa-solid fa-store"></i> SGBR Menu</h5>
					<button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body p-0" style="background-color: #0d0d0d; color: #D9A84E;">
					<div class="bg-dark w-100 p-3 pb-2 text-center"><img src="../images/sunstar1.png" class="img-fluid" alt="...">
						<p class="pb-0 mb-0  fs-6" style="color: #88898C;">Sunstar Gold Buying & Refinery <br> Hardware Store </p>
					</div>
					<div>
						<button id="buttons" onclick="window.location.href='products/products.php'" class="btn w-100 border border-secondary text-secondary"><i class="fas fa-box-open"></i> Product</button>
						<button id="buttons" onclick="window.location.href='supplier/supplier.php'" class="btn w-100  border border-secondary text-secondary"><i class="fas fa-user-tie"></i> Supplier</button>
						<button id="buttons" onclick="window.location.href='customer/customer.php'" class="btn  w-100  border border-secondary text-secondary"><i class="fas fa-user-friends"></i> Customer</button>
						<button id="buttons" onclick="window.location.href='logs/logs.php'" class="btn  w-100  border border-secondary text-secondary"><i class="fas fa-globe"></i> Logs</button>
						<button id="buttons" onclick="window.location.href='cashflow/cashflow.php'" class="btn  w-100  border border-secondary text-secondary"><i class="fas fa-money-bill-wave"></i> Cash-Flow</button>
						<button id="buttons" onclick="window.location.href='sales/sales.php'" class="btn w-100  border border-secondary text-secondary"><i class="fas fa-shopping-cart"></i> Sales</button>
						<button id="buttons" onclick="window.location.href='delivery/delivery.php'" class="btn  w-100 y border border-secondary text-secondary"><i class="fas fa-truck"></i> Deliveries</button>
					</div>
				</div>
			</div>