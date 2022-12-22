<?php
include('../server/connection.php');
include('passchange.php');
include('../set.php');

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM users WHERE username = '$username' AND deleted='FALSE'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result);
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include('../../templates/head1.php'); ?>
	</head>

	<body>
		<div class="contain h-100">
			<?php include('base.php'); ?>
			<div class="col-12 w-100 p-2">
				
				<form method="post" enctype="multipart/form-data">
					<div class="card text-center">
						<div class="card-header">
						<h1 class="ml-4 pt-2"><i class="fas fa-users"></i> My Profile</h1>
						</div>
						<div class="card-body w-100">

							<div class="card mb-3 w-100">
								<div class="row g-0">
									<div class="col-md-4 text-lg-end">
										<img src="<?php echo '../../images/' . $row['image']; ?>" class="img-fluid rounded-start" alt="...">
									</div>
									<div class="col-md-8">
										<div class="card-body text-lg-start ms-lg-5 ps-lg-5">
											<h5 class="card-title"><?php echo "<h3><i class='fas fa-user-circle text-secondary'></i> " . $row['firstname'] . "&nbsp" . $row['lastname'] . "</h3>"; ?></td></h5>
											<h4><i class="fas fa-phone"></i> <?php echo $row['contact_number']; ?></h4>
											<h4><i class="fas fa-user-shield"></i> <?php echo $row['position']; ?></h4>
											<div class="text-left mt-4">
												<a title="Edit" href="update_user.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-user-edit"></i> Edit </a>
												<button type="button" id="user" title="Change Password?" class="btn btn-primary" style="background-color: #1b1464; color:aliceblue;" data-bs-toggle="modal" data-bs-target="#modal-user"><i class="fas fa-edit"></i> Change Password</button>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-danger">
							<p><?php include('../error.php'); ?></p>
						</div>
				</form>
			<?php
		}
			?>
			</div>
		</div>
		</div>

		<script src="../../bootstrap4/jquery/jquery.min.js"></script>
		<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
		<script>
			var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
			var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl)
			})
		</script>
		<?php include('changepassword.php');
		include('error.php');
		include('alert.php'); ?>
	</body>

	</html>


