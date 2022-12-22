<?php
include("../server/connection.php");
include '../set.php';

if (isset($_GET['id'])) {
	$id   =   $_GET['id'];
	$sql  =   "SELECT * FROM users WHERE id = '$id'";
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
			<?php include('../user/base.php'); ?>
			<div class="row">
				<div class="col-12">
					<h1 class="ms-5 pt-2"><i class="fa-solid fa-user-pen"></i> Update Proflie</h1>
					<hr class="pb-0 mb-0">
				</div>
				<div class="col-12">
					<div class="card ms-4 me-4 mb-3">
					<form method="post" enctype="multipart/form-data" action="../user/update.php">
									<input type="hidden" name="size" value="1000000">
						<div class="row g-0">
							<div class="col-md-4" style="border:1px dashed black; height: 20rem; width:auto">
								<img src="../../images/<?php echo $row['image']; ?>"  class="img-fluid rounded-start w-100 h-100" alt="...">
							</div>
							<div class="col-md-7 me-3">
								<div class="card-body ">
									<p class="bg-danger w-50"><?php echo $msg; ?></p>
									<table class="mt-5">
										<tbody>
											<tr>
												<td valign="baseline">Firstname:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="firstname" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces. e.g John12" value="<?php echo $row['firstname']; ?>" class="form-control form-control-sm" required>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Lastname:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input pattern="[A-Za-z]+" title="Name must not contain numbers or spaces. e.g John12" type="text" name="lastname" value="<?php echo $row['lastname']; ?>" class="form-control form-control-sm" required>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Contact number:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" name="number" pattern='\d{10}' title='Phone Number (Format: 0000000000)' value="<?php echo $row['contact_number']; ?>" class="form-control form-control-sm" required>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="baseline">Position:</td>
												<td class="ps-3 pb-2">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
																<i class="fas fa-user-tag"></i></span></div>
														<select name="position" class="form-control form-control-sm">
															<option value="<?php echo $row['position']; ?>"><?php echo $row['position']; ?></option>
															<option value="Admin">Admin</option>
															<option value="Employee">Employee</option>
														</select>
													</div>
												</td>
											</tr>
											<tr>
												<td>Change Photo:</td>
												<td><input class="form-control-sm ps-4" type="file" name="image" ></td>
											</tr>
										</tbody>
									</table>
									<div class="text-left mt-3">
										<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
										<input type="hidden" name="user" value="<?php echo $row['username']; ?>">
										<button type="submit" name="update" class="admin_background btn btn-outline-dark"><i class="fas fa-user-edit"></i> Update</button>
										<button type="button" class="admin_background btn btn-outline-dark" onclick="window.location.href='../user/profile.php'"><i class="fas fa-ban"></i> Cancel</button>
									<?php } ?>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
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