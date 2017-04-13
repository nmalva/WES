<?php
/**
 * Classe que genera automaticamente un listado y los formularios simples que modifican o agregan datos en una tabla de BD
 * 
 * @uses class_paginado.php, class_orderby.php, class_db.php
 * @author Andres Carizza
 * @version 3.2.1
 *
 * (A partir de la version 3.0 cambia la forma de aplicar los estilos css)
 * 
 * Datos para array de campos:
 * 
		campo = nombre del campo en la bd
		tipo = tipo de elemento de formulario (texto, bit, textarea, combo, dbCombo)
		titulo = texto para el campo en los formularios y listado
		tituloListado = si esta seteado usa este valor para el listado solamente
		maxLen = maximo de caracteres que permite ingresar el input del formulario
		requerido = el campo es requerido
		datos = Array("key" => "value"...) para los tipos de datos: "bit" o "combo"
		sqlQuery = para el tipo de campo dbCombo
		campoValor = campo de valor del sqlQuery, para el tipo de campo dbCombo
		campoTexto = campo del texto del sqlQuery, para el tipo de campo dbCombo
		valorPredefinido = valor predefinido para un campo en el formulario de alta
		incluirOpcionVacia = para los tipo "combo" o "dbCombo", si esta en True incluye <option value=''></option>
		adicionalInput = para agregar html dentro de los tags del input. <input type='text' {acá}>
		centrarColumna = centrar los datos de la columna en el listado
		noEditar = no permite editar el campo en el formulario de edicion
		noListar = no mostrar el campo en el listado
		noNuevo = no incuye ni muestra ese campo en el formulario de alta
		noMostrarEditar = no muestra el campo en el formulario de edicion
		noOrdenar = no permite ordenar por ese campo haciendo click en el titulo de la columna
		customPrintListado = sprintf para imprimir en el listado. %s será el valor del campo y {id} se remplaza por el Id del registro definido para la tabla. Ej: <a href='ver_usuario.php?id={id}' target='_blank' title='Ver usuario'>%s</a>
		customEvalListado = esto es para ejecutar PHP en cada celda del listado sin imprimir ni siquiera los tags <td></td>. Las variables utilizables son $id y $valor. Ej: echo "<td align=center>"; if($valor=="admin"){echo "Si";}else{echo "No";}; echo "</td>";
		customFuncionListado = esto es para ejecutar una funcion del usuario en cada celda del listado sin imprimir ni siquiera los tags <td></td>. La funcion debe recibir el parametro $fila que contendra todos los datos de la fila;
		customFuncionValor = esto es para ejecutar una funcion del usuario en el valor antes de usarlo para el query sql en las funciones de INSERT Y UPDATE. La funcion debe recibir el parametro $valor y retornar el nuevo valor
 * 
 * Ejemplo de uso:
 * 
   $abm = new class_abm();
	 $abm->tabla = "usuarios";
	 $abm->registros_por_pagina = 40;
	 $abm->textoTituloFormularioAgregar = "Agregar usuario";
	 $abm->textoTituloFormularioEdicion = "Editar usuario";
 	 $abm->campos = array(
				array("campo" => "usuario", 
							"tipo" => "texto", 
							"titulo" => "Usuario", 
							"maxLen" => 30,
							"customPrintListado" => "<a href='ver_usuario.php?id={id}' target='_blank' title='Ver usuario'>%s</a>"
							), 
				array("campo" => "pass", 
							"tipo" => "texto", 
							"titulo" => "Contraseña", 
							"maxLen" => 30
							),
				array("campo" => "activo", 
							"tipo" => "bit", 
							"titulo" => "Activo", 
							"datos" => array("1"=>"SI", "0"=>"NO"),
							"centrarColumna" => true,
							"valorPredefinido" => "0"
							),
				array("campo" => "nivel", 
							"tipo" => "combo", 
							"titulo" => "Admin", 
							"datos" => array("admin"=>"Si", ""=>"No"),
							"customEvalListado" => 'echo "<td align=center>"; if($valor=="admin"){echo "Si";}else{echo "No";}; echo "</td>";'
							),
				array("campo" => "email", 
							"tipo" => "textarea", 
							"titulo" => "Email", 
							"maxLen" => 70,
							"noOrdenar" => true
							),
				array("campo" => "donde", 
							"tipo" => "combo", 
							"titulo" => "Donde nos conociste?", 
							"tituloListado" => "Donde", 
							"datos" => array("google"=>"Por Google", "amigo"=>"Por un amigo", "publicidad"=>"Por una publicidad", "otro"=>"Otro") 
							),
				array("campo" => "ultimoLogin", 
							"tipo" => "texto", 
							"titulo" => "Ultimo login",
							"noEditar" => true, 
							"noListar" => true,
							"noNuevo" => true
							)
				);
		$abm->generarAbm("", "Administrar usuarios");
		
		
	Ejemplo para incluir una columna adicional personalizada en el listado:
	
		array("campo" => "", 
					"tipo" => "", 
					"titulo" => "Fotos",
					"noNuevo" => true,
					"noMostrarEditar" => true,
					"customEvalListado" => 'echo "<td align=center><a href=\"admin_productos_fotos.php?productoId=$fila[id]\"><img src=\"img/camara.png\" border=0></a></td>";'
					)
  */

