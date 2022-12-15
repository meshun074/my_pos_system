<?php 

	include("../server/connection.php");
	
	$column = array('sales_return_no','username','customer_name','Total','date');

	$query = "SELECT credit_note.sales_return_no, credit_note.username, concat(customer.firstname,' ' ,customer.lastname) AS customer_name, credit_note.Total, credit_note.date FROM credit_note JOIN customer ON credit_note.customer_id = customer.customer_id";

	if($_POST['is_date_search'] == "yes"){
		$query .= ' WHERE credit_note.date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'"'; 
	}

	if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
		$query .= '
			WHERE credit_note.sales_return_no LIKE "%' .$_POST["search"]["value"].'%"
			OR credit_note.username LIKE "%' .$_POST["search"]["value"].'%"
			OR customer.firstname LIKE "%' .$_POST["search"]["value"].'%"
			OR customer.lastname LIKE "%' .$_POST["search"]["value"].'%"
			OR credit_note.date LIKE "%' .$_POST["search"]["value"]. '%"			
		';
	}else{
		$query .= '';
	}

	$query .= " GROUP BY sales_return_no ";

	if(isset($_POST['order'])){
		$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}else{
		$query .= 'ORDER BY sales_return_no DESC ';
	}

	$query1 = '';

	$_POST["length"] = 4;

	if($_POST['length'] != -1){
		$query1 = 'LIMIT ' .$_POST["start"].','.$_POST["length"];
	}



	$data = array();

	$result = mysqli_query($db, $query . $query1);

	$number_filter_row = mysqli_num_rows(mysqli_query($db, $query));


	while($row = mysqli_fetch_array($result)){
		$sub_array = array();
		$sub_array[] = '<a href="../employee/sales_return_details.php?transaction_no='.$row["sales_return_no"].'">'.$row["sales_return_no"].'</a>';
		$sub_array[] = $row["username"];			
		$sub_array[] = $row["customer_name"];	
		$sub_array[] = number_format($row['Total'],2);			
		$sub_array[] = date('d M Y, g:i A', strtotime($row["date"]));	
		$data[] = $sub_array;
		}

	function get_all_data($db){
		$query = "SELECT credit_note.sales_return_no, credit_note.username, concat(customer.firstname,' ' ,customer.lastname) AS customer_name, credit_note.Total, credit_note.date FROM credit_note JOIN customer ON credit_note.customer_id = customer.customer_id GROUP BY credit_note.sales_return_no";
		$result = mysqli_query($db, $query);
		return mysqli_num_rows($result);
	}

	$output = array(
		"draw" 		=> intval($_POST["draw"]),
		"recordsTotal" 	=> get_all_data($db),
		"recordsFiltered" => $number_filter_row,
		"data" 		=> $data
	);
	print json_encode($output);