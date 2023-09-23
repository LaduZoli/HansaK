<?php

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

	    require_once("../include/mysqli_connect.php");
        
	    $params = $columns = $totalRecords = $data = array();

	    $params = $_REQUEST;

	    $columns = array(
	    	0 => 'cikkek.id',
	    	1 => 'cikkek.cikkszam',
	    	2 => 'cikkek.vonalkod',
	    	3 => 'cikkek.nev',
	    	4 => 'cikkek.mennyisegiegyseg',
	    	5 => 'cikkek.nettoegysegar',
	    	6 => 'cikkek.verzio',
	    	7 => 'cikkek.partnerid'
     	);

	    $where_condition = $sqlTot = $sqlRec = "";

	    if( !empty($params['search']['value']) ) {
	    	$where_condition .=	" WHERE ";
	    	$where_condition .= " ( cikkek.id LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR cikkek.cikkszam LIKE '%".$params['search']['value']."%' ";    
	    	$where_condition .= " OR cikkek.vonalkod LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR cikkek.nev LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR cikkek.mennyisegiegyseg LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR cikkek.nettoegysegar LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR cikkek.verzio LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR cikkek.partnerid LIKE '%".$params['search']['value']."%' )";
	    }

	    $sql_query = " SELECT DISTINCT cikkek.id, cikkek.cikkszam, cikkek.vonalkod, cikkek.nev,
                            cikkek.mennyisegiegyseg, cikkek.nettoegysegar, cikkek.verzio,
                            cikkek.partnerid
                        FROM cikkek
                        INNER JOIN vasarlas_tetel ON cikkek.id = vasarlas_tetel.partnerctid
                        WHERE vasarlas_tetel.partnerctid = $id";
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

    } else {
        echo "No 'id' parameter found in the URL.";
    }
?>
	