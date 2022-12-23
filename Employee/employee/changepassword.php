
	</style>
<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal modal-dialog-centered">
		<div class="modal-content text-center p-5">
			<div class="modal-header">
				<h5 class="modal-title">Change Password</h5>
			</div>
			<form method="post" action="">
			<div class="modal-body mt-3">
				<div>
					<input type="hidden" name="position"/>
					<div class="input-group  "><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span></div>
					<input class="form-control form-control-sm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password-field" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" name="newpass" placeholder="Enter New Password" required/><span toggle="#password-field" class="fa fa-sm fa-eye position-absolute end-0 bottom-50 pe-2 toggle-password"></span></div><br>

					<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span></div>
					<input class="form-control-sm form-control" id="password-field1" type="password" name="confirmpass" placeholder="Confirm Password" required/><span toggle="#password-field1" class="fa fa-sm fa-eye position-absolute end-0 bottom-50 pe-2 toggle-password"></span></div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancel</button>
					<button type="submit" name='changepass' style="background-color: #1b1464; color:aliceblue;" class="btn btn-primary"><i class="fas fa-user-edit"></i> Change</button>					
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".toggle-password").click(function() {
  		$(this).toggleClass("fa-eye fa-eye-slash");
  		var input = $($(this).attr("toggle"));
  		if (input.attr("type") == "password") {
    		input.attr("type", "text");
  		} else {
    		input.attr("type", "password");
  		}
	});
</script>