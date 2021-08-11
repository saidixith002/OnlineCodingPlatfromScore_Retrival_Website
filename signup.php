<?php include('includes/header.php');?>	
<?php session_start(); ?>
<?php 
					//echo "<h2> ".isset($_SESSION['status'])." pp " .$_SESSION['key']." </h2>";
					//echo isset($_SESSION['status']);
					if(isset($_SESSION['status']) )
					{header('location:index.php');}
?>
<head>
<!-- Favicon -->
  <link rel="shortcut icon" href="includes/elegant/img/svg/logo.svg" type="image/x-icon">
  	<title>Registration | OnlineJudge </title>
	<style>
		.form-label{margin-top:.5rem;}
	</style>
</head>

<body>


	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 nt-4" style="margin-top:1rem"> 
				<h3 > Registration Page </h3><hr>
				
				<form action=register.php method="POST">
					<div class="form-group">
						<label class="form-label">Name </label>
						<input type="text" class="form-control" name="name" id="name" required>
					</div>
					
					<div class="form-group">
						<label class="form-label">Email address(Personal)</label>
						<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
					</div>
				  
					<div class="form-group">
						<label class="form-label">Rollno</label>
						<input type="text" class="form-control" id="rollno" name="rollno" required>
					</div>
					<div class="form-group">
						<label class="form-label">Branch</label>
						
						<select class="form-select" id="branch" name="branch" >
							<option value="CSE"> Computer Science and Engineering          </option>
							<option value="IT">  Information Technology                    </option>
							<option value="ECE"> Electronics and Communication Engineering </option>
							<option value="EEE"> Electrical and Electronics Engineering          </option>
							<option value="ME"> Mechanical Engineering</option>
							<option value="CE"> Civil Engineering</option>
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">Email address(College)</label>
						<input type="email" class="form-control" id="cemail" name="cemail" aria-describedby="emailHelp" required>
					</div>
					<div class="form-group">
						<label class="form-label">Passout Year</label>
						<input type="text" class="form-control" id="passoutYear" name="passoutYear" required>
					</div>
					<div class="form-group">
						<label class="form-label">Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" required>
					</div>
									
					<div class="form-group">
						<label class="form-label">Codechef Username </label>
						<input type="text" class="form-control" name="codechef" id="codechef" required>
						<input type=hidden name=codechefRating id=codechefRating required>
						<input type=hidden name=codechefProblems id=codechefProblems >
					</div>
					<div class="form-group">
						<label class="form-label">Codeforces Username </label>
						<input type="text" class="form-control" name="codeforces" id="codeforces" required>
						<input type=hidden name=codeforcesRating id=codeforcesRating >
					</div>
					<div class="form-group">
						<label class="form-label">Hackerrank Username </label>
						<input type="text" class="form-control" name="hackerrank" id="hackerrank" required>
					</div>
					<div class="form-group">
						<label class="form-label">Spoj Username </label>
						<input type="text" class="form-control" name="spoj" id="spoj" required>
						<input type=hidden name=spojPoints id=spojPoints >
						<input type=hidden name=spojProblems id=spojProblems >					</div>
					<div class="form-group">
						<label class="form-label">InterviewBit Username </label>
						<input type="text" class="form-control" name="interviewbit" id="interviewbit" required>
						<input type=hidden name=interviewbitRating id=interviewbitRating >
					</div>
					
					<div class="form-group" style="margin-top:1rem">
						<button type="submit" name="register_user" onClick="return loading()" class="btn btn-primary btn-block" style="width:100%">Submit</button>
						
		
					</div>	
				</form>
			</div>
		</div>
	</div>

</body>

<?php	
	include('includes/footer.php');
	
?>