<?php include("includes/title.php");?>
<?php include ("includes/security_session.php");?>
<!DOCTYPE html>
<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>


<!--  BEGIN INCLUDE CLASSES -->
<?php
include_once ("../classes/class.bd.php");
include_once ("../classes/class.casos.php");
include_once ("../classes/class.utiles.php");
?>
<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php
$get_cas_id = $_GET["cas_id"];
$submit = "Guardar";
$cas_fecha=date('d/m/Y');
?>
<!-- END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->
<?php
// visiblePlacesform();

fillFilds($get_cas_id);
visibleFileform();


function getOption_selected($cas_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM CompartirCasos INNER JOIN Usuarios on CompartirCasos.usu_id=Usuarios.usu_id WHERE cas_id={$cas_id} ORDER BY usu_nombre ASC";
    $resultado = $class_bd->ejecutar($sql);
    $i = 1;
    while ($r = $class_bd->retornar_fila($resultado)) {
        echo "<option  selected='selected' value='{$r["usu_id"]}'> {$r["usu_nombre"]} </option>";
        $usu_id_selected[$i] = $r["usu_id"];
        $i ++;
    }
    getOption_nonselected($usu_id_selected);
}
function getOption_nonselected($usu_id_selected){
    $class_bd = new bd();
    $sql = "SELECT * FROM Usuarios ORDER BY usu_nombre ASC";
    $length = sizeof($usu_id_selected);
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        $print = true;
        for ($i = 1; $i <= $length; $i ++) {
            if ($r["usu_id"] == $usu_id_selected[$i]) {
                $print = false;
            }
        }
        if ($print)
            echo "<option value='{$r["usu_id"]}'> {$r["usu_nombre"]}  </option>";
}
}
Function visibleFileform()
{
    Global $show_Fileform;
    if ($_GET["can_id"] == NULL)
        $show_Fileform = "none";
    else
        $show_Fileform = "";
}

function fillFilds($get_cas_id)
{
    global $cas_caratula;
    global $cas_legajo;
    global $cas_legajo1;
    global $esc_id;
    global $juz_id;
    global $jur_id;
    global $cli_id;
    global $mat_id;
    global $cas_fecha;
    global $submit;
    
    if ($get_cas_id != NULL) {
        $class_casos = new Casos($get_cas_id);
        $class_utiles = new utiles();
        
        $cas_caratula = $class_casos->getCas_caratula();
        $cas_legajo = $class_casos->getCas_legajo();
        $cas_legajo1 = $class_casos->getCas_legajo1();
        $esc_id = $class_casos->getEsc_id();
        $juz_id = $class_casos->getJuz_id();
        $jur_id = $class_casos->getJur_id();
        $cli_id = $class_casos->getCli_id();
        $mat_id = $class_casos->getMat_id();
        $cas_fecha = $class_utiles->fecha_mysql_php($class_casos->getCas_fecha());
        
        $submit = "Modificar";
    }
}

function getOption_esc($esc_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM EstadoCaso";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["esc_id"] == $esc_id)
            echo "<option value='{$r["esc_id"]}' selected='selected'>{$r["esc_nombre"]} </option>";
        else
            echo "<option value='{$r["esc_id"]}'>{$r["esc_nombre"]} </option>";
    }
}

function getOption_jur($jur_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Jurisdicciones";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["jur_id"] == $jur_id)
            echo "<option value='{$r["jur_id"]}' selected='selected'>{$r["jur_nombre"]} </option>";
        else
            echo "<option value='{$r["jur_id"]}'>{$r["jur_nombre"]} </option>";
    }
}

function getOption_juz($juz_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Juzgados";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["juz_id"] == $juz_id)
            echo "<option value='{$r["juz_id"]}' selected='selected'>{$r["juz_nombre"]} </option>";
        else
            echo "<option value='{$r["juz_id"]}'>{$r["juz_nombre"]} </option>";
    }
}

