<?php 
include_once("../config.php");
include_once("fonctions.php");

if (isset($_POST['form_connexion'])) {
	if (isset($_POST['email'],$_POST['pass']) AND !empty($_POST['email']) AND !empty($_POST['pass'])) {
		$email = htmlspecialchars($_POST['email']);
		$pass = htmlspecialchars($_POST['pass']);
		$pass = sha1($_POST['pass']);
		$req = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
		$req->execute(array($email,$pass));
		if ($req->rowCount() == 1) {
			$user = $req->fetch();
			$_SESSION['id'] = $user['id'];
			$_SESSION['pseudo'] = $user['pseudo'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['stat'] = $user['stat'];
			$upt = $bdd->prepare("UPDATE users SET stat =  1 WHERE pseudo = ?");
			$upt->execute(array($pseudo));
			header('Location:index.php?id='.$_SESSION['id']);
		}	
		else{
			$erreur = "Identifiants incorrects";
		}
	}
	else{
		$erreur = "Tous les champs doivent etre rempli";
	}
}



 ?>