class class_abm{
	/**
	 * Nombre de la tabla en BD
	 */
	public $tabla;
	
	/**
	 * Campo ID de la tabla
	 */
	public $campoId="id";
	
	/**
	 * Los campos de la BD y preferencias para cada uno. (Ver el ejemplo de la class)
	 */
	public $campos;
	
	/**
	 * Valor del atributo method del formulario
	 */
	public $formMethod="POST";
	
	/**
	 * Texto que muestra el boton submit del formulario Nuevo
	 */
	public $textoBotonSubmitNuevo="Guardar";

	/**
	 * Texto que muestra el boton submit del formulario Modificar
	 */
	public $textoBotonSubmitModificar="Guardar";

	/**
	 * Texto que muestra el boton de Cancelar
	 */
	public $textoBotonCancelar="Cancelar";

	public $textoElRegistroNoExiste="El registro no existe. <A HREF='javascript:history.back()'>[Volver]</A>";

	public $textoNoHayRegistros="No hay registros";
	
	/** Titulo del formulario de edicion **/
	public $textoTituloFormularioEdicion;
	
	/** Titulo del formulario de agregar **/
	public $textoTituloFormularioAgregar;

	/** Muestra los encabezados de las columnas en el listado **/
	public $mostrarEncabezadosListado = true;
	
	/**
	 * Pagina a donde se redireccionan los formularios
	 */
	public $formAction="";
	
	public $registros_por_pagina = 30;
	
	/** para agregar atributos al tag **/
	public $adicionalesForm;
	
	/** para agregar atributos al tag **/
	public $adicionalesTable;
	
	/** para agregar atributos al tag **/
	public $adicionalesTableListado;
	
	/** para agregar atributos al tag **/
	public $adicionalesSubmit;
	
	/** Ejemplo: AND userId=2 **/
	public $adicionalesWhereUpdate;
	
	/** Ejemplo: AND userId=2 **/
	public $adicionalesWhereDelete;
	
	/** Ejemplo: , userId=2 **/
	public $adicionalesInsert;
	
	/** Funcion que se ejecuta antes al borrar un registro. Ej: callbackFuncDelete = "borrarUsuario" (donde borrarUsuario es una funcion que debe recibir los parametros $id y $tabla) **/
	public $callbackFuncDelete;
	
	/** Funcion que se ejecuta despues al actualizar un registro. Ej: callbackFuncUpdate = "actualizarDatosUsuario" (donde actualizarDatosUsuario es una funcion que debe recibir los parametros $id y $tabla) **/
	public $callbackFuncUpdate;
	
	/** Funcion que se ejecuta despues de insertar un registro. Ej: callbackFuncInsert = "crearCarpetaUsuario" (donde crearCarpetaUsuario es una funcion que debe recibir los parametros $id y $tabla) **/
	public $callbackFuncInsert;
	
	/** Para ejecutar PHP en cada tag <TR {aca}>. Esta disponible el array $fila. Ejemplo: if($fila["nivel"]=="admin")echo "style='background:red'"; **/
	public $evalEnTagTR;
	
	/** Ejemplo: AND userId=2 (aplicable siempre y cuando no sea un select custom) **/
	public $adicionalesSelect;
	
	/** Campo order by por defecto para los select */
	public $orderByPorDefecto;
	
	/** texto del confirm() antes de borrar (escapar las comillas dobles si se usan) **/
	public $textoPreguntarBorrar = "¿Confirma que desea borrar el elemento seleccionado?";
	
	/** Muestra el boton Editar en el listado */
	public $mostrarEditar=true;
	
	/** Muestra el boton Nuevo en el listado */
	public $mostrarNuevo=true;
	
	/** Muestra el boton Borrar en el listado */
	public $mostrarBorrar=true;

	/** El titulo de la columna Editar del listado **/
	public $textoEditarListado="Editar";

	/** El titulo de la columna Borrar del listado **/
	public $textoBorrarListado="Borrar";
	
	/** Redireccionar a $redireccionarDespuesInsert despues de hacer un Insert **/
	public $redireccionarDespuesInsert;
	
	/** Redireccionar a $redireccionarDespuesUpdate despues de hacer un Update **/
	public $redireccionarDespuesUpdate;
	
	/** Redireccionar a $redireccionarDespuesDelete despues de hacer un Delete **/
	public $redireccionarDespuesDelete;
	
	/** Icono editar del listado. Por defecto: "<a href=\"%s\"><img src='img/editar.gif' title=Editar border=0></a>" */
	public $iconoEditar="<a href=\"%s\"><img src='img/editar.gif' title='Editar' alt='Editar' border='0'/></a>";

	/** Icono borrar del listado. Por defecto: "<a href=\"%s\"><img src='img/eliminar.gif' title=Eliminar border=0></a>" */
	public $iconoBorrar="<a href=\"%s\"><img src='img/eliminar.gif' title='Eliminar' alt='Eliminar' border='0'/></a>";
	
	/** Icono de Agregar para crear un registro nuevo. Por defecto: "<img src='img/add.png'/> <a href='%s'>[Agregar]</a>" */
	public $iconoAgregar="<input type='button' class='btnAgregar' value='Agregar' onclick='window.location=\"%s\"'/>";

	/** Texto sprintf para el mensaje de campo requerido **/
	public $textoCampoRequerido = "El campo \"%s\" es requerido.";

