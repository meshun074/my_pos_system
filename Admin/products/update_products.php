<?php
include("../server/connection.php");
include '../set.php';

if (isset($_GET['id'])) {
	$id   =   $_GET['id'];
	$sql  =   "SELECT * FROM products WHERE product_id='$id'";
	$result1   = mysqli_query($db, $sql);
	$row1  =   mysqli_fetch_array($result1);
	$sql2 = "SELECT * FROM supplier";
	$result2   = mysqli_query($db, $sql2);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include('../../templates/head1.php'); ?>
	</head>

	<body>
		<div class="contain h-100">
			<div class="admin_background header pb-2">
				<div class="col-12 text-center "><img src="../../images/sunstar1.png" alt="..." class="" style="width: 5rem; height: 4rem;">
					<p><strong><i class="fa-solid fa-store"></i> SGBR Hardware Store</strong></p>
				</div>
			</div>
			<div class="sidebar">
				<button>
					<h3><i class="fas fa-tachometer-alt"></i> Dashboard</h3>
				</button>
				<button id="admin_sidebar_button" onclick="window.location.href='../products/products.php'"><i class="fas fa-list-ul"></i> Product List</button>
				<button id="admin_sidebar_button" onclick="window.location.href='../delivery/add_delivery.php'"><i class="fas fa-truck"></i> Delivery</button>
				<button id="admin_sidebar_button" type="button" data-toggle="popover" title="Product Management" data-content="Here you will create, update, delete and view products." data-placement="bottom"><i class="fas fa-question"></i> Help</button>
				<div class="fixed-bottom w-25">
					<button class="btn m-2 p-2" id="admin_sidebar_button" onclick="window.location.href='../main.php'"><i class="fas fa-arrow-alt-circle-left"></i> Back</button>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<h1 class="ms-4"><i class="fa-solid fa-square-pen"></i> Update Product </h1>
					<hr class="mb-0 mt-1">
				</div>
				<div class="row">
					<div class="col-12 col-md-6 ms-md-0 mt-4 pe-md-5 text-md-end text-center ">
						<?php echo "<img class='img-fluid p-1' style='border:1px dashed black; width: 250px;height: 250px;' src='../../images/" . $row1['images'] . "'>"; ?>
						<form method="post" enctype="multipart/form-data" action="../products/update.php">
							<input class="form-control-sm mt-2" type="file" name="images">
							<input type="hidden" name="size" value="1000000">
							<input type="hidden" name="id" value="<?php echo $row1['product_id']; ?>">
					</div>
					<div class="col-12 col-md-6 ps-5 ms-5 ps-md-0  ms-md-0 table-responsive">
						<p class="bg-danger w-50"><?php echo $msg; ?></p>
						<table class="table-responsive mt-2  text-md-start">
							<tbody>
								<tr>
									<td valign="baseline">Barcode:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="barcode" class="form-control-sm form-control" value="<?php echo $row1['barcode']; ?>" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Name:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="product_name" class="form-control-sm form-control" value="<?php echo $row1['product_name']; ?>" required>
										</div>
									</td>
								</tr>

								<tr>
									<td valign="baseline">Size:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
											<select class="form-control-sm form-control" name="product_size" aria-label="Default select example">
												<option <?php if ($row1['product_size'] == "Custom") {
															echo "selected";
														} ?> value="Custom">Custom</option>
												<option <?php if ($row1['product_size'] == "Small") {
															echo "selected";
														} ?> value="Small">Small</option>
												<option <?php if ($row1['product_size'] == "Medium") {
															echo "selected";
														} ?> value="Medium">Medium</option>
												<option <?php if ($row1['product_size'] == "Large") {
															echo "selected";
														} ?> value="Large">Large</option>
												<option <?php if ($row1['product_size'] == "X-Large") {
															echo "selected";
														} ?> value="X-Large">X-Large</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Quantity:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="qty" value="<?php echo $row1['quantity']; ?>" class="form-control-sm form-control" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Unit per Price:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="unit" value="<?php echo $row1['unit_per_price']; ?>" class="form-control-sm form-control" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Cost Price:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" id="cost_price" name="cost_price" step="0.01" value="<?php echo $row1['cost_price']; ?>" class="form-control form-control-sm" required>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Profit:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" id="profit" name="profit" step="0.01" value="<?php echo $row1['profit']; ?>" class="form-control form-control-sm" required>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Sell Price:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" id="price" readonly name="price" step="0.01" value="<?php echo $row1['sell_price']; ?>" class="form-control form-control-sm" required>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Minimum stocks:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="min_stocks" value="<?php echo $row1['min_stocks']; ?>" class="form-control-sm form-control" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Remarks:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="remarks" value="<?php echo $row1['remarks']; ?>" class="form-control-sm form-control" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Supplier:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
											<select class="form-control-sm form-control" name="supplier_id" aria-label="Default select example">
												<?php while ($row2  =   mysqli_fetch_array($result2)) { ?>
													<option <?php if ($row2['supplier_id'] == $row1['supplier_id']) {
																echo "selected";
															} ?> value="<?= $row2['supplier_id'] ?>"><?php echo $row2['company_name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</td>
								</tr>
							<?php } ?>

							</tbody>
						</table>
						<div class="text-left ms-5 mt-2">
							<button type="submit" name="update" class="admin_background btn btn-warning"><i class="fas fa-thumbs-up"></i> Update</button>
							<button type="button" class="admin_background btn btn-warning" onclick="window.location.href='../products/products.php'"><i class="fas fa-ban"></i> Cancel</button>
						</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<script src="../../bootstrap4/jquery/jquery.min.js"></script>
		<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
		<script>
			$(function() {
				$('[data-toggle="popover"]').popover()
			})
			$(document).ready(function() {
				$(document).on('blur', '#profit', function() {
					sell_price();
				});

				function sell_price() {
					var buy_price = 0;
					var profit = 0;
					var sell_price = 0;
					buy_price = $('#cost_price').val();
					if (buy_price > 0) {
						profit = $('#profit').val();
						if (profit > 0) {
							sell_price = parseFloat(buy_price) + parseFloat(profit);
							$('#price').val(sell_price.toFixed(2));
						}
					}
				}


			});
			
		</script>
	</body>

	</html>