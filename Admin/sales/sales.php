<?php
	include("../server/connection.php");
	include '../set.php';
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
			include('../sales/base.php');
		?>
		<div class="pr-1">
			<div>
				<h1 class="ms-5 pt-0" ><i class="fa-solid fa-receipt"></i> Sales Records</h1>
				<hr>
			</div>
			<div class="form-group row ps-5" id="input-daterange">
				<div class="col-md-4">
					<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span></div>
					<input type="text" name="start_date" readonly id="start_date" class="form-control form-control-sm " placeholder="From Date" /></div>
				</div>
				<div class="col-md-4 pe-5">
					<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span></div>
					<input type="text" name="end_date" readonly id="end_date" class="form-control form-control-sm " placeholder="To Date" /></div>
				</div>
				<div class="col-md-4 pe-5">
				<button class="admin_background btn btn-sm btn-warning" type="button" id="filter"><i class="fas fa-search"></i> Search</button>	
				</div>
			</div>
			<div class="table-responsive mt-2 ps-4 pe-4" id="s">
			<table class="table table-bordered border-warning table-striped" id="sales_table">
				<thead class="admin_background">
					<tr>
						<th scope="col" class="column-text">Receipt No.</th>
						<!-- <th scope="col" class="column-text">Product</th> -->
						<th scope="col" class="column-text">Cashier</th>
						<th scope="col" class="column-text">Customer Name</th>
					<th scope="col" class="column-text">Discount(%)</th>
						<th scope="col" class="column-text">Value ₵</th>
							<th scope="col" class="column-text">Date</th>

					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot class="border border-light">
					<th colspan="3" class="text-right">Total:</th>
					<th id="discount"></th>
					<th id="sales"></th>
					<th></th>
				</tfoot>				
			</table>
			</div>
            <div align="right" class="container pe-5 p-2">
                <button  class="admin_background btn btn-warning" onclick="printSection('s')">Print Sales</button>
            </div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/jquery/accounting.min.js"></script>
	<script src="../../bootstrap4/jquery/datepicker.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../sales/javascript.js"></script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>