	/** Lo que agrega al lado del nombre del campo para indicar que es requerido **/
	public $indicadorDeCampoRequerido = "*";

	/** Codigo JS para poner en window.onload para cada uno de los campos de fecha **/
	public $jsIniciadorCamposFecha = "new DatePicker(\$('%s'), { pickerClass: 'datepicker_vista' });";
	
	/** Adicional para el atributo class de los input para el chequeo de los campos requeridos **/
	public $chequeoInputRequerido = 'validate["required"]';

	/** Formato de fecha a utilizar en los campos tipo fecha del listado. Usa la funcion date() de PHP **/
	public $formatoFechaListado = "d/m/Y";

	/** El JS que se agrega cuando un campo es requerido **/
	public $jsIniciadorChequeoForm = '
		<script type="text/javascript">
		window.addEvent("domready", function() {
			new FormCheck(\'formularioAbm\');
		});
		</script>
	';

	public $jsHints = '
		<script type="text/javascript">
		window.addEvent("domready", function() {
			function setEvHi(inputs){
				for (var i=0; i<inputs.length; i++){
					if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
						inputs[i].onfocus = function () {
							this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
						}
						inputs[i].onblur = function () {
							this.parentNode.getElementsByTagName("span")[0].style.display = "none";
						}
					}
				}
			}
			setEvHi(document.getElementsByTagName("input"));
			setEvHi(document.getElementsByTagName("select"));
			setEvHi(document.getElementsByTagName("textarea"));
		});
		</script>
	';
	
	/**
	 * Para saber que formulario está mostrando (listado, alta, editar, dbDelete, dbUpdate, dbInsert), esto es util cuando queremos hacer diferentes en la pagina segun el estado.
	 *
	 */
	public function getEstadoActual(){
		if ($_GET[abm_nuevo]) {
			
			return "alta";
			
		} elseif (isset($_GET[abm_editar])) {
			
			return "editar";
			
		} elseif (isset($_GET[abm_borrar])) {
			
			return "dbDelete";
			
		} elseif($this->formularioEnviado()) {
			
			if ($_GET['abm_modif']) {
				
				return "dbUpdate";
				
			}elseif ($_GET['abm_alta']){
				
				return "dbInsert";
			}
			
		} else {
			
			return "listado";
			
		}
	}

