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
include_once ("../classes/class.clientes.php");
include_once ("../classes/class.utiles.php");
?>
<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php
$get_cli_id = $_GET["cli_id"];
$submit = "Guardar";
?>
<!-- END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->
<?php
// visiblePlacesform();

fillFilds($get_cli_id);
visibleFileform();

Function visibleFileform()
{
    Global $show_Fileform;
    if ($_GET["can_id"] == NULL)
        $show_Fileform = "none";
    else
        $show_Fileform = "";
}

function fillFilds($get_cli_id)
{
    global $cli_nombre;
    global $cli_apellido;
    global $cli_dni;
    global $cli_movil;
    global $cli_fijo;
    global $cli_email;
    global $cli_direccion;
    global $pro_id;
    global $loc_id;
    global $submit;
    
    if ($get_cli_id != NULL) {
        $class_clientes = new Clientes($get_cli_id);
        $class_utiles = new utiles();
        
        $cli_nombre = $class_clientes->getCli_nombre();
        $cli_apellido = $class_clientes->getCli_apellido();
        $cli_dni = $class_clientes->getCli_dni();
        $cli_movil = $class_clientes->getCli_movil();
        $cli_fijo = $class_clientes->getCli_fijo();
        $cli_email = $class_clientes->getCli_email();
        $cli_direccion = $class_clientes->getCli_direccion();
        $pro_id = $class_clientes->getPro_id();
        $loc_id = $class_clientes->getLoc_id();
        $submit = "Modificar";
    }
}

