<?php 
include_once('config.php');
$req = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
$req->execute(array($_SESSION['email']));
$user = $req->fetch();
if ($user['user_admin'] == 1) {
$req2 = $bdd->query("SELECT * FROM users");
$req3 = $bdd->query("SELECT * FROM photo");
$req4 = $bdd->query("SELECT * FROM categorie");
$req5 = $bdd->query("SELECT * FROM mid_cat");
 ?>


						<div class="row">
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
									<div class="dash-widget-info">
										<h3><?=$req4->rowCount()?></h3>
										<span>Categories</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-clipboard"></i></span>
									<div class="dash-widget-info">
										<h3><?=$req5->rowCount()?></h3>
										<span>mid-categories</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-book"></i></span>
									<div class="dash-widget-info">
										<h3><?=$req3->rowCount()?></h3>
										<span>Livres</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa fa-users"></i></span>
									<div class="dash-widget-info">
										<h3><?=$req2->rowCount()?></h3>
										<span>Users</span>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<?php }
					
					 ?>