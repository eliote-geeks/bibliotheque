<?php 
include_once('config.php');
if (isset($_GET['del'])) {
	$id = htmlspecialchars($_GET['del']);
	$req  = $bdd->prepare("SELECT * FROM photo WHERE id =?");
	$req->execute(array($id));
	if ($req->rowCount() > 0) {
		$re = $req->fetch();
		$delete1 = $bdd->prepare("DELETE FROM ref WHERE livre = ?");
		$delete1->execute(array($re['nom']));
		
		$delete = $bdd->prepare("DELETE FROM photo WHERE id= ?");
		$delete->execute(array($id));
		if ($delete) {
			header('Location:file-manager.php');
		}
	}
	else{
		die('error');
	}
}

 ?>