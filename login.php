<!doctype html>
<html lang="en">

<?php include('includes/header.php');?>	
<?php session_start(); ?>
<?php 
					//echo "<h2> ".$_SESSION['status']." </h2>";
					//echo "<h2> ".isset($_SESSION['status'])." </h2>";
					//echo isset($_SESSION['status']);
					if(isset($_SESSION['status']) )
					{header('location:index.php');}
?>

  <head>
  <!-- Favicon -->
  <link rel="shortcut icon" href="includes/elegant/img/svg/logo.svg" type="image/x-icon">
  	<title>Login form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="includes/login_form/css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(includes/login_form/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login Form</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
				
				
		      	<form  method="post" class="signin-form">
		      		<div class="form-group" style="margin-bottom:0rem">
		      			<input type="text" class="form-control" name="name" id="pwd" placeholder="Username" required>
						<label class="form-label" style="text-align:center;width:100%;">College Mail in lowercase.</label>
		      		</div>
	            <div class="form-group" style="margin-bottom:0rem">
	              <input id="password-field" type="password" class="form-control" name="pwd" id="pwd" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="transform: translateY(-150%);"></span>
				  <label class="form-label" style="text-align:center;width:100%;">College Rollno in uppercase(ex: 18881AXXXX)</label>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name='signin' class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="forgotPassword.php" style="color: #fff">Forgot Password</a>
								</div>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; New to Page &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="signup.php" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> SignUp</a>
	          	
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="includes/login_form/js/jquery.min.js"></script>
  <script src="includes/login_form/js/popper.js"></script>
  <script src="includes/login_form/js/bootstrap.min.js"></script>
  <script src="includes/login_form/js/main.js"></script>
  
  <?php 
	if(isset($_POST['signin'])) {
			
			$uname = $_POST['name'];
			$pwd = $_POST['pwd'];
			include('includes/adminDetails.php');
			if(strcmp($uname ,$adminUsername)==0 && strcmp($pwd , $adminPassword)==0){
							$_SESSION['status'] = 'admin';
							$_SESSION['role'] = 'admin';
							header("Location: adminPanel.php");
			}
			else{
				include("includes/dbconfig.php");
				$reference = "users/";
				$fetchdata = $database->getReference($reference)->getValue();
				if($fetchdata > 0){
					foreach($fetchdata as $key => $row){ 
						if((strcmp($row['username'],$uname)==0) &&( strcmp($row['password'] ,$pwd) == 0)){
							//echo "login Successful";
							$_SESSION['status'] = $key;
							$_SESSION['role'] = $row['role'];
							header("Location: userProfile.php");
						}
					}
				}
					echo '<script> alert("Invalid Username or Password..!"); </script>';
			}
	}
	
  
  ?>

	</body>
</html>

