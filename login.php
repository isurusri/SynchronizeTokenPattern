<?php

    session_start();

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(($username == "admin") && ($password == "admin")){

			// set a session variable
			$_SESSION['csrf_session'] = "csrfstpsamplephp";

			// regenerate an id for session and store it in a cookie
			session_regenerate_id();
			setcookie("csrf_session_cookie", session_id(), (time() + (56400)), "/");
			
			// include service.php to generate csrf token
			include(realpath(__DIR__)."/service.php");
			generateCSRFToken(session_id());

            header("location:index.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
	<title>CSRF Synchronizer Token Pattern | Login</title>

	<?php include (realpath(__DIR__)."/addons/header.php") ?>

</head>

<body>

	<div class="container">
		<div class="row">

			<!-- Sign in block -->
			<div class="col-md-4 mx-auto order-12">
				<div class="card my-5 p-3 shadow">
					<div class="card-body">
						<h5 class="card-title text-center">Sign In</h5>

						<!-- Sign in Form -->
						<form class="mt-5 mb-3" action="login.php" method="POST">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="csrf" required autofocus/>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" value="token" required/>
							</div>
							<button type="submit" class="btn btn-primary btn-block mt-5" name="login">Login</button>
						</form>
						<!-- End Sign in Form -->

					</div>
				</div>
			</div>
			<!-- End Sign in block -->
		</div>
	</div>

	<script>
		feather.replace()
	</script>

</body>

</html>