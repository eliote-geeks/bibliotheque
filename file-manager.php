<?php include_once('config.php');
include_once('fonctions.php');
 include_once('head.php');
  include_once('aside.php');
  $req = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
$req->execute(array($_SESSION['email']));
$user = $req->fetch();
if ($user['user_admin'] == 1) {
$requette = "";

  $dep = $bdd->query('SELECT * FROM categorie ORDER BY id ASC');
  if (isset($_GET['id'])) {

  	$id_dep = htmlspecialchars($_GET['id']);
  	$req = $bdd->prepare("SELECT * FROM categorie WHERE id = ?");
  	$req->execute(array(intval($_GET['id'])));

  	if ($req->rowCount() > 0) {
  		$requette = "SELECT * FROM categorie 
  		RIGHT JOIN mid_cat ON categorie.nom_cat = mid_cat.nom
    	RIGHT JOIN ref ON ref.cat = categorie.nom_cat 
  	  RIGHT JOIN photo ON ref.livre = photo.nom  WHERE categorie.id = $id_dep";
  	}
  }
  else{
  	$requette = "SELECT * FROM categorie 
  		RIGHT JOIN mid_cat ON categorie.nom_cat = mid_cat.nom
    	RIGHT JOIN ref ON ref.cat = categorie.nom_cat 
  	  RIGHT JOIN photo ON ref.livre = photo.nom";
  }


  if (isset($_GET['search'])) {
  	$search = htmlspecialchars($_GET['search']);
  	$requette = "SELECT * FROM categorie 
  		RIGHT JOIN mid_cat ON categorie.nom_cat = mid_cat.nom
    	RIGHT JOIN ref ON ref.cat = categorie.nom_cat 
  	  RIGHT JOIN photo ON ref.livre = photo.nom WHERE photo.nom LIKE '%".$search."%'";
  }



$var_dep = $bdd->query($requette);
 ?>	
			

			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<div class="row">
						<div class="col-sm-12">
							<div class="file-wrap">
								<div class="file-sidebar">
									<div class="file-header justify-content-center">
										<span>Gestion of book</span>
										<a href="javascript:void(0);" class="file-side-close"><i class="fa fa-times"></i></a>
									</div>

									<div class="file-pro-list">
										<div class="file-scroll">
											<ul class="file-menu">
												<li class="active">
													<a href="file-manager.php">All books</a>
												</li>
												<?php  while($d = $dep->fetch()){?>
												<li>
													<a href="file-manager.php?id=<?=$d['id']?>"><?=$d['nom_cat']?></a>
												</li>
												<?php } ?>									
											</ul>
										</div>
									</div>
								</div>
								<div class="file-cont-wrap">
									<div class="file-cont-inner">
										<div class="file-cont-header">
											<div class="file-options">
												<a href="javascript:void(0)" id="file_sidebar_toggle" class="file-sidebar-toggle">
													<i class="fa fa-bars"></i>
												</a>
											</div>
											<span>Book Manager</span>
											<div class="file-options">
												<span class="btn-file"><input type="file" class="upload"><i class="fa fa-upload"></i></span>
											</div>
										</div>
										<div class="file-content">
											<form class="file-search" method="get" action="" autocomplete="off">
												<div class="input-group">
													<div class="input-group-prepend">
														<i class="fa fa-search"></i>
													</div>
													<input type="text" class="form-control" placeholder="Search" name="search">
													<button  style="border-radius: 50%; background: #fff; border: none;" type="submit">lets-go</button>
												</div>
											</form>
											<div class="file-body">
												<div class="file-scroll">
													<div class="file-content-inner">
													 <h4>Nber of books (<?= $var_dep->rowCount()?>)</h4> 
														<div class="row row-lg">
															<?php while($var = $var_dep->fetch()){ ?>
															<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																<div class="card card-file">
																	<div class="dropdown-file">
																		
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="book.php?edit=<?=$var['id']?>" class="dropdown-item">Edit</a>
																			<a href="modification.php?del=<?=$var['id']?>" class="dropdown-item">Delete</a>
																			<a href="livres/<?=$var['photo']?>" download="<?=$var['nom']?>" class="dropdown-item">Download</a>
																		</div>

																	</div>
																	<div class="card-file-thumb">
																	<?php 
																		$limit = '';
																		(strlen($var['nom_cat'] > 4)) ? $limit = substr($var['livre'], 0,22).'.. ' : $limit = $var['nom_cat'];?>
																		<i class="<?=$var['type']?>"></i>
																	</div>
																	<div class="card-body">
																		<h6><?php if(isset($_GET['id'])){ ?> <a href=""><?=$var['livre']?> <?php }else{ ?><a href=""><?=$var['nom']?> <?php } ?></a></h6>
																		<span><?=conversion($var['taille'])?> ko</span>
																	</div>
																	<div class="card-footer">
																		<span class="d-none d-sm-inline">Publie le : </span><?=$var['date_en']?>
																	</div>
																</div>
															</div>
														<?php } ?>


<!-- 															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-word-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Document.docx</a></h6>
																		<span>22.67kb</span>
																	</div>
																	<div class="card-footer">
																		<span class="d-none d-sm-inline">Last Modified: </span>30 mins ago
																	</div>
																</div>
															</div> -->
															
<!-- 															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-image-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">icon.png</a></h6>
																		<span>12.47kb</span>
																	</div>
																	<div class="card-footer">
																		<span class="d-none d-sm-inline">Last Modified: </span>1 hour ago
																	</div>
																</div>
															</div> -->
															
<!-- 															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-excel-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Users.xls</a></h6>
																		<span>35.11kb</span>
																	</div>
																	<div class="card-footer">23 Jul 6:30 PM</div>
																</div>
															</div> -->

														<!-- </div> -->
<!-- 
														<h4>Files</h4>
														<div class="row row-sm">
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-word-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Updates.docx</a></h6>
																		<span>12mb</span>
																	</div>
																	<div class="card-footer">9 Aug 1:17 PM</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-powerpoint-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Vision.ppt</a></h6>
																		<span>72.50kb</span>
																	</div>
																	<div class="card-footer">6 Aug 11:42 AM</div>
																</div>
															</div> -->
<!-- 															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-audio-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Voice.mp3</a></h6>
																		<span>2.17mb</span>
																	</div>
																	<div class="card-footer">
																		<span class="d-none d-sm-inline">Last Modified: </span>30 Jul 9:00 PM
																	</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-pdf-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Tutorials.pdf</a></h6>
																		<span>8.2mb</span>
																	</div>
																	<div class="card-footer">21 Jul 10:45 PM</div>
																</div>
															</div> -->
															
<!-- 															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-excel-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Tasks.xls</a></h6>
																		<span>92.82kb</span>
																	</div>
																	<div class="card-footer">16 Jun 4:59 PM</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-image-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Page.psd</a></h6>
																		<span>118.71mb</span>
																	</div>
																	<div class="card-footer">14 Jun 9:00 AM</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-text-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">License.txt</a></h6>
																		<span>18.7kb</span>
																	</div>
																	<div class="card-footer">5 May 8:21 PM</div>
																</div>
															</div> -->
<!-- 															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-word-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Expenses.docx</a></h6>
																		<span>66.2kb</span>
																	</div>
																	<div class="card-footer">24 Apr 7:50 PM</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-audio-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Music.mp3</a></h6>
																		<span>3.6mb</span>
																	</div>
																	<div class="card-footer">13 Mar 2:00 PM</div>
																</div>
															</div>
															 -->
<!-- 															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-text-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Installation.txt</a></h6>
																		<span>43.9kb</span>
																	</div>
																	<div class="card-footer">26 Feb 5:01 PM</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-video-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">Workflow.mp4</a></h6>
																		<span>47.65mb</span>
																	</div>
																	<div class="card-footer">3 Jan 11:35 AM</div>
																</div>
															</div>
															
															<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
																<div class="card card-file">
																	<div class="dropdown-file">
																		<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item">View Details</a>
																			<a href="#" class="dropdown-item">Share</a>
																			<a href="#" class="dropdown-item">Download</a>
																			<a href="#" class="dropdown-item">Rename</a>
																			<a href="#" class="dropdown-item">Delete</a>
																		</div>
																	</div>
																	<div class="card-file-thumb">
																		<i class="fa fa-file-code-o"></i>
																	</div>
																	<div class="card-body">
																		<h6><a href="">index.html</a></h6>
																		<span>23.7kb</span>
																	</div>
																	<div class="card-footer">1 Jan 8:55 AM</div>
																</div>
															</div> -->

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
                </div>
				<!-- /Page Content -->
				
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
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>
<?php }
else
	header("Location:error-404.php");
 ?>