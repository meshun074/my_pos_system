<?php
	include('server/connection.php');

	if (isset($_POST['products'])){

		$name = mysqli_real_escape_string($db,$_POST['products']);
		$show 	= "SELECT * FROM products WHERE product_name LIKE '$name%' AND quantity > 0 AND deleted='FALSE' OR product_id LIKE '$name%' AND quantity > 0 AND deleted='FALSE'";
		$query 	= mysqli_query($db,$show);
		if(mysqli_num_rows($query)>0){
			while($row = mysqli_fetch_array($query)){
				echo "<div class='js-add col m-1 ' data-id=".$row['product_id']." data-barcode=".$row['barcode']." data-product=".$row['product_name']." data-price=".$row['sell_price']." data-cprice=".$row['cost_price']." data-unt=".$row['product_size']."> <div class='card' style='width: 10rem;  height: 6rem;'>";
				echo "<img src='../images/".$row['images']."' class='card-img-top js-add' data-id=".$row['product_id']." data-barcode=".$row['barcode']." data-product=".$row['product_name']." data-price=".$row['sell_price']." data-cprice=".$row['cost_price']." data-unt=".$row['product_size']." alt='".$row['product_name']."'>";
				echo "<div class='card-body p-1'>";
				echo "<h5 class='card-title text-capitalize mb-0'>".$row['product_name']."</h5>";
				echo "<p class='card-text '>Barcode - ".$row['barcode']." <br>Price - ".$row['sell_price']."<br> Size - ".$row['product_size']."<br>Stocks - ".$row['quantity']."</p>";
				echo "</div><div class='card-footer p-0'>";
				echo "<a href='#' style='background-color: #0d0d0d; color: #D9A84E;' class='btn js-add w-100' data-id=".$row['product_id']." data-barcode=".$row['barcode']." data-product=".$row['product_name']." data-price=".$row['sell_price']." data-cprice=".$row['cost_price']." data-unt=".$row['product_size'].">Add Product</a>";
				echo " </div></div></div>";
			}
		}
		else{
			echo "<div class='col'></div>No Products found!<div class='col'></div>";
		}
	}?>
