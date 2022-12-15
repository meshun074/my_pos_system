<?php

	include("../server/connection.php");
	$msg 		= '';
  	if(isset($_POST['update'])){
	  	$id       	= $_POST['id'];
	  	$make_payment	= mysqli_real_escape_string($db, $_POST['make_payment']);
        $balance  	= mysqli_real_escape_string($db, $_POST['balance']);
        $paid  	= mysqli_real_escape_string($db, $_POST['paid']);
        $username	= $_SESSION['username'];
        $sql = "SELECT* FROM credits WHERE receipt_no = '$id'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $row1 = mysqli_fetch_array($result);
            $newbalance = $balance - $make_payment;
            $newpaid = $paid + $make_payment;
        }        

        $sql1  = "UPDATE credits SET balance='$newbalance', paid='$newpaid' WHERE receipt_no = '$id'";
        $result1 = mysqli_query($db, $sql1);
        if($result1 == true){
            $query 	= "INSERT INTO logs (username,purpose) VALUES('$username','Updated Owings to $owes')";
            mysqli_query($db,$query);
            echo $sql1;
            header('location: ../employee/creditors.php?updated');
        }
 	}