function getOption_pro($pro_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Provincias";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["pro_id"] == $pro_id)
            echo "<option value='{$r["pro_id"]}' selected='selected'>{$r["pro_nombre"]} </option>";
        else
            echo "<option value='{$r["pro_id"]}'>{$r["pro_nombre"]} </option>";
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
						onclick="redireccionar_clientes_tabla(<?php echo ($get_cli_id!=NULL? 1 : 0 );?>);">Retornar</a>
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
										class="caption-subject font-red-sunglo bold uppercase">Cliente</span>
									<span class="caption-helper">Agregar o Modificar Cliente</span>
								</div>
								<div class="tools">
									<a href="" class="collapse"> </a> <a href="#portlet-config"
										data-toggle="modal" class="config"> </a> <a href=""
										class="reload"> </a> <a href="" class="remove"> </a>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form action="javascript:nuevoModificarCliente();"
									name="formulario_cliente" id="formulario_cliente"
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
													<label class="control-label col-md-3">Nombre</label>
													<div class="col-md-9">
														<input type="text" name="cli_nombre" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_nombre;?>">

													</div>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Apellido</label>
													<div class="col-md-9">
														<input type="text" name="cli_apellido" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_apellido;?>">

													</div>
												</div>
											</div>
											<!--/span-->
										</div>
										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Dni</label>
													<div class="col-md-9">
														<input type="text" name="cli_dni" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_dni;?>">

													</div>
												</div>
											</div>
											<!--/span-->
										</div>
										<!--/row-->
										<h3 class="form-section">Contacto</h3>
										<!--/row-->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Teléfono Fijo</label>
													<div class="col-md-9">
														<input type="text" name="cli_fijo" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_fijo;?>">

													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Teléfono Móvil</label>
													<div class="col-md-9">
														<input type="text" name="cli_movil" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_movil;?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Provincia</label>
													<div class="col-md-9">
														<select class="select2_category form-control"
															onChange="getOption_pro();" name="pro_id" id="pro_id"
															data-placeholder="Choose a Category" tabindex="1">
																	<?php  getOption_pro($pro_id);?>
																</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Ciudad</label>
													<div class="col-md-9" id="ciudades">
														<select class="select2_category form-control"
															name="loc_id" data-placeholder="Choose a Category"
															tabindex="1">
														</select>
													</div>
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Dirección</label>
													<div class="col-md-9">
														<input type="text" name="cli_direccion" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_direccion;?>">

													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">E-mail</label>
													<div class="col-md-9">
														<input type="text" name="cli_email" data-required="1"
															class="form-control" placeholder=""
															value="<?php echo $cli_email;?>">

													</div>
												</div>
											</div>
											<!--/span-->
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
													onclick="redireccionar_clientes_tabla(<?php echo ($get_cli_id!=NULL? 1 : 0 );?>);">Retornar</button>
											</div>
										</div>
										<!-- Invisible Input -->
										<input type="hidden" name="cli_id"
											value="<?php echo $get_cli_id;?>" />
										<!-- End Invisible Input -->
									</div>
								</form>
								<!-- END FORM-->
							</div>
						</div>
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
	<script src="../../assets/admin/pages/scripts/form-samples.js"></script>
	<script src="../../assets/admin/pages/scripts/form-validation.js"></script>
	<script src="../../assets/admin/pages/scripts/components-form-tools.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL STYLES -->


	<script>
jQuery(document).ready(function() {    
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout
   FormValidation.init();
   Demo.init(); // init demo features
   FormSamples.init();
   ComponentsFormTools.init();
   UIToastr.init(); //used by toastr
 
});
</script>
	<!-- END JAVASCRIPTS -->


	<!-- START AJAX -->

	<script>
//--START JAVASCRIPT FUNCTIONS --
getOption_pro(<?php echo $loc_id;?>);

function getOption_pro(loc_id){
	 var loc_id = loc_id;
	 var pro_id = $('#pro_id').val();
	// alert (pro_id);
	 $.ajax({
         type:"POST",
         url: "ajax/ajax.combo_localidad.php",
         data:{pro_id:pro_id, loc_id:loc_id},
         cache: false,
         success : function (msg) {
        	 $("#ciudades").html(msg);		
       	    //toast();   
     	 }
    });          
		
}

function updatePlaceForSit(){ 
    var length =  $('#my_multi_select1').val().length;
    var exa_id = this.document.form_placeforsit.exa_id.value;

    $.ajax({
         type:"POST",
         url: "../abm/abm.placeforsit.php",
         data:{selected:selected, length:length, exa_id:exa_id},
         cache: false,
         success : function (msg) {
     	    toast();   
     	 }
    });           
}

function nuevoModificarCliente(){
   
    var cli_id= this.document.formulario_cliente.cli_id.value;

    var cli_nombre= this.document.formulario_cliente.cli_nombre.value;
    var cli_apellido=this.document.formulario_cliente.cli_apellido.value;
    var cli_dni=this.document.formulario_cliente.cli_dni.value;
    var cli_movil=this.document.formulario_cliente.cli_movil.value;
    var cli_fijo=this.document.formulario_cliente.cli_fijo.value;
    var cli_email=this.document.formulario_cliente.cli_email.value;
    var cli_direccion=this.document.formulario_cliente.cli_direccion.value;
    var pro_id=this.document.formulario_cliente.pro_id.value; 
    var loc_id=this.document.formulario_cliente.loc_id.value; 
	if (cli_id==""){ //can_id "" = un nuevo registro, en caso contrario se almacena el can_id.
	    mensaje =	"Desea agregar una nuevo Cliente?";
	    confirmar=confirm(mensaje); 
		if (confirmar) {
    		showLoadingNewupdate();
            $.ajax({
                type:"POST",
                url: "../abm/abm.clientes.php",
                data:{cli_id:cli_id,cli_nombre:cli_nombre, cli_apellido:cli_apellido, cli_dni:cli_dni, 
                     cli_movil:cli_movil, cli_fijo:cli_fijo, cli_email:cli_email, cli_direccion:cli_direccion, pro_id:pro_id, loc_id:loc_id},         
                cache: false,
                success : function (msg) {
                    alert ('Cliente ingresado con exito');
                    hideLoadingNewupdate();
                    var new_cli_id;
                	new_cli_id = parseInt(msg);
                	redireccionar_cliente_formulario(new_cli_id);    
            	}
            });  
		}   
	}else{
    	showLoadingNewupdate();
        $.ajax({
            type:"POST",
            url: "../abm/abm.clientes.php",
            data:{cli_id:cli_id, cli_nombre:cli_nombre, cli_apellido:cli_apellido, cli_dni:cli_dni, 
                cli_movil:cli_movil, cli_fijo:cli_fijo, cli_email:cli_email, cli_direccion:cli_direccion, pro_id:pro_id, loc_id:loc_id},  
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
	toastr.success('Modificado Correctamente', 'Cliente');  		        
 }   
function redireccionar_cliente_formulario(cli_id){
    pagina="cliente_formulario.php?cli_id="+ cli_id;
    redireccionar(pagina);	
}

function redireccionar_clientes_tabla(cli_id){
	if (cli_id=="0"){
      	mensaje =	"Uds esta por abandonar la página actual. Perderá los datos no almacenados. Desea Continuar?";
  		confirmar=confirm(mensaje); 
  		if (confirmar) {
          	pagina="cliente_tabla.php";
            redireccionar(pagina);
        }
    }else{
    	pagina="cliente_tabla.php";
        redireccionar(pagina);
        }
}
function redireccionar(pagina) {
	{
	location.href=pagina;
	} 
    setTimeout ("redireccionar()", 20000);   
}


</script>
	<!-- END JAVASCRIPT FUNCTIONS -->
	<script type="text/javascript">

//--BEGIN FILES UPLOAD--
window.onload = function () {

	
}



    </script>
</body>
<!-- END BODY -->
</html>