<?php include_once('config.php');
 include_once('head.php');
  include_once('aside.php');
  $activite =$bdd->query("SELECT * FROM activite ORDER BY id DESC");
 ?>				
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content">
					
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Activities</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Activities</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="activity">
								<div class="activity-box">
									<ul class="activity-list">
										<?php while($a = $activite->fetch()){ ?>
										<li>
											<div class="activity-user">
												<a href="profile.html" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
													<img src="assets/img/profiles/avatar-01.jpg" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name"><?=$a['activite']?> <a href="#">Hospital Administration</a>
													<span class="time"><?=$a['date_note']?></span>
												</div>
											</div>
										</li>
									<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
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