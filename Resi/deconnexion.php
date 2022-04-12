<?php 
include_once('../config.php');
if (isset($_SESSION['pseudo'])) {
    $req = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
    $req->execute(array($_SESSION['pseudo']));
    if ($req->rowCount() > 0) {
        $upt = $bdd->prepare("UPDATE users SET stat =  0 WHERE pseudo = ?");
        $upt->execute(array($_SESSION['pseudo']));
        $_SESSION = array();
        session_destroy();
        header('Location:index.php');        
    }
}
else{
    header('Location:../index.php');
}

 ?>
