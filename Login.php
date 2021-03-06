<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- Style -->
	<style>
		body {
			font-family: "Roboto", sans-serif;
			background-color: #fff;
		}

		p {
			color: #b3b3b3;
			font-weight: 300;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.h1,
		.h2,
		.h3,
		.h4,
		.h5,
		.h6 {
			font-family: "Roboto", sans-serif;
		}

		a {
			-webkit-transition: .3s all ease;
			-o-transition: .3s all ease;
			transition: .3s all ease;
		}

		a:hover {
			text-decoration: none !important;
		}

		.content {
			padding: 7rem 0;
		}

		h2 {
			font-size: 20px;
		}

		.half,
		.half .container>.row {
			height: 100vh;
			min-height: 700px;
		}

		@media (max-width: 991.98px) {
			.half .bg {
				height: 200px;
			}
		}

		.half .contents {
			background: #f6f7fc;
		}

		.half .contents,
		.half .bg {
			width: 50%;
		}

		@media (max-width: 1199.98px) {

			.half .contents,
			.half .bg {
				width: 100%;
			}
		}

		.half .contents .form-control,
		.half .bg .form-control {
			border: none;
			-webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
			box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
			border-radius: 4px;
			height: 54px;
			background: #fff;
		}

		.half .contents .form-control:active,
		.half .contents .form-control:focus,
		.half .bg .form-control:active,
		.half .bg .form-control:focus {
			outline: none;
			-webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
			box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
		}

		.half .bg {
			background-size: cover;
			background-position: center;
		}

		.half a {
			color: #888;
			text-decoration: underline;
		}

		.half .btn {
			height: 54px;
			padding-left: 30px;
			padding-right: 30px;
		}


		.control {
			display: block;
			position: relative;
			padding-left: 30px;
			margin-bottom: 15px;
			cursor: pointer;
			font-size: 14px;
		}

		.control .caption {
			position: relative;
			/* top: .2rem; */
			color: #888;
		}

		.control input {
			position: absolute;
			z-index: -1;
			opacity: 0;
		}
	</style>

	<title>Login</title>
</head>

<body>


	<div class="d-lg-flex half">
		<div class="bg order-1 order-md-2"
			style="background-image: url('https://qtxasset.com/styles/breakpoint_sm_default_480px_w/s3/fiercehealthcare/1582741956/GettyImages-938754444.jpg/GettyImages-938754444.jpg?T7veAipGbA1FBbqUd17l1XgsuK.YIg1U&itok=1yZhRI9e');">
		</div>
		<div class="contents order-2 order-md-1">

			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-md-7">
						<h3>Login to <strong style="color: orangered;">Raksha</strong></h3>
						<p class="mb-4">Fastest 24/7 Ambulance Booking Service</p>
						<form action="controller.php?action=login" method="POST">
							<select name="user" class="form-control">
								<option value="patient">Patient</option>
								<option value="admin">Admin</option>
								<option value="driver">Driver</option>
							</select>
							<div class="form-group mt-3">
								<label for="username">Email Id</label>
								<!-- <input type="text" class="form-control" placeholder="your-email@gmail.com" id="username"> -->
								<input type="text" class="form-control" name="email"
									placeholder="your-email@gmail.com">
							</div>
							<div class="form-group last mb-3">
								<label for="password">Password</label>
								<input type="password" class="form-control" placeholder="Your Password" name="pass"><br>
							</div>

							<input type="submit" value="Log In" class="btn btn-block btn-primary">

						</form>
						<div class="text-center mt-2">
							<a href="signupform.html">Not A Member? SignUp</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>