<?php include("../server/connection.php");
include('../customer/update.php');
include '../set.php';

if (isset($_GET['id'])) {
	$id   =   $_GET['id'];
	$sql  =   "SELECT * FROM customer WHERE customer_id = '$id'";
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
			<?php include('../customer/base.php'); ?>
			<div class="row">
				<div class="col-12">
					<h1 class="ms-5"><i class="fa-solid fa-user-pen"></i> Update Customer</h1>
					<hr class="mb-0 mt-1">
					<?php include '../customer/alert.php'; ?>
				</div>
				<div class="row">
					<div class="col-12 col-md-5 ms-md-0 pe-md-5 text-md-end text-center mt-2 mt-md-0 ">
						<img class="img-fluid  " style="border:1px dashed black; width: 250px;height: 250px;" src="../../images/<?php echo $row['image']; ?>">

						<form method="post" enctype="multipart/form-data">
							<input type="hidden" name="size" value="1000000">
							<p class="text-center w-100 mb-1 ">Change Photo:</p>
							<input class="form-control-sm " type="file" name="image">
					</div>
					<div class="col-12 table-responsive col-md-6 ps-5 ms-5 ps-md-0  ms-md-0 pe-5 pe-lg-5">
						<p class="bg-danger w-50">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td valign="baseline">First Name:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="fname" value="<?php echo $row['firstname']; ?>" class="form-control-sm form-control" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Last Name:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lname" value="<?php echo $row['lastname']; ?>" class="form-control form-control-sm" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" required>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Address:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div><textarea name="address" pattern="[A-Za-z0-9]+" class="form-control form-control-sm" required cols="23"><?php echo $row['address']; ?></textarea>
										</div>
									</td>
								</tr>
								<tr>
									<td valign="baseline">Contact Number:</td>
									<td class="ps-2 pb-1">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" name="number" pattern='\d{10}' title='Phone Number (Format: 0000000000)' class="form-control-sm form-control" value="<?php echo $row['contact_number']; ?>" required>
										</div>
									</td>
								</tr>
								<tr>
									<td>Change Photo:</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<div class="text-left ms-5 mt-2">
							<input type="hidden" name="id" value="<?php echo $row['customer_id']; ?>">
							<button type="submit" name="update_customer" class="admin_background btn btn-outline-dark"><i class="fas fa-thumbs-up"></i> Update</button>
							<button type="button" class="admin_background btn btn-outline-dark" onclick="window.location.href='../customer/customer.php'"><i class="fas fa-ban"></i> Cancel</button>
						<?php } ?>
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