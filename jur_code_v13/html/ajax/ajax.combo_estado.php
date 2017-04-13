<?php
session_start();
ini_set("session.cookie_lifetime","10");
ini_set("session.gc_maxlifetime", "10");
ob_start();
include_once("../../classes/class.bd.php");
include_once("../../classes/class.tipoactividad.php");



$tia_id=$_POST["tia_id"];
$act_estado=$_POST["act_estado"];
$usu_perfil=$_SESSION["usu_perfil"];
$tia_verificar=getTia_verificar($tia_id);


function getTia_verificar($tia_id){
    $class_tipoactividad=new TipoActividad($tia_id);
    return ($class_tipoactividad->getTia_verificar());
}



function getOption_estado($act_estado, $usu_perfil, $tia_verificar)
{
   if ($usu_perfil==2){ 
        if ($tia_verificar==0){
            if ($act_estado==0){
                echo "<option value='0' selected='selected'>Abierto</option>";
                echo "<option value='1' >Verificar</option>";
                echo "<option value='2' disabled='disabled'>Rever</option>";
                echo "<option value='3' >Cerrado</option>";   
            }
            elseif ($act_estado==1){
                echo "<option value='0' >Abierto</option>";
                echo "<option value='1' selected='selected'>Verificar</option>";
                echo "<option value='2'disabled='disabled'> Rever</option>";
                echo "<option value='3'> Cerrado</option>";
            }
            elseif ($act_estado==2){
                echo "<option value='0' >Abierto</option>";
                echo "<option value='1'>Verificar</option>";
                echo "<option value='2'disabled='disabled' selected='selected'> Rever</option>";
                echo "<option value='3'> Cerrado</option>";
            }
            elseif ($act_estado==3){
                echo "<option value='0'>Abierto</option>";
                echo "<option value='1'>Verificar</option>";
                echo "<option value='2'disabled='disabled'> Rever</option>";
                echo "<option value='3' selected='selected'> Cerrado</option>"; 
            }
        }else if ($tia_verificar==1){
            if ($act_estado==0){
                echo "<option value='0' selected='selected'>Abierto</option>";
                echo "<option value='1'>Verificar</option>";
                echo "<option value='2' disabled='disabled'>Rever</option>";
                echo "<option value='3'disabled='disabled'>Cerrado</option>"; 
            }
            if ($act_estado==1){
                echo "<option value='0' disabled='disabled'>Abierto</option>";
                echo "<option value='1'selected='selected'>Verificar</option>";
                echo "<option value='2' disabled='disabled'>Rever</option>";
                echo "<option value='3'disabled='disabled'>Cerrado</option>";
            }
            if ($act_estado==2){
                echo "<option value='0' disabled='disabled'>Abierto</option>";
                echo "<option value='1' >Verificar</option>";
                echo "<option value='2' disabled='disabled' selected='selected'>Rever</option>";
                echo "<option value='3'disabled='disabled'>Cerrado</option>";
            }
            elseif ($act_estado==3){
                echo "<option value='0'>Abierto</option>";
                echo "<option value='1'>Verificar</option>";
                echo "<option value='2' disabled='disabled'>Rever</option>";
                echo "<option value='3'disabled='disabled' selected='selected'>Cerrado</option>"; 
            }
        }
   }
   
   if ($usu_perfil==0 or $usu_perfil==1){

           if ($act_estado==0){
               echo "<option value='0' selected='selected'>Abierto</option>";
               echo "<option value='1' >Verificar</option>";
               echo "<option value='2' disabled='disabled'>Rever</option>";
               echo "<option value='3' >Cerrado</option>";
           }
           elseif ($act_estado==1){
               echo "<option value='0' disabled='disabled'>Abierto</option>";
               echo "<option value='1' selected='selected' disabled='disabled'>Verificar</option>";
               echo "<option value='2'> Rever</option>";
               echo "<option value='3'> Cerrado</option>";
           }
           elseif ($act_estado==2){
               echo "<option value='0' disabled='disabled'>Abierto</option>";
               echo "<option value='1'disabled='disabled'>Verificar</option>";
               echo "<option value='2'disabled='disabled' selected='selected'> Rever</option>";
               echo "<option value='3'> Cerrado</option>";
           }
           elseif ($act_estado==3){
               echo "<option value='0' disabled='disabled'>Abierto</option>";
               echo "<option value='1'>Verificar</option>";
               echo "<option value='2'> Rever</option>";
               echo "<option value='3' selected='selected'> Cerrado</option>";
           }
   
   }
   
}

?>
<select class="select2_category form-control" name="act_estado" data-placeholder="Choose a Category" tabindex="1">
    <?php getOption_estado($act_estado, $usu_perfil, $tia_verificar);?>		
</select>