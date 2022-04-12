<?php 
include_once('config.php');
if (isset($_POST['valid'])) {
	if (isset($_POST['first'],$_POST['last'],$_POST['pseudo'],$_POST['num'],$_POST['email'],$_POST['address'],$_POST['pass'],$_POST['pass2']) AND !empty($_FILES['photo'])) {
		$name = htmlspecialchars($_POST['first']);
		$name2 = htmlspecialchars($_POST['last']);
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$num = htmlspecialchars($_POST['num']);
		$email = htmlspecialchars($_POST['email']);
		$address = htmlspecialchars($_POST['address']);
		$mdp = htmlspecialchars($_POST['pass']);
		$mdp2 = htmlspecialchars($_POST['pass2']);
		$ip = $_SERVER['REMOTE_ADDR'];
		$pseudolen = strlen($pseudo);
		$lenght_name = strlen($name);
		$lenght_name2 = strlen($name2);
		if (preg_match("/^[a-zA-Z ]*$/",$name) AND preg_match("/^[a-zA-Z ]*$/",$name2))
		{
			 if(($lenght_name<=255) AND ($lenght_name2<=255) AND ($pseudolen<=50)) {
				if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
					$mail = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
					$mail->execute(array($email));
					if ($mail->rowCount() == 0) {
						if ($mdp == $mdp2) {
							$ps = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ?");
							$ps->execute(array($pseudo));
							if (($ps->rowCount() == 0)) {
								$lk = 12;
								$k = "";
								for ($i=0; $i < $lk; $i++) { 
									$k .= mt_rand(0,9).str_shuffle("le roi paul");
								}					
								  $photo = htmlspecialchars($_FILES['photo']['name']);
								  $file_tmp_name = $_FILES['photo']['tmp_name'];
								  $photo_verify =  move_uploaded_file($file_tmp_name,"./assets/img/profiles/$photo");	
								  if ($photo_verify) {
									$pass = sha1($mdp);
									$insert = $bdd->prepare("INSERT INTO menbre(first,photo,last,pseudo,email,address,num,password,ip,date_en) VALUES(?,?,?,?,?,?,?,?,?,NOW())");
								$insert->execute(array($name,$photo,$name2,$pseudo,$email,$address,$num,$pass,$ip));
								$req = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ?");
								$req->execute(array($pseudo));
								$p = $req->fetch();							
								header('Location:login.php?conn='.$p['id']);					  	
								  }
								  else{
								  	$erreur = "Erreur d'extension";
								  }
						      }
							else{
								$erreur = "Oups votre pseudo existe deja";
							}
						}
						else{
							$erreur = "Oups vos mots de passes ne correspondent pas";
						}
					}
					else{
						$erreur = "Oups cette addresse email exste deja";
					}
				}
				else{
					$erreur = "Adresse email invalide";
				}
			}
			else{
				$erreur = "Veuillez saisir les identifiants valides";
			}
		}
		else{
			$erreur = "Votre nom ou prenom est invalide";
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
        <title>Register </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
		
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
			<div class="account-content">
			
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Register</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
								<?php if(isset($erreur)){ ?>
								<div class="form-group">									
								<input class="form-control alert alert-danger" readonly value="<?=$erreur?>" type="text">
								</div>
							<?php } ?>
								<div class="form-group">
									<label>Photo</label>
									<input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
									<img id="output"/>
								</div>
								<div class="form-group">
									<label>first</label>
									<input class="form-control" name="first" type="text">
								</div>
								<div class="form-group">
									<label>Last</label>
									<input class="form-control" type="text" name="last">
								</div>
								<div class="form-group">
									<label>Pseudo</label>
									<input class="form-control" type="text" name="pseudo">
								</div>

								<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="text" name="email">
								</div>

								<div class="form-group">
									<label>Numero de telephone</label>
									<input class="form-control" type="text" name="num">
								</div>
								<div class="form-group">
									<label>addresse</label>
									<input class="form-control" type="text" name="address">
								</div>

								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="pass">
								</div>
								<div class="form-group">
									<label>Repeat Password</label>
									<input class="form-control" type="password" name="pass2">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" name="valid">Register</button>
								</div>
								<div class="account-footer">
									<p>Already have an account? <a href="login.php">Login</a></p>
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
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
    </body>
</html>