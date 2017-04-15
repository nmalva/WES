<?php
include_once("../../classes/class.bd.php");




$get_pro_id=$_POST["pro_id"];
$get_loc_id=$_POST["loc_id"];


escribir_combo($get_pro_id, $get_loc_id);

 Function escribir_combo($pro_id, $loc_id){
     $class_bd=new bd();
     $sql="SELECT * FROM Localidades WHERE pro_id='{$pro_id}'";
     $resultado=$class_bd->ejecutar($sql);
     $string="<select class='select2_category form-control' name='loc_id' data-placeholder='Choose a Category' tabindex='1'>";
     while ($r = $class_bd->retornar_fila($resultado)) {
         if ($r["loc_id"]==$loc_id)
            $string.="<option value='{$r["loc_id"]}' selected='selected'>{$r["loc_nombre"]} </option>";  
         else 
             $string.="<option value='{$r["loc_id"]}'>{$r["loc_nombre"]} </option>";
     } 
     $string.="</select>";
     echo ($string);
 }

?>