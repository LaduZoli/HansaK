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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
	
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
		<?php require_once('./include/header.php'); ?>
		<!-- #END# Top Bar -->
	
		<section class="container">
			<div class="form-group custom-input-space has-feedback">
				<div class="page-heading">
					<h3 class="post-title">2. Szerveroldali alkalmazás</h3>
				</div>
				<div class="page-body clearfix">
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<form id="saveModel" class="new-elem" action="action/vasarlas_insert.php" method="post">
							<filedset>
							<legend>Új vásárlás felvétele:</legend>
    						<p>
    						    <label for="boltNeve">Dátum:</label><br>
    						    <input type="text" name="datum" id="datum"><br>
    						</p>
							<p>
    						    <label for="boltNeve">Összeg:</label><br>
    						    <input type="text" name="osszeg" id="osszeg"><br>
    						</p>
							<p>
    						    <label for="boltNeve">Pénztárgépazonosító:</label><br>
    						    <input type="text" name="penztargepazonosito" id="penztargepazonosito"><br>
    						</p>
    						<p>
    						    <label for="partnerId">PartnerID:</label><br>
    						    <select class="select-input" id="partnerid" name="partnerid">
									<?php 
										include('./include/mysqli_connect.php');
										$partnerids = mysqli_query($con, "SELECT DISTINCT partnerid FROM vasarlas");
										while($c = mysqli_fetch_array($partnerids)) { 
									?>
									<option value="<?= $c['id']?>"><?= $c['partnerid']?></option>
								  	<?php } ?>
  								</select>
    						</p>
							<p>
    						    <label for="partnerId">BoltID:</label><br>
    						    <select class="select-input" id="boltid" name="boltid">
									<?php 
										include('./include/mysqli_connect.php');
										$boltids = mysqli_query($con, "SELECT DISTINCT boltid FROM vasarlas");
										while($c = mysqli_fetch_array($boltids)) { 
									?>
									<option value="<?= $c['id']?>"><?= $c['boltid']?></option>
								  	<?php } ?>
  								</select>
    						</p>
    						<input type="submit" value="Felvétel">
							</filedset>
							</form>
							<div class="panel panel-default">
								<div class="panel-heading">Vásárlások listája:</div>
								<div class="panel-body">
									
									<table id="post_list" class="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>ID</th>
												<th>Dátum</th>
												<th>Összeg</th>
												<th>Pénztárgép azonosítója</th>
												<th>PartnerID</th>
												<th>BoltID</th>
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
	
	<!-- Jquery Core Js -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Select Js -->
    <script src="js/bootstrap-select.js"></script>
	
	<!-- DataTables -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
	<script>
	
	$(document).ready(function(e){
		$('#post_list').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"ajax":{
	            url :"list/vasarlas_list.php",
	            type: "POST",
	            error: function(){
	              $("#post_list_processing").css("display","none");
	            }
          	}
        });
	});
    </script>

	<script>
		$(document).on('submit', '#saveModel', function(event){
			event.preventDefault();
			var esemenydatumido = $('#esemenydatumido').val();
			var vasarlasooszeg = $('#vasarlasooszeg').val();
			var penztargepazonosito = $('#penztargepazonosito').val();
			var partnerid = $('#partnerid').val();
			var boltid = $('#boltid').val();

			if(esemenydatumido != '' && vasarlasooszeg!= '' && penztargepazonosito != ''&& 
				partnerid != '' && boltid != '')
			{
				$.ajax({
					url:"action/vasarlas_insert.php",
					method: 'post',
					data: {
						esemenydatumido: esemenydatumido,
						vasarlasooszeg: vasarlasooszeg,
						nev: nev,
						penztargepazonosito: penztargepazonosito,
						partnerid: partnerid,
						boltid: boltid,
					},
					success:function(data)
					{
						var json = JSON.parse(data);
						var status = json.status;
						if(status=="true")
						{
							table = $('#post_list').dataTable();
							table.draw();
							alert('successfully Cikk added');
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
