<?php 
include_once('../config.php');
if (isset($_POST['valid'])) {
	if (isset($_POST['pseudo'],$_POST['email'],$_POST['pass'],$_POST['pass2']) AND !empty($_FILES['photo'])) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$email = htmlspecialchars($_POST['email']);
		$mdp = htmlspecialchars($_POST['pass']);
		$mdp2 = htmlspecialchars($_POST['pass2']);
		// $ip = $_SERVER['REMOTE_ADDR'];
		$pseudolen = strlen($pseudo);
		if ($pseudolen >= 4)
		{
			 if(($pseudolen<=20)) {
				if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
					$mail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
					$mail->execute(array($email));
					if ($mail->rowCount() == 0) {
						if ($mdp == $mdp2) {
							$ps = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
							$ps->execute(array($pseudo));
							if (($ps->rowCount() == 0)) {
								$lk = 12;
								$k = "";
								for ($i=0; $i < $lk; $i++) { 
									$k .= mt_rand(0,9).str_shuffle("le roi paul");
								}					
								  $photo = htmlspecialchars($_FILES['photo']['name']);
								  $file_tmp_name = $_FILES['photo']['tmp_name'];
								  $photo_verify =  move_uploaded_file($file_tmp_name,"../assets/img/profiles/$photo");	
								  if ($photo_verify) {
									$pass = sha1($mdp);
									$insert = $bdd->prepare("INSERT INTO users(photo,pseudo,email,password) VALUES(?,?,?,?)");
									$insert->execute(array($photo,$pseudo,$email,$pass));						

									$upt = $bdd->prepare("UPDATE users SET stat =  1 WHERE pseudo = ?");
									$upt->execute(array($pseudo));
								header('Location:connexion.php');					  	
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
			$erreur = "Votre pseudo doit etre superieur a 4 caracteres minimum";
		}

	}
	else{
		$erreur = "Tous les champs doivent etre rempli";
	}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Inscription</title>
        <link rel="stylesheet" href="assets/css/ins.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width-device=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            <div class="title" style="margin-top: 100px;">Inscription</div>
            <form action="#" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="user-details">
                
                <div class="input-box">
                	<span class="details"> Photo de profil</span>
                	<input type="file" required accept="image/*" name="photo" onchange="loadFile(event)">
									<img id="output"/>
								</div>

                    <div class="input-box">
                        <span class="details"> Pseudo</span>
                        <input style="width:650px;" type="text" name="pseudo" placeholder="Entrez votre Pseudo" required>   
                    </div>

                     <div class="input-box">
                        <span class="details"> Addresse email</span>
                        <input style="width:650px;" type="text" name="email" placeholder="Entrez votre addresse email" required>   
                    </div>

                    <div class="input-box">
                        <span class="details"> Mot de passe</span>
                        <input style="width:650px;" id="input" type="password" name="pass" placeholder="entrez votre mot de passe" required>   
                    </div>
                              <div class="input-box">
                        <span class="details">Confirmer votre Mot de passe</span>
                        <input style="width:650px;" type="password" name="pass2" placeholder="entrez votre mot de passe" required>   
                    </div>
                                       <div >
                        <input type="radio" name="gender" id="dot-1">
                        <div class="category">
                            <p align="left">      
                                En validant ce formulaire vous acceptez  <a href="">les conditions generales d'utilisations et les accords de confidentialite</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php if(isset($erreur)) {  ?><p style="background-color: red; color: white;"><?= $erreur?></p><?php } ?>
                <div class="button">
                    <input type="submit" name="valid" value="Inscription"><br>
                    <br><i style="margin-left: 200px;">Je suis inscris</i>
                <a href="connexion.php"> Connexion</a>
                </div>
            </form>
        </div>
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
