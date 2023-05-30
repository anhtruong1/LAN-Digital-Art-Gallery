<!--header-->
            <div class="header">
                <div class="container">
                    <div class="header-top">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                      </button>
                                    <div class="navbar-brand">
                                        <h1><a href="index.php"><img src="images/logo_LAN_black.png" width="235" height="75" alt="LAN" /></a></h1>
                                    </div>
                                </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                              <ul class="nav navbar-nav">
                                    <li><a href="index.php">Home</a></li>
									 <li><a href="news.php">News</a></li>
									                                     <li><a href="event.php">Event</a></li>

									<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Shop
									</a>
								<ul class="dropdown-menu">
								<li><a href="art-collection.php">Art Collection</a></li>
								<li><a href="art-bidding.php">Art Bidding</a></li>
								</ul>
								</li>
                                    <li><a href="partner.php">Partner</a></li>

                                    <li><a href="about.php">About</a></li>
                                    <li><a href="contact.php">Contact</a></li>
									<?php if(!empty($_SESSION['lanempid'])) {?>
									<li><a href="emp/dashboard.php">Management</a></li>
									<?php } if(!empty($_SESSION['lanuserid'])) { ?>
									<li><a href="user/dashboard.php">User CP</a></li>
									<?php } ?>
									<?php
									if(empty($_SESSION['lanempid'] OR $_SESSION['lanuserid'])) 
									{?>
																		<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Login
									</a>
								<ul class="dropdown-menu">
								<li><a href="emp/index.php">Employee</a></li>
								<li><a href="user/index.php">User</a></li>
								</ul>
								</li>
                                </ul>
									<?php }else{ ?>
								<li><a href="logout.php">Log Out</a></li>
									<?php } ?>
                            </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
                        </nav>

                    </div>
                </div>
							<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery(".nav.navbar-nav li").click(function(){
        jQuery(".nav.navbar-nav li").removeClass('active');
        jQuery(this).addClass('active');
        })
var loc = window.location.href;
 jQuery(".nav.navbar-nav li").removeClass('active');
    jQuery(".nav.navbar-nav li a").each(function() {
        if (loc.indexOf(jQuery(this).attr("href")) != -1) {

            jQuery(this).closest('li').addClass("active");
        }
    });
}); 
</script>
            </div>