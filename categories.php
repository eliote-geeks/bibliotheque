<?php include_once("config.php"); 
$req = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
$req->execute(array($_SESSION['email']));
$user = $req->fetch();
if ($user['user_admin'] == 1) {


$id  = 0;
$zonemodif = 0;
if (isset($_GET['edit_cat'])) {
	$getdit = htmlspecialchars($_POST['edit_cat']);
	 $reedit = $bdd->prepare("SELECT * FROM categorie WHERE id = ?");
	 $reedit->execute(array($_GET['edit_dep']));
	 if ($reedit->rowCount() > 0) {
	 	$zonemodif = 1;
	 	$edit = $reedit->fetch();	 	
		if($zonemodif ==1){
			$up = $bdd->prepare("UPDATE categorie SET nom_dep = ? WHERE id = ?");
			$up->execute(array($getdit,$edit['edit_dep']));
				header('Location:categories.php');
		}
	 }
}


if (isset($_POST['add'])) {
	if (isset($_POST['cat']) AND !empty($_POST['cat'])) {
		$cat = htmlspecialchars($_POST['cat']);
		$v = $bdd->prepare("SELECT * FROM categorie WHERE nom_cat = ?");
		$v->execute(array($cat));
		if($v->rowCount() == 0){
			if ($zonemodif == 0) {
			$insert = $bdd->prepare("INSERT INTO categorie(nom_cat,date_en) VALUES(?,NOW())");
			$insert->execute(array($cat));
			header('Location:categories.php');				
			}

		}
		else{
			die('erreur oups cette categorie existe deja');
		}
	}
}

if (isset($_GET['del'])) {
	$drop= $bdd->prepare("SELECT * FROM categorie WHERE id = ?");
	$drop->execute(array(intval($_GET['del'])));
	if ($drop->rowCount() > 0) {
		$dop = $bdd->prepare("DELETE FROM categorie WHERE id = ?");
		$dop->execute(array(intval($_GET['del'])));
		header('Location:categories.php');
	}
	else{
		die('erreur de categorie');
	}
}

$categories = $bdd->query("SELECT * FROM categorie ORDER BY id DESC");

 include_once('head.php');

 include_once('aside.php'); ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">categorie</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">categorie</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add categorie</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th style="width: 30px;">#</th>
											<th>Categorie Name</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php while($d = $categories->fetch()){ ?>
										<tr>
											<td><a href="categories.php?dep_id=<?=$d['id']?>"><?=$d['id']?></a></td>
											<td><a href="categories.php?dep_id=<?=$d['id']?>"><?=$d['nom_cat']?></a></td>
											<td class="text-right">
                                            <div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" 
                                                    data-href="categories.php?edit_dep=<?php echo $d['id']; ?>"

                                                     data-toggle="modal" data-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                                    <a class="dropdown-item" href="categories.php?del=<?php echo $d['id'];?>" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
												</div>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Department Modal -->
				<div id="add_department" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Categorie</h5>
								<button name="adds" type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="" autocomplete="off">
									<div class="form-group">
										<label>Categorie Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="cat">
									</div>
									<div class="submit-section">
										<button type="submit"  name="add" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Department Modal -->
				
				<!-- Edit Department Modal -->
				<div id="edit_department" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Department</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<div class="form-group">
										<label>Department Name <span class="text-danger">*</span></label>
										<input class="form-control" name="edit_dep" value="IT Management" type="text">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" name="edit">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Department Modal -->

				<!-- Delete Department Modal -->
				<div class="modal custom-modal fade" id="delete_department" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Department</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="categories.php?id=<?php echo $d['id'];?>" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Department Modal -->
				
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
		
		<!-- Datatable JS -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>
<?php 
}
else{
	header("Location:error-404.php");
}

 ?>