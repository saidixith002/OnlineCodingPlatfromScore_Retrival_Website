<!DOCTYPE html>
<?php include('includes/header.php');?>	
<?php session_start(); ?>
<?php 
					//echo "<h2> ".$_SESSION['status']." pp " .isset($_SESSION['role'])." </h2>";
					//echo isset($_SESSION['role']);
					$role = $_SESSION['role'];
					if(!isset($_SESSION['status']) )
					{header('location:login.php');}
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link rel="shortcut icon" href="includes/elegant/img/svg/logo.svg" type="image/x-icon">
  	<title>ScoreSheet | OnlineJudge </title>
  
  <!-- Custom styles -->
  <link rel="stylesheet" href="includes/elegant/css/style.min.css">
  <style >
	tbody, td, tfoot, th, thead, tr { text-align:center; padding:.5rem; border:1px; }
	
  </style>

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
      <h2 class="main-title" style="margin-left:2rem; ">Score Sheet of All Users</h2>
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
            <picture><source srcset="./includes/elegant/img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./includes/elegant/img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="<?php if(strcmp($role , 'admin')==0) echo 'adminPanel.php'; else echo 'userProfile.php';?>">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Profile</span>
            </a></li>
          <li><a href="##">
              <i data-feather="settings" aria-hidden="true"></i>
              <span>Account settings</span>
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

		<div class="card" style="align-items: center; border:0; background:transparent;" >	
			<div class="card" style="align-items: center; width:50% background:transparent; margin:.5rem;" >						
				<form action="index.php" method=post name="filter">
					<span style="margin:.5rem;"><strong>Sort By: </strong></span>
					<label class="form-label">  Column Name:</label>
					<select name="columnName" id="columnName">
					  <option value="totalScore" selected>Total Score</option>
					  <option value="name">Name</option>
					  <option value="branch">Branch</option>
					  <option value="rollno">Rollno</option>
					  <option value="passoutYear">Passout Year</option>
					  <option value="codechefScore">Codechef Score</option>
					  <option value="codeforcesScore">Codeforces Score</option>
					  <option value="spojScore">Spoj Score</option>
					  <option value="interviewScore">InterviewBitScore</option>
					</select>
					<label class="form-label"> Order By:</label>
					<select name="orderby" id="orderby">
					  <option value="desc" selected>Descending order</option>
					  <option value="asc">Asscending order</option>
					</select>
					<button type=submit value="Go"  class="btn btn-primary btn-block" style="margin:.5rem">Go</button>
				</form>
			</div>
		</div>
        <div class="row">
          <div class="col-lg-12">
            
            <div class="users-table table-wrapper">
              <table class="posts-table">
                <thead>
                  
				  <tr >
					
									  <th scope="col" rowspan=2 style="text-align:center;">#</th>
									  <th scope="col" rowspan=2>Rollno</th>
									  <th scope="col" rowspan=2 width="100dp">Name</th>
									  <th scope="col" rowspan=2>Branch</th>
									  <th scope="col" rowspan=2>Passout Year</th>
									  <th scope="col" rowspan=2>Email</th>
									  <th scope="col" rowspan=2>Phone</th>						  
									  <th scope="col" colspan=2 style="text-align:center;">Hackerrank</th>
									  <th scope="col" colspan=4 style="text-align:center;">Codechef</th>  
									  <th scope="col" colspan=4 style="text-align:center;">Codeforces</th>
									  <th scope="col" colspan=4 style="text-align:center;">Spoj</th>
									  <th scope="col" colspan=3 style="text-align:center;">InterviewBit</th>
									  <th scope="col" rowspan=2 >Total Score</th>
									</tr>
									<tr >
									 
									  <th scope="col">UserName</th>
									  <th scope="col">Score</th>
									  <th scope="col">UserName</th>
									  <th scope="col">Problems</th>
									  <th scope="col">Rating</th>
									  <th scope="col">Score</th>
									  <th scope="col">UserName</th>
									  <th scope="col">Problems</th>
									  <th scope="col">Rating</th>
									  <th scope="col">Score</th>
									  <th scope="col">UserName</th>
									  <th scope="col">Points</th>
									  <th scope="col">Problems</th>
									  <th scope="col">Score</th>
									  <th scope="col">UserName</th>
									  <th scope="col">Rating</th>
									  <th scope="col">Score</th>
									</tr>
                </thead>
                <tbody>
								<?php 
									include("includes/dbconfig.php");
									$reference = "users/";
									$fetchdata = $database->getReference($reference)->getValue();
									$columnName = 'totalScore';
									$subcolumn = 'totalScore';
									$orderBy = 'desc';
									if(isset($_POST['columnName'])){ 
										$subcolumn = $_POST['columnName'];
										$orderBy = $_POST['orderby'];
										//echo $subcolumn;
										if(strnatcmp($subcolumn,'name')==0 || strnatcmp($subcolumn,'branch')==0 || strnatcmp($subcolumn,'passoutYear')==0 || strnatcmp($subcolumn,'rollno')==0 ){
											$columnName = 'details';
										}else if(strnatcmp($subcolumn,'hackerrankScore')==0  ){  $columnName = 'hackerrank'; }
										else if(strnatcmp($subcolumn,'codechefScore')==0  ){  $columnName = 'codechef'; }
										else if(strnatcmp($subcolumn,'spojScore')==0  ){  $columnName = 'spoj'; }
										else if(strnatcmp($subcolumn,'interviewbitScore')==0  ){  $columnName = 'interviewbit'; }
										else if(strnatcmp($subcolumn,'codeforcesScore')==0  ){  $columnName = 'codeforces'; }
										else if(strnatcmp($subcolumn,'totalScore')==0  ){  $columnName = 'totalScore'; }
									}else{
										$columnNamee = 'totalScore';
										$subcolumn = 'totalScore';
										$orderBy = "desc";
									}
									$fetchdata = getDataToPrint($fetchdata, $orderBy); // $column Name  has to be modied
									$rowCount = 0;
									foreach($fetchdata as $key => $row){ $rowCount++;
								?>
								<tr>
								  <td><strong><?php echo $rowCount; ?></strong></td>
								  <td><?php echo $row['details']['rollno']; ?></td>
								  <td><?php echo $row['details']['name']; ?></td>
								  <td><?php echo $row['details']['branch']; ?></td>
								  <td><?php echo $row['details']['passoutYear']; ?></td>
								  <td><?php echo $row['details']['email']; ?></td>
								  <td><?php echo $row['details']['phone']; ?></td>
								  <td><?php echo $row['hackerrank']['hackerrankName']; ?></td>
								  <td><?php echo $row['hackerrank']['hackerrankScore']; ?></td>
								  <td><?php echo $row['codechef']['codechefName']; ?></td>
								  <td><?php echo $row['codechef']['codechefRating']; ?></td>
								  <td><?php echo $row['codechef']['codechefProblems']; ?></td>
								  <td><?php echo $row['codechef']['codechefScore']; ?></td>
								  <td><?php echo $row['codeforces']['codeforcesName']; ?></td>
								  <td><?php echo $row['codeforces']['codeforcesProblems']; ?></td>
								  <td><?php echo $row['codeforces']['codeforcesRating']; ?></td>
								  <td><?php echo $row['codeforces']['codeforcesScore']; ?></td>
								  <td><?php echo $row['spoj']['spojName']; ?></td>
								  <td><?php echo $row['spoj']['spojPoints']; ?></td>
								  <td><?php echo $row['spoj']['spojProblems']; ?></td>
								  <td><?php echo $row['spoj']['spojScore']; ?></td>
								  <td><?php echo $row['interviewbit']['interviewbitName']; ?></td>
								  <td><?php echo $row['interviewbit']['interviewbitRating']; ?></td>
								  <td><?php echo $row['interviewbit']['interviewbitScore']; ?></td>
								  <td><?php echo $row['totalScore']['totalScore']; ?></td>
							<!--  <td><span class="badge-pending">Invalid</span></td> -->
								
								  	
								</tr>
								<?php  }   ?>
                  
                </tbody>-->
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </main>
   
  </div>
</div>
<!-- Chart library -->
<script src="includes/elegant/plugins/chart.min.js"></script>
<script src="includes/elegant/plugins/feather.min.js"></script>
<script src="includes/elegant/js/script.js"></script>
</body>


<?php 
	
	
		
	function getDataToPrint($array, $order){
		
		function asc($a, $b) {
			global $columnName ,$subcolumn;
			$constraint1 = $columnName;
			$constraint2 = $subcolumn;
            return strnatcmp($a[$constraint1][$constraint2],$b[$constraint1][$constraint2]); 
        }
		function desc($a, $b) {
			global $columnName ,$subcolumn;
			$constraint1 = $columnName;
			$constraint2 = $subcolumn;
			//echo $constraint1 . " " .$constraint2;
            return strnatcmp($b[$constraint1][$constraint2],$a[$constraint1][$constraint2]); 
        }
		
		if(strnatcmp($order, "desc")== 0){
			usort($array, 'desc' );
		}
		else usort($array, 'asc');
		
		return $array;
	}

?>
<?php include('includes/footer.php');?>
</html>