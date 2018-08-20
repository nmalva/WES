<?php 
if ($_SESSION["tenant_control"] =='ortiz'){
       if($_SESSION["usu_id"]==NULL){
           $string.="Session fuera de Tiempo </br>";
           $string.="<a href='login_formulario.php'>volver para loguearse</a>";
           echo $string;
           exit();
       }
}else{
      $string.="Session Invalida </br>";
      $string.="<a href='login_formulario.php'>volver para loguearse</a>";
      echo $string;
      exit();     
}

?>