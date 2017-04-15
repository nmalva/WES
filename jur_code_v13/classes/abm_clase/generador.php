<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<title>Herramienta generador</title>
	
	<!-- Estilos -->
	<link href="css/sitio.css" rel="stylesheet" type="text/css">
	<link href="css/abm.css" rel="stylesheet" type="text/css">
	
	<!-- MooTools -->
	<script type="text/javascript" src="js/mootools-1.2.3-core.js"></script>
	<script type="text/javascript" src="js/mootools-1.2.3.1-more.js"></script>

</head>
<body>
<div class='mabm'>

<?
require("comun/class_db.php");

function imprOpcionesTipo($sel){
	echo "<option value='texto' ".   ($sel=='texto' ? "selected" : "").">texto</option>";
	echo "<option value='fecha' ". ($sel=='fecha' ? "selected" : "").">fecha</option>";
	echo "<option value='bit' ".     ($sel=='bit' ? "selected" : "").">bit</option>";
	echo "<option value='textarea' ".($sel=='textarea' ? "selected" : "").">textarea</option>";
	echo "<option value='combo' ".   ($sel=='combo' ? "selected" : "").">combo</option>";
	echo "<option value='dbCombo' ". ($sel=='dbCombo' ? "selected" : "").">dbCombo</option>";
}

function formatearTitulo($str){
	if (preg_match('/(.)?([a-z])/e', $str)) {
		$str = preg_replace('/(.)?([A-Z])/e', '"$1 $2"', $str);
		$str = str_replace("_", " ", $str);
		$str = ucfirst(strtolower($str));
	}
	return $str;
}

