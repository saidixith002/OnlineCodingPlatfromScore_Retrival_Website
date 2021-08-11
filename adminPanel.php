<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.php');?>	
<?php session_start(); ?>
<?php 
					
					if(!isset($_SESSION['status']) )
					{header('location:login.php');}
					if(strcmp($_SESSION['role'] ,  'admin') != 0) header('location:logout.php');
?>
<?php
			$rowlimit = 5;  //top two performers
 
			if(isset($_POST['filterValue']))
				$rowlimit = $_POST['filterValue'];
			
			include("includes/dbconfig.php");
			$reference = "users/";
			$fetchdata = $database->getReference($reference)->getValue();
			$columnName = 'totalScore';
			$subcolumn = 'totalScore';
			
			
	// array to print top performers
	$topDetails = [
					' Hackerrank' => [
							'columnName' => 'hackerrank',
							'subcolumn' => 'hackerrankScore',
							'username' => 'hackerrankName'
						 ],
					' Codechef' => [
							'columnName' => 'codechef',
							'subcolumn' => 'codechefScore',
							'username' => 'codechefName'
						 ],
					' Codeforces' => [
							'columnName' => 'codeforces',
							'subcolumn' => 'codeforcesScore',
							'username' => 'codeforcesName'
						 ],
					' Spoj' => [
							'columnName' => 'spoj',
							'subcolumn' => 'spojScore',
							'username' => 'spojName'
						 ],
					' InterviewBit' => [
							'columnName' => 'interviewbit',
							'subcolumn' => 'interviewbitScore',
							'username' => 'interviewbitName'
						 ],
	];

?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Dashboard</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="includes/elegant/img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="includes/elegant//css/style.min.css">
</head>

<body>
  <div class="layer"></div>
<!-- ! Body -->

<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">Admin</span>
                    <span class="logo-subtitle">Dashboard</span>
                </div>

            </a>
           
        </div>
	
    </div>
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <div class="sidebar-user-info" style="text-align:center">
                <span class="sidebar-user__title">Vardhaman College</span>
                <span class="sidebar-user__subtitle">onlnejudge.vardhaman@gmail.com</span>
            </div>
        </a>
    </div>
</aside>

<div class="main-wrapper">
    <!-- ! Main nav -->
<nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
		<h2 class="main-title" style="margin-left:2rem; ">Hello Administrator </h2>
    </div>
    <div class="main-nav-end" style="margin-right:1rem">
      

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
        <button href="##" class="nav-user-btn dropdown-btn" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
				<picture><source srcset="includes/elegant/img/avatar/avatar-illustrated-02.webp" type="image/webp">
				<img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
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
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php echo count($fetchdata); ?></p>
                <p class="stat-cards-info__title">Total Students Enrolled</p>
              </div>
            </article>
          </div>
		  <div class="col-md-6 col-xl-8" >
            <article class="stat-cards-item" style="float:right; background:transparent;">
              <div class="stat-cards-info" style="background:transparent;">
                <p class="stat-cards-info__num">Top Performers Filter</p>
				<form action="adminPanel.php" method="POST">
					<input type=number placeholder="Number" min=1 style="background:white" name="filterValue" value=5>
					<input type=submit style="margin-left:1rem; background:blue; width:3rem; color:white;" value=Go>
				<form>
                
              </div>
            </article>
          </div>
        </div>
		

	
      
 
	
	
		<!-- TOP Performers Cards -->
        <div class="row">  
			<?php 
				foreach($topDetails as $platform => $pInfo){
					?>
					  <div class="col-lg-3">
						<article class="white-block">
						  <div class="top-cat-title">
							<h3>Top <?php echo $rowlimit;?> Performers in <?php echo $platform; ?></h3>
						  </div>
						  <ul class="top-cat-list">
						  <?php $rowcount = 0;
							  $columnName = $pInfo['columnName']; 
							  $subcolumn = $pInfo['subcolumn'];
							  $fetchdata1 = getDataToPrint($fetchdata);
							
							foreach($fetchdata1 as $key => $row){ $rowcount++; 
							if($rowcount > $rowlimit) break;
							?>
							<li>
							  <a href="##">
								<div class="top-cat-list__title">
								  <?php echo $row['details']['name'];?> <span><?php echo $row[$pInfo['columnName']][$pInfo['subcolumn']];?></span>
								</div>
								<div class="top-cat-list__subtitle"> Username: <?php echo $row[$pInfo['columnName']][$pInfo['username']];?> </div>
								<div class="top-cat-list__subtitle">   Rollno: <?php echo $row['details']['rollno'];?> 		</div>
							  </a>
							</li>
							<?php }?>
						  </ul>
						</article>
					  </div>
				<?php }  ?>
        </div>
    
	  </div>
    </main>
    <!-- ! Footer -->
	<footer class="footer">
	  <div class="container footer--flex">
		<div class="footer-start">
		  <p>2021 © Vardhaman College - <a href="http://www.vardhaman.org" target="_blank"
			  rel="noopener noreferrer">vardhaman.org</a></p>
		</div> 
	  </div>
	</footer>
  
	</div>
	</div>
</div>
<script src="includes/elegant/plugins/chart.min.js"></script>

<!-- Icons library -->
<script src="includes/elegant/plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="includes/elegant/js/script.js"></script>
</body>

<?php

	function desc($a, $b) {
		global $columnName ,$subcolumn;
		$constraint1 = $columnName;
		$constraint2 = $subcolumn;
		//echo $constraint1 . " " .$constraint2;
		return strnatcmp($b[$constraint1][$constraint2],$a[$constraint1][$constraint2]); 
	}
	
	function getDataToPrint($array){
		usort($array, 'desc' );
		return $array;
	}
?>
</html>