<?php include('server/connection.php'); ?>
<?php include('login.php');?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
	<script src="../bootstrap4/jquery/sweetalert.min.js"></script>
</head>
<body style="background-color: #0d0d0d; height:max-content;">
	<div class="text-center border-bottom border-light justify-content-center">
		<div class="main">
			<div class="text-center w-20 p-20">
				<img src="../images/sunstar1.png" class="rounded img-fluid" alt="...">
			</div>
			<p class="fs-1" style="color:#D9A84E;">Sunstar Gold Buying & Refinery <br> Hardware Store </p>
  			<?php include('error.php');?>
		</div>		
	</div>
	<div class="text-center mt-5">
			<div class="d-inline">
				<button type="button" style="background-color: #0d0d0d; color: #D9A84E;" id="admin" class="btn-lg btn-secondary" data-bs-toggle="modal" data-bs-target=".bd-example-modal"><i class="fas fa-user-tie"></i> Administrator</button>
			</div>                                                            
		</div>
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('modals/admin_login_modal.php');?>

</body>
</html>
