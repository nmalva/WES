<?php include("includes/title.php");?>
<?php include ("includes/security_session.php");?>
<?php include ("includes/security_admin.php");?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<!--  BEGIN INCLUDE CLASSES -->

<!--  END INCLUDE CLASSES -->


<!--  BEGIN GLOBAL VARIABLES -->
<?php 
$admin_path="../classes/abm_clase/admin_usuarios.php";
$admin_name="USUARIOS";
?>
<!--  END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->

<!--  PAGE TITLE  -->
<?php include ("includes/pagetitle.php");?>
<!--  END PAGE TITLE  -->
<!-- BEGIN GLOBAL STYLE -->
<?php include("includes/globalstyle.html");?>
<!-- END GLOBAL STYLE -->

<!-- BEGIN THEME STYLES -->
<?php include("includes/themestyle.html");?>
<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES USED BYE TOASTR NOTIFICATION -->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" />
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES USE BY DATE PICKER-->

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES USED BY MULTIPLE SELECT-->

<!-- END PAGE LEVEL STYLES USED BY MULTIPLE SELECT-->

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>

<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
	<!-- BEGIN HEADER -->
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
	       <?php include("includes/headertop.php");?>
	   <!-- END HEADER TOP -->

		<!-- BEGIN HEADER MENU -->
	      <?php include("includes/headermenu.php");?>
	<!-- END HEADER MENU -->
	</div>
	<!-- END HEADER -->

	<!-- BEGIN PAGE CONTAINER -->
	<div class="page-container">
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head">
			<div class="container">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>
						Administrador <small>Agregar o Modificar Campos</small>
					</h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
				<div class="page-toolbar">
					<!-- BEGIN THEME PANEL -->

					<!-- END THEME PANEL -->
				</div>
				<!-- END PAGE TOOLBAR -->
			</div>
		</div>
		<!-- END PAGE HEAD -->


		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
			<div class="container">


				<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<div class="modal fade" id="portlet-config" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true"></button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">Widget settings form goes here</div>
							<div class="modal-footer">
								<button type="button" class="btn blue">Save changes</button>
								<button type="button" class="btn default" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <!-- BEGIN PAGE BREADCRUMB -->
			    <!-- END PAGE BREADCRUMB -->
				<!-- <div class="col-md-10 "> -->
				<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cogs font-green-sharp"></i> <span
								class="caption-subject font-green-sharp bold uppercase"><?php echo $admin_name;?></span>
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"> </a> <a
								href="#portlet-config" data-toggle="modal" class="config"> </a>
							<a href="javascript:;" class="reload"> </a> <a
								href="javascript:;" class="remove"> </a>
						</div>
					</div>
					<div class="portlet-body form">

					<?php 
						if ($_SESSION["usu_perfil"]==ADMINISTRADOR)
                        include "{$admin_path}";
					else 
					     echo  "Usted no cuenta con permisos para acceder a esta sección";
					?>

					</div>
				</div>
				<!-- END SAMPLE FORM PORTLET-->
				
				<!-- END PAGE CONTENT INNER -->
			</div>
		</div>
		<!-- END PAGE CONTENT -->

		<!-- END PAGE CONTAINER -->
	</div>

<!-- BEGIN PRE-FOOTER -->
    <?php include("includes/prefooter.html")?>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
    <?php include("includes/footer.html");?>
<!-- END FOOTER -->


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
    <?php include("includes/coreplugins.html");?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS USED BY TOASTR-->
<script
	src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-toastr.js"></script>
<!-- END PAGE LEVEL SCRIPTS USED BY TOASTR-->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js"
	type="text/javascript"></script>
<script src="../../assets/admin/layout3/scripts/layout.js"
	type="text/javascript"></script>
<script src="../../assets/admin/layout3/scripts/demo.js"
	type="text/javascript"></script>

<!-- MULTIPLE SELECT -->
<!-- USED BY PICKER -->

<!-- END PAGE LEVEL SCRIPTS -->
<script>
 jQuery(document).ready(function() {       
	 // initiate layout and plugins
     Metronic.init(); // init metronic core components
     Layout.init(); // init current layout
     Demo.init(); // init demo features
    });   
</script>

<!-- START AJAX -->
<script>

//--START JAVASCRIPT FUNCTIONS --

//--END JAVASCRIPT FUNCTIONS--
</script>
<!-- END JAVASCRIPTS -->


</body>
<!-- END BODY -->
</html>