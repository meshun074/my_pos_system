<div class="modal fade" id="modal-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content text-center p-5">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-lock"></i> Sign In</h5>
			</div>
			<form method="post" action="">
			<div class="modal-body mt-3 ">
				<div>
					<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span></div>
					<input class="form-control-sm form-control" type="text" name="username" placeholder="Enter Username" required/></div>
					<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span></div>
					<input class="form-control-sm form-control" type="password" name="password" placeholder="Enter Password" required/>
					<input type="hidden" name="position" value="Employee"/></div>
				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-ban"></i>  Close</button>
					<button type="submit" name='login' style="background-color: #1b1464; color:aliceblue;" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> login</button>					
				</div>
			</form>
			</div>
		</div>
	</div>
</div>



