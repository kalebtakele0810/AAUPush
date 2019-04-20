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
			'operation' => 'getPosts',
			);
			$json = json_encode($request);
			$options = array(
			'http' => array(
				'method'  => 'GET',
				'content' => $json ,
				'header'=> "Accept: application/json\r\n"
				)
			);
			$url='http://localhost:8080/server/UserServlet';
			$context  = stream_context_create( $options );
			$result = file_get_contents( $url, false, $context );
			$posts = json_decode( $result );
		}
            if (!isset($_POST['submit'])) {
                $request = array(
                'operation' => 'getYears',
                );
                $json = json_encode($request);
                $options = array(
                'http' => array(
                    'method'  => 'GET',
                    'content' => $json ,
                    'header'=> "Accept: application/json\r\n"
                    )
                );
                $url='http://localhost:8080/server/PostServlet';
                $context  = stream_context_create( $options );
                $result = file_get_contents( $url, false, $context );
                $years = json_decode( $result );
            }

			if (isset($_POST['submit'])) {

			$request = array(
						'operation' => 'ADD',
						'payload' => array(
								'postcontent' => $_POST['first_name'],
								'file1' => $_POST['file1'],
								'file2' => $_POST['file2'],
								'file3' => $_POST['file3'],
								'image1' => $_POST['image1'],
								'image2' => $_POST['image2'],
								'section' => $_POST['section']
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
			$url='http://localhost:8080/server/PostServlet';
			$context  = stream_context_create( $options );
			$result = file_get_contents( $url, false, $context );
			$response = json_decode( $result );
			echo $response->status;
			}	
			if (isset($_POST['edit'])) {

				$request = array(
							'operation' => 'ADD',
							'payload' => array(
									'postcontent' => $_POST['first_name'],
									'file1' => $_POST['file1'],
									'file2' => $_POST['file2'],
									'file3' => $_POST['file3'],
									'image1' => $_POST['image1'],
									'image2' => $_POST['image2'],
									'section' => $_POST['section']
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
				$url='http://localhost:8080/server/PostServlet';
				$context  = stream_context_create( $options );
				$result = file_get_contents( $url, false, $context );
				$response = json_decode( $result );
				echo $response->status;
				}	
			if (isset($_POST['delete'])) {

				$request = array(
							'operation' => 'ADD',
							'payload' => array(
									'post_id' => $_POST['post_id'],
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
					  <h2 style = "margin-left:20px;">Post Page</h2>
					<div class="panel-body">
						<form method="post" action="index.php" class="form-horizontal" role="form">
                                <input class="form-control" name="postcontent" type="text" placeholder="Write your post" required>
                                Attach Files
                                <input class="form-control" name="file1" type="file" >
                                <input class="form-control" name="file2" type="file" >
                                <input class="form-control" name="file3" type="file" >
                                Attache Images
                                <input class="form-control" name="image1" type="file">
                                <input class="form-control" name="image2" type="file">
                                <select name="section" class="form-control my-3 push-corners" required>
                                <option value="" disabled selected>Pick section to send</option>
                                    <?php
                                        if (!empty($years)) {
                                            foreach ($years as $year ) {
                                                echo '<option value="' . $year['id'] . '">' . $year['name'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <button class="btn" type="submit">Send</button>
						</form>
					</div>
				</div>
				<div class="panel panel-default">
					  <h2 style = "margin-left:20px;">Track Post</h2>
					<div class="panel-body">
                             <?php
                                    if (!empty($posts)) {
                                        foreach ($posts as $post ) {
                                            echo '<p>' . $post['content'] . '</p>';
											echo '<p> seen by: ' . $post['count'] . '</p>';
											echo '<form action="sendpost.php">';
											echo '<button class="btn" type="submit" name="edit">Edit post</button>';
											echo '<input name="post_id" value="'.$post['id'].'" hidden>';
											echo '<button class="btn" type="submit" name="delete">Delete post </button>';
											echo '</form>';
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
	<a href='index.php'>Index</a>
	<a href='index2.php'>Index2</a>
	<a href='post.php'>Post</a>
</div>
</body>
</html>