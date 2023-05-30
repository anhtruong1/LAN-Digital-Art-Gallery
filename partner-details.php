<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>LAN - Digital Arts Network | Partner Detail</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<!--lightbox-->
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">
<script src="js/jquery.lightbox.js"></script>
<script>
  // Initiate Lightbox
  $(function() {
    $('.gallery a').lightbox(); 
  });
</script>
<!--lightbox-->
</head>
<body>
<?php include_once('includes/header.php');?>
		<div class="banner-header">
			<div class="container">
				<h2>Partner Detail</h2>
			</div>
			</div>
	<div class="content">
	<!--gallery-->
			<div class="gallery-section">
					<div class="container">
					<div class="welcome-grid">
				
				<div class="col-md-8">
					<div>
						<?php 
						$id=$_GET['id'];
 $query=mysqli_query($con,"select * from partner where ID='$id'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
						<img src="images/<?php echo $row['Image'];?>" alt=" " class="img-responsive" width="300" height="500"/>
						<br>
<h3 style="padding-top: 20px"><?php echo $row['Name'];?></h3>
<br>
<strong style="padding-top: 20px">Category: <?php echo $row['Category'];?></strong><br>
<strong style="padding-top: 20px">Address: <?php echo $row['Address'];?>.</strong><br>
<br>
				<p><?php echo $row['Description'];?></p>

					<?php }?>
					</div>	
				</div>
				<div class="clearfix"> </div>
			</div>
	
		</div>
	</div>
<!--gallery-->
<!--specials-->
		<?php include_once('includes/special.php');?>
			</div>
		<?php include_once('includes/footer.php');?>
</body>
</html>