<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>3. Kész felület</title>
    
    <!-- Bootstrap Core Css -->
    <link href="css/bootstrap.css" rel="stylesheet" />

    <!-- Font Awesome Css -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

	<!-- Bootstrap Select Css -->
    <link href="css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/app_style.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- DataTables CSS -->	
	<link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/datatables.min.css" rel="stylesheet">

	<style>
	.cust-table {
	    margin: 35px 0px;
	}
	.cust-table th {
	    padding: 10px;
	}
	table.dataTable tr.odd {
		background-color: #ace0e0;
	}
	table.dataTable tr.even td.sorting_1 {
		background-color: #ffffff;
	}
	table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
		background-color: #ace0e0;
	}
	.details-button {
    	background-color: #3498db;
    	color: #fff;
    	border: none;
    	padding: 5px 10px;
    	cursor: pointer;
    	/* Add any other styles you desire */
}

	.details-button:hover {
    	background-color: #2980b9;
    	/* Define hover styles as needed */
}
	
	</style>
</head>
<body>
    <div class="all-content-wrapper">
		<!-- Top Bar -->
		<?php require_once('./include/header.php'); ?>
		<!-- #END# Top Bar -->
		
	
		<section class="container">
			<div class="form-group custom-input-space has-feedback">
				<div class="page-heading">
					<h3 class="post-title">3. Tételek cikkei</h3>
				</div>
				
				<div class="page-body clearfix">
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">Tétel cikke:</div>
								<div class="panel-body">
									
									<table id="vasarlas_reszletei_list" class="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>CikkID</th>
												<th>Cikkszám</th>
												<th>Vonalkód</th>
												<th>Név</th>
												<th>Mennyiség egysége</th>
												<th>Nettó egységár</th>
												<th>Verzió</th>
												<th>PartnerID</th>
											</tr>
										</thead>
								 
									</table>
									
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
    </div>
	
	
	
	<!-- DataTables -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
	
	<script> 
	$(document).ready(function(){
		const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
		
		$('#vasarlas_reszletei_list').DataTable({
			"processing": true,
         	"serverSide": true,
         	"ajax":{
	            url :`list/tetelcikkei_list.php?id=${id}`,
	            type: "POST",
	            error: function(){
	              $("#post_list_processing").css("display","none");
	            }
          	},
			dom: 'lBfrtip',
    		buttons: [
        		'copy', 'csv', 'excel', 'pdf'
   			],
			"lengthMenu": [ [10, 25, 50, 36000], [10, 25, 50, "All"] ]
        });
	});
	</script>
</body>
</html>