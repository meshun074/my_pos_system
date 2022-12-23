<?php
	include("../server/connection.php");
	include '../set.php';
	$success = isset($_GET['success']);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');
    include('../print.php');
	?>

</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../sales/base1.php');

			if($success){
			echo '<script>swal("Success","Successfully Added!","success");</script>';
			}
		?>
		<div class="pr-1">
			<div>
				<h1 class="ms-5 pt-2" ><i class="fas fa-truck"></i> Sales Return Records</h1>
				<hr>
			</div>
			<div class="form-group row ms-4 me-4" id="input-daterange">
				<div class="col-md-4">
					<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span></div>
					<input type="text" name="start_date" readonly id="start_date" class="form-control form-control-sm" placeholder="From Date" /></div>
				</div>
				<div class="col-md-4 ">
					<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span></div>
					<input type="text" name="end_date" readonly id="end_date" class="form-control form-control-sm" placeholder="To Date" /></div>
				</div>
				<div class="col-md-4 ">
				<button class="admin_background btn btn-sm btn-warning" type="button" id="filter"><i class="fas fa-search"></i> Search</button>
				</div>
			</div>
			<div class="table-responsive mt-2 ps-4 pe-4" id="d">
			<table class="table table-bordered border-warning table-striped  mt-5" id="sales_return_table" style="margin-top: -22px;">
				<thead class="admin_background">
					<tr>
						<th scope="col" class="column-text">Credit Note No.</th>
						<th scope="col" class="column-text">Reciever Name</th>
						<th scope="col" class="column-text">Customer Name</th>				
						<th scope="col" class="column-text">Total Value ₵</th>
						<th scope="col" class="column-text">Date</th>

					</tr>
				</thead>
				<tbody>
					
				</tbody>				
			</table>
			</div>
            <div align="right" class="container pe-5 pb-2 pt-4">
                <button  class="admin_background btn  btn-warning" onclick="printSection('d')">Print Sales Return</button>
            </div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/jquery/datepicker.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../../bootstrap4/js/typeahead1.js"></script>
	<script src="../sales/script.js"></script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>