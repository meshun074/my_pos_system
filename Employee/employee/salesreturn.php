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
		include('../employee/base1.php');

		if ($success) {
			echo '<script>swal("Success","Successfully Added!","success");</script>';
		}
		
		?>
		<div class="pr-1">
			<div>
				<h1 class="ms-5 pt-2" align="left"><i class="fa-solid fa-file-invoice"></i> Sales Return Records</h1>
			</div>
			<div class="form-group row ps-4" id="input-daterange">
				<div class="col-md-4">
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span></div><input type="text" name="start_date" readonly id="start_date" class="form-control pr-5" placeholder="From Date" />
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span></div>
						<input type="text" name="end_date" readonly id="end_date" class="form-control" placeholder="To Date" />
					</div>
				</div>
				<div class="col-md-4">
					<button class="employee_background btn btn-primary " type="button" id="filter"><i class="fas fa-search"></i> Search</button>
				</div>

			</div>
			<div class="table-responsive mt-3 ps-4 pe-4" id="d">
				<table class="table table-bordered table-striped table mt-5" id="sales_return_table" >
					<thead>
						<tr>
							<th scope="col" class="column-text">Credit Note No.</th>
							<th scope="col" class="column-text">Reciever Name</th>
							<th scope="col" class="column-text">Customer Name</th>
							<th scope="col" class="column-text">Total Value₵</th>
							<th scope="col" class="column-text">Date</th>

						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<!-- <div align="right" class="container p-5">
				<button class="btn employee_background btn-primary" onclick="printSection('d')">Print Sales Return</button>
			</div> -->
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/jquery/datepicker.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../../bootstrap4/js/typeahead1.js"></script>
	<script src="../employee/script.js"></script>
	<script>
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
	var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
	return new bootstrap.Popover(popoverTriggerEl)
	})
	</script>
</body>

</html>