<?php 
include('../Employee/server/connection.php');

if(isset($_POST["load_receipt"])){  
    $output = '';

    $query3 = "SELECT sales_no,	receipt_no,	customer_id, username, sales_office, discount, status, total,DATE(date) AS date, TIME(date) AS time FROM sales ORDER BY sales_no DESC LIMIT 1";
    $result3 = mysqli_query($db, $query3);
    $myrow = mysqli_fetch_assoc($result3);
    $id = $myrow['receipt_no'];  
    $query = "SELECT * FROM products,sales_product,customer WHERE sales_product.receipt_no = '$id' AND products.product_id = sales_product.product_id AND sales_product.customer_id = customer.customer_id";  
    $result = mysqli_query($db, $query);
    $query1 = "SELECT * FROM products,sales_product,customer WHERE sales_product.receipt_no = '$id' AND products.product_id = sales_product.product_id AND sales_product.customer_id = customer.customer_id";  
    $result1 = mysqli_query($db, $query1);
    $first_row = mysqli_fetch_assoc($result1);
    if ($first_row){
        echo '<h6 class=" text-center font-weight-bold" >Sunstar Gold Buying & Refinery</h6>
          <h6 class=" text-center font-weight-bold" >Hardware Store</h6>
          <h6 class="text-center" >No: 0243062545 / 0559433723</h6>
          <h6 class="text-center" >Loc: Achimfo, Abokyia, Sewum</h6><hr>';
    }
    
    echo '<table class="table table-borderless table-sm">
    <thead>
      <tr >
      <td scope="col" >Reciept no.</td>
      <th scope="col" >'.$myrow["sales_no"].'</th>      
      </tr>
      <tr>
      <td  scope="col">Date</td>
      <th  colspan="2" scope="col">'.$myrow["date"].'</th>
      </tr>
      <tr>
      <td scope="col">User</td>
      <td scope="col">'.$myrow["username"].'</td>
      </tr>
      <tr>
      <td scope="col">Time</td>
      <th scope="col">'.$myrow["time"].'</th>
      </tr>
    </thead>
    <tbody>
      <tr >
      <td colspan="1" scope="row">Customer:</td>
      <td colspan="3">'.$first_row["firstname"]." ".$first_row["lastname"].'</td>				
      </tr>
      <tr>
      <td colspan="1" scope="row">Address</td>
      <td colspan="3">'.$first_row["address"].'</td>				
      </tr>
      <tr>
      <th scope="col">Description</th>
      <th scope="col">Price₵</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total₵</th>
      </tr>
    </tbody>
    </table>';
    // .$first_row["firstname"]." ".$first_row["lastname"].
    while($row = mysqli_fetch_array($result)){

			$output .= '  
	  			<div class="table-responsive">  
          <table class="table table-borderless table-sm">
          <tbody>';
		   	$output .= '
			   <tr>
					<td scope="col"><strong>'.$row["product_name"].'</strong></td>  
					<td scope="col"><strong>'.$row["price"].'</strong></td> 
					<td scope="col"><strong>'.$row["product_quantity"].'</strong></td> 
					<td scope="col"><strong>'.($row["product_quantity"]*$row["price"]).'</strong></td>  
				</tr>';  
	  }  
	  $output .= '
    </tbody>  
		   </table>  
	  		</div>  
	  ';
    
    echo $output;

    if(isset($_POST["owes"]))
    {
      if($_POST["owes"]== 0){
    echo '<hr>
    <div class="table-responsive">  
          <table class="table table-borderless table-sm">
          <tbody>
          <tr>
          <th scope="col">Total</th>
          <td scope="col">'.$myrow["total"].'</td>
          </tr>
          <tr>
          <td scope="col">Status</td>
          <th scope="col">'.$myrow["status"].'</th>
          </tr>
    </tbody>  
		   </table>  
	  		</div>
        <p class="text-center" >Thank you <br>Visit Again</p>';
 }else{
  echo '<hr>
    <div class="table-responsive">  
          <table class="table table-borderless table-sm">
          <tbody>
          <tr>
          <th scope="col">Total</th>
          <td scope="col">'.$myrow["total"].'</td>
          </tr>
          <tr>
          <td scope="col">Status</td>
          <th scope="col">'.$myrow["status"].'</th>
          </tr>
          <tr>
          <td scope="col">Paid</td>
          <th scope="col">'.$_POST["paid"].'</th>
          </tr>
          <tr>
          <td scope="col">Owes</td>
          <th scope="col">'.$_POST["owes"].'</th>
          </tr>
    </tbody>  
		   </table>  
	  		</div>
        <p class="text-center" >Thank you <br>Visit Again</p>';
}  
}
}
?>
