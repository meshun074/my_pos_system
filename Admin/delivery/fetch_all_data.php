<?php 

	include("../server/connection.php");

	$column = array('transaction_no','username','company_name','Totalvalue','date');

	$query = "SELECT delivery.transaction_no, delivery.username, supplier.company_name, delivery.Total, delivery.date FROM delivery JOIN supplier ON delivery.supplier_id = supplier.supplier_id";

	if($_POST['is_date_search'] == "yes"){
		$query .= ' WHERE delivery.date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'"'; 
	}

	if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
		$query .= '
			WHERE delivery.transaction_no LIKE "%' .$_POST["search"]["value"].'%"
			OR delivery.username LIKE "%' .$_POST["search"]["value"].'%"
			OR supplier.company_name LIKE "%' .$_POST["search"]["value"].'%"
			OR delivery.date LIKE "%' .$_POST["search"]["value"]. '%"			
		';
	}else{
		$query .= '';
	}

	$query .= " GROUP BY transaction_no ";

	if(isset($_POST['order'])){
		$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}else{
		$query .= 'ORDER BY transaction_no DESC ';
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
		$sub_array[] = '<a href="../delivery/delivery_details.php?transaction_no='.$row["transaction_no"].'">'.$row["transaction_no"].'</a>';
		$sub_array[] = $row["username"];			
		$sub_array[] = $row["company_name"];	
		$sub_array[] = number_format($row['Total']);			
		$sub_array[] = date('d M Y, g:i A', strtotime($row["date"]));	
		$data[] = $sub_array;
		}

	function get_all_data($db){
		$query = "SELECT delivery.transaction_no,delivery.username,supplier.company_name,delivery.Total,delivery.date FROM delivery JOIN supplier ON delivery.supplier_id = supplier.supplier_id GROUP BY delivery.transaction_no";
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