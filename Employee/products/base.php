<div class="header bg-dark">
	<img class="img-fluid w-100 mt-2 ml-1" src="../images/louisville.png" >
</div>
<div class="sidebar">
	<button><h3><i class="fas fa-tachometer-alt"></i> Dashboard</h3></button>
	<button id="sidebar_button" onclick="window.location.href='../products/create_product.php'"><i class="fas fa-address-card"></i> Add Product</button>
	<button id="sidebar_button" onclick="window.location.href='../products/products.php'"><i class="fas fa-list-ul"></i> Product List</button>
	<button id="sidebar_button" onclick="window.location.href='../delivery/add_delivery.php'"><i class="fas fa-truck"></i> Delivery</button>
	<button id="sidebar_button" onclick="window.location.href='../products/product_summary.php'"><i class="fas fa-address-card"></i>Product Summary</button>
	<button id="sidebar_button" data-bs-toggle="popover" title="Product Management" data-bs-content="Here you can create, update, delete and view products." data-bs-placement="bottom"><i class="fas fa-question"></i> Help</button>
	<div class="fixed-bottom">
		<button class="btn m-2 p-2" id="sidebar_button" onclick="window.location.href='../main.php'"><i class="fas fa-arrow-alt-circle-left"></i> Back</button>
	</div>
</div>