function getOption_mat($mat_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Materias";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["mat_id"] == $mat_id)
            echo "<option value='{$r["mat_id"]}' selected='selected'>{$r["mat_nombre"]} </option>";
        else
            echo "<option value='{$r["mat_id"]}'>{$r["mat_nombre"]} </option>";
    }
}

function getOption_cli($cli_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Clientes";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["cli_id"] == $cli_id)
            echo "<option value='{$r["cli_id"]}' selected='selected'>{$r["cli_apellido"]} {$r["cli_nombre"]} - {$r["cli_dni"]} </option>";
        else
            echo "<option value='{$r["cli_id"]}'>{$r["cli_apellido"]} {$r["cli_nombre"]} - {$r["cli_dni"]} </option>";
    }
}
?>
<!--  END PHP FUNCTIONS -->

<!--  PAGE TITLE  -->
<?php include ("includes/pagetitle.php");?>
<!--  END PAGE TITLE  -->

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php include("includes/globalstyle.html");?>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/select2/select2.css" />
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL STYLES USED BYE TOASTR NOTIFICATION -->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" />
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES USED BY VALIDATION-->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/select2/select2.css" />

<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.css" />
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL STYLES USED BY FILE INPUT-->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/typeahead/typeahead.css">
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<?php include("includes/themestyle.html");?>
<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body <? if ($can_disability==1) echo "onload='showDisability();'";?>>

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
				<?php //getExaInfo($session_exa_id);?>
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
				<ul class="page-breadcrumb breadcrumb">
					<li><a
						onclick="redireccionar_casos_tabla(<?php echo ($get_cas_id!=NULL? 1 : 0 );?>);">Retornar</a>
					</li>
				</ul>
				<!-- END PAGE BREADCRUMB -->
				<!-- BEGIN PAGE CONTENT INNER -->
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-equalizer font-red-sunglo"></i> <span
										class="caption-subject font-red-sunglo bold uppercase">Caso</span>
									<span class="caption-helper">Agregar o Modificar Caso</span>
								</div>
								<div class="tools">
									<a href="" class="collapse"> </a> <a href="#portlet-config"
										data-toggle="modal" class="config"> </a> <a href=""
										class="reload"> </a> <a href="" class="remove"> </a>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form action="javascript:nuevoModificarCaso();"
									name="formulario_caso" id="formulario_caso"
									class="form-horizontal" accept-charset="UTF-8">
									<div class="form-body">
										<div class="alert alert-danger display-hide">
											<button class="close" data-close="alert"></button>
											You have some form errors. Please check below.
										</div>
										<div class="alert alert-success display-hide">
											<button class="close" data-close="alert"></button>
											Your form validation is successful!
										</div>
										<h3 class="form-section">Dátos de Registro</h3>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Carpeta Id</label>
													<div class="col-md-9">
														<input type="text" name="cas_legajo" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cas_legajo;?>">

													</div>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Estado</label>
													<div class="col-md-9">
														<select class="select2_category form-control"
															name="esc_id" data-placeholder="Choose a Category"
															tabindex="1">
																	<?php  getOption_esc($esc_id);?>
																</select>
													</div>
												</div>
											</div>
											<!--/span-->
										</div>
										<!--/row-->
										<div class="row">
										<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Expediente Id</label>
													<div class="col-md-9">
														<input type="text" name="cas_legajo1" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cas_legajo1;?>">

													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Cliente</label>
													<div class="col-md-9">
														<select class="select2_category form-control"
															name="cli_id" data-placeholder="Choose a Category"
															tabindex="1">
																<?php  getOption_cli($cli_id);?>
															</select>
													</div>
												</div>
											</div>
											<!--/span-->
										</div>
										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Inicio de Causa</label>
													<div class="col-md-9">
														<div class="input-group date date-picker"
															data-date-format="dd/mm/yyyy">
															<input type="text" class="form-control" readonly
																name="cas_fecha" value="<?php echo $cas_fecha;?>"> <span
																class="input-group-btn">
																<button class="btn default" type="button">
																	<i class="fa fa-calendar"></i>
																</button>
															</span>
														</div>
													</div>
												</div>
											</div>
											<!--/span-->
										</div>
										<!--/row-->
										<h3 class="form-section">Tipificación de la Causa</h3>
										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Juzgado</label>
													<div class="col-md-9">
														<select class="select2_category form-control"
															name="juz_id" data-placeholder="Choose a Category"
															tabindex="1">
																	<?php  getOption_juz($juz_id);?>
																</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Jurisdicción</label>
													<div class="col-md-9">
														<select class="select2_category form-control"
															name="jur_id" data-placeholder="Choose a Category"
															tabindex="1">
																	<?php  getOption_jur($jur_id);?>
																</select>
													</div>
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Materia</label>
													<div class="col-md-9">
														<select class="select2_category form-control"
															name="mat_id" data-placeholder="Choose a Category"
															tabindex="1">
																	<?php getOption_mat($mat_id);?>
																</select>
													</div>
												</div>
											</div>
											<!--/span-->
											<!--/span-->
										</div>
										<!--/row-->
										<h3 class="form-section">Carátula</h3>
										<!--/span-->

										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3"></label>
													<div class="col-md-9">
														<textarea class="form-control" name="cas_caratula"
															rows="7"><?php echo $cas_caratula; ?></textarea>
													</div>
												</div>
											</div>

											<!--/span-->
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<img alt=""
													src="../../assets/admin/layout3/img/loading-spinner-blue.gif"
													id="loading_newupdate" style="display: none;">
												<button name="can_submit" type="submit" class="btn green"
													value=""><?php echo $submit;?></button>
												<button type="button" class="btn default"
													onclick="redireccionar_casos_tabla();">Retornar</button>
											</div>
										</div>
										<!-- Invisible Input -->
										<input type="hidden" name="cas_id"
											value="<?php echo $get_cas_id;?>" />
										<!-- End Invisible Input -->
									</div>
								</form>
								<!-- END FORM-->
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<!-- BEGIN PORTLET-->
						<div class="portlet light bordered" style="display:<?php echo $show_Fileform;?>">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cogs font-green-sharp"></i> <span
										class="caption-subject font-green-sharp bold uppercase">File
										Input</span> <span class="caption-helper">Max File Allowed
										(1MByte) Extensions (pdf, png, jpg, gif)</span>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"> </a> <a
										href="#portlet-config" data-toggle="modal" class="config"> </a>
									<a href="javascript:;" class="reload"> </a> <a
										href="javascript:;" class="remove"> </a>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form name="form5" enctype="multipart/form-data" method="post"
									action="../classes/class.upload_v32/upload.php"
									class="form-horizontal form-bordered">
									<div class="form-body">
										<div class="form-group">
											<label class="control-label col-md-3">Payment Receipt</label>

											<div class="col-md-9">
												<div class="fileinput fileinput-new"
													data-provides="fileinput">
													<span class="btn default btn-file"> <span
														class="fileinput-new"> Select file </span> <span
														class="fileinput-exists"> Change </span> <input
														type="file"
														accept="image/jpg,image/png, image/gif, application/pdf"
														size="32" name="my_field" value="" id="xhr_field_payment" />
													</span> <input type="submit" name="Submit"
														class="btn blue fileinput-exists" value="upload"
														id="xhr_upload_payment" /> <span
														class="fileinput-filename"> </span> &nbsp; <a
														href="javascript:;" class="close fileinput-exists"
														data-dismiss="fileinput"> </a>
												</div>
												<div id="xhr_result_payment"></div>
												<div id="loading_payment" style="display: none;">
													<img alt=""
														src="../../assets/admin/layout3/img/loading-spinner-blue.gif">
												</div>
											</div>

										</div>
										<div class="form-group">
											<label class="control-label col-md-3">DNI/Passport Scan</label>
											<div class="col-md-9">
												<div class="fileinput fileinput-new"
													data-provides="fileinput">
													<span class="btn default btn-file"> <span
														class="fileinput-new"> Select file </span> <span
														class="fileinput-exists"> Change </span> <input
														type="file"
														accept="image/jpg,image/png, image/gif, application/pdf"
														size="32" name="my_field" value="" id="xhr_field_dni" />
													</span> <input type="submit" name="Submit"
														class="btn blue fileinput-exists" value="upload"
														id="xhr_upload_dni" /> <span class="fileinput-filename"> </span>
													&nbsp; <a href="javascript:;"
														class="close fileinput-exists" data-dismiss="fileinput"> </a>
												</div>
												<div id="xhr_result_dni"></div>
												<div id="loading_dni" style="display: none;">
													<img alt=""
														src="../../assets/admin/layout3/img/loading-spinner-blue.gif">
												</div>
											</div>
										</div>
										<div class="form-group" style="display: <?php if ($exa_aci==0) echo "none"; ?>;">
											<label class="control-label col-md-3">Photo Consent Scan</label>
											<div class="col-md-9">
												<div class="fileinput fileinput-new"
													data-provides="fileinput">
													<span class="btn default btn-file"> <span
														class="fileinput-new"> Select file </span> <span
														class="fileinput-exists"> Change </span> <input
														type="file"
														accept="image/jpg,image/png, image/gif, application/pdf"
														size="32" name="my_field" value="" id="xhr_field_aci" />
													</span> <input type="submit" name="Submit"
														class="btn blue fileinput-exists" value="upload"
														id="xhr_upload_aci" /> <span class="fileinput-filename"> </span>
													&nbsp; <a href="javascript:;"
														class="close fileinput-exists" data-dismiss="fileinput"> </a>
												</div>
												<div id="xhr_result_aci"></div>
												<div id="loading_aci" style="display: none;">
													<img alt=""
														src="../../assets/admin/layout3/img/loading-spinner-blue.gif">
												</div>
											</div>
										</div>
										<div class="form-group" id="file_disability" style="display: <?php echo $display_can_disabilitycom;?>">
											<label class="control-label col-md-3">Special Consideration:
												medical certificate scan</label>
											<div class="col-md-9">
												<div class="fileinput fileinput-new"
													data-provides="fileinput">
													<span class="btn default btn-file"> <span
														class="fileinput-new"> Select file </span> <span
														class="fileinput-exists"> Change </span> <input
														type="file"
														accept="image/jpg,image/png, image/gif, application/pdf"
														size="32" name="my_field" value=""
														id="xhr_field_disability" />
													</span> <input type="submit" name="Submit"
														class="btn blue fileinput-exists" value="upload"
														id="xhr_upload_disability" /> <span
														class="fileinput-filename"> </span> &nbsp; <a
														href="javascript:;" class="close fileinput-exists"
														data-dismiss="fileinput"> </a>
												</div>
												<div id="xhr_result_disability"></div>
												<div id="loading_disability" style="display: none;">
													<img alt=""
														src="../../assets/admin/layout3/img/loading-spinner-blue.gif">
												</div>
											</div>
										</div>


									</div>

								</form>
								<!-- END FORM-->
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
					<div class="col-md-4">
						<!-- BEGIN PORTLET-->
						<div class="portlet light bordered" style="display:<?php echo $show_Fileform;?>">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cogs font-green-sharp"></i> <span
										class="caption-subject font-green-sharp bold uppercase">File
										Check</span>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"> </a> <a
										href="#portlet-config" data-toggle="modal" class="config"> </a>
									<a class="reload"
										onclick="reload_filescheck(<?php echo $get_can_id;?>);"> </a>
									<a href="javascript:;" class="remove"> </a>
								</div>
							</div>
							<div id="files_check"></div>


						</div>
					</div>
				</div>








				<div class="row" style="display:<?php if ($get_cas_id=="") echo "none";?>">
					<div class="col-md-12">
						<!-- BEGIN PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cogs font-green-sharp"></i> <span
										class="caption-subject font-green-sharp bold uppercase">Compartir Caso</span>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"> </a> <a
										href="#portlet-config" data-toggle="modal" class="config"> </a>
									<a href="javascript:;" class="reload"> </a> <a
										href="javascript:;" class="remove"> </a>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form name="form_compartircasos"
									class="form-horizontal form-row-seperated">
									<div class="form-body">
										<div class="form-group">
											<label class="control-label col-md-3">Seleccione del cuadro izquierdo a quien quiere compartir el caso</label>								
												<div class="col-md-9" style="height: 200px;">	
												<select multiple="multiple" class="multi-select"
													id="my_multi_select1" name="usu_id[]">
													<?php 
													$usu_id_selected=getOption_selected($get_cas_id);
													?>
												</select>
											</div>
										</div>

									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button name="cas_id" type="button" class="btn green"
													value="<?php echo $get_cas_id;?>"
													onclick="updateCompartirCasos();">Modificar</button>
												<button type="button" class="btn default" onclick="redireccionar_casos_tabla();">Retornar</button>
											</div>
										</div>
									</div>
								</form>
								<!-- END FORM-->
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
				</div>




			</div>
		</div>
		<!-- END PAGE CONTENT INNER -->
	</div>

	<!-- END PAGE CONTENT -->

	<!-- END PAGE CONTAINER -->

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
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS USED BY DATE PICKER-->
	<script type="text/javascript"
		src="../../assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
	<script
		src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
		type="text/javascript"></script>
	<script
		src="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js"
		type="text/javascript"></script>
	<script
		src="../../assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"
		type="text/javascript"></script>
	<script
		src="../../assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js"
		type="text/javascript"></script>
	<script src="../../assets/global/plugins/typeahead/handlebars.min.js"
		type="text/javascript"></script>
	<script
		src="../../assets/global/plugins/typeahead/typeahead.bundle.min.js"
		type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS USED BY TOASTR-->
	<script
		src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
	<script src="../../assets/admin/pages/scripts/ui-toastr.js"></script>
	<!-- END PAGE LEVEL SCRIPTS USED BY TOASTR-->

	<!-- BEGIN PAGE LEVEL PLUGINS USED BY VALIDATION-->
	<script type="text/javascript"
		src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/ckeditor/ckeditor.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/bootstrap-markdown/lib/markdown.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS USED BY FILE INPUT-->
	<script type="text/javascript"
		src="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
	<!-- BEGIN PAGE LEVEL PLUGINS USED BY FILE INPUT-->

	<!-- BEGIN PAGE LEVEL STYLES -->
	<script src="../../assets/global/scripts/metronic.js"
		type="text/javascript"></script>
	<script src="../../assets/admin/layout3/scripts/layout.js"
		type="text/javascript"></script>
	<script src="../../assets/admin/layout3/scripts/demo.js"
		type="text/javascript"></script>
	<script src="../../assets/admin/pages/scripts/components-dropdowns.js"></script>
	<script src="../../assets/admin/pages/scripts/form-samples.js"></script>
	<script src="../../assets/admin/pages/scripts/form-validation.js"></script>
	<script src="../../assets/admin/pages/scripts/components-form-tools.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
	<!-- END PAGE LEVEL STYLES -->


	<script>
