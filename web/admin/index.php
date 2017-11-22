<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Gestion de flux Weezjump Jeje!!!| Tableau de bord seb</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="css/style-spritz.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="login.php" class="navbar-brand"><img class="logo-top" src="img/logo-weezjump.png" title="" alt="" /> WeezJump</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					
					
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/img/user-13.jpg" alt="" /> 
							<span class="hidden-xs">Sébastien Fuger</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Déconnexion</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					
					<li class="active"><a href="index.php"><i class="fa fa-calendar"></i> <span>Tableau de bord</span></a></li>
					<li class=""><a href="users.php"><i class="fa fa-key"></i> <span>Utilisateurs</span></a></li>
					<li class=""><a href="settings.php"><i class="fa fa-cogs"></i> <span>Paramètres</span></a></li>
					<li class=""><a href="statistiques.php"><i class="fa fa-area-chart"></i> <span>Statistiques</span></a></li>
					
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="index.php">Accueil</a></li>
				<li class="active">Tableau de bord</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Tableau de bord</h1>
			<!-- end page-header -->
			
			<!-- begin row : Première ligne -->
			<div class="row">
				
				<!-- begin col-6 -->
			    <div class="col-md-6 col-sm-12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#default-tab-1" data-toggle="tab">Date du jour</a></li>
						<li class=""><a href="#default-tab-2" data-toggle="tab">Détails entrées</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
							<div class="panel-body panel-form">
	                            <form method="" action="" class="form-horizontal form-bordered">
									<div class="form-group">
										<label class="control-label col-md-4">Nous sommes le</label>
										<div class="col-md-8">
	                                        <div class="input-group date" id="datetimepicker1">
	                                            <input type="text" class="form-control" />
	                                            <span class="input-group-addon">
	                                                <span class="glyphicon glyphicon-calendar"></span>
	                                            </span>
	                                        </div>
										</div>
									</div>
								</form>
	                        </div>
						</div>
						<div class="tab-pane fade" id="default-tab-2">
							<table class="table">
                                <thead>
                                    <tr>
                                        <th>Type d'entrée</th>
                                        <th>Quantité</th>
                                    </tr>
                                </thead>
                                <tbody>
	                                <tr>
                                        <td>Entrées totales</td>
							            <td><a href="#" class="btn btn-sm btn-default" >288</a></td>
							        </tr>
							        <tr>
                                        <td>Sessions</td>
							            <td><a href="#" class="btn btn-sm btn-default" >12 / 26</a></td>
							        </tr>
                                    <tr>
                                        <td>Entrées A</td>
							            <td><a href="#" class="btn btn-sm btn-success" >160</a></td>
							        </tr>
							        <tr>
							            <td>Entrées B</td>
							            <td><a href="#" class="btn btn-sm btn-success" >30</a></td>
							        </tr>
							        <tr>
							            <td>Entrées C</td>
							            <td><a href="#" class="btn btn-sm btn-success" >40</a></td>
							        </tr>
							        <tr>
							            <td>Entrées D</td>
							            <td><a href="#" class="btn btn-sm btn-success" >58</a></td>
							        </tr>
                                </tbody>
                            </table>						
                        </div>
					</div>
					
				</div>
				
					<div class="col-md-3 col-sm-6">
						<div class="widget widget-stats bg-green">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
				            <div class="stats-title">VISITEURS ACTIFS</div>
				            <div class="stats-number">58</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 58%;"></div>
	                        </div>
	                        <div class="stats-desc">Total du jour : 288</div>
				        </div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="widget widget-stats bg-purple">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-dashboard fa-fw"></i></div>
				            <div class="stats-title">PLACES RESTANTES</div>
				            <div class="stats-number">25</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 25%;"></div>
	                        </div>
	                        <div class="stats-desc"><a href="#" title="Modifier la quantité de places maximale">Modifier la quantité maximale</a></div>
				        </div>
					</div>
				
			</div>
			<!-- end row -->
			
			<!-- Titre calendrier -->
			<h3>Vos créneaux</h3>
			<p class="m-b-20">
			    Ci-dessous la liste des créneaux configurés pour la journée en cours. Vous pouvez modifier, mettre en sommeil et réactiver les créneaux de votre choix.
			</p>
			
			<!-- begin row : Ligne calendrier -->
			<div class="row">
				
				<!-- The Modal : Popup permettant de choisir la quantité de personnes à enregistrer -->
				<div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog modal-sm">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Enregistrement participant</h4>
				        </div>
				        <div class="modal-body">
				          <p>Veuillez choisir la quantité de participants à enregistrer pour la session choisie.</p>
				          <p><strong>Type sélectionné : </strong>Standard</p>
				          
				        </div>
				        <div class="modal-footer">
				          	<div class="input-group number-spinner">
								<span class="input-group-btn">
									<button class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
								</span>
								<input type="text" class="form-control text-center" value="1">
								<span class="input-group-btn">
									<button class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
								</span>
							</div>
							<input type="submit">
				        </div>
				      </div>
				    </div>
				  </div>
  
							<!-- Démarrage de la boucle -->
							<div class="col-md-4">
								<?php 	$couleur = 'rose';
								?>
								<!-- begin panel -->
			                    <div class="panel panel-warning <?php echo $couleur; ?>" data-sortable-id="ui-widget-16">
			                        <div class="panel-heading">
			                            <div class="panel-heading-btn">
			                               	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-cog"></i></a>
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-repeat"></i></a>
			                                
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"><i class="fa fa-times"></i></a>
			                            </div>
			                            <h4 class="panel-title"><i class="fa fa-calendar"></i> 10h00 - 11h00</h4>
			                        </div>
			                        <div class="panel-body <?php echo $couleur; ?> text-white">
				                            <form class="form-horizontal">
				                                <div class="form-group">
				                                    <div class="col-md-9">
				                                        <select class="form-control">
				                                            <option>Standard</option>
				                                            <option>Groupe</option>
				                                            <option>Gratuit</option>
				                                            <option>Baby Weez</option>
				                                            <option>Laser Weez</option>
				                                        </select>
				                                        
				                                    </div>
				                                    <div class="col-md-3">
					                                    <div class="btn btn-sm btn-warning places-restantes">60 / 80</div>
				                                    </div>
				                                </div>
				                            </form>
			                        </div>
			                    </div>
							</div>
							<!-- Fin de la boucle -->
							
							
							<div class="col-md-4">
								<?php 	$color_top_panel = 'primary';
										$color_body_panel = 'blue';
								?>
								<!-- begin panel -->
			                    <div class="panel panel-<?php echo $color_top_panel; ?>" data-sortable-id="ui-widget-16">
			                        <div class="panel-heading">
			                            <div class="panel-heading-btn">
			                               	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-cog"></i></a>
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-repeat"></i></a>
			                                
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"><i class="fa fa-times"></i></a>
			                            </div>
			                            <h4 class="panel-title"><i class="fa fa-calendar"></i> 10h30 - 11h30</h4>
			                        </div>
			                        <div class="panel-body bg-<?php echo $color_body_panel; ?> text-white">
				                             <form class="form-horizontal">
				                                <div class="form-group">
				                                    <div class="col-md-9">
				                                        <select class="form-control">
				                                            <option>Standard</option>
				                                            <option>Groupe</option>
				                                            <option>Gratuit</option>
				                                            <option>Baby Weez</option>
				                                            <option>Laser Weez</option>
				                                        </select>
				                                        
				                                    </div>
				                                    <div class="col-md-3">
					                                    <div class="btn btn-sm btn-warning places-restantes">60 / 80</div>
				                                    </div>
				                                </div>
				                             </form>
			                        </div>
			                    </div>
							</div>
							
							<div class="col-md-4">
								<?php 	$color_top_panel = 'success';
										$color_body_panel = 'green';
								?>
								<!-- begin panel -->
			                    <div class="panel panel-<?php echo $color_top_panel; ?>" data-sortable-id="ui-widget-16">
			                        <div class="panel-heading">
			                            <div class="panel-heading-btn">
			                               	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-cog"></i></a>
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-repeat"></i></a>
			                                
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"><i class="fa fa-times"></i></a>
			                            </div>
			                            <h4 class="panel-title"><i class="fa fa-calendar"></i> 12h00 - 13h00</h4>
			                        </div>
			                        <div class="panel-body bg-<?php echo $color_body_panel; ?> text-white">
				                             <form class="form-horizontal">
				                                <div class="form-group">
				                                    <div class="col-md-9">
				                                        <select class="form-control">
				                                            <option>Standard</option>
				                                            <option>Groupe</option>
				                                            <option>Gratuit</option>
				                                            <option>Baby Weez</option>
				                                            <option>Laser Weez</option>
				                                        </select>
				                                        
				                                    </div>
				                                    <div class="col-md-3">
					                                    <div class="btn btn-sm btn-warning places-restantes">60 / 80</div>
				                                    </div>
				                                </div>
				                             </form>
			                        </div>
			                    </div>
							</div>
							
							<div class="col-md-4">
								<?php 	$color_top_panel = 'info';
										$color_body_panel = 'aqua';
								?>
								<!-- begin panel -->
			                    <div class="panel panel-<?php echo $color_top_panel; ?>" data-sortable-id="ui-widget-16">
			                        <div class="panel-heading">
			                            <div class="panel-heading-btn">
			                               	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-cog"></i></a>
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"><i class="fa fa-repeat"></i></a>
			                                
			                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"><i class="fa fa-times"></i></a>
			                            </div>
			                            <h4 class="panel-title"><i class="fa fa-calendar"></i> 12h30 - 13h30</h4>
			                        </div>
			                        <div class="panel-body bg-<?php echo $color_body_panel; ?> text-white">
				                             <form class="form-horizontal">
				                                <div class="form-group">
				                                    <div class="col-md-9">
				                                        <select class="form-control">
				                                            <option>Standard</option>
				                                            <option>Groupe</option>
				                                            <option>Gratuit</option>
				                                            <option>Baby Weez</option>
				                                            <option>Laser Weez</option>
				                                        </select>
				                                        
				                                    </div>
				                                    <div class="col-md-3">
					                                    <div class="btn btn-sm btn-warning places-restantes">60 / 80</div>
				                                    </div>
				                                </div>
				                             </form>
			                        </div>
			                    </div>
							</div>
						
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Personnalisation</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Rouge">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Bleue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pourpre">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Noir">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">En-tête</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control input-sm">
                            <option value="1">Blanche</option>
                            <option value="2">Colorée</option>
                        </select>
                    </div>
                </div>
                
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control input-sm">
                            <option value="1">Normale</option>
                            <option value="2">Grille</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar couleur</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control input-sm">
                            <option value="1">Normale</option>
                            <option value="2">Dégradée</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Corps</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control input-sm">
                            <option value="1">Couleur 1</option>
                            <option value="2">Couleur 2</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Réinitialiser</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/form-plugins.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<script src="js/js-spritz.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>
	


</body>
</html>
