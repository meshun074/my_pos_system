<div class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content text-center p-5">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-lock"></i> Admin Sign In</h5>
			</div>
			<form method="post" action="">
			<div class="modal-body mt-3">
				<div>
					<input type="hidden" name="position" value="Admin"/>
					<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span></div>
					<input class="form-control-sm form-control" type="text" name="username" placeholder="Enter Username" required/></div>
					<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span></div>
					<input class="form-control-sm form-control" id="pass" type="password" name="password" placeholder="Enter Password" required/></div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
					<button type="submit" name="login" class="btn btn-warning"><i class="fas fa-sign-in-alt"></i> login</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>