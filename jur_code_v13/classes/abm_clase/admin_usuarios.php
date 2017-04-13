<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<title>Demo abm</title>
	
	<!-- Estilos -->
	<link href="../classes/abm_clase/css/sitio.css" rel="stylesheet" type="text/css">
	<link href="../classes/abm_clase/css/abm.css" rel="stylesheet" type="text/css">

	<!-- MooTools -->
	<script type="text/javascript" src="../classes/abm_clase/js/mootools-1.2.3-core.js"></script>
	<script type="text/javascript" src="../classes/abm_clase/js/mootools-1.2.3.1-more.js"></script>
	
	<!--FormCheck-->
	<script type="text/javascript" src="../classes/abm_clase/js/formcheck/lang/es.js"></script>
	<script type="text/javascript" src="../classes/abm_clase/js/formcheck/formcheck.js"></script>
	<link rel="stylesheet" href="../classes/abm_clase/js/formcheck/theme/classic/formcheck.css" type="text/css" media="screen"/>

	<!--Datepicker-->
	<link rel="stylesheet" href="../classes/abm_clase/js/datepicker/datepicker_vista/datepicker_vista.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="../classes/abm_clase/js/datepicker/datepicker.js"></script>

</head>
<body>

<?
require("../classes/abm_clase/comun/class_db.php");
require("../classes/abm_clase/comun/class_abm.php");
require("../classes/abm_clase/comun/class_paginado.php");
require("../classes/abm_clase/comun/class_orderby.php");

//conexión a la bd
$db = new class_db("localhost", "root", "root", "JUDICIAL");
$db->mostrarErrores = true;
$db->connect();

$abm = new class_abm(); 
$abm->tabla = 'Usuarios'; 
$abm->campoId = 'usu_id'; 
$abm->orderByPorDefecto = 'usu_apellido ASC'; 
$abm->mostrarBorrar = false; 
$abm->registros_por_pagina = 50; 
$abm->textoTituloFormularioAgregar = "Agregar"; 
$abm->textoTituloFormularioEdicion = "Editar"; 
$abm->campos = array( 
	array('campo' => 'usu_nombre', 
		'tipo' => 'texto',
		'tituloListado' => 'Nombre',
		'requerido' => true,
		'maxLen' => 50,
		'titulo' => 'Usu nombre'
	), 
	array('campo' => 'usu_apellido', 
		'tipo' => 'texto',
		'tituloListado' => 'Apellido',
		'requerido' => true,
		'maxLen' => 50,
		'titulo' => 'Usu apellido'
	), 
	array('campo' => 'usu_usuario', 
		'tipo' => 'texto',
		'tituloListado' => 'Usuario',
		'requerido' => true,
		'maxLen' => 50,
		'titulo' => 'Usu usuario'
	), 
	array('campo' => 'usu_clave', 
		'tipo' => 'texto',
		'tituloListado' => 'Clave',
		'requerido' => true,
		'maxLen' => 50,
		'titulo' => 'Usu clave'
	), 
	array('campo' => 'usu_perfil', 
		'tipo' => 'texto',
		'hint' => "1 Admin 2 Básico",
		'tituloListado' => 'Perfil',
		'requerido' => true,
		'maxLen' => 3,
		'titulo' => 'Usu perfil'
	)
); 
$abm->generarAbm('', 'Administrar Usuarios'); 




echo "<br><br>";

if ( $_GET['vercodigo'] ){
	highlight_file(__FILE__);
}else{
	//echo "<a href='?vercodigo=1'>Ver c�digo fuente</a>";
}
?>

</body>
</html>