<?php 
	include('../server/connection.php');
	include('../user/passchange.php');
	include('../set.php');

	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($db ,$sql);
		$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php include('base.php');?>
		<div class="row">
			<div class="col">
				<h1 class="ms-5 pt-2"><i class="fa-solid fa-user"></i> User Profile</h1>
				<hr class="mb-0 pb-0">
			</div>

			<form method="post" enctype="multip+ ':' + seconds + ' ' art/form-data">
			<div class="card ms-4 me-4 mb-3">
			<div class="row g-0">
				<div class="col-md-4 ">
				<img src="../../images/<?php echo $row['image']; ?>" style="height: 20rem; width:auto" class="img-fluid rounded-start" alt="...">
				</div>
				<div class="col-md-8">
				<div class="card-body ms-3 ms-lg-0 p-0 text-start">
				<table class="table-responsive mt-2">
						<p><?php include('../error.php');?></p>
						<tbody>
							<tr>
								<td class="pb-3"><?php echo "<h3><i class='fas fa-user-circle text-secondary'></i> ".$row['firstname']."&nbsp".$row['lastname']."</h3>"; ?></td>
							</tr>
							<tr>
								<td class="pb-3"><h4><i class="fas fa-phone"></i> <?php echo $row['contact_number'];?></h4></td>
							</tr>
							<tr>
								<td class="pb-3"><h4><i class="fas fa-user-shield"></i> <?php echo $row['position'];?></h4></td>
							</tr>
						</tbody>
					</table>
					<div class="text-left mt-4">
						<a title="Edit" href="../user/update_profile.php?id=<?php echo $row['id'];?>" class="btn btn-info"><i class="fas fa-user-edit"></i> Edit </a>
						<button type="button" id="user" title="Change Password?" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-user"><i class="fas fa-edit"></i> Change Password</button>
					</div>
					
				</div>
				</div>
			</div>
			</div>
			</form>
			<?php 
			} 
			?>
		</div> 
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../user/changepassword.php');
		include('../user/error.php');
	include('../user/alert.php');?>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>
