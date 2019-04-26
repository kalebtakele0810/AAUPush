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
			if (isset($_POST['submit'])) {

			$request = array(
						'operation' => 'DEL',
						'payload' => array(
								'title' => $_POST['title'],
								'dueDate' => $_POST['dueDate'],
								'place' => $_POST['place'],
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
            $url='http://localhost:8080/server/ReminderServlet';
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
					  <h2 style = "margin-left:20px;">Delete Reminder Page</h2>
					<div class="panel-body">
						<form method="post" action="index.php" class="form-horizontal" role="form">
								<input class="form-control" name="title" type="text" placeholder="Title of the reminder" required>
								<input class="form-control" name="dueDate" type="date" placeholder="Date  of the reminder" required>
								<input class="form-control" name="place" type="text" placeholder="place of the reminder" required>
                                <button class="btn" type="submit">Delete Reminder</button>
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
<hr>
<div>
<p>Forum Links</p>
<a href='createforum.php'>Create</a>
<a href='destroyforum.php'>Destroy</a>
<a href='openforum.php'>Open</a>
<a href='joinforum.php'>Join</a>
<a href='searchforum.php'>Search</a>
</div>
<hr>
<div>
<p>Reminder Links</p>
<a href='setreminder.php'>Set Reminder</a>
<a href='viewreminder.php'>View Reminder</a>
<a href='deletereminder.php'>Delete Reminder</a>
</div>
<hr>
<div>
<p>Admin Links</p>
<a href='inviteinstructor.php'>Invite instructor</a>
<a href='forgotpassword.php'>Forgot Password</a>
<a href='updateaccount.php'>Update Account Info</a>
</div>
</body>
</html>