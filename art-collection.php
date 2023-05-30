<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>LAN - Digital Arts Network | Art Collection</title>
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
				<h2>Art Collection</h2>
			</div>
			</div>
	<div class="content">
	<!--gallery-->

			<div class="gallery-section">
				<div align="">
	Sort by: <select class="pagination" name="sort" id="myselect" onchange="sort(this.value);">
	<?php
	if($_GET['sort']){
	switch($_GET['sort']){
      case 'la': ?>
	<option value="la" <?php if($sorting == 'la'):?>selected="selected"<?php endif;?>>Last added</option>
    <option value="lh"  <?php if($sorting == 'lh'):?> selected="selected"<?php endif;?>>Price low - high</option>
    <option value="hl"  <?php if($sorting == 'hl'):?> selected="selected"<?php endif;?>>Price high - low</option>
	<?php break; ?>
    <?php case 'lh': ?>
	<option value="lh"  <?php if($sorting == 'lh'):?> selected="selected"<?php endif;?>>Price low - high</option>
    <option value="hl"  <?php if($sorting == 'hl'):?> selected="selected"<?php endif;?>>Price high - low</option>
	<option value="la" <?php if($sorting == 'la'):?>selected="selected"<?php endif;?>>Last added</option>
	<?php break; ?>
    <?php case 'hl': ?>
	<option value="hl"  <?php if($sorting == 'hl'):?> selected="selected"<?php endif;?>>Price high - low</option>
	<option value="lh"  <?php if($sorting == 'lh'):?> selected="selected"<?php endif;?>>Price low - high</option>
	<option value="la" <?php if($sorting == 'la'):?>selected="selected"<?php endif;?>>Last added</option>
	<?php break;  }
	}else{ ?>
	<option value="la" <?php if($sorting == 'la'):?>selected="selected"<?php endif;?>>Last added</option>
    <option value="lh"  <?php if($sorting == 'lh'):?> selected="selected"<?php endif;?>>Price low - high</option>
    <option value="hl"  <?php if($sorting == 'hl'):?> selected="selected"<?php endif;?>>Price high - low</option>
	<?php } ?>
</select>
</div>
					<div class="container">
					<div class="welcome-grid">
			<?php 
			if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        // Formula for pagination
		if($_GET['sort']){
  switch($_GET['sort']){
      case 'la':
	    $no_of_records_per_page = 8;
		$offset = ($pageno-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL";
		$ret1=mysqli_query($con,"SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL");
		$total_rows = mysqli_fetch_array($ret1)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);
		$query=mysqli_query($con,"SELECT a.ID as ArtID,a.Name as ArtName,a.Price as Price, ar.Name as ArtistName,Image FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL order by a.ID desc LIMIT $offset, $no_of_records_per_page");
      break;
       case 'lh': 
	    $no_of_records_per_page = 8;
		$offset = ($pageno-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL";
		$ret1=mysqli_query($con,"SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL");
		$total_rows = mysqli_fetch_array($ret1)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);
		$query=mysqli_query($con,"SELECT a.ID as ArtID,a.Name as ArtName,a.Price as Price, ar.Name as ArtistName,Image FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL order by a.Price,a.ID desc LIMIT $offset, $no_of_records_per_page");
       break;
      case 'hl': 
	  	$no_of_records_per_page = 8;
		$offset = ($pageno-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL";
		$ret1=mysqli_query($con,"SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL");
		$total_rows = mysqli_fetch_array($ret1)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);
		$query=mysqli_query($con,"SELECT a.ID as ArtID,a.Name as ArtName,a.Price as Price, ar.Name as ArtistName,Image FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL order by a.Price desc,a.ID desc LIMIT $offset, $no_of_records_per_page");
       break;
		}
		}else{
        $no_of_records_per_page = 8;
		$offset = ($pageno-1) * $no_of_records_per_page;
		$total_pages_sql = "SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL";
		$ret1=mysqli_query($con,"SELECT COUNT(*) FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL");
		$total_rows = mysqli_fetch_array($ret1)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);
		$query=mysqli_query($con,"SELECT a.ID as ArtID,a.Name as ArtName,a.Price as Price, ar.Name as ArtistName,Image FROM art a INNER JOIN artist ar ON a.ArtistID = ar.ID WHERE a.Review IS NULL ORDER BY a.ID DESC LIMIT $offset, $no_of_records_per_page");
		}
 while ($row=mysqli_fetch_array($query)) {
 ?>
								<div class="col-md-3 welcome-grid" >
									<img src="images/<?php echo $row['Image'];?>" width='220' height='200' alt=" " class="img-responsive" />
									<div class="wel-info">
										<h4><a href="art-details.php?id=<?php echo $row['ArtID'];?>"><?php echo $row['ArtName'];?></a></h4>
										<?php echo $row['ArtistName'];?><br>
										<h4 style="color:white;"><?php echo $row['Price'];?>€</h4>
									</div>
		<br></div><?php }?>
				
				<div class="clearfix"> </div>
			</div>
	<div align="center">
    <ul class="pagination" >
        <li><a href="?pageno=1"><strong>First></strong></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev></strong></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next></strong></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
    </ul>
</div>
	<div align="center">
    <ul class="pagination" >
        <li><strong>Page <?php echo $pageno ; ?> / <?php echo $total_pages; ?></strong></li>
    </ul>
</div>
		</div>
	</div>
<!--gallery-->
<!--specials-->
		<?php include_once('includes/special.php');?>
			</div>
		<?php include_once('includes/footer.php');?>
		<script type="text/javascript">
  function sort(option){

   window.location = window.location.pathname+'?sort='+option;
}
</script>
								<script type="text/javascript">
								$( document ).ready(function() {
    var heights = $(".wel-info").map(function() {
        return $(this).height();
    }).get();

    maxHeight = Math.max.apply(null, heights);

    $(".wel-info").height(maxHeight);
});
</script>
</body>

</html>