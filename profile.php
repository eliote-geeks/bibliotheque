<?php include_once('config.php');
 include_once('head.php');
  include_once('aside.php');
  $req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $req->execute(array($_SESSION['id']));
  $req2 = $req->fetch();
 ?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<!-- Page Content -->
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Profile</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Profile</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
												<?php if(!empty($req2['photo'])){ ?>
												<a href="#"><img alt="" src="assets/img/profiles/<?php echo $req2['photo']?>"></a>
											<?php } ?>
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 mb-0"><?=$req2['first']?></h3>
														<small class="text-muted"><?=$req2['last']?></small>
														<div class="staff-id">Employee ID : FT-000<?=$req2['id']?></div>
														<!-- <div class="small doj text-muted">Date of Join : 1st Jan 2013</div> -->														
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Phone:</div>
															<div class="text"><a href=""><?=$req2['num']?></a></div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><a href=""><?=$req2['email']?></a></div>
														</li>
														<li>
															<div class="title">Address:</div>
															<div class="text"><?=$req2['address']?></div>
														</li>
														<li>
															<div class="title">Pseudo:</div>
															<div class="text"><?=$req2['pseudo']?></div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card tab-box">
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs nav-tabs-bottom">
									<li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile
									<?php if($req2['user_admin'] == 1){ ?>
									 <small class="text-danger">(Admin Only)</small></a></li>
									<?php }else{ ?>
									<small class="text-danger">(User Only)</small></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>



				<!-- Profile Modal -->
				<div id="profile_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Profile Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post" autocomplete="off">
									<div class="row">
										<div class="col-md-12">
											<div class="profile-img-wrap edit-img">
												<img class="inline-block" src="assets/img/profiles/<?php echo $req2['photo'] ?>" alt="user">
												<div class="fileupload btn">
													<span class="btn-text">edit</span>
													<input class="upload" type="file">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>First Name</label>
														<input type="text" class="form-control" value="<?=$req2['first']?>" name="first">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Last Name</label>
														<input type="text" class="form-control" value="<?=$req2['last']?>" name="last">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>pseudo</label>
														<div class="cal-icon">
															<input class="form-control " type="text" value="<?=$req2['pseudo']?>" name=pseudo>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>number</label>
															<input class="form-control" value="<?=$req2['num']?>">		
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" value="<?=$req2['address']?>">
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
				<!-- /Profile Modal -->
					
						</div>
						<!-- /Bank Statutory Tab -->
						
					</div>
                

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
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Tagsinput JS -->
		<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>