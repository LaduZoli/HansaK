<?php
	
	require_once("../include/mysqli_connect.php");
	
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	$columns = array(
		0 => 'id',
		1 => 'cikkszam', 
		2 => 'vonalkod',
		3 => 'nev',
		4 => 'mennyisegiegyseg',
		5 => 'nettoegysegar',
		6 => 'verzio',
		7 => 'partnerid'
	);

	$where_condition = $sqlTot = $sqlRec = "";

	if( !empty($params['search']['value']) ) {
		$where_condition .=	" WHERE ";
		$where_condition .= " ( id LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR cikkszam LIKE '%".$params['search']['value']."%' ";    
		$where_condition .= " OR vonalkod LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR nev LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR mennyisegiegyseg LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR nettoegysegar LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR verzio LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR partnerid LIKE '%".$params['search']['value']."%' )";
	}

	$sql_query = " SELECT * FROM cikkek ";
	$sqlTot .= $sql_query;
	$sqlRec .= $sql_query;
	
	if(isset($where_condition) && $where_condition != '') {

		$sqlTot .= $where_condition;
		$sqlRec .= $where_condition;
	}

 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($con, $sqlTot) or die("Database Error:". mysqli_error($con));

	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($con, $sqlRec) or die("Error to Get the Post details.");

	while( $row = mysqli_fetch_row($queryRecords) ) { 
		$data[] = $row;
	}	

	$json_data = array(
		"draw"            => intval( $params['draw'] ),   
		"recordsTotal"    => intval( $totalRecords ),  
		"recordsFiltered" => intval($totalRecords),
		"data"            => $data
	);

	echo json_encode($json_data);
?>
	