	public function generarFormAlta($titulo=""){
		global $db;
		
		$_POST = $this->limpiarEntidadesHTML($_POST);

		//genera el query string de variables previamente existentes
		$get = $_GET;
		unset($get[abm_nuevo]);
		$qs = http_build_query($get);
		if($qs!="") $qs = "&".$qs;
		
		//agregar script para inicar FormCheck ?
		foreach($this->campos as $campo){
			if($campo[requerido]){
				echo $this->jsIniciadorChequeoForm;
				break;
			}
		}

		//agregar script para inicar los Hints ?
		foreach($this->campos as $campo){
			if($campo[hint] != ""){
				echo $this->jsHints;
				break;
			}
		}
		
		echo "<div class='mabm'>";
		if (isset($_GET[abmsg])) {
			echo "<div class='merror'>".urldecode($_GET[abmsg])."</div>";
		}
		echo "<form method='".$this->formMethod."' id='formularioAbm' action='".$this->formAction."?abm_alta=1$qs' $this->adicionalesForm> \n";
		echo "<input type='hidden' name='abm_enviar_formulario' value='1'/> \n";
		echo "<table class='mformulario' $this->adicionalesTable> \n";
		if (isset($titulo) or isset($this->textoTituloFormularioAgregar)) {
			echo "<thead><tr><th colspan='2'>".(isset($this->textoTituloFormularioAgregar) ? $this->textoTituloFormularioAgregar : $titulo)."&nbsp;</th></tr></thead>";
		}
		foreach($this->campos as $campo){
			
			if($campo[noNuevo] == true) continue;
			
			if ($campo[requerido]) {
				$requerido = $this->chequeoInputRequerido;
			}else{
				$requerido = "";
			}
			
			echo "<tr> \n";
			echo "<th>".($campo[titulo]!=''?$campo[titulo]:$campo[campo]).":".($campo[requerido] ? " ".$this->indicadorDeCampoRequerido : "")."</th> \n";
			
			echo "<td> \n";
			switch ($campo[tipo]) {
				case "texto":
					echo "<input type='text' name='".$campo[campo]."' id='".$campo[campo]."' value='".($_POST[$campo[campo]] != "" ? $_POST[$campo[campo]] : $campo[valorPredefinido] )."' ".($campo[maxLen]>0 ? "maxlength='$campo[maxLen]'" : "")." class='input-text $requerido' $campo[adicionalInput]/> \n";
					break;
					
				case "textarea":
					echo "<textarea name='".$campo[campo]."' id='".$campo[campo]."' class='input-textarea $requerido' $campo[adicionalInput]>".($_POST[$campo[campo]] != "" ? $_POST[$campo[campo]] : $campo[valorPredefinido] )."</textarea>\n";
					break;
					
				case "dbCombo":
					echo "<select name='".$campo[campo]."' id='".$campo[campo]."' class='input-select $requerido' $campo[adicionalInput]> \n";
					if($campo[incluirOpcionVacia]) echo "<option value=''></option> \n";
					
					$result = $db->query($campo[sqlQuery]);
					while ($fila = $db->fetch_array($result)) {
						if ((isset($_POST[$campo[campo]]) and $_POST[$campo[campo]] == $fila[$campo[campoValor]]) or $campo[valorPredefinido] == $fila[$campo[campoValor]]) {
							$sel = "selected='selected'";
						}else{
							$sel = "";
						}
						echo "<option value='".$fila[$campo[campoValor]]."' $sel>".$fila[$campo[campoTexto]]."</option> \n";
					}
					echo "</select> \n";
					break;
					
				case "combo":
					echo "<select name='".$campo[campo]."' id='".$campo[campo]."' class='input-select $requerido' $campo[adicionalInput]> \n";
					if($campo[incluirOpcionVacia]) echo "<option value=''></option> \n";
					
					foreach ($campo[datos] as $valor => $texto) {
						if ((isset($_POST[$campo[campo]]) and $_POST[$campo[campo]] == $valor) or $campo[valorPredefinido] == $valor) {
							$sel = "selected='selected'";
						}else{
							$sel = "";
						}
						echo "<option value='$valor' $sel>$texto</option> \n";
					}
					echo "</select> \n";
					break;
					
				case "bit":
					echo "<select name='".$campo[campo]."' id='".$campo[campo]."' class='input-select $requerido' $campo[adicionalInput]> \n";
					
					foreach ($campo[datos] as $valor => $texto) {
						if ((isset($_POST[$campo[campo]]) and $_POST[$campo[campo]] == $valor) or $campo[valorPredefinido] == $valor) {
							$sel = "selected='selected'";
						}else{
							$sel = "";
						}
						echo "<option value='$valor' $sel>$texto</option> \n";
					}
					echo "</select> \n";
					break;

				case "fecha":
					echo "<script type='text/javascript'>window.addEvent('load', function() { ".sprintf($this->jsIniciadorCamposFecha, $campo[campo])." });</script>";
					echo "<input type='text' name='".$campo[campo]."' id='".$campo[campo]."' value='".($_POST[$campo[campo]] != "" ? $_POST[$campo[campo]] : $campo[valorPredefinido] )."' class='input-fecha $requerido' $campo[adicionalInput]/> \n";
					break;
			
				default:
					echo $campo[nombre];
					break;
			}

			if($campo[hint] != "") echo "<span class='mhint'>$campo[hint]<span class='mhint-pointer'>&nbsp;</span></span>";

			echo "</td> \n";
			
			echo "</tr> \n";
			
		}
		echo "<tfoot>";
		echo "	<tr>";
		echo "		<th colspan='2'><div class='divBtnCancelar'><input type='button' class='input-button' value='$this->textoBotonCancelar' onclick=\"window.location='$_SERVER[PHP_SELF]?$qs'\"/></div> <div class='divBtnAceptar'><input type='submit' class='input-submit' value='$this->textoBotonSubmitNuevo' $this->adicionalesSubmit /></div></th>";
		echo "	</tr>";
		echo "</tfoot>";

		echo "</table> \n";
		echo "</form> \n";
		echo "</div>";
	}
	
