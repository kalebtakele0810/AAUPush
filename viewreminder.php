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
                'operation' => 'getReminders',
                );
                $json = json_encode($request);
                $options = array(
                'http' => array(
                    'method'  => 'GET',
                    'content' => $json ,
                    'header'=> "Accept: application/json\r\n"
                    )
                );
                $url='http://localhost:8080/server/ReminderServlet';
                $context  = stream_context_create( $options );
                $result = file_get_contents( $url, false, $context );
                $reminders = json_decode( $result );
            }
	?>	



	<div class="container">
		<div class="row">
			<div class="col-md-6" style = "margin-top:0px;">
                <div class="panel panel-default">
					  <h2 style = "margin-left:20px;">View Reminder</h2>
					<div class="panel-body">
                             <?php
                                    if (!empty($reminders)) {
                                        foreach ($reminders as $reminder ) {
                                            echo '<p>' . $reminder['title'] . '</p>';
                                            echo '<p>' . $reminder['duedate'] . '</p>';
                                            echo '<p>' . $reminder['place'] . '</p>';
                                        }
                                    }
                                ?>
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