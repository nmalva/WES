<?php
session_start();
ob_start();
require_once ("../classes/class.usuarios.php");
require_once ("../classes/class.bd.php");
include_once("../classes/mobile-detect/Mobile_Detect.php");

$usu_usuario = $_POST["usu_usuario"];
$usu_clave = $_POST["usu_clave"];

$sql = "SELECT * FROM Usuarios WHERE usu_usuario='{$usu_usuario}' and usu_clave ='{$usu_clave}'";


$bd = new BD();
$class_detect= new Mobile_Detect();
$resultados = $bd->ejecutar($sql);
$r = $bd->retornar_fila($resultados);


unset($_SESSION["tenant_control"]);


if (is_numeric($r["usu_id"])) {
    $_SESSION["tenant_control"] = 1;
    $_SESSION["usu_id"] = $r["usu_id"];
    $_SESSION["usu_nombre"] = $r["usu_nombre"];
    $_SESSION["usu_apellido"] = $r["use_apellido"];
    $_SESSION["usu_perfil"] = $r["usu_perfil"];
    $_SESSION["device_type"] = ($class_detect->isMobile() ? ($class_detect->isTablet() ? 'tablet' : 'phone') : 'computer');
    $url = "home.php";
} else {
    $nombre = $_POST["usu_usuario"];
    unset($_SESSION["usu_id"], $_SESSION["usu_nombre"], 
        $_SESSION["usu_apellido"], $_SESSION["usu_perfil"]); 
        // esto borra lo que tiene "idusuario y nombre" de SESSION, es decir borro la sesi�n
    $url = "login_formulario.php?error=1&nombre=" . $nombre;
}

header("Location: {$url}");
ob_end_flush();
?>