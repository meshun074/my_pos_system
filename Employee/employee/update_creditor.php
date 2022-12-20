<?php
include("../server/connection.php");
include '../set.php';

if (isset($_GET['id'])) {
	$id   =   $_GET['id'];
	$sql  =   "SELECT * FROM credits,customer WHERE receipt_no='$id' AND credits.customer_id = customer.customer_id";
	$result1   = mysqli_query($db, $sql);
	$row1  =   mysqli_fetch_array($result1);
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include('../../templates/head1.php');
		?>

	</head>

	<body>
		<div class="contain h-100">
			<?php
			include('../employee/base4.php');
			?>



			<form method="post" action="creditors_payment.php" class="pr-4">
				<div class="">
					<div class="side">
						<h1 class="ms-5 mt-2"><i class="fa-solid fa-pen-to-square"></i>Update Creditor's Account</h1>
					</div>

					<div class="card p-4 pt-2">
						<div class="employee_background text-white card-header p-0">
							<h2 class="text-center text-capitalize" ><?php echo $row1['firstname'] . " " . $row1['lastname']; ?></h2>
						</div>
						<div class="card-body ps-0 pe-0 w-100">
							<div class="card ">
								<div class="row g-0">
									<div class="col-md-4">
										<img src="../../images/<?php echo $row1['image']; ?>" style="width: 18rem; height:18rem" class="img-fluid rounded-start" alt="...">
									</div>
									<div class="col-md-8">
										<div class="card-body pt-0 pb-0">
											<div class="table-responsive">
												<p class="bg-danger w-50"><?php echo $msg; ?></p>
												<table class="table mb-0 table-borderless" >
													<tbody>														
														<tr>
															<td valign="baseline">Owes:</td>
															<td class=" pb-1">
																<div class="input-group">
																	<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="owes" readonly class="form-control-sm form-control" value="<?php echo $row1['owes']; ?>" required>
																</div>
															</td>
														</tr>
														<tr>
															<td valign="baseline">Paid:</td>
															<td class=" pb-1">
																<div class="input-group">
																	<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min="0.01" step="0.01" name="paid" readonly class="form-control-sm form-control" value="<?php echo $row1['paid']; ?>" required>
																</div>
															</td>
														</tr>
														<tr>
															<td valign="baseline">Balance:</td>
															<td class=" pb-1">
																<div class="input-group">
																	<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min="0.01" step="0.01" style="background-color: red; color: white;" name="balance" readonly class="form-control-sm form-control" value="<?php echo $row1['balance']; ?>" required>
																</div>
															</td>
														</tr>
														<tr>
															<td valign="baseline">Make Payment:</td>
															<td class=" pb-1">
																<div class="input-group">
																	<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min="0.01" step="0.01" name="make_payment" class="form-control-sm form-control" placeholder="₵ 0.00" required>
																</div>
															</td>
														</tr>
														<tr style="visibility: hidden">
															<td valign="baseline">reciept_no:</td>
															<td class="p-0">
																<div class="input-group m-0 p-0">
																	<div class="input-group-prepend m-0 p-0"><span class="input-group-text m-0 p-0" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="id" class="form-control-sm form-control" value="<?php echo $row1['receipt_no']; ?>" required>
																</div>
															</td>
														</tr>

													<?php } ?>
													</tbody>
												</table>
												<div class="text-left ps-5">
													<button type="submit" name="update" class="employee_background btn btn-primary"><i class="fas fa-thumbs-up"></i> Pay</button>
													<button type="button" class="btn btn-danger" onclick="window.location.href='../employee/creditors.php'"><i class="fas fa-ban"></i> Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</form>
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