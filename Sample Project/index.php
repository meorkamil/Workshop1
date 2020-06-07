<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/assets/ico/favicon.ico">
		<title>Checkout Page</title>
		<!-- CSS Plugins -->
		<link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.min.css">
		
		<!-- CSS Global -->
		<link href="assets/css/styles.css" rel="stylesheet">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,500' rel='stylesheet' type='text/css'>
	</head>
	<body>
		
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-header">
					Payee Checkout Page
					</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Items details</h4>
						</div>
						<div class="panel-body text-center">
							<img src="assets/img/tshirt.jpg" class="img-responsive">
							<p>
								<h3>Total: <strong>RM 60.00</strong></h3>
							</p>
							<p>
							
								<button type="button" id="payButton">
									<img style="height: 80px;" src="assets/img/Maybank2uPay_button.png" class="img-responsive">
								</button>
								
								
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="m2upay" ></div>
		<!-- JavaScript
		================================================== -->
		
		<!-- JS Global -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>

		<script src="assets/js/m2upay_frontend.js"></script>
		<script>
		
		$('#payButton').on('click', function(e) {
			//AJAX call to get encrypted Send String from merchant API
			$.get( window.location.href + "backend.php", 
				function( data,status ) {
					m2upay.initPayment(data.encryptedString,data.actionUrl,'OT');
				}, 
				"json");

			
		});
		// Close Checkout on page navigation:
		$(window).on('popstate', function() {
			handler.close();
		});
		</script>
	</body>
</html>