jQuery(document).ready(function() {    
   // initiate layout and plugins
	   
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
   FormValidation.init();
   FormSamples.init();
   Demo.init(); // init demo features
   //ComponentsFormTools.init();
   ComponentsDropdowns.init();
   UIToastr.init(); //used by toastr

 
});
</script>
	<!-- END JAVASCRIPTS -->


	<!-- START AJAX -->

	<script>
//--START JAVASCRIPT FUNCTIONS --
//deshab();
//deshab1();

function deshab() {
	  frm = document.forms['formulario_caso'];
	  for(i=0; ele=frm.elements[i]; i++)
	    ele.disabled=true;
	}

function deshab1() {
	  frm = document.forms['form_compartircasos'];
	  for(i=0; ele=frm.elements[i]; i++)
	    ele.disabled=true;
	}

	
	
function updateCompartirCasos(){ 
    var selected = $('#my_multi_select1').val();
    var length =  $('#my_multi_select1').val().length;
    var cas_id = this.document.form_compartircasos.cas_id.value;
    
    $.ajax({
         type:"POST",
         url: "../abm/abm.compartircasos.php",
         data:{selected:selected, length:length, cas_id:cas_id},
         cache: false,
         success : function (msg) {
     	    toast();   
     	 }
    });           
}

function nuevoModificarCaso(){

    var cas_id= this.document.formulario_caso.cas_id.value;

    var cas_caratula= this.document.formulario_caso.cas_caratula.value;
    var cas_legajo=this.document.formulario_caso.cas_legajo.value;
    var cas_legajo1=this.document.formulario_caso.cas_legajo1.value;
    var esc_id=this.document.formulario_caso.esc_id.value;
    var juz_id=this.document.formulario_caso.juz_id.value;
    var jur_id=this.document.formulario_caso.jur_id.value;
    var cli_id=this.document.formulario_caso.cli_id.value;
    var mat_id=this.document.formulario_caso.mat_id.value;
    var cas_fecha=this.document.formulario_caso.cas_fecha.value; 


	if (cas_id==""){ //can_id "" = un nuevo registro, en caso contrario se almacena el can_id.
	    mensaje =	"Desea agregar una nueva Causa?";
	    confirmar=confirm(mensaje); 
		if (confirmar) {
    		showLoadingNewupdate();
            $.ajax({
                type:"POST",
                url: "../abm/abm.casos.php",
                data:{cas_id:cas_id, cas_caratula:cas_caratula, cas_legajo:cas_legajo, cas_legajo1:cas_legajo1, esc_id:esc_id, 
                      juz_id:juz_id, jur_id:jur_id, cli_id:cli_id, mat_id:mat_id, cas_fecha:cas_fecha},         
                cache: false,
                success : function (msg) {
                   // alert (msg);
                    hideLoadingNewupdate();
                    var new_can_id;
                	new_cas_id = parseInt(msg);
                	redireccionar_caso_formulario(new_cas_id);    
            	}
            });  
		}   
	}else{
    	showLoadingNewupdate();
        $.ajax({
            type:"POST",
            url: "../abm/abm.casos.php",
            data:{cas_id:cas_id, cas_caratula:cas_caratula, cas_legajo:cas_legajo, cas_legajo1:cas_legajo1, esc_id:esc_id, 
                juz_id:juz_id, jur_id:jur_id, cli_id:cli_id, mat_id:mat_id, cas_fecha:cas_fecha},
            cache: false,
            success : function (msg) {
            	toast();
            	hideLoadingNewupdate();
        	}
        });    
	}
        
}   


