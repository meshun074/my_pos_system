<?php
include("../server/connection.php");
include('../supplier/update.php');
include '../set.php';

if (isset($_GET['id'])) {
	$id   =   $_GET['id'];
	$sql  =   "SELECT * FROM supplier WHERE supplier_id = '$id'";
	$result   = mysqli_query($db, $sql);
	$row  =   mysqli_fetch_array($result);

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
					<h1 class="ms-5"><i class="fa-solid fa-user-pen"></i> Update Supplier </h1>
					<hr class="mb-0 pb-0">
				</div>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="size" value="1000000">
					<div class="card ms-4 me-4 mb-3">
						<div class="row g-0">
							<div class="col-md-5 p-3" style=" width: 250px;height: 250px;">
								<img src="../../images/<?php echo $row['image']; ?>" style="border:1px dashed black;" class="img-fluid rounded-start  h-100 w-100" alt="...">
								<i class="fas fa-file-upload"></i> Change Photo: <br><input class="form-control-sm mt-2 " type="file" name="image" required>
							</div>
							<div class="col-md-7">
								<div class="card-body table-responsive ms-3 ms-lg-5 p-0 pe-2 text-start">
									<p class="bg-danger w-50"><?php echo $msg; ?></p>
									<table class="mt-5 mt-lg-0">
										<tbody>
											<tr>
												<td valign="baseline">Company Name:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span></div><input type="text" name="com_name" pattern="[A-Za-z0-9]+" title="Name must not contain numbers or spaces. e.g John12" class="form-control-sm form-control" value="<?php echo $row['company_name']; ?>" required>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Firstname:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="firstname" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" class="form-control-sm form-control" value="<?php echo $row['firstname']; ?>" required>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Lastname:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lastname" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" class="form-control-sm form-control" value="<?php echo $row['lastname']; ?>" required>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Address:</td>
												<td class="ps-3 pb-2 ">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div><textarea name="address" pattern="[A-Za-z0-9]+" class="form-control-sm form-control " required cols="23"><?php echo $row['address']; ?></textarea>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Contact Number:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input class="form-control-sm form-control" pattern='\d{10}' title='Phone Number (Format: 0000000000' type="text" name="number" value="<?php echo $row['contact_number']; ?>" required>
													</div>
												</td>
											
										</tbody>
									</table>
									<div class="text-left ms-5 mt-3 pb-2">
										<input type="hidden" name="id" value="<?php echo $row['supplier_id']; ?>">
										<button type="submit" name="update" class="admin_background btn btn-outline-dark"><i class="fas fa-thumbs-up"></i> Update</button>
										<button type="button" class="admin_background btn btn-outline-dark" onclick="window.location.href='../supplier/supplier.php'"><i class="fas fa-ban"></i> Cancel</button>
									<?php } ?>
									</div>
								</div>
							</div>
						</div>
				</form>
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