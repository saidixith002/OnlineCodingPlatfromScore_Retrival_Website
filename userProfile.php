<!DOCTYPE html>
<?php include('includes/header.php');?>	
<?php session_start(); ?>
<?php 
					// echo "<h2> ".$_SESSION['status']." pp " .isset($_SESSION['key'])." </h2>";
					// echo isset($_SESSION['key']);
					if(!isset($_SESSION['status']) )
					{header('location:login.php');}
?>

<?php 

	include('includes/dbconfig.php');
	$key = $_SESSION['status'];
	$reference = "users/";
	$fetchdata = $database->getReference($reference)->getChild($key)->getValue();
	//echo "<h2> ".$fetchdata['username']." </h2>";
	
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | OnlineJudge</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="includes/elegant/img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="includes/elegant/css/style.min.css">
</head>

<body>
<div class="layer"></div>
<!-- ! Body -->

<div class="page-flex">
 
  
  <div class="main-wrapper">
    <!-- ! Main nav -->
<nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
		<h2 class="main-title" style="margin-left:2rem; ">WELCOME <?php echo strtoupper($fetchdata['details']['name']); ?> </h2>
    </div>
	
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
      </button>

      <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
        <span class="sr-only">Switch theme</span>
        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
      </button>
	  

      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="includes/elegant/img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="includes/elegant/img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="index.php">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Sheet</span>
            </a></li>
          <li><a href="updateScore.php">
              <i data-feather="settings" aria-hidden="true"></i>
              <span>Update Scores</span>
            </a></li>
          <li><a class="danger" href="logout.php">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>Log out</span>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">Dashboard</h2>
        <div class="row stat-cards">
		
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
               <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $fetchdata['hackerrank']['hackerrankScore']; ?></p>
                <p class="stat-cards-info__num">Hackerrank</p>
				<p class="stat-cards-info__title">Auto Generated </p>
                <p class="stat-cards-info__title">Not Included In TotalScore </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $fetchdata['codechef']['codechefScore']; ?></p>
				<p class="stat-cards-info__num">Codechef</p>
                <p class="stat-cards-info__title">
				 <?php echo 'Problems: '.$fetchdata['codechef']['codechefProblems'].' Rating: '.$fetchdata['codechef']['codechefRating']; ?>
				</p>
               
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon purple">
                <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $fetchdata['codeforces']['codeforcesScore']; ?></p>
				<p class="stat-cards-info__num">CodeForces</p>
                <p class="stat-cards-info__title"><?php echo 'Problems: '.$fetchdata['codeforces']['codeforcesProblems'].'  Rating: '.$fetchdata['codeforces']['codeforcesRating']; ?></p>
                
              </div>
            </article>
          </div>
		  <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
               <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $fetchdata['spoj']['spojScore']; ?></p>
				<p class="stat-cards-info__num">Spoj</p>
                <p class="stat-cards-info__title"><?php echo 'Problems: '.$fetchdata['spoj']['spojProblems'].'   Points: '.$fetchdata['spoj']['spojPoints']; ?></p>
                
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
               <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $fetchdata['interviewbit']['interviewbitScore']; ?></p>
				<p class="stat-cards-info__num">InterviewBit</p>
                <p class="stat-cards-info__title"><?php echo 'Rating: '.$fetchdata['interviewbit']['interviewbitRating']; ?></p>

              </div>
            </article>
          </div>
		  <div class="col-md-6 col-xl-3	">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
                <i data-feather="feather" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo $fetchdata['totalScore']['totalScore']; ?></p>
                <p class="stat-cards-info__num">Total Score</p>

              </div>
            </article>
          </div>
        </div>

		<div class="row center">
			  <div class="col-lg-6">
				<article class="white-block">
				  <div class="top-cat-title">
					<h3>User Details</h3>
				  </div>
					
				  <ul class="top-cat-list" style="margin-left: 1rem;margin-right: 1rem;">
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  HackerRank <span><?php echo $fetchdata['hackerrank']['hackerrankScore']; ?></span>
						</div>
						<div class="top-cat-list__subtitle">
						 Username: <?php echo $fetchdata['hackerrank']['hackerrankName']; ?> 
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Codechef <span><?php echo $fetchdata['codechef']['codechefScore']; ?></span>
						</div>
						<div class="top-cat-list__subtitle">
						  Username: <?php echo $fetchdata['codechef']['codechefName']; ?> 
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Codeforces <span><?php echo $fetchdata['codeforces']['codeforcesScore']; ?></span>
						</div>
						<div class="top-cat-list__subtitle">
						  Username: <?php echo $fetchdata['codeforces']['codeforcesName']; ?> 
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Spoj <span><?php echo $fetchdata['spoj']['spojScore']; ?></span>
						</div>
						<div class="top-cat-list__subtitle">
						 Username: <?php echo $fetchdata['spoj']['spojName']; ?> 
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  InterviewBit <span><?php echo $fetchdata['interviewbit']['interviewbitScore']; ?></span>
						</div>
						<div class="top-cat-list__subtitle">
						 Username: <?php echo $fetchdata['interviewbit']['interviewbitName']; ?> 
						</div>
					  </a>
					</li>
				  </ul>
				</article>
			  </div>

			  <div class="col-lg-4">
				<article class="white-block">
				  <div class="top-cat-title">
					<h3>Personal Details</h3>
				   
				  </div>
				  <ul class="top-cat-list" style="margin-left: 1rem;margin-right: 1rem;">
				  
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Name <span><?php echo strtoupper($fetchdata['details']['name']); ?></span>
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Rollno <span><?php echo strtoupper($fetchdata['details']['rollno']); ?></span>
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Branch <span><?php echo strtoupper($fetchdata['details']['branch']); ?></span>
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Passout Year <span><?php echo $fetchdata['details']['passoutYear']; ?></span>
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Email (Personal)<span><?php echo $fetchdata['details']['email']; ?></span>
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Email (College) <span><?php echo $fetchdata['username']; ?></span>
						</div>
					  </a>
					</li>
					<li>
					  <a href="##">
						<div class="top-cat-list__title">
						  Phone <span><?php echo $fetchdata['details']['phone']; ?></span>
						</div>
					  </a>
					</li>
				  </ul>
				</article>
			  </div>          
		</div>
		<!-- Graph -->
        <div class="row stat-cards"> 
				
          <div class="col-md-6 col-xl-6">
            <article class="stat-cards-item">
			<h2 class="page-header" >Analytics Reports </h2>
              <canvas  id="chartjs_bar"></canvas>
            </article>
          </div>
		  
		  <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
			<h2 class="page-header" >Scores Percentage </h2>
              <canvas  id="chartjs_pie"></canvas>
            </article>
          </div><br>
		  
           <div class="col-md-6 col-xl-6" style="margin-top:1rem">
            <article class="stat-cards-item">
			<h2 class="page-header" >TimeLine of your Scores </h2>
              <canvas  id="chartjs_line"></canvas>
            </article>
          </div> 
           
          </div>
          
        </div>
		
      </div>
    </main>
   
  </div>
