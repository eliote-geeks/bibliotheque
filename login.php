<?php 
include_once('config.php');

if (isset($_POST['valid'])) {
	if (isset($_POST['identifiant'],$_POST['pass']) AND !empty($_POST['pass']) AND !empty($_POST['identifiant'])) {
		$identifiant = htmlspecialchars($_POST['identifiant']);
		$pass = sha1(htmlspecialchars($_POST['pass']));

		if (filter_var($identifiant,FILTER_VALIDATE_EMAIL)) {
			$req = $bdd->prepare("SELECT * FROM menbre WHERE email = ? AND password = ?");
			$req->execute(array($identifiant,$pass));
		}
		else{
			$req = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND password = ?");
			$req->execute(array($identifiant,$pass));	
		}

		if (($req->rowCount() > 0)) {
			$userinfo = $req->fetch();
    	 		  $_SESSION['id'] = $userinfo['id'];
      			  $_SESSION['first'] = $userinfo['first'];
			      $_SESSION['last'] = $userinfo['first'];
			      $_SESSION['email'] = $userinfo['email'];
			      $_SESSION['photo'] = $userinfo['photo'];
			      $_SESSION['pseudo'] = $userinfo['pseudo'];   
			      $_SESSION['address'] = $userinfo['address'];   
			      $_SESSION['password'] = $userinfo['password'];
			      $_SESSION['date_en'] = $userinfo['date_en'];
   
      header('Location:index.php?id='.$_SESSION['id']);
		}
		else{
			$erreur = "Identifiants incorrectes";
		}
	}
	else{
		$erreur = "Tous les champs doivent etre rempli";
	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content" align="center">
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
					</div>
					<!-- /Account Logo -->
					<?php if(isset($_GET['conn']) AND !empty($_GET['conn'])){ 
						$req1 = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
						$req1->execute(array($_GET['conn']));
						$req3 = $req1->fetch();
					}
						?>
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form action="" method="post" autocomplete="off">
							<?php if(isset($erreur)){ ?>
								<div class="form-group">									
								<input class="form-control alert alert-danger" readonly value="<?=$erreur?>" type="text">
								</div>
							<?php } ?>
								<div class="form-group">
									<label>Email Address or Pseudo</label>
									<input class="form-control" name="identifiant" type="text" <?php if(isset($_GET['conn'])){ ?> value="<?=$req3['email']?>" <?php } ?>>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="forgot-password.php">
												Forgot password?
											</a>
										</div>
									</div>
									<input class="form-control" type="password" name="pass">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" name="valid" type="submit">Login</button>
								</div>
								<div class="account-footer">
									<p>Don't have an account yet? <a href="register.php">Register</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>