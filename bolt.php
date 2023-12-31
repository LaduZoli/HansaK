<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>2. Szerveroldali alkalmazás</title>
    
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
	</style>
</head>
<body>
    <div class="all-content-wrapper">
		<!-- Top Bar -->
		<?php require_once('include/header.php'); ?>
		<!-- #END# Top Bar -->
	
		<section class="container">
			<div class="form-group custom-input-space has-feedback">
				<form id="saveModel" class="new-elem" method="post">
					<filedset>
					<legend>Új bolt felvétele:</legend>
    				<p>
    				    <label for="boltNeve">Bolt Neve:</label><br>
    				    <input type="text" name="nev" id="nev" pattern="[0-9a-zA-Z ]*+" title="Csak számok és karakterek engedélyezettek" required><br>
    				</p>
    				<p>
    				    <label for="partnerid">PartnerID:</label><br>
    				    <select class="select-input" id="partnerid" name="partnerid">
							<?php 
								include('include/mysqli_connect.php');
								$partnerids = mysqli_query($con, "SELECT DISTINCT partnerid FROM bolt");
								while($c = mysqli_fetch_array($partnerids)) { 
							?>
							<option value="<?= $c['partnerid']?>"><?= $c['partnerid']?></option>
						  	<?php } ?>
  						</select>
    				</p>
    					<button type="submit" name="insert" class="btn btn-primary">Felvétel</button>
					</filedset>
				</form>
				<div class="page-body clearfix">
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">Boltok listája:</div>
								<div class="panel-body">
									
									<table id="post_list" class="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>ID</th>
												<th>Név</th>
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
	$(document).ready(function(e){
		var table = $('#post_list').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"ajax":{
	            url :"list/bolt_list.php",
	            type: "POST",
	            error: function(){
	              $("#post_list_processing").css("display","none");	
	            }
          	},
			dom: 'lBfrtip',
    		buttons: [
        		'copy', 'csv', 'excel', 'pdf'
   			],
			"lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, "All"] ]
        });
	});
    </script>

	<script>
		$(document).on('submit', '#saveModel', function(event){
			event.preventDefault();
			var nev = $('#nev').val();
			var partnerid = $('#partnerid').val();
			
			if (nev !== '' && partnerid !== '')
			{
				$.ajax({
					url:"action/bolt_insert.php",
					method: 'POST',
					data: {
						nev: nev,
						partnerid: partnerid,
					},
					success:function(data)
					{
						console.log("Response data:", data);
						var json = JSON.parse(data);
						var status = json.status;
						if(status=="true")
						{
							$('#post_list').DataTable().ajax.reload();
                            alert('Sikeres új bolt felvétele!');
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
</body>
</html>
