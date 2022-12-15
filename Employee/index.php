<?php include('server/connection.php');?>
<?php include('login.php');?> 
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
	<script src="../bootstrap4/jquery/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body style="background-color: #1b1464; height:max-content;">
	<div class="text-center border-bottom border-light justify-content-center">
		<div class="main ">
			<div class="text-center w-20 p-20">
				<img src="../images/sunstar1.png" class="rounded img-fluid" alt="...">
			</div>			
			<p class="fs-1" style="color:white">Sunstar Gold Buying & Refinery <br> Hardware Store </p>
  			<?php include('../Employee/error.php');?>
		</div>

	</div>
	<div class="text-center mt-5">                                                           
			<div class="d-inline ">
				<button type="button" style="background-color: #1b1464; color:aliceblue;" id="user" class="btn-lg btn-secondary " data-bs-toggle="modal" data-bs-target="#modal-user"><i class="fas fa-user"></i> User</button>
			</div>
	</div>
	
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../Employee/modals/employee_login_modal.php');?>
</body>
</html>
