<?php
include("../server/connection.php");
include('../employee/update.php');
include '../set.php';
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
	$id   =   $_GET['id'];
	$sql  =   "SELECT * FROM users WHERE username = '$username'";
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
			<?php include('base0.php'); ?>
			<div class="col-12 w-100 p-2">

				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="size" value="1000000">
					<div class="card text-center">
						<div class="card-header">
							<h1 class="ml-4"><i class="fas fa-users"></i> User Management</h1>
						</div>
						<div class="card-body w-100">

							<div class="card mb-3 w-100">
								<div class="row g-0">
									<div class="col-md-4 text-lg-end">
										<img src="<?php echo '../../images/' . $row['image']; ?>" class="img-fluid rounded-start" alt="...">
									</div>
									<div class="col-md-8">
										<div class="card-body text-lg-start ms-lg-5 ">
											<p class="bg-danger w-50"><?php echo $msg; ?></p>
											<table class="mt-5 mb-2">
												<tbody>
													<tr>
														<td valign="baseline">Username:</td>
														<td class="ps-2 pb-2">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span></div><input type="text" name="username" readonly pattern="[a-z0-9]{1,15}" title="Username should contain lowercase or letters. e.g. john12" value="<?php echo $row['username']; ?>" class="form-control form-control-sm" required>
															</div>
														</td>
													</tr>
													<tr>
														<td valign="baseline">Firstname:</td>
														<td class="ps-2 pb-2">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="firstname" title="Name must not contain numbers or spaces. e.g John12" value="<?php echo $row['firstname']; ?>" class="form-control form-control-sm" required>
															</div>
														</td>
													</tr>
													<tr>
														<td valign="baseline">Lastname:</td>
														<td class="ps-2 pb-2">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lastname" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" value="<?php echo $row['lastname']; ?>" class="form-control form-control-sm" required>
															</div>
														</td>
													</tr>
													<tr>
														<td valign="baseline">Contact number: </td>
														<td class="ps-2 pb-2">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" name="number" pattern='\d{10}' title='Phone Number (Format: 0000000000)' value="<?php echo $row['contact_number']; ?>" class="form-control form-control-sm" required>
															</div>
														</td>
													</tr>
													<tr>
														<td>Change Photo:</td>
														<td><input class="form-control-sm ps-3" type="file" name="image" style="padding-left:80px;"></td>
													</tr>
												</tbody>
											</table>
											<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
											<button type="submit" name="update" class="employee_background btn btn-secondary"><i class="fas fa-user-edit"></i> Update</button>
											<button type="button" class="btn btn-danger" onclick="window.location.href='../employee/profile.php'"><i class="fas fa-ban"></i> Cancel</button>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-danger">
							<p class="bg-danger w-50"><?php echo $msg; ?></p>
						</div>
				</form>
			<?php
		}
			?>
			</div>
		</div>

		
		<script src="../../bootstrap4/jquery/jquery.min.js"></script>
		<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
		<script>
			$(function() {
				$('[data-toggle="popover"]').popover()
			})
		</script>
	</body>

	</html>