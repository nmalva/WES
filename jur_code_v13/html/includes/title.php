<?php 
session_start();
ini_set("session.cookie_lifetime","10");
ini_set("session.gc_maxlifetime", "10");
ob_start();
include ("variables.php");
?>
<!-- 
Template Name: Administrador de Causas Judiciales
Version: 13
Author: Nicolas Malvasio
Website: http://www.warasolutions.com/
Contact: nmalva@hotmail.com
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->