<?php include_once('config.php');
 include_once('head.php');
  include_once('aside.php');


$req = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
$req->execute(array($_SESSION['email']));
$user = $req->fetch();
if ($user['user_admin'] == 1) {

    $req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $req->execute(array($_SESSION['id']));
  $req2 = $req->fetch();
  if (isset($_POST['valid'])) {
  	$pass = sha1(htmlspecialchars($_POST['pass']));
  	$pass2 = sha1(htmlspecialchars($_POST['pass2']));
  	$pass3 = sha1(htmlspecialchars($_POST['pass2']));

  	$r = $bdd->prepare("SELECT * FROM menbre WHERE password = ?");
  	$r->execute(array($pass));
  	if ($r->rowCount() > 0) {
  		if (($pass2 == $pass)  OR ($pass3 == $pass)) {
  			$erreur = "Votre nouveau mot de passe ne peut pas etre identique a l'ancien";
  		}
  		if (($pass2 == $pass3) AND (strlen($pass2) > 6) AND  (strlen($pass3) > 6)) {
  			$up = $bdd->prepare("UPDATE menbre SET password = ? WHERE id = ?");
  			$up->execute(array($pass,$req2['id']));
  			$reussie = "Votre mot de passe a ete modifie avec success";
  		}else{
  			$erreur = "vos mots de passe doivent depasser les 6 caracteres et doivent etre identiques";
  		}
  	}
  	else{
  		$erreur = "Ce mot de passe ne correspond pas a l'ancien";
  	}
  }
 ?>	
			
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 offset-md-3">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Change Password</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							<form action="" method="post" autocomplete="off">
								<?php if(isset($reussie)){ ?>
									<p class="alert alert-success"><?=$reussie?></p>
								<?php } ?>
								<?php if(isset($erreur)){ ?>
									<p class="alert alert-danger"><?=$erreur?></p>
								<?php } ?>
								<div class="form-group">
									<label>Old password</label>
									<input type="password" class="form-control" name="pass">
								</div>
								<div class="form-group">
									<label>New password</label>
									<input type="password" class="form-control" name="pass2">
								</div>
								<div class="form-group">
									<label>Confirm password</label>
									<input type="password" class="form-control" name="pass3">
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" type="submit" name="valid">Update Password</button>
								</div>
							</form>
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
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>

    </body>
</html><?php }
exit(); ?>