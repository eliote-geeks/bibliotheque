<?php include_once('config.php'); 

?>
<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="active" href="index.php">Admin Dashboard</a></li>
									<?php if(isset($_SESSION['id'])){ ?>
									<li><a class="active" href="change-password.php?pass=<?=$_SESSION['id']?>">change password</a></li>
								<?php } ?>
								</ul>
							</li>
							<li> 
								<a href="clients.php"><i class="la la-users"></i> <span>Users</span></a>
							</li>

							<li class="submenu">
								<a href="#"><i class="la la-files-o"></i> <span> Library </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="categories.php">Categories</a></li>
									<li><a href="sub-category.php">end categorie</a></li>
									<li><a href="book.php">new book</a></li>
									<li><a href="file-manager.php">file manager</a></li>
								</ul>
							</li>

							<li class="menu-title"> 
								<span>Performance</span>
							</li>
							<li> 
								<a href="activities.php"><i class="la la-bell"></i> <span>Activities</span></a>
							</li>
<!-- 							<li> 
								<a href="settings.php"><i class="la la-cog"></i> <span>Settings</span></a>
							</li> -->
							<li> 
								<a href="candidates.php"><i class="la la-user-shield"></i> <span>Admins</span></a>
							</li>
							<li> 
								<a href="search.php"><i class="la la-search"></i> <span>Search</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->