switch ($_REQUEST[paso]) {
	
	case 1:
		//conexión a la bd
		$db = new class_db($_REQUEST[db_host], $_REQUEST[db_user], $_REQUEST[db_pass], $_REQUEST[db_base]);
		$db->mostrarErrores = true;
		$db->connect();
		
		?>
		<script>
		// return the value of the radio button that is checked
		// return an empty string if none are checked, or
		// there are no radio buttons
		function getCheckedValue(radioObj) {
			if(!radioObj)
				return "";
			var radioLength = radioObj.length;
			if(radioLength == undefined)
				if(radioObj.checked)
					return radioObj.value;
				else
					return "";
			for(var i = 0; i < radioLength; i++) {
				if(radioObj[i].checked) {
					return radioObj[i].value;
				}
			}
			return "";
		}
		
		function generar(){
			var c = "";
			c += "$abm = new class_abm(); \n"
			c += "$abm->tabla = '"+ $('db_tabla').value +"'; \n"
			c += "$abm->campoId = '"+ getCheckedValue(document.getElementsByName('pk')) +"'; \n"
			if($('orderBy').value != "") c += "$abm->orderByPorDefecto = '"+ $('orderBy').value + $('orderBy2').value +"'; \n"
			if(!$('mostrarNuevo').checked) c += "$abm->mostrarNuevo = false; \n"
			if(!$('mostrarEditar').checked) c += "$abm->mostrarEditar = false; \n"
			if(!$('mostrarBorrar').checked) c += "$abm->mostrarBorrar = false; \n"
			c += "$abm->registros_por_pagina = 50; \n"
			c += "$abm->textoTituloFormularioAgregar = \"Agregar\"; \n"
			c += "$abm->textoTituloFormularioEdicion = \"Editar\"; \n"
			c += "$abm->campos = array( \n"
			
			var elementosSel = document.getElementsByName("seleccionados");
			contCampos = 0;
			
		  for (i=0; i<elementosSel.length; i++){
			  if (elementosSel[i].checked) {
			  	if(contCampos > 0) c += ", \n"
			  	
					c += "	array('campo' => '"+ elementosSel[i].value +"', \n"
					c += "		'tipo' => '"+ $('tipo_'+elementosSel[i].value).value +"',\n"
					
					switch ($('tipo_'+elementosSel[i].value).value){
						case "combo":
							c += "		'datos' => Array("+ $('datos_'+elementosSel[i].value).value +"),\n"
							c += "		'incluirOpcionVacia' => false,\n"
							break;
						case "dbCombo":
							c += "		'sqlQuery' => '*** COMPLETAR ***',\n"
							c += "		'campoValor' => '*** COMPLETAR ***',\n"
							c += "		'campoTexto' => '*** COMPLETAR ***',\n"
							c += "		'incluirOpcionVacia' => false,\n"
							break;
						case "bit":
							c += "		'datos' => Array(1 => 'Si', 0 => 'No'),\n"
							break;
					}
					
					if($('predefinido_'+elementosSel[i].value).value != '') c += "		'valorPredefinido' => \""+ $('predefinido_'+elementosSel[i].value).value +"\",\n"
					if($('hint_'+elementosSel[i].value).value != '') c += "		'hint' => \""+ $('hint_'+elementosSel[i].value).value +"\",\n"
					if($('tituloL_'+elementosSel[i].value).value != '') 		c += "		'tituloListado' => '"+ $('tituloL_'+elementosSel[i].value).value +"',\n"
					if($('requerido_'+elementosSel[i].value).checked) 			c += "		'requerido' => true,\n"
					if($('maxLen_'+elementosSel[i].value).value > 0) 				c += "		'maxLen' => "+ $('maxLen_'+elementosSel[i].value).value +",\n"
					if($('centrar_'+elementosSel[i].value).checked) 				c += "		'centrarColumna' => true,\n"
					if($('noEditar_'+elementosSel[i].value).checked) 				c += "		'noEditar' => true,\n"
					if($('noMostrarEditar_'+elementosSel[i].value).checked) c += "		'noMostrarEditar' => true,\n"
					if($('noListar_'+elementosSel[i].value).checked) 				c += "		'noListar' => true,\n"
					if($('noNuevo_'+elementosSel[i].value).checked)					c += "		'noNuevo' => true,\n"
					if($('noOrdenar_'+elementosSel[i].value).checked) 			c += "		'noOrdenar' => true,\n"
					c += "		'titulo' => '"+ $('tituloF_'+elementosSel[i].value).value +"'\n"
					c += "	)"
					contCampos++;
			  }
		  }

			c += "\n); \n"
			c += "$abm->generarAbm('', 'Administrar "+ $('db_tabla').value +"'); \n"

			$('generado').innerHTML = "<pre>"+c+"</pre>";
		}
		</script>
		
		* <b>PK</b> es para indicar el campo que es clave primaria (Primary key).<br>
		* Si <b>Título en listado</b> será igual a <b>Título campo</b> dejar vacio.<br>
		* <b>Centrar</b> es para centrar los valores de la columna en el listado.<br>
		* <b>Datos combo</b> es solo para los tipo <b>combo</b> o <b>bit</b> y se completa con este formato 'UNO','DOS','TRES'.<br>
		* <b>Hint</b> texto para mostrar en un "tip" cuando se hace foco en ese control.<br>
		* <b>noEditar</b> no permite modificar el valor del campo pero lo muestra en la edición.<br>
		* <b>noMostrarEditar</b> no muestra el campo en la edición.<br>
		* <b>noListar</b> no muestra el campo en el listado.<br>
		* <b>noNuevo</b> no muestra el campo en nuevo.<br>
		* <b>noOrdenar</b> no permite ordenar por ese campo en el listado.<br>
		<br>
		<form method="POST">
			<input type="hidden" name="paso" value="2" />
			<input type="hidden" name="db_tabla" id="db_tabla" value="<?=$_REQUEST[db_tabla]?>" />
			<table class='mlistado'>
				<tr>
					<th>PK</th>
					<th>Incluir</th>
					<th>Campo</th>
					<th>Título campo</th>
					<th>Título en listado</th>
					<th>Type</th>
					<th>Tipo</th>
					<th>maxLen</th>
					<th>Datos combo</th>
					<th>Valor predefinido</th>
					<th>Hint</th>
					<th>Requerido</th>
					<th>Centrar</th>
					<th>noEditar</th>
					<th>noMostrarEditar</th>
					<th>noListar</th>
					<th>noNuevo</th>
					<th>noOrdenar</th>
				</tr>
				<?
				$result = $db->query("DESCRIBE $_REQUEST[db_tabla]");
				while($fila = $db->fetch_array($result)){
					
					if(strpos($fila[Type], "(") > 0){
						$tipo = substr( $fila[Type], 0, strpos($fila[Type], "(") );
						$tipo2 = substr( $fila[Type], strpos($fila[Type], "(")+1, strlen($fila[Type])-strpos($fila[Type], "(")-2 );
					}else{
						$tipo = $fila[Type];
						$tipo2 = "";
					}
					
					$rallado = !$rallado;
					
					echo "<tr class='rallado$rallado'>";
					echo "	<td><input type='radio' name='pk' value='$fila[Field]' ".($fila['Key']=="PRI" ? "checked='checked'" : "")." /></td>";
					echo "	<td><input type='checkbox' name='seleccionados' value='$fila[Field]' ".($fila['Key']=="PRI" ? "" : "checked='checked'")." /></td>";
					echo "	<td>$fila[Field]</td>";
					echo "	<td><input type='text' id='tituloF_$fila[Field]' value='".formatearTitulo($fila[Field])."' /></td>";
					echo "	<td><input type='text' id='tituloL_$fila[Field]' /></td>";
					echo "	<td>$tipo</td>";
					echo "	<td><select id='tipo_$fila[Field]'>";
					switch ($tipo) {
						case "enum":
							imprOpcionesTipo("combo");
							break;
							
						case "text":
							imprOpcionesTipo("textarea");
							break;

						case "date":
							imprOpcionesTipo("fecha");
							break;

						case "datetime":
							imprOpcionesTipo("fecha");
							break;
							
						case "bit":
							imprOpcionesTipo("bit");
							break;
							
						case "bool":
							imprOpcionesTipo("bit");
							break;
					
						default:
							imprOpcionesTipo("texto");
							break;
					}
					echo "	</select></td>";
					echo "	<td><input type='text' id='maxLen_$fila[Field]' value='".($tipo2 > 0 ? $tipo2 : "")."' size='5'/></td>";
					echo "	<td><input type='text' id='datos_$fila[Field]' value=\"".($tipo == 'enum' ? $tipo2 : "")."\" /></td>";
					echo "	<td><input type='text' id='predefinido_$fila[Field]' value='$fila[Default]' size='15'/></td>";
					echo "	<td><input type='text' id='hint_$fila[Field]' size='15'/></td>";
					echo "	<td><input type='checkbox' id='requerido_$fila[Field]' value='1' ".($fila['Null']=="YES" ? "" : "checked='checked'")." /></td>";
					echo "	<td><input type='checkbox' id='centrar_$fila[Field]' value='1' ".($tipo2==1 ? "checked='checked'" : "")." /></td>";
					echo "	<td><input type='checkbox' id='noEditar_$fila[Field]' value='1' /></td>";
					echo "	<td><input type='checkbox' id='noMostrarEditar_$fila[Field]' value='1' /></td>";
					echo "	<td><input type='checkbox' id='noListar_$fila[Field]' value='1' ".(($tipo=='text' or $tipo=='mediumtext' or $tipo=='longtext' or $tipo=='tinytext' or $tipo=='binary' or $tipo=='varbinary' or $tipo=='blob' or $tipo=='mediumblob' or $tipo=='longblob' or $tipo=='tinyblob') ? "checked='checked'" : "")." /></td>";
					echo "	<td><input type='checkbox' id='noNuevo_$fila[Field]' value='1' ".($fila['Extra']=='auto_increment' ? "checked='checked'" : "")." /></td>";
					echo "	<td><input type='checkbox' id='noOrdenar_$fila[Field]' value='1' /></td>";
					echo "</tr>";
				}
				?>
			</table>
			
			<br/>
			
			Order by por defecto: 
			<select id="orderBy">
				<option value=""></option>
				<?
				$db->data_seek($result,0);
				while($fila = $db->fetch_array($result)){
					echo "<option value='$fila[Field]'>$fila[Field]</option>";
				}
				?>
			</select>
			<select id="orderBy2">
				<option value=""></option>
				<option value=" DESC">DESC</option>
			</select>
			<br/>
			
			<input type="checkbox" id="mostrarNuevo" value="1" checked="checked"/><label for="mostrarNuevo">Mostrar botón Nuevo</label><br/>
			<input type="checkbox" id="mostrarEditar" value="1" checked="checked"/><label for="mostrarEditar">Mostrar botón Editar</label><br/>
			<input type="checkbox" id="mostrarBorrar" value="1" checked="checked"/><label for="mostrarBorrar">Mostrar botón Borrar</label><br/>
			<br/>
			
			<input type="button" value="Generar" onclick="generar()"/><br/>
			
			<br/>
			
		</form>
		<div id="generado"></div>
		<?
		
		break;
			
	default:
		?>
		<form method="POST">
			<input type="hidden" name="paso" value="1" />
			<table class="mformulario">
				<thead>
					<tr>
						<th colspan="2">Conectar a la base de datos</th>
					</tr>
				</thead>
				<tr>
					<th>Host:</th>
					<td><input type="text" name="db_host" value="localhost" /></td>
				</tr>
				<tr>
					<th>Usuario:</th>
					<td><input type="text" name="db_user" value="root" /></td>
				</tr>
				<tr>
					<th>Contraseña:</th>
					<td><input type="text" name="db_pass" /></td>
				</tr>
				<tr>
					<th>Base:</th>
					<td><input type="text" name="db_base" value="demoabm" /></td>
				</tr>
				<tr>
					<th>Tabla:</th>
					<td><input type="text" name="db_tabla" value="usuarios" /></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" value="Continuar >" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
}
?>

</div>
</body>
</html>