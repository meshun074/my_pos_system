<div id="restoreModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">  
	<div class="modal-dialog" role="document">  
		<div class="modal-content">
			<form action="restore.php" method="GET">
		   		<div class="modal-header bg-primary"> 
					<h3>Restore!</h3>
					<button type="button" class="btn-close " data-bs-dismiss="modal" aria-hidden="true"></button>
		   		</div>
				<div class="modal-body">
					<p>Are you sure you want to restore this product?</p>					
				</div> 
				<div class="modal-footer">
					<input type="hidden" name="id" value="" />
					<input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
					<button class="btn btn-primary" type="submit">Restore</button>  
				</div>
			</form>  
		</div>  
	</div>  
</div>