function showLoadingNewupdate(){
    this.document.getElementById("loading_newupdate").style.display = 'inline';
    }
function hideLoadingNewupdate(){
    this.document.getElementById("loading_newupdate").style.display = 'none';
    }
function toast(){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
	};			        
	toastr.success('Modificado Correctamente!', 'Caso');  		        
 }   
function redireccionar_caso_formulario(cas_id){
    pagina="caso_formulario.php?cas_id="+ cas_id;
    redireccionar(pagina);	
}

function redireccionar_casos_tabla(cas_id){
	if (cas_id=="0"){
      	mensaje =	"Uds esta por abandonar la página actual. Perderá los datos no almacenados. Desea Continuar?";
  		confirmar=confirm(mensaje); 
  		if (confirmar) {
          	pagina="caso_tabla.php";
            redireccionar(pagina);
        }
    }else{
    	pagina="caso_tabla.php";
        redireccionar(pagina);
        }
}
function redireccionar(pagina) {
	{
	location.href=pagina;
	} 
    setTimeout ("redireccionar()", 20000);   
}
function reload_filescheck(can_id, exa_aci){
    $.ajax({
    url:"ajax/ajax.filescheck.php",
    type: "POST",
    data:{can_id:can_id, exa_aci:exa_aci}, 
    success: function(opciones){ 
        $("#files_check").html(opciones);				
    }
    });
}

</script>
	<!-- END JAVASCRIPT FUNCTIONS -->

 </body>
<!-- END BODY -->
</html>