	public function generarFormModificacion($id, $titulo=""){
		global $db;
		
		//por cada campo...
		for ($i=0;$i<count($this->campos);$i++){
			if($this->campos[$i][campo] == "") continue;
			if($this->campos[$i][noMostrarEditar] == true) continue;
			
			//campos para el select
			if($camposSelect != "")$camposSelect .= ", ";
			$camposSelect .= $this->campos[$i][campo];
		}
		
		$id = $this->limpiarParaSql($id);
		$result = $db->query("SELECT $this->campoId, $camposSelect FROM ".$this->tabla." WHERE ".$this->campoId."='".$id."'");
		if($db->num_rows($result)==0){
			echo $this->textoElRegistroNoExiste;
			return;
		}
		$fila = $db->fetch_array($result);
		
		$fila = $this->limpiarEntidadesHTML($fila);

		//genera el query string de variables previamente existentes
		$get = $_GET;
		unset($get[abm_editar]);
		$qs = http_build_query($get);
		if($qs!="") $qs = "&".$qs;
		
		//agregar script para inicar FormCheck ?
		foreach($this->campos as $campo){
			if($campo[requerido]){
				echo $this->jsIniciadorChequeoForm;
				break;
			}
		}

		//agregar script para inicar los Hints ?
		foreach($this->campos as $campo){
			if($campo[hint] != ""){
				echo $this->jsHints;
				break;
			}
		}
		
		echo "<div class='mabm'>";
		if (isset($_GET[abmsg])) {
			echo "<div class='merror'>".urldecode($_GET[abmsg])."</div>";
		}
		echo "<form method='".$this->formMethod."' id='formularioAbm' action='".$this->formAction."?abm_modif=1&$qs' $this->adicionalesForm> \n";
		echo "<input type='hidden' name='abm_enviar_formulario' value='1'/> \n";
		echo "<input type='hidden' name='".$this->campoId."' value='".$id."'/> \n";
		echo "<table class='mformulario' $this->adicionalesTable> \n";
		if (isset($titulo) or isset($this->textoTituloFormularioEdicion)) {
			echo "<thead><tr><th colspan='2'>".(isset($this->textoTituloFormularioEdicion) ? $this->textoTituloFormularioEdicion : $titulo)."&nbsp;</th></tr></thead>";
		}
		foreach($this->campos as $campo){

			if($campo[noMostrarEditar] == true) continue;
			
			if($campo[noEditar] == true){
				$disabled = "disabled='disabled'";
			}else{
				$disabled = "";
			}
			
			if ($campo[requerido]) {
				$requerido = $this->chequeoInputRequerido;
			}else{
				$requerido = "";
			}
			
			echo "<tr> \n";
			echo "<th>".($campo[titulo]!=''?$campo[titulo]:$campo[campo]).":".($campo[requerido] ? " ".$this->indicadorDeCampoRequerido : "")."</th> \n";
			
			echo "<td> \n";
			switch ($campo[tipo]) {
				case "texto":
					echo "<input type='text' name='".$campo[campo]."' id='".$campo[campo]."' class='input-text $requerido' $disabled value='".$fila[$campo[campo]]."' ".($campo[maxLen]>0 ? "maxlength='$campo[maxLen]'" : "")." ".($campo[campo]==$this->campoId ? "readonly='readonly' disabled='disabled'" : "")." $campo[adicionalInput]/> \n";
					break;
					
				case "textarea":
					echo "<textarea name='".$campo[campo]."' id='".$campo[campo]."' $disabled class='input-textarea $requerido' $campo[adicionalInput]>".$fila[$campo[campo]]."</textarea>\n";
					break;
					
				case "dbCombo":
					echo "<select name='".$campo[campo]."' id='".$campo[campo]."' class='input-select $requerido' $disabled $campo[adicionalInput]> \n";
					if($campo[incluirOpcionVacia]) echo "<option value=''></option> \n";
					
					$resultCombo = $db->query($campo[sqlQuery]);
					while ($filaCombo = $db->fetch_array($resultCombo)) {
						$filaCombo = limpiarEntidadesHTML($filaCombo);
						if ($filaCombo[$campo[campoValor]] == $fila[$campo[campo]]) {
							$selected = "selected";
						}else{
							$selected = "";
						}
						echo "<option value='".$filaCombo[$campo[campoValor]]."' $selected>".$filaCombo[$campo[campoTexto]]."</option> \n";
					}
					echo "</select> \n";
					break;
					
				case "combo":

					echo "<select name='".$campo[campo]."' id='".$campo[campo]."' class='input-select $requerido' $disabled $campo[adicionalInput]> \n";
					if($campo[incluirOpcionVacia]) echo "<option value=''></option> \n";
					
					foreach ($campo[datos] as $valor => $texto) {
						if ($fila[$campo[campo]] == $this->limpiarEntidadesHTML($valor)) {
							$sel = "selected='selected'";
						}else{
							$sel = "";
						}
						echo "<option value='$valor' $sel>$texto</option> \n";
					}
					echo "</select> \n";
					break;
					
				case "bit":
					echo "<select name='".$campo[campo]."' id='".$campo[campo]."' class='input-select $requerido' $disabled $campo[adicionalInput]> \n";
					
					foreach ($campo[datos] as $valor => $texto) {
						if ($fila[$campo[campo]] == limpiarEntidadesHTML($valor)) {
							$sel = "selected='selected'";
						}else{
							$sel = "";
						}
						echo "<option value='$valor' $sel>$texto</option> \n";
					}
					echo "</select> \n";
					break;

				case "fecha":
					echo "<script type='text/javascript'>window.addEvent('load', function() { ".sprintf($this->jsIniciadorCamposFecha, $campo[campo])." });</script>";
					echo "<input type='text' name='".$campo[campo]."' id='".$campo[campo]."' value='".$fila[$campo[campo]]."' class='input-fecha $requerido' $disabled $campo[adicionalInput]/> \n";
					break;
			
				default:
					echo $campo[nombre];
					break;
			}

			if($campo[hint] != "") echo "<span class='mhint'>$campo[hint]<span class='mhint-pointer'>&nbsp;</span></span>";

			echo "</td> \n";
			
			echo "</tr> \n";
			
		}

		echo "<tfoot>";
		echo "	<tr>";
		echo "		<th colspan='2'><div class='divBtnCancelar'><input type='button' class='input-button' value='$this->textoBotonCancelar' onclick=\"window.location='$_SERVER[PHP_SELF]?$qs'\"/></div> <div class='divBtnAceptar'><input type='submit' class='input-submit' value='$this->textoBotonSubmitModificar' $this->adicionalesSubmit /></div></th>";
		echo "	</tr>";
		echo "</tfoot>";

		echo "</table> \n";
		echo "</form> \n";
		echo "</div>";
	}
	
