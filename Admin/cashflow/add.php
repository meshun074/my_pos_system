<?php 
	include('../server/connection.php');
	$alert  = array();
	if(isset($_POST['add_cashflow'])){
		$user 		= $_SESSION['username'];
		$purpose 	= mysqli_real_escape_string($db, $_POST['purpose']);
		$amount 	= mysqli_real_escape_string($db, $_POST['amount']);
		$t_type 	= mysqli_real_escape_string($db, $_POST['t_type']);
		
		$sql  = "INSERT INTO draw_invest_flow (username,transaction_type,purpose,amount) VALUES ('$user','$t_type','$purpose','$amount')";
	  	$result = mysqli_query($db, $sql);
 		if($result == true){
 			$query 	= "INSERT INTO logs (username,purpose) VALUES('$user','$t_type.' '.$purpose')";
 			$insert = mysqli_query($db,$query);
 			header('location: ../cashflow/draw_invest.php?added');
	  	}else{
			array_push($alert,"Something went wrong!");
	  	}
	}
