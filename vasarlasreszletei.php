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
					<h3 class="post-title">3. Vásárlás tételei</h3>
				</div>
				
				<div class="page-body clearfix">
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<form id="saveModel" class="new-elem" action="action/vasarlas_tetele_insert.php" method="post">
							<filedset>
							<legend>Új vásárlási tétel felvétele:</legend>
    						<p>
    						   	<label for="partnercid">PartnerctID:</label><br>
    						   	<select class="select-input" id="partnerctid" name="partnerctid">
									<?php 
										include('./include/mysqli_connect.php');
										$partnerctids = mysqli_query($con, "SELECT nev, id
																			FROM cikkek
																			ORDER BY nev ASC");
										while($c = mysqli_fetch_array($partnerctids)) { 
									?>
									<option value="<?= $c['id']?>"><?= $c['nev']?></option>
							  		<?php } ?>
  								</select>
    						</p>
							<p>
    						    <label for="boltNeve">Mennyiség:</label><br>
    						    <input type="number" name="mennyiseg" id="mennyiseg" pattern="^[1-9]\d*$" min="1" title="Csak pozitív egész számok engedélyezettek!" required><br>
    						</p>
    						<input type="submit" value="Felvétel">
							</filedset>
							</form>
							<div class="panel panel-default">
								<div class="panel-heading">Vásárlás tételének részletei lista:</div>
								<div class="panel-body">
									
									<table id="post_list" class="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>TételID</th>
												<th>PartnerctID</th>
												<th>Mennyiég</th>
												<th>Bruttó ára</th>
												<th>PartnerID</th>
												<th>Részletek</th>
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
		
		$('#post_list').DataTable({
			"processing": true,
         	"serverSide": true,
         	"ajax":{
	            url :`list/vasarlas_reszletei_list.php?id=${id}`,
	            type: "POST",
	            error: function(){
	              $("#post_list_processing").css("display","none");
	            }
          	},
			dom: 'lBfrtip',
    		buttons: [
				{
                	extend: 'copy',
                	exportOptions: {
                    	columns: [0, 1, 2, 3, 4, 5] 
                	}
            	},
            	{
            	    extend: 'csv',
            	    exportOptions: {
            	        columns: [0, 1, 2, 3, 4, 5]
            	    }
            	},
            	{
            	    extend: 'excel',
            	    exportOptions: {
            	        columns: [0, 1, 2, 3, 4, 5]
            	    }
            	},
            	{
            	    extend: 'pdf',
            	    exportOptions: {
            	        columns: [0, 1, 2, 3, 4, 5]
            	    }
            	}
   			],
			"lengthMenu": [ [10, 25, 50, 36000], [10, 25, 50, "All"] ],
			columnDefs: [
				{
				targets: -1, // -1 targets the last column
                data: null, // Use data from the row's data source
                render: function (data, type, row) {
                    // Create a button with an onClick function
                    return '<button class="details-button" onclick="handleButtonClick(' + data[1] + ')">Cikkek megtekintése</button>';
                	}
				}
			]
        });
	});
	</script>
	<script>
		$(document).on('submit', '#saveModel', function(event){
			event.preventDefault(); 
			var urlParams = new URLSearchParams(window.location.search);
			var vasarlasid = urlParams.get('id');
			var partnerctid = $('#partnerctid').val();
			var mennyiseg = $('#mennyiseg').val();

			if(vasarlasid !=='' && partnerctid !== '' && mennyiseg !== '')
			{
				$.ajax({
					url:"action/vasarlasreszletei_insert.php",
					method: 'POST',
					data: {
						partnerctid: partnerctid,
						vasarlasid: vasarlasid,
						mennyiseg: mennyiseg
					},
					success:function(data)
					{
						console.log("Response data:", data);
						var json = JSON.parse(data);
						var status = json.status;
						if(status=="true")
						{
							$('#post_list').DataTable().ajax.reload();
                            alert('Sikeres, új tétel a vásárláshoz!');
						}
						else {
							alert('Hiba történt az adatok beszúrása közben.');
						}
					}
				});
			} 
			else 
			{
				alert("Kérlek töltsd ki a mezőt!")
			}
		})
	</script>
	<script>
		function handleButtonClick(id) {
			window.location.href = 'tetelekcikkei.php?id=' + id;
    }
	</script>
</body>
</html>