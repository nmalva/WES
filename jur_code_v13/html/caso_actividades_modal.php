<?php 
session_start();
ini_set("session.cookie_lifetime","10");
ini_set("session.gc_maxlifetime", "10");
ob_start();
?>
<?php 
include_once("../classes/class.bd.php");
include_once("../classes/class.casos.php");
include_once("../classes/class.actividades.php");
include_once("../classes/class.utiles.php");
?>
<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php 
$get_act_id=$_GET["act_id"];

$cas_id=($_GET["cas_id"]!="" ? $_GET["cas_id"] : getCasId($get_act_id));
$session_usu_id=$_SESSION["usu_id"];
$submit="Guardar";
$usu_perfil=$_SESSION["usu_perfil"];

?>
<!-- END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->

<!--  BEGIN PHP FUNCTIONS -->
<?php 
//visiblePlacesform();

fillFilds($get_act_id);
//visibleFileform();

function getCasId($act_id){  
    $class_actividades=new Actividades($act_id);
    return($class_actividades->getCas_id());
}

function getCasoInfo($cas_id){
    $class_bd=new bd();
    $sql="SELECT * FROM Casos
    INNER JOIN Clientes on Casos.cli_id=Clientes.cli_id
    WHERE cas_id={$cas_id}";

    $resultado=$class_bd->ejecutar($sql);
    $r=$class_bd->retornar_fila($resultado);
    $string.= " <i style='font-size:14px;' class='icon-user'>  Cliente: ". $r["cli_nombre"]." ".$r["cli_apellido"]." - Caso {$r["cas_id"]}</i>";
	$string.=" <i style='font-size:12px;'> - ".$r["cas_caratula"]." - </i>";
	echo $string;
}


Function visibleFileform(){
    Global $show_Fileform;
    if ($_GET["can_id"]==NULL)
        $show_Fileform="none";
    else
         $show_Fileform="";
}

function fillFilds($get_act_id){
    global $tia_id;
    global $act_estado;
    global $usu_idemisor;
    global $usu_idresponsable;
    global $act_comentario;
    global $act_fecha;
    global $act_fechacierre;
    global $submit;      

    if ($get_act_id!=NULL){    
        $class_actividades =new Actividades($get_act_id);
        $class_utiles=new utiles();
        
        $tia_id=$class_actividades->getTia_id();
        $act_estado=$class_actividades->getAct_estado();
        $usu_idemisor=$class_actividades->getUsu_idemisor();
        $usu_idresponsable=$class_actividades->getUsu_idresponsable();
        $act_comentario=$class_actividades->getAct_comentario();
        $act_fecha=$class_utiles->fecha_mysql_php_datetime($class_actividades->getAct_fecha());
        $act_fechacierre="";       
        $submit="Modificar";
   }
}

function getOption_actividad($tia_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM TipoActividad ORDER BY tia_nombre ASC";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["tia_id"]==$tia_id)
            echo "<option value='{$r["tia_id"]}' selected='selected'>{$r["tia_nombre"]} </option>";
        else 
            echo "<option value='{$r["tia_id"]}' >{$r["tia_nombre"]} </option>";
    }
}

function getOption_responsable($usu_idresponsable)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Usuarios";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["usu_id"]==$usu_idresponsable)
            echo "<option value='{$r["usu_id"]}' selected='selected'>{$r["usu_nombre"]} </option>";
        else
            echo "<option value='{$r["usu_id"]}'>{$r["usu_nombre"]} </option>";
    }
}
function getOption_mat($mat_id)
{
    $class_bd = new bd();
    $sql = "SELECT * FROM Materias";
    $resultado = $class_bd->ejecutar($sql);
    while ($r = $class_bd->retornar_fila($resultado)) {
        if ($r["mat_id"]==$mat_id)
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
        if ($r["cli_id"]==$cli_id)
            echo "<option value='{$r["cli_id"]}' selected='selected'>{$r["cli_apellido"]} {$r["cli_nombre"]} - {$r["cli_dni"]} </option>";
        else
            echo "<option value='{$r["cli_id"]}'>{$r["cli_apellido"]} {$r["cli_nombre"]} - {$r["cli_dni"]} </option>";
    }
}
?>
<!--  END PHP FUNCTIONS -->
<!-- BEGIN PAGE LEVEL STYLES USED BYE TOASTR NOTIFICATION -->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" />
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES USED BY VALIDATION-->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<div class="caption">
		<i class="icon-equalizer font-red-sunglo"></i> <span
			class="caption-subject font-red-sunglo bold uppercase">Actividad</span>
		<span class="caption-helper">Agregar Modificar una Actividad del Caso</span><br><br>
		<?php getCasoInfo($cas_id);?>
	</div>
</div>



