<?php
include('../supplier/add.php');
include '../set.php';
?>
<!DOCTYPE html>
<html>

<head>
	<?php include('../../templates/head1.php'); ?>
</head>

<body>
	<div class="contain h-100">
		<?php include('../supplier/base.php'); ?>
		<div class="row">
			<div class="col">
				<h1 class="ms-5 mt-2"><i class="fas fa-hospital-user"></i> Add Supplier </h1>
				<hr class="mb-0 pb-0">
			</div>

			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="size" class="form-control-sm" value="1000000">
				<div class="card ms-4 me-4 mb-3">
					<div class="row g-0">
						<div class="col-md-5 p-3" style=" width: 250px;height: 250px;">
							<img src="../../images/supplier.png" style="border:1px dashed black;" class="img-fluid rounded-start p-2 h-100 w-100" alt="...">
							<input class="form-control-sm mt-3 " type="file" name="image" required>
						</div>
						<div class="col-md-7">
							<div class="card-body table-responsive ms-3 ms-lg-5 p-0 pe-2 text-start">
								<table class="table-responsive mt-5 mt-lg-0">
									<p><?php include('../error.php'); ?></p>
									<tbody>
										<tr>
											<td valign="baseline">Company Name:</td>
											<td class="ps-5 pb-2">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span></div><input type="text" name="com_name" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces. e.g John12" class="form-control-sm form-control" placeholder="Enter Company Name" required>
												</div>
											</td>
										</tr>
										<tr>
											<td valign="baseline">Firstname:</td>
											<td class="ps-5 pb-2">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="firstname" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" class="form-control-sm form-control" placeholder="Enter Firstname" required>
												</div>
											</td>
										</tr>
										<tr>
											<td valign="baseline">Lastname:</td>
											<td class="ps-5 pb-2">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lastname" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" class="form-control-sm form-control" placeholder="Enter Lastname" required>
												</div>
											</td>
										</tr>
										<tr>
											<td valign="baseline">Address:</td>
											<td class="ps-5 pb-2">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div><textarea name="address" required pattern="[A-Za-z0-9]+" class="form-control-sm form-control" placeholder="Enter Address" cols="23"></textarea>
												</div>
											</td>
										</tr>
										<tr>
											<td valign="baseline">Contact Number:</td>
											<td class="ps-5 pb-2">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" title='Phone Number' class="form-control-sm form-control" name="number" placeholder="Enter Conctact Number" required>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="text-left ms-5 mt-3 mb-1">
									<button type="submit" name="add" class="admin_background btn btn-outline-dark"><i class="fas fa-thumbs-up"></i> Submit</button>
									<button class="admin_background btn btn-outline-dark" onclick="window.location.href='../supplier/supplier.php'"><i class="fas fa-ban"></i> Cancel</button>
								</div>
							</div>

						</div>
					</div>
			</form>
		</div>
	</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script>
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl)
		})
	</script>
</body>

</html>