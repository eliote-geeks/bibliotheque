<?php include_once('../config.php'); 
// if (isset($_GET['d'])) {
//   $req_d = $bdd->prepare("SELECT * FROM photo WHERE id = ?");
//   $req_d->execute(array(intval($_GET['d'])));
//   if ($req->rowCount()) {
//     $not = "Un nouveau livre a ete telecharge";
//     $ind = $bdd->prepare("INSERT INTO activite(activite,id_livre,date_note) VALUES(?,?,NOW())");
//     $ind->execute(array($not,intval($_GET['d'])));    
//   }
// }

$reponsesparpages = 9;
$reponsesTotallesReq = $bdd->query("SELECT * FROM photo");
$reponsestotal = $reponsesTotallesReq->rowCount();
$pagesTotales = ceil($reponsestotal/$reponsesparpages);

if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND  $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
}
else{
    $pageCourante = 1;
}

$depart = ($pageCourante - 1) * $reponsesparpages;
$livre = $bdd->query("SELECT * FROM photo ORDER BY date_en DESC LIMIT ".$depart.",".$reponsesparpages);
$ref = $bdd->prepare("SELECT * FROM ref WHERE livre = ?");
 ?>
    <section id="why-us" class="why-us">
      <div class="container">
          <h1 style="text-transform:uppercase; text-align: center;">Acceuil</h1>

        <div class="row">
          <?php while($l = $livre->fetch()){
            $ref->execute(array($l['nom']));
            $r = $ref->fetch();
           ?>
          <div class="col-lg-4 mt-lg-0">
      <a href="">
            <div class="box">
              <p style="font-size: 7px;"><span style="font-size: 13px;"><?=$r['mid']?></span></p>
              <h4 style="text-transform:uppercase;"><?=$l['nom']?></h4>
              <p><?=conversion($l['taille'])?> ko</p>
             <?php if(isset($ps['pseudo'])){ ?>
          <a class="getstarted scrollto" href="../livres/<?=$l['photo']?>?d=<?=$l['id']?>" download="<?=$l['nom']?>">Telecharger ce fichier</a>
          <?php } else{?>
            <a style="color:red;" href="connexion.php">Connectez-vous pour telecharger ce fichier</a>
          <?php } ?>
            </div>
        </a>
          </div>
        <?php } ?>

    <div align="center" style="margin:40px;">
    <?php 
      for ($i=1; $i < $pagesTotales ; $i++) { 
        if($i == $pageCourante){
            echo " page ".$i."  ";
        }
          else{
              echo "<a style='border:1px solid black; padding:5px; background:black; color:white; margin-left:9px;' href='index.php?page=".$i."'>".$i."</a>";
              } 
           }
    ?>
    </div>


        </div>

      </div>
    </section><!-- End Why Us Section -->