<div class="modal-body">

	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="javascript:nuveoModificarActividad();"
						name="formulario_actividad" id="formulario_actividad"
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
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Actividad</label>
										<div class="col-md-9">
											<select onload='getOption_estado(<?php echo $act_estado;?>)' onchange='getOption_estado(<?php echo $act_estado;?>)' <?php if ($get_act_id!="") echo "disabled";?> class="select2_category form-control" name="tia_id"
												data-placeholder="Choose a Category" tabindex="1">
    												<?php getOption_actividad($tia_id);?>
    										</select>
										</div>
									</div>
								</div>
								
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Estado</label>
										<div class="col-md-9" id="estado">
											
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Fecha </label>
										<div class="col-md-9">
											<div class="input-group date form_datetime"
												data-date-format="DD/MM/YY">
												<input type="text" class="form-control" readonly
													name="act_fecha" value="<?php echo $act_fecha;?>"> 
													<span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Responsable</label>
										<div class="col-md-9">
											<select class="select2_category form-control" name="usu_idresponsable"
												data-placeholder="Choose a Category" tabindex="1">
    												<?php getOption_responsable($usu_idresponsable);?>
    										</select>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<!--/row-->
							<h3 class="form-section"></h3>
							<!--/span-->

							<!--/row-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"></label>
										<div class="col-md-12">
											<textarea class="form-control" name="act_comentario" rows="7"><?php echo stripslashes($act_comentario); ?></textarea>
										</div>
									</div>
								</div>

								<!--/span-->
							</div>
						</div>
							<input type="hidden" name="act_id" class="btn blue" value='<?php echo $get_act_id;?>'>
	                        <input type="hidden" name="cas_id" class="btn blue" value='<?php echo $cas_id;?>'>
	                        <input type="hidden" name="usu_idemisor" class="btn blue" value='<?php echo $session_usu_id;?>'>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>


</div>
<a style="margin-left: 20px;" href="caso_actividades_tabla.php?cas_id=<?php echo $cas_id?>">ir al caso...</a>
<div class="modal-footer">
    <img alt="" src="../../assets/admin/layout3/img/loading-spinner-blue.gif" id="loading_newupdate" style="display: none;">
 
	<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
	<button type="button" onclick="nuevoModificarActividad();" name="act_submit" class="btn blue"><?php echo $submit;?></button>

</div>


<!-- BEGIN PAGE LEVEL PLUGINS USED BY DATE PICKER-->
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS USED BY TOASTR-->
<script	src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="../../assets/admin/pages/scripts/ui-toastr.js"></script>
<!-- END PAGE LEVEL SCRIPTS USED BY TOASTR-->

<!-- BEGIN PAGE LEVEL PLUGINS USED BY VALIDATION-->
<script type="text/javascript" src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL STYLES -->

<script src="../../assets/admin/pages/scripts/form-samples.js"></script>
<script src="../../assets/admin/pages/scripts/form-validation.js"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script> <!-- se anulo una línea en este archivo ya que no dejaba bajar los combos -->

<!-- END PAGE LEVEL STYLES -->
<script>

getOption_estado(<?php echo $act_estado;?>)

function getOption_estado(act_estado){

	 var tia_id= this.document.formulario_actividad.tia_id.value;
	 $.ajax({
       type:"POST",
       url: "ajax/ajax.combo_estado.php",
       data:{tia_id:tia_id, act_estado:act_estado},
       cache: false,
       success : function (msg) {
        	 $("#estado").html(msg);		
     	    //toast();   
   	 }
  });       
	
		
}
function nuevoModificarActividad(){
    var act_id= this.document.formulario_actividad.act_id.value;
	var cas_id= this.document.formulario_actividad.cas_id.value;     
    var tia_id= this.document.formulario_actividad.tia_id.value;
    var act_estado= this.document.formulario_actividad.act_estado.value;
    var usu_idemisor=this.document.formulario_actividad.usu_idemisor.value;
    var usu_idresponsable=this.document.formulario_actividad.usu_idresponsable.value;
    var act_comentario=this.document.formulario_actividad.act_comentario.value;  
    var act_fecha=this.document.formulario_actividad.act_fecha.value;


    if (act_id==""){ //can_id "" = un nuevo registro, en caso contrario se almacena el can_id.
	    mensaje =	"Desea agregar una nueva Actividad?";
	    confirmar=confirm(mensaje); 
		if (confirmar) {
    		showLoadingNewupdate();
            $.ajax({
                type:"POST",
                url: "../abm/abm.actividades.php",
                data:{cas_id:cas_id, tia_id:tia_id, act_estado:act_estado, usu_idemisor:usu_idemisor, usu_idresponsable:usu_idresponsable, 
                      act_comentario:act_comentario, act_fecha:act_fecha},         
                cache: false,
                success : function (msg) {
                    //alert (msg);
                    hideLoadingNewupdate();
                    var new_act_id;
                	new_act_id = parseInt(msg);
                	alert ("La actividad ha sido ingresada");
                	//redireccionar_casos_tabla(new_cas_id);    
            	}
            });  
		}   
	}else{
    	showLoadingNewupdate();
        $.ajax({      	 
            type:"POST",
            url: "../abm/abm.actividades.php",
            data:{act_id:act_id, cas_id:cas_id, tia_id:tia_id, act_estado:act_estado, usu_idresponsable:usu_idresponsable, 
                act_comentario:act_comentario, act_fecha:act_fecha},   
            cache: false,
            success : function (msg) {
                //alert (msg);
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
	toastr.success('Modificada con Exito!', 'Actividad');  		        
 }   

</script>

<script>
jQuery(document).ready(function() {    
   //initiate layout and plugins
   // Metronic.init(); // init metronic core components
   //Layout.init(); // init current layout
   FormValidation.init();
   // Demo.init(); // init demo features
   FormSamples.init();
   //ComponentsFormTools.init();
   UIToastr.init(); //used by toastr
   ComponentsPickers.init();
   
 
});
</script>