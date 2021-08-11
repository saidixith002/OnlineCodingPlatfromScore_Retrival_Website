<?php
	session_start();
	include('includes/dbconfig.php');
	 
	if(isset($_SESSION['status']) )
	{header('location:index.php');}

	if(isset($_POST['register_user']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$branch = $_POST['branch'];
		$passoutYear = $_POST['passoutYear'];
		$rollno = $_POST['rollno'];
		$username = strtolower($_POST['cemail']);
		$password = strtoupper($_POST['rollno']);
		
		$codechefName = $_POST['codechef'];
		$codechefRating = "invalid";
		$codechefProblems = "invalid";
		$codechefScore = 0;
		
		$codeforcesName = $_POST['codeforces'];
		$codeforcesRating = "invalid";
		$codeforcesScore = 0;
		
		$hackerrankName = $_POST['hackerrank'];
		$hackerrankScore = 0;
		
		$spojName = $_POST['spoj'];
		$spojPoints = "invalid";
		$spojProblems = "invalid";;
		$spojScore = 0;
		
		$interviewbitName = $_POST['interviewbit'];
		$interviewbitRating = "invalid";
		$interviewbitScore = 0;
		
		
		$totalScore = $codechefScore + $codeforcesScore + $spojScore + $hackerrankScore + $interviewbitScore;
		$role = 'user';
		
		echo "<h2> interviewBit: ".$interviewbitRating."</h2>";
		echo "<h2> spojPoints: ".$spojPoints."</h2>";
		echo "<h2> spojProblems: ".$spojProblems."</h2>";
		echo "<h2> codeforcesRating: ".$codeforcesRating."</h2>";
		echo "<h2> codechefRating: ".$codechefRating."</h2>";
		echo "<h2> codechefProblems: ".$codechefProblems."</h2>";
		
		$data = [
			'username' => $username,
			'password' => $password,
			'details' => [
							'name' => $name,
							'email' => $email,
							'phone' => $phone,
							'branch' => $branch,
							'rollno' => $rollno,
							'passoutYear' => $passoutYear
							
						 ],
			'codechef' => [
							'codechefName' => $codechefName,
							'codechefRating' => $codechefRating,
							'codechefProblems' => $codechefProblems,
							'codechefScore' =>$codechefScore,
							],
			'codeforces' => [
								'codeforcesName' => $codeforcesName,
								'codeforcesRating' => $codeforcesRating,
								'codeforcesScore' => $codeforcesScore,
							],
			'hackerrank' => [
								'hackerrankName' => $hackerrankName,
								'hackerrankScore' => $hackerrankScore,
							],
			'spoj' => [
						'spojName' => $spojName,
						'spojPoints' => $spojPoints,
						'spojProblems' => $spojProblems,
						'spojScore' => $spojScore,
					  ],
			'interviewbit' => [
								'interviewbitName' => $interviewbitName,
								'interviewbitRating' => $interviewbitRating,
								'interviewbitScore' => $interviewbitScore,
							  ],
							  
			'totalScore' => ['totalScore' => $totalScore ],
			'role' => $role
		];
		
		$ref = "/users";
		
		$postdata = $database->getReference($ref)->push($data)->getKey(); 
		echo "<h2> key: ".$postdata."</h2>";
		?>
		
		
		
		<?php 
			
				if($postdata != ""){
					$_SESSION['status'] = $postdata;
					$_SESSION['role'] = $role;
					header("Location: updateScore.php");
				}else{
					$_SESSION['status'] = "Data Not Inserted. Something Went Wrong. Please Signup Again.";
					header("Location: signup.php");
				}
		
	}

?>