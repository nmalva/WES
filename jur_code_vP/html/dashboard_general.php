<?php include ("includes/title.php");?>
<?php include ("includes/security_session.php");?>
<?php include ("includes/security_admin.php");?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="tipo_contenido" content="text/html;"
	http-equiv="content-type" charset="utf-8">
<!--  BEGIN INCLUDE CLASSES -->
<?php include_once("../classes/class.casos.php");?>
<?php include_once("../classes/class.utiles.php");?>
<?php include_once("../classes/class.bd.php");?>

<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php


$session_usu_id= $_SESSION["usu_id"];
$session_device_type=$_SESSION["device_type"];

?>
<!--  END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->
<?php 
function get_cantidad_actividades(){
    $class_bd=new bd();
    $sql="SELECT count(*) FROM Actividades
          INNER JOIN TipoActividad   on Actividades.tia_id = TipoActividad.tia_id
          INNER JOIN Usuarios        on Actividades.usu_idemisor = Usuarios.usu_id
           INNER JOIN CompartirCasos on Actividades.cas_id=CompartirCasos.cas_id
          WHERE (act_estado=0 or act_estado =1 or act_estado=2) 
          AND tia_popup=1
          AND tia_diaprevio > 0  
    	  AND act_fecha <= DATE_ADD(CURDATE(), INTERVAL tia_diaprevio DAY)
          AND CompartirCasos.usu_id='{$_SESSION["usu_id"]}'";  //act_estad=o=0 es abierto
         
    $resultado=$class_bd->ejecutar($sql);
    return(mysql_result($resultado, 0));
}

function get_cantidad_casos($session_usu_id){
    $class_bd=new bd();
    $sql="SELECT count(*) FROM Casos 
            INNER JOIN Clientes on Casos.cli_id = Clientes.cli_id
            INNER JOIN Jurisdicciones on Casos.jur_id = Jurisdicciones.jur_id
            INNER JOIN Juzgados    on Casos.juz_id = Juzgados.juz_id
            INNER JOIN Materias    on Casos.mat_id = Materias.mat_id
            INNER JOIN EstadoCaso  on Casos.esc_id = EstadoCaso.esc_id
            INNER JOIN CompartirCasos on Casos.cas_id=CompartirCasos.cas_id 
          WHERE usu_id={$session_usu_id}";
    $resultado=$class_bd->ejecutar($sql);
    return(mysql_result($resultado, 0));
}

function get_cantidad_clientes(){
    $class_bd=new bd();
    $sql="SELECT count(*) FROM Clientes";
    $resultado=$class_bd->ejecutar($sql);
    return(mysql_result($resultado, 0));
}


function getRowsPerYear($year, $session_usu_id){
    $class_bd=new bd();
    $year_ini=$year-1;
    $sql="SELECT * FROM Casos 
    INNER JOIN CompartirCasos on Casos.cas_id=CompartirCasos.cas_id 
    WHERE
         cas_timestamp > '{$year_ini}-12-31'
         AND cas_timestamp < '{$year}-12-31'
         AND usu_id={$session_usu_id}";
    $resultado = $class_bd->ejecutar($sql);
    $total_rows = mysql_num_rows($resultado);
    return ($total_rows);
}

function getCasePerState($session_usu_id){
    $class_bd=new bd();
    $year_ini=$year-1;
    $sql="SELECT esc_nombre, COUNT(*) AS Cuenta
			FROM Casos 
			INNER JOIN EstadoCaso on EstadoCaso.esc_id=Casos.esc_id
			INNER JOIN CompartirCasos on Casos.cas_id=CompartirCasos.cas_id 
			WHERE usu_id={$session_usu_id}
			GROUP BY esc_nombre
			ORDER BY esc_nombre ASC";

	$i=0;
    $resultado = $class_bd->ejecutar($sql);
    while ($r=$class_bd->retornar_fila($resultado)){
    	$array[$i][0]= $r["esc_nombre"];
    	$array[$i][1]= $r["Cuenta"];
    	$i++;
    }

    return ($array);
}

function getCasePerMateria(){
    $class_bd=new bd();
    $year_ini=$year-1;
    $sql="SELECT mat_nombre, COUNT(*) AS Cuenta
			FROM Casos 
			INNER JOIN Materias on Materias.mat_id=Casos.mat_id
			GROUP BY mat_nombre
			ORDER BY Cuenta DESC";

	$i=0;
    $resultado = $class_bd->ejecutar($sql);
    while ($r=$class_bd->retornar_fila($resultado)){
    	$array[$i][0]= $r["mat_nombre"];
    	$array[$i][1]= $r["Cuenta"];
    	$i++;
    }

    return ($array);
}

?>



<head>

