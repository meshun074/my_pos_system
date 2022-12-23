<?php 
	include("../cashflow/add.php");
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT SUM(quantity*cost_price)  as cTotal, SUM(quantity*sell_price)  as sTotal  FROM products";
	$result	= mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
	$sql1 = "SELECT SUM(Total)  as sTotal  FROM credit_note";
	$result1	= mysqli_query($db, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $sql2 = "SELECT SUM(amount) as Total FROM draw_invest_flow Where purpose LIKE '%expense%' AND transaction_type = 'Cash_out'";
	$result2	= mysqli_query($db, $sql2);
    $row2 = mysqli_fetch_assoc($result2)
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
			include('../cashflow/base.php');

		?>
		<div >
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-receipt"></i> Income Statement</h1>
			<hr class="mb-0 pb-0">
			<div class="table-responsive mt-0 ps-4 pe-4" id="cash">
				<h2 class="text-center mb-0">Income statement for the year <?php echo date("Y"); ?></h2>
			<table class="mt-0 table table-sm table-striped" id="balance_table" >
				<thead>
					<tr>
						<th scope="col" class="column-text"><h3>Revenue</h3></th>						
						<th scope="col" class="column-text"><h3 class="text-right">GHS Amount</h3></th>						
					</tr>
				</thead>
                <tbody>
                <tr class="table-active">
						<th>Sales</th>
						<td class="text-right"></td>						
					</tr>
					<tr class="table-active">
						<td>Product Sales</td>
						<td class="text-right"><?php echo $row['sTotal']?> </td>						
					</tr>					
					
                    <tr class="table-active">
						<td>Cost of Sales</td>
						<td class="text-right"><?php echo -$row['cTotal']?></td>						
					</tr>
					<tr class="table-active">
						<td>Sales Return</td>
						<td class="text-right"><?php echo -$row1['sTotal']?> </td>						
					</tr>
                    <tr class="table-active">
						<td>Gross Profit</td>
						<td class="text-right"> <?php echo $row['sTotal']-$row['cTotal']-$row1['sTotal'];?> </td>						
					</tr>
                    <tr class="table-active">
						<th>Expenses</th>
						<td class="text-right"></td>						
					</tr>
                    <tr class="table-active">
						<td>Business Expenses(Maintenance, Wages, Rent, etc.) </td>
						<td class="text-right"><?php echo -$row2['Total']?></td>						
					</tr>
                    <tr class="table-active">
						<td colspan="2"><h3 class="text-center">Income</h3> </td>
												
					</tr>
                    <tr class="table-active">
						<th>Net Income</th>
						<td class="text-right"><?php echo $row['sTotal']-$row['cTotal'] -$row2['Total']-$row1['sTotal'];?></td>						
					</tr>                   

                </tbody>
                    
			</table>
			</div>
            <div align="right" class="container p-2 pe-5">
                <button  class="admin_background btn btn-outline-dark" onclick="printSection('cash')">Print Cashflow</button>
            </div>
		</div>
	</div>
	<script src="../../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#cashflow_table').dataTable();
		})
	</script>
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default btn-success" data-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
<script>
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
	$(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_cashflow.php",  
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

</script>