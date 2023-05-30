<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>LAN - Digital Arts Network | Home Page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</head>
<body>
		<?php include_once('includes/header.php');?>
			<div class="header-banner">
				<div class="container">
					<div class="head-banner">
						<h3>Visit Haarlem ?</h3>
						<p>A beautiful historic city center, famous museums, shops, restaurants and the beach around the corner: welcome to Haarlem, the city that has everything. From hidden courtyards from bygone times to trendy concept stores. From medieval church to terrace on the water. From Dutch Masters to French star chefs. From antique market to pop concert. Fancy a memorable day out? Visit Haarlem and be surprised by the sights, boutiques and picturesque squares, by the old and contemporary artists, the Burgundian atmosphere and the rich history.</p>
					</div>
					<div class="banner-grids">
						<div class="col-md-6 banner-grid">
							<h4>Event</h4>
							<p>Looking for an exhibition or festival to visit ? Check out at out event pages</p>
						</div>
						<div class="col-md-6 banner-grid">
						<h4>Shop</h4>
							<p>Looking for art product to buy or bid ? Check out at our shop pages</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!--header-->
			<!--welcome-->
			<div class="content">
				<div class="welcome">
					<div class="container">
						<h2>welcome to Haarlem</h2>
							<div class="welcome-grids">
								
								<?php 
 $query=mysqli_query($con,"select * from partner order by rand() limit 4");
 while ($row=mysqli_fetch_array($query)) {
 ?>
								<div class="col-md-3 welcome-grid" >
									<img src="images/<?php echo $row['Image'];?>" width='220' height='200' alt=" " class="img-responsive" />
									<div class="wel-info">
										<h4><a href="partner-details.php?id=<?php echo $row['ID'];?>"><?php echo $row['Name'];?></a></h4>
										<p><em>(<?php echo $row['Category'];?>)</em></p>
										<p><?php echo strip_tags(substr($row['Description'],0,100));?>...</p>
									</div>
								</div>
								
<?php }?>
								<br>
							</div>
					</div>
				</div>
			<!--welcome-->
			
				<!--animals-->
					<div class="animals">
						<div class="container">
							<h3>Partner</h3>
							<div class="clients">
								<ul id="flexiselDemo3">
									<?php 
 $query=mysqli_query($con,"select * from partner");
 while ($row=mysqli_fetch_array($query)) {
 ?>
									<li>      <a href="partner.php">
<img src="images/<?php echo $row['Image'];?>" width='220' height='200' alt=" " class="img-responsive" />
</a></li><?php }?>
								</ul>
									<script type="text/javascript">
								$(window).load(function() {
									
								  $("#flexiselDemo3").flexisel({
										visibleItems: 5,
										animationSpeed: 1000,
										autoPlay: true,
										autoPlaySpeed: 3000,    		
										pauseOnHover: true,
										enableResponsiveBreakpoints: true,
										responsiveBreakpoints: { 
											portrait: { 
												changePoint:480,
												visibleItems: 1
											}, 
											landscape: { 
												changePoint:640,
												visibleItems: 2
											},
											tablet: { 
												changePoint:768,
												visibleItems: 3
											}
										}
									});
									});
								</script>
								<script type="text/javascript" src="js/jquery.flexisel.js"></script>
								<script type="text/javascript">
								$( document ).ready(function() {
    var heights = $(".wel-info").map(function() {
        return $(this).height();
    }).get();

    maxHeight = Math.max.apply(null, heights);

    $(".wel-info").height(maxHeight);
});
</script>
						</div>
					</div>
				</div>
			<!--models-->
		
				
						<!--events-->
						<!--specials-->
				 <?php include_once('includes/special.php');?>
			</div>
			<!--footer-->
			<?php include_once('includes/footer.php');?>
</body>
</html>
