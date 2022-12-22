<?php 
	include("../server/connection.php");
	include('../user/add.php');
	include '../set.php';
	$sql = "SELECT * FROM users WHERE deleted='TRUE' ORDER BY firstname ASC ";
	$result	= mysqli_query($db, $sql);
	$restore = isset($_GET['restore']);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$unrestore = isset($_GET['unrestore']);
	$error = isset($_GET['error']);
	$failure = "";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../templates/head1.php');?>

</head>
<body>
	<div class="contain h-100">
		<?php include('../user/base.php');?>
		<div>
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-user-slash"></i> Deleted Users</h1>
			<hr>
				<?php include('../alert.php');?>
			<div class="table-responsive mt-4 ps-4 pe-4">
			<table class="table table-striped table-bordered" id="user_table">
				<thead class="admin_background">
					<tr>
						<th scope="col" class="column-text">Username</th>
						<th scope="col" class="column-text">Name</th>
						<th scope="col" class="column-text">Position</th>
						<th scope="col" class="column-text">Contact Number</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_array($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['firstname'];echo '&nbsp';echo $row['lastname'];?></td>
						<td><?php echo $row['position'];?></td>
						<td><?php echo $row['contact_number'];?></td>
						<td>
							<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo $row['id'];?>" class="btn btn-success btn-xs view_data" title="View"><i class="fas fa-eye"></i></button>
							<button type="button" name="delete" title="Delete" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['id'];?>" class="restore btn btn-primary" data-bs-toggle="modal" data-bs-target="#restoreModal" title="Restore"><i class="fa-solid fa-recycle"></i></button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<?php include('../user/restore_user.php');?>
	<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-bs-backdrop="static" data-bs-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default btn-success" data-bs-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script>
	$(function () {
  	$('[data-toggle="popover"]').popover()
	});
	$(function(){
		$('button.restore').click(function(e){
			e.preventDefault();
			var link = this;
			var restoreModal = $("#restoreModal");
			restoreModal.find('input[name=id]').val(link.dataset.id);
			restoreModal.modal();
		});
	});
	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#Contact_Details').html(data);  
					$('#dataModal').modal('show');  
				}  
			});  
		}            
	});   
 }); 

$(document).ready(function(){
	$('#user_table').dataTable();
})
</script>