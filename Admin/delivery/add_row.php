<?php
include('../server/connection.php');
if(isset($_POST["add_row"]))
{
    $sql  = "SELECT `product_id`,`product_name`,`product_size`,`unit_per_price` FROM `products`";
    $result = mysqli_query($db, $sql);
    if(!$result->num_rows >0){
        echo 'No suppliers';
    }
    $suppliers = array();
    while($row = $result->fetch_assoc())
    {
        $suppliers[$row['product_id']] = $row["product_name"]. " - ". $row["product_size"]. " - ".$row["unit_per_price"]. " per price ";
    }
    
    // $myObj->name = "John";
    // $myObj->age = 30;
    // $myObj->city = "New York";

    $myJSON = json_encode($suppliers);

    echo $myJSON;
}	

?>