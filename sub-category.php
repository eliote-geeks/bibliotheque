<?php include_once('config.php'); 

$zonemodif = 0;
if (isset($_GET['edit'])) {
	$editsub = htmlspecialchars($_POST['editsub']);
	$cat = htmlspecialchars($_POST['cat']);
	$getdit = htmlspecialchars($_POST['edit']);
	 $reedit = $bdd->prepare("SELECT * FROM mid_cat WHERE id = ?");
	 $reedit->execute(array($_GET['edit']));
	 if ($reedit->rowCount() > 0) {
	 	$zonemodif = 1;
	 	$edit = $reedit->fetch();	 	
		if($zonemodif ==1){
			$up = $bdd->prepare("UPDATE mid_cat SET nom = ? AND cat = ? WHERE id = ?");
			$up->execute(array($editsub,$cat,$edit['edit']));
				header('Location:categories.php');
		}
	 }
}



if (isset($_POST['add_sub'])) {
	var_dump($_POST);
	$categorie = htmlspecialchars($_POST['categorie']);
	$su = htmlspecialchars($_POST['subcat']);
	$req = $bdd->prepare("SELECT * FROM mid_cat WHERE nom =? AND cat = ?");
	$req->execute(array($categorie,$su));
	if ($req->rowCount() == 0) {
		$ins = $bdd->prepare("INSERT INTO mid_cat(nom,cat,date_en) VALUES(?,?,NOW())");
		$ins->execute(array($categorie,$su));
		header('Location:sub-category.php');
	}
	else{
		die('error');
	}
}

if (isset($_GET['del'])) {
	$drop= $bdd->prepare("SELECT * FROM mid_cat WHERE id = ?");
	$drop->execute(array(intval($_GET['del'])));
	if ($drop->rowCount() > 0) {
		$dop = $bdd->prepare("DELETE FROM mid_cat WHERE id = ?");
		$dop->execute(array(intval($_GET['del'])));
		header('Location:sub-category.php');
	}
	else{
		die('erreur de sous categorie');
	}
}

$cat = $bdd->query("SELECT * FROM categorie ORDER BY id ASC");
$sub_cat = $bdd->query("SELECT * FROM mid_cat ORDER BY id ASC");?>
<?php include_once('head.php'); ?>
<?php include_once('aside.php'); ?>

			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Sub Categories</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Accounts</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_categories"><i class="fa fa-plus"></i> Add Sub Categories</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Sub-Category Name</th>
											<th>Category Name </th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php while($s = $sub_cat->fetch()){ ?>
										<tr>
											<td><?=$s['id']?></td>
											<td><?=$s['cat']?></td>
											<td><?=$s['nom']?></td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_categories"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="sub-category.php?del=<?=$s['id']?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
				
				<!-- Add Modal -->
				<div class="modal custom-modal fade" id="add_categories" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Sub Categories</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="" autocomplete="off">
									<div class="form-group">
										<label>Categories Name <span class="text-danger">*</span></label>
										<select class="form-control select" name="categorie">
											<option>Select</option>
											<?php while($c = $cat->fetch()){ ?>
											<option><?=$c['nom_cat']?></option>
										<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label>Sub Categories Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="subcat">
									</div>

									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="add_sub">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Modal -->

				<!-- Edit Modal -->
				<div class="modal custom-modal fade" id="edit_categories" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Categories</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-group">
										<label>Categories Name <span class="text-danger">*</span></label>
										<select class="form-control select">
											<option>Select</option>
											<option>Hardwaree</option>
											<option>Material</option>
										</select>
									</div>

									<div class="form-group">
										<label>Sub Categories Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text">
									</div>

									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Modal -->

				<!-- Delete Holiday Modal -->
				<div class="modal custom-modal fade" id="delete" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete </h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
				<!-- /Delete Holiday Modal -->
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
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>