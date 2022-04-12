<?php include_once('config.php'); 
$users = $bdd->query("SELECT * FROM menbre ORDER BY id ASC");

if (isset($_GET['del'])) {
	$del = intval($_GET['del']);
	$delete = $bdd->prepare("DELETE FROM menbre WHERE id =  ?");
	$delete->execute(array($del));
	header("Location:candidates.php");
}

if (isset($_POST['valid'])) {
	if (isset($_POST['first'],$_POST['last'],$_POST['email'],$_POST['phone'],$_POST['addresse'],$_POST['pseudo']) AND !empty($_POST['first']) AND !empty($_POST['last']) AND !empty($_POST['email']) AND !empty($_POST['pseudo'])  AND !empty($_POST['addresse']) ) {
		$first = htmlspecialchars($_POST['first']);		
		$last = htmlspecialchars($_POST['last']);
		$email = htmlspecialchars($_POST['email']);
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$phone = htmlspecialchars($_POST['phone']);
		$addresse = htmlspecialchars($_POST['addresse']);				
		$ip = $_SERVER['REMOTE_ADDR'];
    	$photo = htmlspecialchars($_FILES['photo']['name']);
	    $file_tmp_name = $_FILES['photo']['tmp_name'];
	    $photo_verify =  move_uploaded_file($file_tmp_name,"./assets/img/profiles/$photo");
		if ($photo_verify) {			
			if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
				if (1) {
					$reqmail = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
					$reqmail->execute(array($email));
					if ($reqmail->rowCount() == 0) {
						$reqpseudo = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ?");
						$reqpseudo->execute(array($pseudo));
						if ($reqpseudo->rowCount() == 0) {
							$insert_mbr = $bdd->prepare("INSERT INTO menbre(first,last,pseudo,num,address,photo,email,password,ip,date_en) VALUES(?,?,?,?,?,?,?,?,?,NOW())");
							$insert_mbr->execute(array($first,$last,$pseudo,$phone,$addresse,$photo,$email,sha1('123456'),$ip));							
						}
						else{
							$erreur = "Oups cette addresse email existe deja";
						}
					}
					else{
						$erreur = "Oups cette addresse email existe deja";
					}
				}else{
					$erreur = "pseudo invalide";
				}
			}else{
				$erreur = "Addresse email invalide ";
			}
		}
		else{
			$erreur = "Erreur d'estension veuillez reesayer";
		}
	}
	else{
		$erreur = "Tous les champs doivent etre rempli ";
	}
}
			 include_once('head.php'); ?>
			<!-- Sidebar -->
            <?php include_once('aside.php');  ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			<?php if (isset($erreur)){ 
					echo $erreur;
				?>
				
			<?php } ?>
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Admin List</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item">Admin</li>
									<li class="breadcrumb-item active">Admin List</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" data-toggle="modal" data-target="#add_employee" class="btn add-btn"> Add Admin</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Mobile Number</th>
											<th>Email</th>
											<th>Created Date</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>									
									<tbody>
										<?php while($u = $users->fetch()){ ?>
										<tr>
											<td><?=$u['id']?></td>
											<td>
												<h2 class="table-avatar">
													<a href="index.php" class="avatar"><img alt="" src="assets/img/profiles/<?=$u['photo']?>"></a>
													<a href=""><?=$u['first']." ".$u['last']?> </a>
												</h2>
											</td>
											<td><?=$u['num']?></td>
											<td><?=$u['email']?></td>
											<td><?=$u['date_en']?></td>
											<td class="text-center">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_job"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="candidates.php?del=<?=$u['id']?>" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
				
				<!-- Add Employee Modal -->
				<div id="add_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Users</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="" autocomplete="off" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Pseudo <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="pseudo">
											</div>
											<div class="form-group">
												<label class="col-form-label">First Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="first">
											</div>
										</div>
								<div class="col-sm-6">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label">Last Name</label>
												<input class="form-control" type="text" name="last">
											</div>
										</div>
								
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email" name="email">
											</div>
										</div>
								</div>		
								<div class="col-sm-12">
										
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label">Phone </label>
												<input class="form-control" type="text" name="phone">
								</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label">addresse </label>
												<input class="form-control" type="text" name="addresse">
											</div>
										</div>
								</div>									
								<div class="col-sm-12">	
								<div class="form-group">
									<label>Photo</label>
									<input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
									<img id="output"/>
								</div>
							</div>
										
									</div>
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="valid">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Employee Modal -->

				<!-- Edit Job Modal -->
				<div id="edit_job" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Candidates</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">First Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Last Name</label>
												<input class="form-control" type="text">
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Created Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Phone </label>
												<input class="form-control" type="text">
											</div>
										</div>
										
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Job Modal -->

				<!-- Delete Job Modal -->
				<div class="modal custom-modal fade" id="delete_job" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="" class="btn btn-primary continue-btn">Delete</a>
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
				<!-- /Delete Job Modal -->
				
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
		
		<!-- Datatable JS -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>		
    </body>
</html>
