<?php include_once('config.php');
 include_once('head.php');
  include_once('aside.php');
$req = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
$req->execute(array($_SESSION['email']));
$user = $req->fetch();
if ($user['user_admin'] == 1) {
  $client = $bdd->query("SELECT * FROM users ORDER BY id DESC");

 ?>				
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">			
				<!-- Page Content -->
                <div class="content container-fluid">				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Clients</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Clients</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Client</a>				
								</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#edit_client"><i class="fa fa-plus"></i> Edit Client</a>				
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					

					
					<div class="row staff-grid-row">
						<?php while($c = $client->fetch()){ ?>
						<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="client-profile.php?id=<?=$c['id']?>" class="avatar"><img alt="" src="assets/img/profiles/<?php echo $c['photo']?>"></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>																	
								</div>
								<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.php"><?=$c['email']?></a></h4>
								<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.php"><?=$c['pseudo']?></a></h5>
								<div class="small text-muted"><?=$c['stat']?></div>
								<a href="client-profile.php?id=<?=$c['id']?>" class="btn btn-white btn-sm m-t-10">View Profile</a>
							</div>
						</div>
					<?php } ?>

						</div>

					</div>
                </div>
				<!-- /Page Content -->
			
				<!-- Add Client Modal -->
				<div id="add_client" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Client</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="" autocomplete="off">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="email">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Pseudo</label>
												<input class="form-control" type="text" name="pseudo">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Password</label>
												<input name="pass" class="form-control" type="password">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Confirm Password</label>
												<input class="form-control" name="pass2" type="password">
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button type="submit" name="valid" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Client Modal -->
				
				<!-- Edit Client Modal -->
				<div id="edit_client" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Client</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
																<form method="post" action="" autocomplete="off">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="nemail">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Pseudo</label>
												<input class="form-control" type="text" name="npseudo">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Password</label>
												<input name="npass" class="form-control" type="password">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Confirm Password</label>
												<input class="form-control" name="npass2" type="password">
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button type="submit" name="nvalid" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Client Modal -->
				
				<!-- Delete Client Modal -->
				<div class="modal custom-modal fade" id="delete_client" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Client</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Client Modal -->
				
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
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
<?php }
else
	header("Location:error-404.php");
 ?>