</div>



<!-- Chart library -->
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="includes/elegant/plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="includes/elegant/plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="includes/elegant/js/script.js"></script>


 
<script type="text/javascript">

	// graph Scripts
	<?php
		 $xLabels = ['Hackerrank','Codechef','Codeforces','Spoj','InterviewBit'];
		 $yLabels = [
					$fetchdata['hackerrank']['hackerrankScore'],
					$fetchdata['codechef']['codechefScore'],
					$fetchdata['codeforces']['codeforcesScore'],
					$fetchdata['spoj']['spojScore'],
					$fetchdata['interviewbit']['interviewbitScore']
				  ];
	?>

      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($xLabels); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($yLabels); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    }
 
 
                }
                });
				
	  var ctx = document.getElementById("chartjs_pie").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($xLabels); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($yLabels); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    } 
                }
                });
	

	  <?php
			$xLabelsline = [];
		    $yLabelsline = [];
			foreach($fetchdata['totalScore']['timeline'] as $k => $roww ){
				
				array_push($xLabelsline , $roww['date']);
				array_push($yLabelsline, $roww['score']);
			}
		 
	  ?>

	  var ctx = document.getElementById("chartjs_line").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($xLabelsline); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($yLabelsline); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    }
 
 
                }
                });
</script>
</body>

</html>