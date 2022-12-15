<div class="header bg-dark">
	<img class="img-fluid w-100 mt-2 ml-1" src="../images/logo.png" >
</div>
<div class="sidebar">
	<button><h3><i class="fas fa-tachometer-alt"></i> Dashboard</h3></button>
	<button id="sidebar_button" onclick="window.location.href='../employee/cashflow.php'" ><i class="fas fa-money-bill-alt"></i> Sales</button>
	<button id="sidebar_button" onclick="window.location.href='../employee/creditors.php'" ><i class="fas fa-money-bill-alt"></i> creditors</button>
	<button id="sidebar_button" type="button" data-toggle="popover" title="Cash Management" data-content="Here you can view cash of the store." data-placement="bottom"><i class="fas fa-question"></i> Help</button>
	<div class="fixed-bottom">
		<button class="btn m-2 p-2" id="sidebar_button" onclick="window.location.href='../employee/creditors.php'"><i class="fas fa-arrow-alt-circle-left"></i> Back</button>
	</div>
</div>