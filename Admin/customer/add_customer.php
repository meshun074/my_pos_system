<?php 
	include('../customer/add.php');
	include '../set.php';
	?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../customer/base.php');
			include('../customer/alert.php');
		?>
		<div class="row">
			<div class="col-12">
				<h1 class="ms-5"><i class="fas fa-user-friends"></i> Add Customer</h1>
				<hr class="mb-0 mt-1">
			</div>
			<div class="row">
				<div class="col-12 col-md-5 ms-md-0 pe-md-5 text-md-end text-center mt-2 mt-md-0 ">
                    <img class="img-fluid  " style="border:1px dashed black; width: 250px;height: 250px;" src="../../images/user2.png">
				
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="size" class="form-control-sm" value="1000000">
						<input class="form-control-sm mt-2" type="file" name="image" required>
						<p class="bg-danger mt-3"></p>
				</div>
				<div class="col-12 table-responsive col-md-6 ps-5 ms-5 ps-md-0  ms-md-0 pe-5 pe-lg-5">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td  valign="baseline">First Name:</td>
									<td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="fname" class="form-control-sm form-control" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter Firstname" required></div></td>
								</tr>
								<tr>
									<td  valign="baseline">Last Name:</td>
									<td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lname" class="form-control-sm form-control" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter Lastname" required></div></td>
								</tr>
								<tr>
									<td  valign="baseline">Address:</td>
									<td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div><textarea name="address" required class="form-control-sm form-control" pattern="[A-Za-z0-9]+" placeholder="Enter Adderss"  cols="23"></textarea></div></td>
								</tr>
								<tr>
									<td  valign="baseline">Contact Number:</td>
									<td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" name="number" class="form-control-sm form-control" pattern='\d{10}' title='Phone Number (Format: 0000000000' placeholder="Enter Contact number" required></div></td>
								</tr>
							</tbody>
						</table>
						<div class="text-left ms-5 mt-4">
							<button type="submit" name="add_customer" class="admin_background btn btn-outline-dark"><i class="fas fa-thumbs-up"></i> Submit</button>
							<button class="admin_background btn btn-outline-dark" onclick="window.location.href='../customer/customer.php'" ><i class="fas fa-ban"></i> Cancel</button>
						</div>
					</form>
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