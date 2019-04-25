<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up User</title>
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
            if (!isset($_POST['submit'])) {
                $request = array(
                'operation' => 'getMyClasses',
                );
                $json = json_encode($request);
                $options = array(
                'http' => array(
                    'method'  => 'GET',
                    'content' => $json ,
                    'header'=> "Accept: application/json\r\n"
                    )
                );
                $url='http://localhost:8080/server/ClassServlet';
                $context  = stream_context_create( $options );
                $result = file_get_contents( $url, false, $context );
                $myclasses = json_decode( $result );
            }

			if (isset($_POST['submit'])) {

			$request = array(
						'operation' => 'DEL',
						'payload' => array(
							'name' => $_POST['name'],
							'ects' => $_POST['ects'],
							'courseCode' => $_POST['courseCode'],
							'creditHour' => $_POST['creditHour'],
							'id' => $_POST['id'],
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
			$url='http://localhost:8080/server/ClassServlet';
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
					  <h2 style = "margin-left:20px;">Drop Class Page</h2>
					  <div class="panel-body">
						<form method="post" action="index.php" class="form-horizontal" role="form">
								<input class="form-control" name="name" type="text" placeholder="Name of the course" required>
								<input class="form-control" name="ects" type="text" placeholder="ECTS of the course" required>
								<input class="form-control" name="creditHour" type="text" placeholder="Credit hour of the course" required>
								<input class="form-control" name="id" type="text" placeholder="ID of the course" required>
								<input class="form-control" name="courseCode" type="text" placeholder="Course Code of the course" required>
                                <button class="btn" type="submit">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div>
<p>Links</p>
	<a href='index.php'>Index</a>
	<a href='index2.php'>Index2</a>
	<a href='sendpost.php'>Send Post</a>
	<a href='viewpost.php'>View Post</a>
	<a href='addclass.php'>Add Class</a>
	<a href='dropclass.php'>Drop Class</a>
</div>
</body>
</html>