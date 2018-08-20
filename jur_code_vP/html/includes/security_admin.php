<?php 
if($_SESSION["usu_perfil"]>1){
   $string.="invalid access </br>";
   $string.="<a href='login_formulario.php'>return to login</a>";
   echo $string;
   exit();
}

?>