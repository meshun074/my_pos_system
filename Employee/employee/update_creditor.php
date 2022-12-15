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
	<?php include('../templates/head1.php');
	?>

</head>
<body>
	<div class="contain h-100">
	<?php 
			include('../employee/base4.php');			
		?>
		<div class="header bg-dark">
			<img class="img-fluid w-100 mt-2 ml-1" src="../images/logo.png" >
		</div>
	
        <form method="post" action="creditors_payment.php" class="pr-4">
		<div class="main">
			<div class="side">
				<h1 class="ml-4">Creditors Management</h1>
				<hr>
				<h2 class="text-center" style="margin-bottom: 30px;"><?php echo $row1['firstname']. " " . $row1['lastname'];?></h2>
				<br><br>
			</div>


			<div class="second_side table-responsive">
					<p class="bg-danger w-50"><?php echo $msg;?></p>
					<table class="mt-5">
						<tbody>
							<tr style="visibility: hidden">
								<td  valign="baseline">reciept_no:</td>
								<td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="id" class="form-control-sm form-control" value="<?php echo $row1['receipt_no'];?>"required></div></td>
							</tr>
							<tr>
                                <td  valign="baseline">Owes:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="owes" readonly class="form-control-sm form-control" value="<?php echo $row1['owes'];?>"required></div></td>
                            </tr>
							<tr>
                                <td  valign="baseline">Paid:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min = "0.01" step="0.01" name="paid" readonly class="form-control-sm form-control" value="<?php echo $row1['paid'];?>"required></div></td>
                            </tr>
							<tr>
                                <td  valign="baseline">Balance:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min = "0.01" step="0.01" style="background-color: red; color: white;" name="balance" readonly class="form-control-sm form-control" value="<?php echo $row1['balance'];?>"required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Make Payment:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" min = "0.01" step="0.01" name="make_payment" class="form-control-sm form-control" placeholder="GHS 0.00" required></div></td>
                            </tr>

						<?php }?>
						</tbody>
					</table>
					<div class="text-left mt-3">
                        <button type="submit" name="update" class="btn btn-secondary"><i class="fas fa-thumbs-up"></i> Pay</button>
						<button type="button" class="btn btn-danger" onclick="window.location.href='../employee/creditors.php'" ><i class="fas fa-ban"></i> Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script>
		$(function () {
  			$('[data-toggle="popover"]').popover()
	})
	</script>
</body>
</html>