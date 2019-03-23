<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add User</title>
	<!-- Bootstrap -->
    <link href="bootstrap.min.css" rel="stylesheet">
	<style>
	body {
	margin-top: 50px;
	margin-bottom: 50px;
	.panel-default {
	opacity: .9;
	margin-top:30px;
	}
	.dropdown:hover .dropdown-menu {
	display: block;
	}
		</style>
  </head>
<body>
	<div class="container-fluid">
		<?php
			if (isset($_POST['submit'])) {

$request = array(
     'operation' => 'ADD',
     'payload' => array(
	 'Firstname' => $_POST['Firstname'],
	 'Lastname' => $_POST['Lastname'],
	 'Email' => $_POST['Email'],
	 'Password' => $_POST['Password'],
	 'Id' => $_POST['Id']
	 )
);
$json = json_encode($request);
$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => $json ,
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);
$url='http://localhost:8080/server/UserServlet';
$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );
echo $response->status;
			}
			
			
	?>	
	<div class="container">
		<div class="row">
			<div class="col-md-6" style = "margin-top:0px;">
				<div class="panel panel-default">
				   <div class="page-header">
					  <h2 style = "margin-left:50px;">Add User </small></h2>
					</div>
					<div class="panel-body">
						<form method="post" action="index.php" class="form-horizontal" role="form">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-1 control-label"></label>
								<div class="col-sm-10">
									<input type="number" id="Id" name="Id" value="Id"  required  autofocus>   Id</>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-1 control-label"></label>
								<div class="col-sm-10">
									<input type="text" id="Firstname" name="Firstname" required autofocus>   First name</>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-1 control-label"></label>
								<div class="col-sm-10">
									<input type="text" id="Lastname" name="Lastname" required   autofocus>   Last name</>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-1 control-label"></label>
								<div class="col-sm-10">
									<input type="text" id="Email" name="Email" required  autofocus>   Email</>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-1 control-label"></label>
								<div class="col-sm-10">
									<input type="text" id="Password" name="Password" required  autofocus>   Password</>
								</div>
							</div>
							<div class="form-group last">
								<div class="col-sm-offset-1 col-sm-9">
									<button type="submit" id="submit" name="submit" class="btn btn-success">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>