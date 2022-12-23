<?php 
	include("../server/connection.php");
	include '../set.php';

  	if (isset($_GET['id'])){
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
			include('../sales/base.php');
		?>
        <form method="post" action="update.php" class="pr-4">
		<div class="main">
			<div class="side">
				<h1 class="ml-4">Creditors Management</h1>
				<hr>
				<h2 class="text-center" ><?php echo $row1['firstname']. " " . $row1['lastname'];?></h2>
				<br><br>
			</div>


			<div class="second_side table-responsive">
					<p class="bg-danger w-50"><?php echo $msg;?></p>
					<table class="table table-borderless">
						<tbody>
							<tr style="visibility: hidden">
								<td  valign="baseline">reciept_no:</td>
								<td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="id" class="form-control-sm form-control" value="<?php echo $row1['receipt_no'];?>"required></div></td>
							</tr>
							<tr>
                                <td  valign="baseline">Owes ₵:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="owes" readonly class="form-control-sm form-control" value="<?php echo $row1['owes'];?>"required></div></td>
                            </tr>
							<tr>
                                <td  valign="baseline">Paid ₵:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min = "0.01" step="0.01" name="paid" readonly class="form-control-sm form-control" value="<?php echo $row1['paid'];?>"required></div></td>
                            </tr>
							<tr>
                                <td  valign="baseline">Balance ₵:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min = "0.01" step="0.01" style="background-color: red; color: white;" name="balance" readonly class="form-control-sm form-control" value="<?php echo $row1['balance'];?>"required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Make Payment ₵:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min = "0.01" step="0.01" name="make_payment" class="form-control-sm form-control" placeholder="₵ 0.00" required></div></td>
                            </tr>

						<?php }?>
						</tbody>
					</table>
					<div class="text-left mt-3">
                        <button type="submit" name="update" class="btn btn-secondary"><i class="fas fa-thumbs-up"></i> Pay</button>
						<button type="button" class="btn btn-danger" onclick="window.location.href='../sales/creditors.php'" ><i class="fas fa-ban"></i> Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>