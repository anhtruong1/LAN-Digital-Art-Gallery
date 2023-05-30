<?php
session_start();
error_reporting(0);
date_default_timezone_set('Europe/Amsterdam');
include('includes/dbconnection.php');

if(isset($_POST['submit']))
{
if(empty($_SESSION['lanuserid'])){
	
$id=$_GET['id'];
echo "<script>alert('Please login to perform this action');</script>" ;	
echo"<script>window.location = 'art-details.php?id=$id';</script>";

}else{
	
$id=$_GET['id'];
$userid=$_SESSION['lanuserid'];

$query=mysqli_query($con,"SELECT ab.ID as ArtBiddingID,ab.StartDate,ab.EndDate FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID LEFT JOIN art_bidding ab ON a.ID = ab.ArtID WHERE a.ID = '$id'");
while ($row=mysqli_fetch_array($query)) {
	
$abid = $row['ArtBiddingID'];
	 
if(empty($row['ArtBiddingID'] && $row['StartDate'] && $row['EndDate'])){
	$processquery=mysqli_query($con, "insert into art_order(ArtID,UserID) value('$id','$userid')");
		if ($processquery){
           echo "<script>alert('Order has been sucessfully placed');</script>" ;
		   echo"<script>window.location = 'art-collection.php';</script>";
		} else {
	       echo "<script>alert('Something went wrong');</script>" ;}
} else {
	$price=$_POST['price'];
	$processquery=mysqli_query($con, "insert into bid(Price,ArtBiddingID,UserID) value('$price','$abid','$userid')");
		if ($processquery){
           echo "<script>alert('Bid has been sucessfully placed');</script>" ;
		   echo"<script>window.location = 'art-details.php?id=$id';</script>";
		} else {
	       echo "<script>alert('Something went wrong');</script>" ;}
}
}

}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>LAN - Digital Arts Network | Art Details</title>
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
				<h2>Art Details</h2>
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
 $query=mysqli_query($con,"select * from art where ID='$id'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
						<img src="images/<?php echo $row['Image'];?>" alt=" " class="img-responsive" width="300" height="500"/>
						<br>


					<?php }?>
					</div>	
				</div>
				
				<div class="paragraphs">
  <div class="row">
    <div class="col-md-4">
	<?php 
						$id=$_GET['id'];
 $query=mysqli_query($con,"SELECT ab.ID as ArtBiddingID,a.Name as ArtName,a.Price as Price,a.Category,a.Description,a.CreationDate,ab.StartDate,ab.EndDate, ar.Name as ArtistName,Image FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID LEFT JOIN art_bidding ab ON a.ID = ab.ArtID WHERE a.ID = '$id'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
      <div class="content-heading clearfix media">
<h2 style="padding-top: 20px"><?php echo $row['ArtName'];?></h3>

<br>
<strong style="padding-top: 20px">Artist: </strong><?php echo $row['ArtistName'];?><br>
<strong style="padding-top: 20px">Category: </strong><?php echo $row['Category'];?><br>

<?php
if(empty($row['StartDate'] && $row['EndDate']))
{
?>
<strong style="padding-top: 20px">Posting Date: </strong><?php echo $row['CreationDate'];?>
<br><br>
<h4 style="color:black; padding-top: 20px">Price: <?php echo $row['Price'];?>€</h3>
<br>
<form method="post" enctype="multipart/form-data">
<button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure you want to place this order')" name="submit">Buy Now</button>
                                        </form>
<?php } else { ?>
<strong style="padding-top: 20px">Start Date: </strong><?php echo $row['StartDate'];?><br>
<strong style="padding-top: 20px">End Date: </strong><?php echo $row['EndDate'];?>
<br><br>
<h4 style="color:black; padding-top: 20px">Starting Price: <?php echo $row['Price'];?>€</h3>
<h4 style="padding-top: 20px">Highest Bid: <font color="red"><?php 
$abid = $row['ArtBiddingID'];
$query2=mysqli_query($con,"SELECT MAX(b.Price) as highestbid FROM bid b INNER JOIN art_bidding ab ON b.ArtBiddingID = ab.ID WHERE ArtBiddingID = '$abid'");
while ($row2=mysqli_fetch_array($query2)) {
echo $row2['highestbid'];}?>€</font></h3>
<br>
<?php 
$now = date("Y-m-d");
if($now > $row['StartDate'] AND $now < $row['EndDate']){
?>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
 <label for="exampleInputEmail1">Your bid price</label>
<input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp" placeholder="Enter bidding price" value="" required="true">
                                            </div> 
<button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure you want to place this bid')"  name="submit">Bid Now</button>
                                        </form>
<?php } else {?>
<p><em>This bid event is not open or already passed</em></p>
<?php }} ?>
<br>
<?php echo $row['Description'];
}?>

    </div>
	
  </div>
</div>
			</div>
	
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