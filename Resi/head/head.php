<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog paul</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">


<style type="text/css">
	p{
		letter-spacing: 2px;
	}
</style>
</head>
<body>
	<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="forum.php">FATHE.   <?php if(isset($_SESSION['id'])) { ?><p style="font-size:10px; color: greenyellow;">Vous etes connectes <i class="fa fa-check"></i></p><?php } ?></a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="forum.php">Forum</a></li>         
          <?php if(isset($_SESSION['id'])){ ?><li><a class="getstarted scrollto" href="deconnexion.php">deconnexion</a></li><li><a class="getstarted scrollto" href="profil.php">Mon Profil</a></li><?php } else{  ?><li><a class="getstarted scrollto" href="connexion.php">Connexion</a></li>
        <?php } ?>
          <li><a class="getended scrollto" href="inscription.php">Inscription</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
<br><br><br><br><br><br><br>