	/**
	 * Genera el listado ABM con las funciones de editar, nuevo y borrar (segun la configuracion).
	 * NOTA: Esta funcion solamente genera el listado, se necesita usar la funcion generarAbm() para que funcione el ABM.
	 *
	 * @param string $sql Query SQL personalizado para el listado. Usando este query no se usa $adicionalesSelect
	 * @param string $titulo Un titulo para mostrar en el encabezado del listado
	 */
	public function generarListado($sql="", $titulo){
		global $db;
		
		//por cada campo...
		for ($i=0;$i<count($this->campos);$i++){
			if($this->campos[$i][campo] == "") continue;
			if($this->campos[$i][noListar] == true) continue;
			if($this->campos[$i][noOrdenar] == true) continue;
			
			//para la class de ordenar por columnas
			if($camposOrder != "")$camposOrder .= "|";
			$camposOrder .= $this->campos[$i][campo];
			
			//campos para el select
			if($camposSelect != "")$camposSelect .= ", ";
			$camposSelect .= $this->campos[$i][campo];
		}

		$o = new class_orderby($this->orderByPorDefecto, $camposOrder);
		
		if($o->getOrderBy()!="") $orderBy = " ORDER BY ".$o->getOrderBy();
		
		if ($sql=="") {
			$sql = "SELECT $this->campoId, $camposSelect FROM $this->tabla WHERE 1 $this->adicionalesSelect $orderBy";
		}else{
			$sql = $sql." ".$orderBy;
		}

		$paginado = new class_paginado;
		$paginado->registros_por_pagina = $this->registros_por_pagina;
		$result = $paginado->query($sql);
		
		//genera el query string de variables previamente existentes
		$get = $_GET;
		unset($get[abmsg]);
		$qs = http_build_query($get);
		if($qs!="") $qs = "&".$qs;
		
		echo "<div class='mabm'>";
		?>
		<script type="text/javascript">
		function abmBorrar(id, idObjetoHtml){
			var classAnt = document.getElementById(idObjetoHtml).style.backgroundColor;
			
			//resalto el elemento que se va a borrar
			document.getElementById(idObjetoHtml).style.backgroundColor = 'yellow';
			
			if (confirm("<?=$this->textoPreguntarBorrar?>")){
				window.location = "<?= $_SERVER[PHP_SELF]."?".$qs."&abm_borrar=" ?>" + id;
			}
			
			document.getElementById(idObjetoHtml).style.backgroundColor = classAnt;
		}
		</script>
		<?
		if (isset($_GET[abmsg])) {
			echo "<div class='merror'>".urldecode($_GET[abmsg])."</div>";
		}
		
		echo "<table class='mlistado' $this->adicionalesTableListado> \n";
		
		//titulo y boton nuevo
		echo "<thead>";
		echo "<tr><th colspan=".(count($this->campos)+2).">";
		
		echo "<div class='mtitulo'>$titulo</div>";
		
		if($this->mostrarNuevo){
			echo "<div class='mbotonera'>";
			echo sprintf($this->iconoAgregar, "$_SERVER[PHP_SELF]?abm_nuevo=1$qs");
			echo "</div>";
		}
		
		echo "</th></tr> \n";
		echo "</thead>";
		//fin titulo y boton nuevo
			
		if($paginado->total_registros > 0){
			
			//columnas del encabezado
			if($this->mostrarEncabezadosListado){
				echo "<tr> \n";
				foreach($this->campos as $campo){
					if($campo[noListar] == true) continue;
					
					if($campo[campo]=="" or $campo[noOrdenar]){
						echo "<th>".($campo[tituloListado]!="" ? $campo[tituloListado] : ($campo[titulo]!=''?$campo[titulo]:$campo[campo]))."</th> \n";
					}else{
						echo "<th>".$o->linkOrderBy( ($campo[tituloListado]!="" ? $campo[tituloListado] : ($campo[titulo]!=''?$campo[titulo]:$campo[campo])), $campo[campo])."</th> \n";
					}
				}
				if ($this->mostrarEditar) echo "<th class='mtituloColEditar'>$this->textoEditarListado</th> \n";
				if ($this->mostrarBorrar) echo "<th class='mtituloColBorrar'>$this->textoBorrarListado</th> \n";
				echo "</tr> \n";
			}
			
			//filas de datos
			$i = 0;
			while ($fila = $db->fetch_array($result)) {
				$fila = $this->limpiarEntidadesHTML($fila);
				$i++;
				$rallado = !$rallado;
				
				echo "<tr class='rallado$rallado' id='t$i'";
				if(isset($this->evalEnTagTR)) eval($this->evalEnTagTR);
				echo "> \n";
				foreach($this->campos as $campo){
					if($campo[noListar] == true) continue;
					
					if($campo['centrarColumna']){
						$centradoCol = 'align="center"';
					}else{
						$centradoCol = '';
					}
					
					if ($campo[customEvalListado] != "") {
						
						extract($GLOBALS);
						$id = $fila[$this->campoId];
						$valor = $fila[$campo[campo]];
						eval($campo[customEvalListado]);
						
					}elseif ($campo[customFuncionListado] != "") {
						
						call_user_func_array($campo[customFuncionListado], array($fila));
						
					}elseif ($campo[customPrintListado] != "") {
						
						echo "<td $centradoCol>";
						$campo[customPrintListado] = str_ireplace('{id}', $fila[$this->campoId], $campo[customPrintListado]);
						echo sprintf($campo[customPrintListado], $fila[$campo[campo]]);
						echo "</td> \n";
						
					}else{
						
						if ($campo[tipo] == "bit") {
							if ($fila[$campo[campo]]) {
								echo "<td $centradoCol>".$campo[datos][1]."</td> \n";
							}else{
								echo "<td $centradoCol>".$campo[datos][0]."</td> \n";
							}
						}else{

							//si es tipo fecha lo formatea
							if ($campo[tipo] == "fecha") {
								if( $fila[$campo[campo]] != "" and $fila[$campo[campo]] != "0000-00-00" and $fila[$campo[campo]] != "0000-00-00 00:00:00" ){
									if (strtotime($fila[$campo[campo]]) !== -1){
										$fila[$campo[campo]] = date($this->formatoFechaListado, strtotime($fila[$campo[campo]]));
									}
								}
							}

							echo "<td $centradoCol>".$fila[$campo[campo]]."</td> \n";
						}
						
					}
					
				}
				if ($this->mostrarEditar) echo "<td class='celdaEditar'>".sprintf($this->iconoEditar, $_SERVER[PHP_SELF]."?abm_editar=".$fila[$this->campoId].$qs)."</td> \n";
				if ($this->mostrarBorrar) echo "<td class='celdaBorrar'>".sprintf($this->iconoBorrar, "javascript:abmBorrar('".$fila[$this->campoId]."', 't$i');void(0)")."</td> \n";
				echo "</tr> \n";
			}
			
			if($paginado->total_paginas > 1){
				echo "<tfoot> \n";
				echo "<tr> \n";
				echo "<th colspan=".(count($this->campos)+2).">";
				$paginado->mostrar_paginado();
				echo "</th> \n";
				echo "</tr> \n";
				echo "</tfoot> \n";
			}
			
		}else{
			
			echo "<td colspan=".(count($this->campos)+2).">$this->textoNoHayRegistros</td>";
			
		}
		
		echo "</table> \n";
		echo "</div>";
		
		if ($this->mostrarNuevo){
			//genera el query string de variables previamente existentes
			$get = $_GET;
			unset($get[abmsg]);
			unset($get[$o->variableOrderBy]);
			$qs = http_build_query($get);
			if($qs!="") $qs = "&".$qs;
		}
		
	}
	
