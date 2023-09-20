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
				<form id="saveModel" class="new-elem" method="post">
					<filedset>
					<legend>Új bolt felvétele:</legend>
    				<p>
    				    <label for="boltNeve">Bolt Neve:</label><br>
    				    <input type="text" name="nev" id="nev"><br>
    				</p>
    				<p>
    				    <label for="partnerid">PartnerID:</label><br>
    				    <select class="select-input" id="partnerid" name="partnerid">
							<?php 
								include('./include/mysqli_connect.php');
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
				<div class="page-heading">
					<h3 class="post-title">Boltok listája</h3>
				</div>
				</div>
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
	            url :"list/bolt_list.php",
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
			var nev = $('#nev').val();
			var partnerid = $('#partnerid').val();

			if(nev != '' && partnerid != '')
			{
				$.ajax({
					url:"action/bolt_insert.php",
					method: 'post',
					data: {
						nev: nev,
						partnerid: partnerid
					},
					success:function(data)
					{
						var json = JSON.parse(data);
						var status = json.status;
						if(status=="true")
						{
							table = $('#post_list').dataTable();
							table.draw();
							alert('successfully Bolt added');
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
