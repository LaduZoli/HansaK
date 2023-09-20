<?php
	
	require_once("../include/mysqli_connect.php");
	
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	$columns = array(
		0 => 'vasarlas.id',
		1 => 'vasarlas.esemenydatumido', 
		2 => 'vasarlas.vasarlasosszeg',
		3 => 'vasarlas.penztargepazonosito',
		4 => 'vasarlas.partnerid',
		5 => 'bolt.nev'
	);

	$where_condition = $sqlTot = $sqlRec = "";

	if( !empty($params['search']['value']) ) {
		$where_condition .=	" WHERE ";
		$where_condition .= " ( vasarlas.id LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR vasarlas.esemenydatumido LIKE '%".$params['search']['value']."%' ";    
		$where_condition .= " OR vasarlas.vasarlasosszeg LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR vasarlas.penztargepazonosito LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR vasarlas.partnerid LIKE '%".$params['search']['value']."%' ";
		$where_condition .= " OR bolt.nev LIKE '%".$params['search']['value']."%' )";
	}

	$sql_query = "SELECT vasarlas.id, vasarlas.esemenydatumido, vasarlas.vasarlasosszeg, 
                         vasarlas.penztargepazonosito, vasarlas.partnerid, bolt.nev
                  FROM vasarlas 
                  INNER JOIN bolt ON vasarlas.boltid=bolt.id";
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
	