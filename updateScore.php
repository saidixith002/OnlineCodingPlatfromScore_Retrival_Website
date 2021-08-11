<?php include('includes/header.php');?>	
<?php session_start(); ?>
<?php 
		// echo "<h2> ".$_SESSION['status']." pp " .$_SESSION['key']." </h2>";
		// echo isset($_SESSION['key']);
		if(!isset($_SESSION['status']) )
		{header('location:login.php');}

		$ky = $_SESSION['status'];
		$role = $_SESSION['role'];
		
		include('includes/simple_html_dom.php');

			function update($database, $key, $row, $date){
				
					echo "<h2> Updating ".$row['details']['name']."details</h2>";
					echo "<h4>Updating hackerrank Score</h4>";
					//Updating hackerrank Score
					$huname = $row['hackerrank']['hackerrankName'];
					$hScore = fetchHackerRankScore($huname);
					$ref = "users/".$key."/hackerrank/hackerrankScore";
					$database->getReference($ref)->set($hScore);
					
					echo "<h4>//Updating codechef Score </h4>";
					//Updating codechef Score
					$cuname = $row['codechef']['codechefName'];
					$cScore = fetchCodechefScore($cuname);
					$ref = "users/".$key."/codechef";
					$database->getReference($ref."/codechefScore")->set($cScore['score']);
					$database->getReference($ref."/codechefRating")->set($cScore['rating']);
					$database->getReference($ref."/codechefProblems")->set($cScore['problems']);
					
					echo "<h4> //Updating codeforces Score</h4>";
					//Updating codeforces Score
					$cfuname = $row['codeforces']['codeforcesName'];
					$cfScore = fetchCodeforcesScore($cfuname);
					$ref = "users/".$key."/codeforces";
					$database->getReference($ref."/codeforcesScore")->set($cfScore['score']);
					$database->getReference($ref."/codeforcesRating")->set($cfScore['rating']);
					$database->getReference($ref."/codeforcesProblems")->set($cfScore['problems']);
					
					echo "<h4>//Updating spoj Score </h4>";
					//Updating spoj Score
					$suname = $row['spoj']['spojName'];
					$sScore = fetchSpojScore($suname);
					$ref = "users/".$key."/spoj";
					$database->getReference($ref."/spojScore")->set($sScore['score']);
					$database->getReference($ref."/spojPoints")->set($sScore['rating']);
					$database->getReference($ref."/spojProblems")->set($sScore['problems']);
					
					echo "<h4>//Updating interviewbit Score</h4>";
					//Updating interviewbit Score
					$iuname = $row['interviewbit']['interviewbitName'];
					$iScore = fetchInterviewbitScore($iuname);
					$ref = "users/".$key."/interviewbit";
					$database->getReference($ref."/interviewbitScore")->set($iScore['score']);
					$database->getReference($ref."/interviewbitRating")->set($iScore['rating']);
					
					echo "<h4> //Updating totalScore</h4>";
					//updating totalScore
					
					// change if Hackerrnk is Included
					//$totalScore = $hScore + $cScore['score'] + $cfScore['score'] + $sScore['score'] + $iScore['score'] ;
					$totalScore = $cScore['score'] + $cfScore['score'] + $sScore['score'] + $iScore['score'] ;
					
					
					$ref = "users/".$key."/totalScore";
					$database->getReference($ref."/totalScore")->set($totalScore);
					
					echo "<h4> Adding total Score to timeline</h4>";
					// adding total Score to timeline
					$timeline  = [
									'date' => $date,
									'score' => $totalScore
									];
					$ref = "users/".$key."/totalScore/timeline";
					$database->getReference($ref)->push($timeline);
					
					echo "<h4> Updated ".$row['details']['name']."details</h4>";
			}
			
			function fetchHackerRankScore($uname){
				$score = rand(150, 1502);
				return $score;
			}
			
			function fetchCodechefScore($uname){
					
				$dom = file_get_html("https://www.codechef.com/users/".$uname , false);

				if(!empty($dom)){
					
					$var = $dom->find('div.content',3)->getElementByTagName('h5')->plaintext;	
					$problems = substr($var,14,strlen($var)-15);
					$rating = ($dom->find('div.rating-number',0)->plaintext);
					
					$r =  0;
					if($rating > 1300)
						$r = ($rating - 1300);
					$scr = round(($problems*10) + ( $r * $r )/30);
				}
				else{
					$rating = "invalid";
					$problems = "invaid";
					$scr = 0;
				}
				
				$score = [
							'rating' => $rating,
							'problems' => $problems,
							'score' => $scr
						];
				return $score;
	
			}
			
			function fetchCodeforcesScore($uname){
				
				$dom = file_get_html("https://codeforces.com/profile/".$uname , false);
		
				if(!empty($dom)){
					$var = $dom->find('div._UserActivityFrame_counterValue',0)->plaintext;
					$problems = substr($var,0,strlen($var)-9);
					$rating = $dom->find('div.info',0)->getElementByTagName('ul')->getElementByTagName('li')->getElementByTagName('span')->plaintext;
					
					$r =  0;
					if($rating > 1200)
						$r = ($rating - 1200);
				    $scr = round($problems*10 + ($r*$r)/30);
				}
				else{
					$rating = "invalid";
					$problems = "invaid";
					$scr = 0;
				}
								
				$score = [
							'rating' => $rating,
							'problems' => $problems,
							'score' => $scr
						];
				return $score;
			}

			function fetchSpojScore($uname){
				
				$dom = file_get_html("https://www.spoj.com/users/".$uname , false);
			
				if(!empty($dom)){
					$var = "";
					foreach($dom->find('div.row',4)->find('div.col-md-3',0)->find('p') as $p){
						if(strpos($p->plaintext ,"World Rank")){
							$var = $p->plaintext;
						}
					}					
					$rating =  substr($var , strpos($var,'(')+1 , strpos($var,'points') - strpos($var,'(') -2);	
					$problems = $dom->find('div.row',6)->getElementByTagName('dd')->plaintext;			
					$scr = round(($problems*20) + ($rating *500));
				}
				else{
					$rating = "invalid";
					$problems = "invaid";
					$scr = 0;
				}	
				
				$score = [
							'rating' => $rating,
							'problems' => $problems,
							'score' => $scr
						];
				return $score;
			}
			
			function fetchInterviewbitScore($uname){ 
				
				$dom = file_get_html("https://www.interviewbit.com/profile/".$uname , false);

				if(!empty($dom)){
					$rating = $dom->find('div.txt',1)->plaintext;
					$scr = round($rating/3);
				}
				else{
					$rating = "invalid";
					$scr = 0;
				}
				
				$score = [
							'rating' => $rating,
							'score' => $scr
						];
				return $score;
			}
	

		//Main code
	include("includes/dbconfig.php");
	$reference = "users/";
	$fetchdata = $database->getReference($reference)->getValue();
	
	if($fetchdata > 0){
		$date = getdate();
			$date = $date['month'].' '.$date['mday'].' , '.$date['year'];
		
			if(strcmp($role, 'user') == 0){
				foreach($fetchdata as $key => $row){
					if(strcmp($key , $ky) == 0 )
						update($database, $key , $row , $date);
					} 
					header('location:userProfile.php');					
			}
			else{ 
					foreach($fetchdata as $key => $row){ 
						update($database, $key , $row , $date);
					}		
				header('location:adminPanel.php');
			}
				
	}
	
  ?>
  