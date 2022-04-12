<?php include_once('config.php');
 include_once('head.php');
  include_once('aside.php');
$req = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
$req->execute(array($_SESSION['email']));
$user = $req->fetch();
if ($user['user_admin'] == 1) {

$zonemodif = 0;
if (isset($_POST['cat_ok'])) {
	if (isset($_POST['categorie']) AND !empty($_POST['categorie'])) {
			$categorie = htmlspecialchars($_POST['categorie']);
			$req2 = $bdd->prepare("SELECT * FROM mid_cat WHERE nom = ? ");
			$req2->execute(array($categorie));			
	}
	else{
		die("Erreur");
	}
}									

if (isset($_GET['edit'])) {
	$edit = intval($_GET['edit']);
	$ve = $bdd->prepare("SELECT * FROM photo WHERE id = ?");
	$ve->execute(array($edit));
	if ($ve->rowCount() > 0) {
		$livre = $ve->fetch();
		$req4  = $bdd->prepare("SELECT * FROM ref WHERE livre = ?");
		$req4->execute(array($livre['nom']));
		$req5 = $req4->fetch();
		$zonemodif = 1;
	}
	else{
		header('Location:index.php');
	}
}

if (isset($_POST['book_send'])) {
	if (isset($_POST['souscategorie'],$_POST['book']) AND !empty($_POST['souscategorie']) AND !empty($_POST['book']) AND !empty($_FILES['photo']) AND !empty($_POST['description'])) {
		$souscategorie = htmlspecialchars($_POST['souscategorie']);
		$book = htmlentities($_POST['book']);
		$description = htmlspecialchars($_POST['description']);
	    $photo = htmlspecialchars($_FILES['photo']['name']);
	    $file_tmp_name = $_FILES['photo']['tmp_name'];
	    $taille = $_FILES['photo']['size'];
	    $ty = "";
	    $vl = $bdd->prepare("SELECT * FROM photo WHERE nom = ?");
	    $vl->execute(array($book));
	    if ($vl->rowCount() > 0) {
	    	die("Erreur ce livre existe deja");
	    }

		    $req = $bdd->prepare("SELECT * FROM mid_cat WHERE cat = ?");
		    $req->execute(array($souscategorie));
		    if ($req->rowCount() > 0) {
		    	$id_cat = $req->fetch()['nom'];
				$move =  move_uploaded_file($file_tmp_name,"./livres/$photo");
				if ($move) {
					if ($zonemodif == 0) {
					if ($_FILES['photo']['type'] == 'application/pdf') {
							$ty = "fa fa-file-pdf-o";
					}
					if ($_FILES['photo']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
						$ty = "fa fa-file-word-o";
					}

   				$insert = $bdd->prepare("INSERT INTO photo(nom,type,photo,description,taille,date_en) VALUES(?,?,?,?,?,NOW())");
					$insert->execute(array($book,$ty,$photo,$description,$taille));
					$ins = $bdd->prepare("INSERT INTO ref(livre,mid,cat) VALUES(?,?,?)");
					$ins->execute(array($book,$souscategorie,$id_cat));
					$reussie = "Nouveau livre ajoute avec success";						
					}
					else{
						$up = $bdd->prepare("UPDATE photo SET nom = ?, photo = ?, description = ?, taille = ? WHERE id = ?");
						$up->execute(array($book,$photo,$description,$taille,$edit));
						$up1 = $bdd->prepare("UPDATE ref SET livre = ?, type = ?, taille = ? WHERE livre = ?");
						$up1->execute(array($book,$ty,$taille,$book));
						$reussie = "Modidfication reussie";
					}
				}
				else{
					die('erreur verifier le formualire et renvoyer');
				}	    	
		}
		else{
			die('erreur oups ce livre existe deja');
		}
	}
	else{
		die("Tous les champs doivent etre rempli");
	}

}

  $req1 = $bdd->query("SELECT * FROM categorie ORDER BY id ASC");
 ?>			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">new Book</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Book</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
			<!-- Add Client Modal -->
				<!-- <div id="add_client" class="modal custom-modal fade" role="dialog"> -->



													<?php if(@$reussie){ ?>
												<input type="text" style="width:400px;" class="alert alert-success" readonly value="<?=$reussie?>">
											
										</div>
								<?php } ?>
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">

							<form method="post" action="">
									<div class="col-md-12">
											<div class="form-group">
												<label class="col-form-label">Name categorie <span class="text-danger">*</span></label>
												<select class="form-control" name="categorie">
								<?php if($zonemodif == 1){ ?><option><?=$req5['cat']?></option><?php } ?>
													<?php if($zonemodif == 0){ ?>
											<?php while($c = $req1->fetch()){ ?>
											<option value="<?=$c['nom_cat']?>"><?=$c['nom_cat']?></option>
											<?php } ?>
											<?php } ?>
												</select>
											</div>
										</div>
								<button style="margin-left: 370px;" class="btn btn-info" name="cat_ok" type="submit">OK</button>
							</form>

							<div class="modal-header"><br>
								<h5 class="modal-title" style="margin-left: 320px;">Add a new book</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">

								<form method="post" action="" autocomplete="off" enctype="multipart/form-data">									
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-form-label">Name of end-categorie <span class="text-danger">*</span></label>
												<select class="form-control" name="souscategorie">
												<?php if($zonemodif == 1){ ?><option value="<?=$req5['mid']?>"><?=$req5['mid']?></option><?php } ?>

													<?php while($sc = $req2->fetch()){ ?>												
														<option><?=$sc['cat']?></option>													
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-form-label">Name of book <span class="text-danger">*</span></label>
												<input class="form-control" <?php if($zonemodif ==1){?> value="<?=$livre['nom']?>" <?php } ?> name="book" type="text">
											</div>
										</div>
								<div class="col-md-12">
											<div class="form-group">
												<label class="col-form-label">file <span class="text-danger">*</span></label>
												<input class="form-control"    <?php if($zonemodif ==1){?> value="<?=$livre['photo']?>" <?php } ?> name="photo" type="file" accept=".pdf,.docx">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-form-label">Description <span class="text-danger">*</span></label>
												<textarea class="form-control" name="description" rows="5"> <?php if($zonemodif ==1){?> <?=$livre['description']?> <?php } ?></textarea>
											</div>
										</div>
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="book_send">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<!-- </div> -->
					
<!-- <a href="home/in.pf=df" download="nom du livre">
	<button>
		telecharger
	</button>
</a> -->
					 
					<!-- Search Filter -->
						
                </div>
				<!-- /Page Content -->

				<!-- /Add Client Modal -->
				
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		<script src="assets/js/xml1.js"></script>
		
    </body>
<?php
} 
else{
	header("Location:error-404.php");
}

 ?>
