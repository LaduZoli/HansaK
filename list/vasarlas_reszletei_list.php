<?php

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

	    require_once("../include/mysqli_connect.php");
        
	    $params = $columns = $totalRecords = $data = array();

	    $params = $_REQUEST;

	    $columns = array(
	    	0 => 'vasarlas_tetel.id',
	    	1 => 'vasarlas_tetel.partnerctid', 
	    	2 => 'vasarlas_tetel.mennyiseg',
	    	3 => 'vasarlas_tetel.brutto',
	    	4 => 'vasarlas_tetel.partnerid'
	    );

	    $where_condition = $sqlTot = $sqlRec = "";

	    if( !empty($params['search']['value']) ) {
	    	$where_condition .=	" WHERE ";
	    	$where_condition .= " ( vasarlas_tetel.id LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR vasarlas_tetel.partnerctid LIKE '%".$params['search']['value']."%' ";    
	    	$where_condition .= " OR vasarlas_tetel.mennyiseg LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR vasarlas_tetel.brutto LIKE '%".$params['search']['value']."%' ";
	    	$where_condition .= " OR vasarlas_tetel.partnerid LIKE '%".$params['search']['value']."%' )";
	    }

	    $sql_query = " SELECT vasarlas_tetel.id, vasarlas_tetel.partnerctid, 
                            vasarlas_tetel.mennyiseg, vasarlas_tetel.brutto, vasarlas_tetel.partnerid
                        FROM vasarlas_tetel 
                        INNER JOIN vasarlas ON vasarlas_tetel.vasarlasid = vasarlas.id
                        WHERE vasarlas.id = $id";
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
	