	/**
	 * Genera el listado ABM con las funciones de editar, nuevo y borrar (segun la configuracion)
	 *
	 * @param string $sql Query SQL personalizado para el listado. Usando este query no se usa $adicionalesSelect
	 * @param string $titulo Un titulo para mostrar en el encabezado del listado
	 */
	public function generarAbm($sql="", $titulo){
		global $db;
		
		$estado = $this->getEstadoActual();
		
		switch ($estado) {
			case "listado":
				$this->generarListado($sql, $titulo);
				break;
				
			case "alta":
				if(!$this->mostrarNuevo) die("Error"); //chequeo de seguridad, necesita estar activado mostrarNuevo

				$this->generarFormAlta("Nuevo");
				break;
				
			case "editar":
				if(!$this->mostrarEditar) die("Error"); //chequeo de seguridad, necesita estar activado mostrarEditar

				$this->generarFormModificacion($_GET[abm_editar], "Editar");
				break;
				
			case "dbInsert":
				if(!$this->mostrarNuevo) die("Error"); //chequeo de seguridad, necesita estar activado mostrarNuevo

				$r = $this->dbRealizarAlta();
				if($r!=0) $abmsg = "&abmsg=".urlencode($db->error());
				
				unset($_POST['abm_enviar_formulario']);
				unset($_GET['abm_alta']);
				unset($_GET['abmsg']);
				
				if ($r==0 && $this->redireccionarDespuesInsert != ""){
					$this->redirect_http($this->redireccionarDespuesInsert);
				}else{
					$qs = http_build_query($_GET); //conserva las variables que existian previamente
					$this->redirect_http("$_SERVER[PHP_SELF]?$qs$abmsg");
				}

				break;
				
			case "dbUpdate":
				if(!$this->mostrarEditar) die("Error"); //chequeo de seguridad, necesita estar activado mostrarEditar

				$r = $this->dbRealizarModificacion($_POST[$this->campoId]);
				if($r!=0) $abmsg = "&abmsg=".urlencode($db->error());

				unset($_POST['abm_enviar_formulario']);
				unset($_GET['abm_modif']);
				unset($_GET['abmsg']);
				
				if ($r==0 && $this->redireccionarDespuesUpdate != ""){
					$this->redirect_http($this->redireccionarDespuesUpdate);
				}else{
					$qs = http_build_query($_GET); //conserva las variables que existian previamente
					$this->redirect_http("$_SERVER[PHP_SELF]?$qs$abmsg");
				}
				
				break;
				
			case "dbDelete":
				if(!$this->mostrarBorrar) die("Error"); //chequeo de seguridad, necesita estar activado mostrarBorrar

				$r = $this->dbBorrarRegistro($_GET[abm_borrar]);
				if($r!=0) $abmsg = "&abmsg=".urlencode($db->error());
	
				unset($_GET['abm_borrar']);
				
				if ($r==0 && $this->redireccionarDespuesDelete != ""){
					$this->redirect_http($this->redireccionarDespuesDelete);
				}else{
					$qs = http_build_query($_GET); //conserva las variables que existian previamente
					$this->redirect_http("$_SERVER[PHP_SELF]?$qs$abmsg");
				}
				
				break;
				
			default:
				$this->generarListado($sql, $titulo);
				break;
		}
		
	}
	
