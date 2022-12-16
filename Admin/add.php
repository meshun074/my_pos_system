
<style>
	input[name="image"]{
		width: 100px;
	}
	input[id="validationCustom02"]{
		margin-bottom: -20px
	}
</style>


<!-- Modal for Adding data -->
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-fluid" role="document">
		<div class="modal-content" style="width:70%; margin-left: 20%;">
	  		<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light" id="exampleModalCenterTitle" ><strong>Add New Customer</strong></h4>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
	  		</div>
	  	<div class="modal-body">
			<div class="container-fluid">
				<form method="post" id="modal-form" action="" enctype="multipart/form-data" class="needs-validation">
		  			<div>
		  			<div style="text-align:center">
		  				<input type="hidden" name="size" class="form-control-sm" value="1000000">
		  				<input type="hidden" id="user1" name="user" class="form-control-sm" value="<?php echo $_SESSION['username'];?>">
		  				<img class="mb-1" width="150" height="150" src="images/user.png"/>
		  			</div>
		  				<small><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>		  				
		  				<input class="form-control form-control-sm" type="text" name="fname" id="fname1" placeholder="Enter First name" required></div>
		  				<div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
		  				<input class="form-control form-control-sm" type="text" name="lname" id="lname1" placeholder="Enter Last name" required></div>
		  				<div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div>
		  				<input class="form-control form-control-sm" type="text" name="number" id="number1" placeholder="Enter Phone number" required></div>
		  				<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div>
		  				<textarea type="text" class="form-control form-control-sm" name="address" id="address1" placeholder="Enter Address" required></textarea></div>
		  				<label>Choose Picture:<i class="fas fa-file-upload"></i></label><input type="file" class="form-control-sm" name="image" id="image1" required/>
		  				</small>

		  			</div>
				</form>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancel</button>
				<button id="submit_customer" type="button"  name="submit" class="btn btn-secondary" data-bs-dismiss="modal" form="modal-form">Submit</button>
			</div>
		</div>
	</div>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="max.js"></script> -->
</div>

