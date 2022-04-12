<?php 
include_once('../config.php'); 
include_once('tete.php');
include_once('entete.php');
include_once('php/fonctions.php');

if (@url_custom_encode($_GET['id'])) {
  $id1 = $_GET['id'];
  $id_categorie = $bdd->prepare("SELECT * FROM categorie WHERE id = ?");
  $id_categorie->execute(array($id1));

  $id_categorie1 = $id_categorie->fetch()['nom_cat'];
  $re = "SELECT *,photo.nom base_id FROM photo LEFT JOIN ref ON ref.livre = photo.nom WHERE ref.cat = ?";
  $exec = array($id_categorie1);
}

if (@url_custom_encode($_GET['id2'])) {
  $id2 = $_GET['id2'];
  $id_souscategorie = $bdd->prepare("SELECT * FROM mid_cat WHERE id = ?");
  $id_souscategorie->execute(array($id2));
  $id_souscategorie1 = $id_souscategorie->fetch()['cat'];

  $re .= " AND ref.mid = ? ";
  $exec = array($id_categorie1,$id_souscategorie1);
}

$ref = $bdd->prepare("SELECT * FROM ref WHERE cat = ? ");
$ref->execute(array($id_categorie1));
$r = $ref->fetch();

$livre = $bdd->prepare($re);
$livre->execute($exec);

// $l = $livre->rowCount();
// var_dump($exec);
// var_dump($l);
 ?><br><br><br>

 <div align="center">
   <h1 style="text-transform:uppercase;"><?=$r['cat']?></h1><br>
 </div>
    <section id="why-us" class="why-us" style="text-align: center;">
      <div class="container">

        <div class="row">
          <?php while($l = $livre->fetch()){?>
          <div class="col-lg-4 mt-lg-0">
      <a href="">
            <div class="box">
              <p ><span style="font-size: 13px;"><?=$l['mid']?></span></p>
              <h4 style="text-transform: uppercase;"><?=$l['nom']?></h4>
              <p><?=conversion($l['taille'])?> ko</p>
            </div>
          <?php if(isset($ps['pseudo'])){ ?>
        <a class="getstarted scrollto" href="../livres/<?=$l['photo']?>" download="<?=$l['nom']?>">Telecharger ce fichier</a>
          <?php } else{?>
            <a style="color:red;" href="connexion.php">Connectez-vous pour telecharger ce fichier</a>
          <?php } ?>
          </div>
        <?php } ?>
        </a>


        </div>

      </div>
    </section> 