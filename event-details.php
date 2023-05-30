<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
{
if(empty($_SESSION['lanuserid'])){
	
$id=$_GET['id'];
echo "<script>alert('Please login to perform this action');</script>" ;	
echo"<script>window.location = 'event-details.php?id=$id';</script>";

}else{
$id=$_GET['id'];
$userid=$_SESSION['lanuserid'];
$tid=$_POST['tid'];
$tam=$_POST['tam'];


if(empty($tid)){
	       echo "<script>alert('There is no ticket available to buy');</script>" ;
	} else{
			$query=mysqli_query($con, "insert into ticket_order(Quantity,TicketID,UserID) value('$tam','$tid','$userid')");
			if ($query){
				echo "<script>alert('Ticker order has been sucessfully placed');</script>" ;
				echo"<script>window.location = 'event-details.php?id=$id';</script>";
			} else {
				echo '<script>alert("Something Went Wrong. Please try again.")</script>';
			}	
		}
	}	
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>LAN - Digital Events Network | Event Details</title>
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
				<h2>Event Details</h2>
			</div>
			</div>
	<div class="content">
	<!--gallery-->
			<div class="gallery-section">
					<div class="container">
					<div class="welcome-grid">
				
				<div class="col-md-6">
					<div>
						<?php 
						$id=$_GET['id'];
 $query=mysqli_query($con,"select * from event where ID='$id'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
						<img src="images/<?php echo $row['Image'];?>" alt=" " class="img-responsive" width="300" height="300"/>
						<br>


					<?php }?>
					</div>	
				</div>
				
				<div class="paragraphs">
  <div class="row">
    <div class="col-md-6">
	<?php 
						$id=$_GET['id'];
 $query=mysqli_query($con,"SELECT * FROM event WHERE ID = '$id'");
 while ($row=mysqli_fetch_array($query)) {
 ?>
      <div class="content-heading clearfix media">
<h2 style="padding-top: 20px"><?php echo $row['Name'];?></h3>

<br>
<strong style="padding-top: 20px">Location: </strong><?php echo $row['Location'];?><br>
<strong style="padding-top: 20px">StartDate: </strong><?php echo $row['StartDate'];?><br>
<strong style="padding-top: 20px">EndDate: </strong><?php echo $row['EndDate'];?><br>
<br>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
						<select id="tid" name="tid" class="form-control" required="true">
            <option value="">Select Ticket</option>
							<?php 
			$eid = $row['ID'];
			$query2=mysqli_query($con,"SELECT * from ticket where eventid='$eid'");
			while ($row2=mysqli_fetch_array($query2)) {
							?>
			<option value="<?php echo $row2['ID'];?>"><?php echo $row2['Title'];?> - <?php echo $row2['Price'];?>€&nbsp;&nbsp;</option>
								<?php } ?>
        </select>
		</div>
<div class="form-group">
						<select id="tam" name="tam" 
          onchange="if(this.options[this.selectedIndex].value=='newAmount'){
              toggleField(this,this.nextSibling);
              this.selectedIndex='0';
          }" class="form-control" required="true">
            <option value="">Select Amount</option>
			            <option value="newAmount">[Other Amount]</option>
            <?php
    for ($i=1; $i<=20; $i++)
    {
        ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
    }
?>
        </select><input name="tam" class="form-control" style="display:none;" disabled="disabled" 
            onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
												</div>
						<br>
<button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure you want to place this order')" name="submit">Buy Ticket</button>
  </form>
<br>
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
			<script type="text/javascript">
	function toggleField(hideObj,showObj){
	  hideObj.disabled=true;        
	  hideObj.style.display='none';
	  showObj.disabled=false;   
	  showObj.style.display='inline';
	  showObj.focus();
	}
	</script>
</body>
</html>