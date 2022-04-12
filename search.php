<?php include_once('config.php');
 include_once('head.php');
  include_once('aside.php');

if (isset($_GET['search'])) {
	$search = htmlspecialchars($_GET['search']);
	if (explode("'", $search)) {
		$client = $bdd->query('SELECT * FROM users WHERE pseudo LIKE "%'.$search.'%"  OR email LIKE "%'.$search.'%"  ORDER BY id DESC ');					
	}
	else
		$erreur = "Aucun caracterere speciaux dans la recherche";
	
		
}

 ?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Search</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Search</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Content Starts -->
						<div class="row">
							<div class="col-12">
							<?php if(isset($erreur)){ ?>
								<p class="alert alert-danger"><?=$erreur?></p>
							<?php } ?>
								<!-- Search Form -->
								<div class="main-search">
									<form action="#" method="get" action="">
										<div class="input-group">
											<input type="text" class="form-control" name="search">
											<div class="input-group-append">
												<button class="btn btn-primary" type="submit" name="valid">Search</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /Search Form -->
								
								<?php if(isset($_GET['search']) AND !isset($erreur)){ ?>
								<div class="search-result">
									<?php if(isset($client)){ ?>
										<h3>Search Result Found For: <u><?=@$_GET['search']?></u></h3>
										<p><?=@$client->rowCount()?> Results found</p>
								<?php } ?>
								</div>
								
								<div class="search-lists">
									<ul class="nav nav-tabs nav-tabs-solid">										
										<li class="nav-item"><a class="nav-link" href="#results_users" data-toggle="tab">Users</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane show active" id="results_projects">
																				
										<div class="tab-pane" id="results_clients">
										
											<div class="row staff-grid-row">
												<?php if (@$client->rowCount() > 0){ ?>												
												
												<?php while($c = $client->fetch()){ ?>
												<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
													<div class="profile-widget">
														<div class="profile-img">
															<a href="client-profile.php" class="avatar"><img alt="" src="assets/img/profiles/<?php echo $c['photo'] ?>"></a>
														</div>
														<div class="dropdown profile-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														</div>
														</div>
														<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.php"><?=$c['pseudo']?></a></h4>
														<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.php"><?=$c['email']?></a></h5>
														<div class="small text-muted"><?=$c['stat']?></div>
														<a href="client-profile.php" class="btn btn-white btn-sm m-t-10">View Profile</a>
													</div>
												</div>
													<?php } ?>
														<?php } ?>

											</div>
											
										</div>
										
										
									</div>
								</div>
								
							</div>
						</div>
					<!-- /Content End -->
					<?php } ?>
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>