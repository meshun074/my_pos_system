<?php 
	include("../cashflow/add.php");
	include("../server/connection.php");
	include '../set.php';
	$date='';
	$curyear = date("Y");
	if(isset($_GET['date']))
	{
		$date = $_GET['date'];
	}
	else{
		$date = date("Y");
	}
	$sql = "SELECT SUM(product_quantity*c_price)  as cTotal, SUM(product_quantity*price)  as sTotal  FROM sales_product WHERE YEAR(date)= $date";
	$result	= mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
	$sql1 = "SELECT SUM(Total)  as sTotal  FROM credit_note WHERE YEAR(date)= $date";
	$result1	= mysqli_query($db, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $sql2 = "SELECT SUM(amount) as Total FROM draw_invest_flow Where purpose LIKE '%expense%' AND transaction_type = 'Cash_out' AND YEAR(transaction_date)= $date";
	$result2	= mysqli_query($db, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

	$sql3 = "SELECT SUM(balance) AS creditors  FROM credits Where YEAR(transaction_date)= $date";
	$result3	= mysqli_query($db, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
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
			<h1 class="ms-5 pt-2"><i class="fa-solid fa-receipt"></i> Income Statement for the year <span>
				<select class="fs-3" name="date" id="date">
					<?php for ( $i=0; $i <=10; $i++){?>
						<option <?php if(intval($curyear)-$i == $date){echo 'selected ';}?> onclick="window.location.href='../cashflow/balance.php?date=<?=intval($curyear)-$i?>'" value="<?=intval($curyear)-$i?>"> <?=intval($curyear)-$i?> </option>
					 <?php }?>
				</select></span> </h1>
			<hr class="mb-0 pb-0">
			<div class="table-responsive mt-0 ps-4 pe-4" id="cash">
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
						<td class="text-end"><?php echo number_format($row['sTotal'] , 2, '.','');?> </td>						
					</tr>					
					
                    <tr class="table-active">
						<td>Cost of Sales</td>
						<td class="text-end"><?php echo number_format(-$row['cTotal'], 2, '.','');?></td>						
					</tr>
					<tr class="table-active">
						<td>Sales Return</td>
						<td class="text-end"><?php echo number_format(-$row1['sTotal'], 2, '.','')?> </td>						
					</tr>
                    <tr class="table-active">
						<td>Gross Profit</td>
						<td class="text-end"> <?php echo number_format($row['sTotal']-$row['cTotal']-$row1['sTotal'], 2, '.','');?> </td>						
					</tr>
                    <tr class="table-active">
						<th>Expenses</th>
						<td class="text-end"></td>						
					</tr>
                    <tr class="table-active">
						<td>Business Expenses(Maintenance, Wages, Rent, etc.) </td>
						<td class="text-end"><?php echo number_format(-$row2['Total'], 2, '.','');?></td>						
					</tr>
					<tr class="table-active">
						<th>Creditors</th>
						<td class="text-end"><?php echo number_format(-$row3['creditors'], 2, '.','');?></td>						
					</tr>
                    <tr class="table-active">
						<td colspan="2"><h3 class="text-center">Income</h3> </td>
												
					</tr>
                    <tr class="table-active">
						<th>Net Income</th>
						<td class="text-end"><?php echo number_format($row['sTotal']-$row['cTotal'] -$row2['Total']-$row1['sTotal']-$row3['creditors'], 2, '.','');?></td>						
					</tr>                   

                </tbody>
                    
			</table>
			</div>
            <div align="right" class="container p-2 pe-5">
                <button  class="admin_background btn btn-outline-dark" onclick="printSection('cash')">Print Income Statement</button>
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