	public function dbRealizarAlta(){
		global $db;
		
		if(!$this->formularioEnviado()) return;

		$_POST = $this->limpiarParaSql($_POST);
		
		$sql = "INSERT INTO ".$this->tabla." SET \n";

		$camposSql = "";
		
		foreach($this->campos as $campo){
			if($campo[noNuevo] == true) continue;
			
			$valor = $_POST[$campo[campo]];
			
			//chequeo de campos requeridos
			if($campo[requerido] and trim($valor)==""){
				//genera el query string de variables previamente existentes
				$get = $_GET;
				unset($get[abmsg]);
				unset($get[abm_alta]);
				$qs = http_build_query($get);
				if($qs!="") $qs = "&".$qs;
				
				$this->redirect_http("$_SERVER[PHP_SELF]?abm_nuevo=1$qs&abmsg=".urlencode(sprintf($this->textoCampoRequerido, $campo[titulo])));
			}
			
			if($camposSql != "") $camposSql .= ", \n";
			
			if ($campo[customFuncionValor] != "") {
				$valor = call_user_func_array($campo[customFuncionValor], array($valor));
			}
			
			$camposSql .= $campo[campo]."= '".$valor."' ";
		}
		
		$sql .= $camposSql;
		
		$sql .= $this->adicionalesInsert;

		$db->query($sql);
		
		if (isset($this->callbackFuncInsert)) {
			$id = $db->insert_id();
			call_user_func_array($this->callbackFuncInsert, array($id, $this->tabla));
		}
		
		return $db->errno();
	}
	
	public function dbRealizarModificacion($id){
		global $db;
		
		if(!$this->formularioEnviado()) return;
		
		$id = $this->limpiarParaSql($id);
		$_POST = $this->limpiarParaSql($_POST);
		
		$sql = "UPDATE ".$this->tabla." SET \n";

		$camposSql = "";
		
		foreach($this->campos as $campo){
			if($campo[noEditar] or $campo[noMostrarEditar]) continue;
			
			$valor = $_POST[$campo[campo]];
			
			//chequeo de campos requeridos
			if($campo[requerido] and trim($valor)==""){
				//genera el query string de variables previamente existentes
				$get = $_GET;
				unset($get[abmsg]);
				unset($get[abm_modif]);
				$qs = http_build_query($get);
				if($qs!="") $qs = "&".$qs;
				
				$this->redirect_http("$_SERVER[PHP_SELF]?abm_editar=$id$qs&abmsg=".urlencode(sprintf($this->textoCampoRequerido, $campo[titulo])));
			}
			
			if($camposSql != "") $camposSql .= ", \n";
			
			if ($campo[customFuncionValor] != "") {
				$valor = call_user_func_array($campo[customFuncionValor], array($valor));
			}
			
			$camposSql .= $campo[campo]."= '".$valor."'";
		}
		
		$sql .= $camposSql;
		
		$sql .= $this->adicionalesUpdate." WHERE ".$this->campoId."='".$id."' ".$this->adicionalesWhereUpdate." LIMIT 1";

		$db->query($sql);
		
		if (isset($this->callbackFuncUpdate)) {
			call_user_func_array($this->callbackFuncUpdate, array($id, $this->tabla));
		}
		
		return $db->errno();
	}
	
	public function dbBorrarRegistro($id){
		global $db;
		
		$id = $this->limpiarParaSql($id);
		
		if (isset($this->callbackFuncDelete)) {
			call_user_func_array($this->callbackFuncDelete, array($id, $this->tabla));
		}
		
		$sql = "DELETE FROM ".$this->tabla." WHERE ".$this->campoId."='".$id."' ".$this->adicionalesWhereDelete." LIMIT 1";

		$db->query($sql);

		return $db->errno();
	}
	
	/**
	 * Retorna true si el formulario fue enviado y estan disponibles los datos enviados
	 *
	 * @return boolean
	 */
	private function formularioEnviado(){
		if ($_POST[abm_enviar_formulario]) {
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Convierte de un array todas las entidades HTML para que sea seguro mostrar en pantalla strings ingresados por los usuarios
	 * Ejemplo: $_REQUEST = limpiarEntidadesHTML($_REQUEST);
	 *
	 * @param Array o String $param Un array o un String
	 * @return Depende del parametro recibido, un array con los datos remplazados o un String
	 */
	private function limpiarEntidadesHTML($param) {
		return is_array($param) ? array_map(array($this, __FUNCTION__), $param) : htmlentities($param, ENT_QUOTES);
	}
	
	/**
	 * Escapa de un array todos los caracteres especiales de una cadena para su uso en una sentencia SQL
	 * Ejemplo: $_REQUEST = limpiarParaSql($_REQUEST);
	 *
	 * @param Array o String $param Un array o un String
	 * @return Depende del parametro recibido, un array con los datos remplazados o un String
	 */
	private function limpiarParaSql($param){
		return is_array($param) ? array_map(array($this, __FUNCTION__), $param) : mysql_real_escape_string($param);
	}
	
	/**
	 * Imprime el META de HTML y hace Exit para redireccionar al usuario a $url
	 * Esta función es util para cuando no se pueden mandar headers por haber impreso antes
	 *
	 * @param String $url
	 * @param Integer $segundos Tiempo en segundos antes de hacer la redireccion
	 * @param String $mensaje Un mensaje opcional a imprimir en pantalla
	 * @version 1.0
	 */
	private function redirect_http($url, $segundos=0, $mensaje=""){
		echo "<HTML><HEAD>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$segundos; URL=$url\">";
		if ($mensaje!="") echo $mensaje;
		echo "</HEAD></HTML>";
		exit;
	}
}
?>