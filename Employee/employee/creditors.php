<?php 
include("../server/connection.php");
include '../set.php';
$sql = "SELECT * FROM credits,customer where credits.customer_id=customer.customer_id AND balance!=0";
$result	= mysqli_query($db, $sql);
$deleted = isset($_GET['deleted']);
$added  = isset($_GET['added']);
$updated = isset($_GET['updated']);
$undelete = isset($_GET['undelete']);
$error = isset($_GET['error']);
$failure = "";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../employee/base3.php');			
		?>
		<div>
			<h1 class="ml-4 pt-2"><i class="fas fa-money-bill-alt"></i> Cash Management</h1>
			<hr>
			<?php
			if($updated){
				echo '<script>swal({title: "Successfully Updated!",icon: "success",buttons: "Okay"}).then((okay)=>{if(okay){ window.location.href="creditors.php";}});</script>';
			}
			?>
			<div class="table-responsive mt-4 pl-5 pr-5">
			<table class="table table-striped table-bordered" id="product_table" style="margin-top: -22px;">
                <thead>
                <tr>
                    <th scope="col" class="column-text">Reciept Number</th>
                    <th scope="col" class="column-text">Customer</th>
                    <th scope="col" class="column-text">Username</th>
                    <th scope="col" class="column-text">Owes</th>
                    <th scope="col" class="column-text">Paid</th>
                    <th scope="col" class="column-text">Balance</th>
                    <th scope="col" class="column-text">Date</th>
                    <th scope="col" class="column-text">Actions</th>
                </tr>
                </thead>
                <tbody class="table-hover">
                <?php
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr class="table-active">
                        <td><?php echo $row['receipt_no'];?></td>
                        <td><?php echo $row['firstname'] ." ". $row['lastname'];?></td>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['owes'];?></td>
                        <td><?php echo $row['paid'];?></td>
                        <td><?php echo $row['balance'];?></td>
                        <td><?php echo $row['transaction_date'];?></td>
                        <td>
                            <a name="edit" title="Make Payment" style='font-size:10px; border-radius:5px;padding:4px;' href="update_creditor.php?id=<?php echo $row['receipt_no'];?>" class="btn btn-info btn-xs"><i class="fas fa-user-edit"></i></a>
<!--                            <button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="--><?php //echo $row['reciept_no'];?><!--" class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i></button>-->
<!--                            <button type="button" name="delete" title="Delete" style='font-size:10px; border-radius:5px;padding:4px;' data-id="--><?php //echo $row['reciept_no'];?><!--"  class="delete btn btn-danger btn-xs" data-toggle="#deleteModal" title="Delete"><i class="fas fa-trash"></i></button>-->
                        </td>
                    </tr>
                <?php } ?>
				<div>&nbsp</div>
                </tbody>
            </table>
			</div>
		</div>
	</div>
	<div>&nbsp</div>
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="../sales/javascript.js"></script>
</body>
</html>
