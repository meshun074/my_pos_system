<?php
include('../cashflow/add.php');
include '../set.php';
?>
<!DOCTYPE html>
<html>

<head>
	<?php include('../../templates/head1.php'); ?>
</head>

<body>
	<div class="contain h-100">
		<?php
		include('../cashflow/base.php');
		?>
		<div class="row">
			<div class="col-12">
				<h1 class="ms-5"><i class="fa-solid fa-cash-register"></i> Record Drawings / Investments</h1>
				<hr>
			</div>
			<div class="row">
				<div class="col-12 col-md-5 ms-md-0 pe-md-5 text-md-end text-center mt-2 mt-md-0 ">
					<img class="img-fluid  " style=" width: 250px;height: 250px;" src="../../images/cash.png">

					<form method="post">
						<p class="bg-danger mt-3">
				</div>
				<div class="col-12 table-responsive col-md-6 ps-5 ms-5 ps-md-0  ms-md-0 pe-5 pe-lg-5">
					<table class="table table-borderless">
						<tbody>
							<tr>
								<td valign="baseline">Purpose:</td>
								<td class="pl-5 pb-2"><textarea name="purpose" required placeholder="Enter Purpose" cols="28" rows="8" class="form-control"></textarea></td>
							</tr>
							<tr>
								<td valign="baseline">Transaction type:</td>
								<td class="pl-5 pb-2">
									<select name="t_type" id="t_type" class="form-control" placeholder="Transaction type" aria-label="Default select example">
										<option value="Cash_out">Cash out</option>
										<option value="Cash_in">Cash in</option>
									</select>
								</td>
							</tr>
							<tr>
								<td valign="baseline">Amount:</td>
								<td class="pl-5 pb-2">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">GHS</span></div><input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="text-left ms-5 mt-3">
						<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
						<button type="submit" name="add_cashflow" class="admin_background btn btn-outline-dark"><i class="fas fa-check-circle"></i> Submit</button>
						<button class="admin_background btn btn-outline-dark ms-2" onclick="window.location.href='../cashflow/cashflow.php'"><i class="fas fa-ban"></i> Cancel</button>
					</div>
					
					</form>
				</diV>
			</div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script>
		$(function() {
			$('[data-toggle="popover"]').popover()
		})
	</script>
</body>

</html>