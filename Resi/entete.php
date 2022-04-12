<?php include_once('../config.php');?>
<?php include_once('tete.php');
include_once('php/fonctions.php');
$cat = $bdd->query("SELECT * FROM categorie ORDER BY id DESC");
$souscategories = $bdd->prepare("SELECT * FROM mid_cat WHERE nom = ?");

if (isset($_SESSION['pseudo'])) {
  $psel = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
  $psel->execute(array($_SESSION['pseudo']));
  if ($psel->rowCount() > 0) {
    $ps = $psel->fetch();  
  }
}

?>


  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">
      
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
   <!--    <a href="home/in.pf=df" download="nom du livre">
  <button>
    telecharger
  </button>
</a> -->
      <nav id="navbar" class="navbar" >
        <ul>
          <?php 
           ?>
          <?php while($c = $cat->fetch()){ 
            $link1 = "href= biblioteque.php?id=".$c['id']."";
              $souscategories->execute(array($c['nom_cat']));
              if ($souscategories->rowCount() == 0) {
                  echo "<li><a  class=\"nav-link scrollto active\" $link1 >".$c['nom_cat']."</a></li>";
              }else{
                    echo "<li class=\"dropdown\"><a href=\" \"><span>".$c['nom_cat']."</span> <i class=\"bi bi-chevron-right\"></i></a> 
                  <ul>";
                while($sc = $souscategories->fetch())
                {
                    $link1 = "href= biblioteque.php?id=".$c['id']."&id2=".$sc['id']."";
                    echo"<li><a $link1>".$sc['cat']."</a></li>";   
                }
              echo  "</ul>
                          </li>";               
          } 
            ?>
          <?php } ?>
          <?php if(isset($ps['pseudo'])){ ?>
            
            <!--   <li><a class="getstarted scrollto" href="deconnexion.php">Deconnexion</a></li>
              <?php }else{ ?>
                <li><a class="getstarted scrollto" href="connexion.php">Connexion</a></li>
              <?php } ?>
              <li><a  href="#about"><i style="font-size:40px;" class="bi bi-search"></i></a></li> -->
            
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
