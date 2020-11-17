<?php
session_start();
$email = $_SESSION["email"];
$name = $_SESSION["name"];

?>
<header class="main-header main-header-overlay" data-react-to-megamenu="true" data-sticky-header="true" data-sticky-options='{ "stickyTrigger": "first-section" }'>
		
			<div class="mainbar-wrap">
				<div class="megamenu-hover-bg"></div><!-- /.megamenu-hover-bg -->
				<div class="container-fluid mainbar-container">
					<div class="mainbar">
						<div class="row mainbar-row align-items-lg-stretch px-4">
							
							<div class="col">
								<div class="navbar-header">
									<a class="navbar-brand" href="index.php" rel="home">
                                    <span class="navbar-brand-inner">
                                    <img class="logo-dark" src="./images/logoBlack.png" alt="Ave HTML Template" style="width: 100px;height:30px">
                                    <img class="logo-sticky" src="./images/logoBlack.png" alt="Ave HTML Template" style="width: 100px;height:30px">
                                    <img class="mobile-logo-default" src="./images/logoBlack.png" alt="Ave HTML Template" style="width: 100px;height:30px">
                                    <img class="logo-default" src="./images/logo.png" alt="Ave HTML Template" style="width: 100px;height:30px">
                                    </span>
									</a>
									<button type="button" class="navbar-toggle collapsed nav-trigger style-mobile" data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false" data-changeclassnames='{ "html": "mobile-nav-activated overflow-hidden" }'>
										<span class="sr-only">Toggle navigation</span>
										<span class="bars">
											<span class="bar"></span>
											<span class="bar"></span>
											<span class="bar"></span>
										</span>
									</button>
								</div><!-- /.navbar-header -->
							</div><!-- /.col -->
							
							
							<div class="col">
								
								<div class="collapse navbar-collapse" id="main-header-collapse">
									
								<ul id="primary-nav" class="main-nav nl_index_main-nav nav align-items-lg-stretch justify-content-lg-start" data-submenu-options='{ "toggleType":"fade", "handler":"mouse-in-out" }' data-localscroll="true">
                 
                                    <!-- <li class="nl_searchBarMob_profileLI">
                                        <a style="padding: 0px;">
                                            <span class="link-icon"></span>
                                            <span class="link-txt">
                                            <span class="link-ext"></span>
                                                <span class="txt">
                                                    <b>Admin Dashboard</b>
                                                </span>
                                            </span>
                                        </a>
                                    </li> -->
                                    <li>
                                    <a href="adminDashboardAdminUsers.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Admins
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="adminDashboardUsers.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Users
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="adminDashboardServices.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                            Services
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="adminDashboard_withdrawal_request.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Withdrawals
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a>
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                More
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                    <ul class="nav-item-children">
                                        
                                <li>
                                    <a href="adminDashboardBlog.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Comments
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="adminDashboardProducts.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Products
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="adminAdvertPost.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Advert
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="admin_newsletter.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Newsletter
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="adminDashboardBulkSms.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Bulk SMS
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="adminNotice.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Notice
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../api/admin_logout.php">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
                                            <span class="link-ext"></span>
                                            <span class="txt">
                                                Logout
                                                <span class="submenu-expander">
                                                    <i class="fa fa-angle-down"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>

                            </ul><!-- /#primary-nav  -->
								
								</div><!-- /#main-header-collapse -->
								
							</div><!-- /.col -->
						
							<div class="col text-right">
                            
								<div class="header-module">
									<ul class="social-icon social-icon-sm">
										<li>
											<a href="https://fb.me/diligentmartofficial" target="_blank"><i class="fa fa-facebook"></i></a>
										</li>
										<li>
											<a href="https://twitter.com/diligentmart?s=09" target="_blank"><i class="fa fa-twitter"></i></a>
										</li>
										<li>
											<a href="https://t.me/Diligentmart" target="_blank"><i class="fa fa-telegram"></i></a>
										</li>
									</ul>
								</div><!-- /.header-module -->
								
							</div><!-- /.col -->
						
						</div><!-- /.mainbar-row -->
					</div><!-- /.mainbar -->
				</div><!-- /.mainbar-container -->
			</div><!-- /.mainbar-wrap -->
			
		</header><!-- /.main-header -->