<!--  PAGE TITLE  -->
<?php include ("includes/pagetitle.php");?>
<!--  END PAGE TITLE  -->

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php include("includes/globalstyle.html");?>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES USED BY TABLE-->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/select2/select2.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<?php include ("includes/themestyle.html")?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />

  <!-- Gráfico de Barras-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);
      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['2016', 'Casos'],
          ["2015", <?php echo getRowsPerYear("2015", $session_usu_id);?>],
          ["2016", <?php echo getRowsPerYear("2016", $session_usu_id);?>],
          ["2017", <?php echo getRowsPerYear("2017", $session_usu_id);?>],
          ["2018", <?php echo getRowsPerYear("2018", $session_usu_id);?>]
        ]);
        var options = {
          width: 1000,
          Height: 400,
          legend: { position: 'none' },
          chart: {
          /*title: 'Candidates per Year',
          subtitle: 'Considered Sent State Candidate'*/ },
          vAxis: {format: 'decimal'},
          axes: {
           /* x: {
              0: { side: 'top', label: 'White to move'} // Top x-axis.
            }*/
          },
          bar: { groupWidth: "90%" }

        };
        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>

   

 <!-- Gráfico Casos por Estado-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php	
          $array_filas = getCasePerState($session_usu_id);
          $cantidad_filas = count($array_filas);
          echo "['Task', 'Hours per Day'],";
          for ($i=0 ; $i<$cantidad_filas; $i++){
          	echo "['{$array_filas[$i][0]}',     {$array_filas[$i][1]}],";
          }
          ?>
        ]);
        var options = {
         // title: 'Estado de Casos',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>



  <!-- Gráfico Casos por Materia-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
       var data = google.visualization.arrayToDataTable([  
        <?php	
          $array_filas = getCasePerMateria();
          $cantidad_filas = count($array_filas);
          $q_valores_mostrar=9;
          for ($i=0 ; $i<$cantidad_filas; $i++){
          	$total += $array_filas[$i][1];
          }
          echo "['Task', 'Hours per Day'],";
          for ($i=0 ; $i<$cantidad_filas; $i++){
          	$total_final=$total - $total_mostrado;
          	if ($i<$q_valores_mostrar){
          		echo "['{$array_filas[$i][0]}', {$array_filas[$i][1]}],";
          		$total_mostrado += $array_filas[$i][1]; 
          	}else{
          		echo "['OTROS',  {$total_final}]";
          		break;
          	}	
          }
          ?>
        ]);
        var options = {
         // title: 'Estado de Casos',
        is3D: true,
        //legend: '',
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart1_3d'));
        chart.draw(data, options);
      }
    </script>


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
		
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
			<div class="container">
				
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<!-- BEGIN PAGE BREADCRUMB -->
				<!-- END PAGE BREADCRUMB -->
				<!-- BEGIN PAGE CONTENT INNER -->
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-equalizer font-red-sunglo"></i>
										<span class="caption-subject font-red-sunglo bold uppercase">Casos Inciados / Año</span>
										<span class="caption-helper">Se considera fecha de carga</span>
									</div>
									<div class="tools">
										<a href="" class="collapse">
										</a>
										<a href="#portlet-config" data-toggle="modal" class="config">
										</a>
										<a href="" class="reload">
										</a>
										<a href="" class="remove">
										</a>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="row">
										<div class="col-md-6">
											<div id="top_x_div" style="width: 1200px; height: 400px;"></div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE CONTENT INNER -->
					<!-- BEGIN PAGE CONTENT INNER -->
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-equalizer font-red-sunglo"></i>
										<span class="caption-subject font-red-sunglo bold uppercase"> % Estado de Casos / Estado</span>
										<span class="caption-helper">Según estado configurado</span>
									</div>
									<div class="tools">
										<a href="" class="collapse">
										</a>
										<a href="#portlet-config" data-toggle="modal" class="config">
										</a>
										<a href="" class="reload">
										</a>
										<a href="" class="remove">
										</a>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="row">
										<div class="col-md-6">
											<div id="piechart_3d" style="width: 1000px; height: 500px;"></div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE CONTENT INNER -->
					<!-- BEGIN PAGE CONTENT INNER -->
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-equalizer font-red-sunglo"></i>
										<span class="caption-subject font-red-sunglo bold uppercase"> % Estado de Casos / Materia</span>
										<span class="caption-helper">Según materia configurada</span>
									</div>
									<div class="tools">
										<a href="" class="collapse">
										</a>
										<a href="#portlet-config" data-toggle="modal" class="config">
										</a>
										<a href="" class="reload">
										</a>
										<a href="" class="remove">
										</a>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="row">
										<div class="col-md-6">
											<div id="piechart1_3d" style="width: 1100px; height: 800px;"></div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE CONTENT INNER -->

			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>
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
	<script type="text/javascript"
		src="../../assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
	<script type="text/javascript"
		src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="../../assets/global/scripts/metronic.js"
		type="text/javascript"></script>
	<script src="../../assets/admin/layout3/scripts/layout.js"
		type="text/javascript"></script>
	<script src="../../assets/admin/layout3/scripts/demo.js"
		type="text/javascript"></script>
	<script src="../../assets/admin/pages/scripts/table-advanced.js"></script>
	<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout    
   Demo.init(); // init demo features
   TableAdvanced.init();
});

//--START JAVASCRIPT FUNCTIONS--
function redireccionar_caso_tabla(cas_id){
	pagina = "caso_tabla.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_actividades_tabla(cas_id){
	pagina = "actividades_tabla.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_caso_actividades(cas_id){
	pagina = "caso_actividades_tabla.php?cas_id="+ cas_id;
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_cliente_tabla(){
	pagina = "cliente_tabla.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_actividades_calendario(){
	pagina = "actividades_calendario.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_actividades_calendario_movil(){
	pagina = "actividades_calendario_movil.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar(pagina) {
	{
	location.href=pagina;
	}             
}
//--END JAVASCRIPT FUNCTIONS--
</script>

</body>
<!-- END BODY -->
</html>