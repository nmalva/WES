<?
/**
  Class para el paginado de registros.
  Realiza de forma eficiente la consulta a BD para contar la cantidad de registros
  y traer solo los necesarios. Imprime el paginador con Anterior Siguiente y los numeros de paginas.

	USAR:
	include("class_paginado.php");
	$paginado = new class_paginado;
	$paginado->registros_por_pagina = 20;
	$result = $paginado->query($query);

* @author Andres Carizza
* @version 3.5.3
* 
* MODIFICADO PARA QUE USE LA CLASE DB
*/
class class_paginado{
	/** archivo sobre el cual se realiza el paginado (ej: $_SERVER['PHP_SELF']) */
	var $parent_self;
	
	/** nombre de la variable registro con la que hace el paginado (la que pasa por GET) */
	var $nombre_var_registro="r";
	
	/** cantidad de registros por página */
	var $registros_por_pagina=20;
	
	/** cantidad de links para adelante despues del actual.  >5< 7 8 9 10 */
	var $cant_link_paginas_adelante=5;
	
	/** cantidad de links para atras antes del actual. 1 2 3 4 >5<  */
	var $cant_link_paginas_atras=4;
	
	/** string o html para el link Siguiente (ej: <img src='img/siguiente.gif' border=0>) */
	var $siguiente=">";
	
	/** string o html para el link Anterior (ej: <img src='img/anterior.gif' border=0>) */
	var $anterior="<";
	
	/** string o html para Siguiente cuando esta inabilitado */
	var $siguiente_des=">";
	
	/** string o html para Anterior cuando esta inabilitado */
	var $anterior_des="<";
	
	/** string para el title de los links de los numeros de pagina */
	var $str_ir_a="Ir a la página";
	
	/** string para Total */
	var $str_total="Total";
	
	var $str_registro="registro";
	var $str_registros="";
	var $str_paginas="Páginas";

	/** total de registros en total */
	var $total_registros;
	
	/** pagina actual */
	var $pagina;
	
	/** total de paginas */
	var $total_paginas;
	
	/** si muestra el total de registros al lado del paginado */
	var $mostrarTotalRegistros = false;
	
	/** si muestra la palabra "Páginas:" al lado del paginado */
	var $mostrarPalabraPaginas = true;
	
	/** un array con las variables que el paginador no debe conservar al cambiar de pagina. (ej: $variablesNoConservar=array('agregado','modificado','msg');) */
	var $variablesNoConservar = array();
	
	/** para asignar un estilo css diferente. Nombres de estilos css: paginado (DIV) -> link_ant, ant_desact (SPAN), link_pagina_actual (SPAN), link_pagina, link_sig, sig_desact (SPAN), rotuloTotalRegistros (SPAN) */
	var $cssClassPaginado = "paginado";
	
	private $registro;
	private $desde_reg;
	private $hasta_reg;

	/**
	 * Ejecuta el query de mysql (que no debe tener LIMIT) que cuenta el total de registros 
	 * y el que retorna solo los registros que corresponden a la página actual.
	 */
	function query($sqlQuery){
		global $db;
		
		$query = $sqlQuery;

		$this->registro = $_GET[$this->nombre_var_registro]; //es el numero de registro por el cual empieza

		if($this->registro > 0){}else{$this->registro=0;} 

		$this->desde_reg = $this->registro+1;

		//Contar cuantos registros hay
		//Transforma el query en un count y saca el ORDER BY, si existe, para que el query sea optimo en performance
		//Si existe un GROUP BY ejecuta el original
		if(stripos($query, "GROUP BY") === false){
			$queryCount = eregi_replace("SELECT(.*)FROM", "SELECT count(*) as cantidad FROM", $query);
			$queryCount = eregi_replace("ORDER BY.*", "", $queryCount);
			$result_paginado = $db->query($queryCount);
		}else{
			$ejecutarQueryOriginal = true;
		}
		
		if ($ejecutarQueryOriginal or $db->num_rows($result_paginado) > 1 or $db->num_rows($result_paginado) == 0) {
			//ejecuta el count mandando el query original
			$result_paginado = $db->query($sqlQuery);
			$cantidad = $db->num_rows($result_paginado);
		}elseif ($db->num_rows($result_paginado) == 1){
			$cantidad = $db->result($result_paginado, 0, "cantidad");
		}
		$this->total_registros = $cantidad;

		//Ejecutar el query original con el LIMIT
		$query .= " LIMIT $this->registro, $this->registros_por_pagina";
			
		$result = $db->query($query);

		$this->pagina = ceil($this->registro / $this->registros_por_pagina)+1;
		$this->total_paginas = ceil($this->total_registros / $this->registros_por_pagina);

		if(($this->registro + $this->registros_por_pagina) > $this->total_registros){
			$this->hasta_reg = $this->total_registros;
		}else{
			$this->hasta_reg = $this->registro + $this->registros_por_pagina;
		}

		return $result;
	}

	/**
	 * Imprime el paginado
	 */
	function mostrar_paginado(){

		if($this->total_registros <= $this->registros_por_pagina){
			if($this->mostrarTotalRegistros){
				echo "<div class='$this->cssClassPaginado'>";
				echo $this->str_total.": <span class='rotuloTotalRegistros'>".$this->total_registros."</span> ".($this->total_registros > 1 ? $this->str_registros : $this->str_registro);
				echo "</div>";
			}
			return;
		}
		
		echo "<div class='$this->cssClassPaginado'>";
		
		if($this->mostrarPalabraPaginas) echo $this->str_paginas.": ";
		
		unset($_GET[$this->nombre_var_registro]);
		if ( count($this->variablesNoConservar) > 0 ) {
			for ($i=0;$i<count($this->variablesNoConservar);$i++) unset($_GET[$this->variablesNoConservar[$i]]);
		}
	
		$qs = http_build_query($_GET); //conserva las variables que existian previamente
		if($qs!="") $qs = "&".$qs;

		if(($this->registro - $this->registros_por_pagina)>=0){
			echo "<a href='$this->parent_self?".$this->nombre_var_registro."=".($this->registro-$this->registros_por_pagina)."$qs' class='link_ant'>".$this->anterior."</a> ";
		}else{
			echo "<span class='ant_desact'>".$this->anterior_des."</span> ";
		}

		$link_pagina = $this->registro-($this->registros_por_pagina*$this->cant_link_paginas_atras);
		if($link_pagina<0){$link_pagina=0;}

		for($i=$link_pagina; $i< $this->total_registros; $i=$i+$this->registros_por_pagina){
		   $pagina=((($i)*($this->total_registros/$this->registros_por_pagina))/$this->total_registros)+1; //regla de tres simple...

		   if ($this->registro==$i){
			 	echo "<span class='link_pagina_actual'>$pagina</span> ";
		   }else{
				echo "<a href='$this->parent_self?".$this->nombre_var_registro."=".$i."$qs' title='".$this->str_ir_a." $pagina' class='link_pagina'>".$pagina."</a> ";
		   }

		   if($i>$this->registro){ //si ya se pasó link del numero de página actual
			   $cant_adelante++;
			   if($cant_adelante >= $this->cant_link_paginas_adelante){break;}
		   }
		}//FIN for

		if(($this->registro + $this->registros_por_pagina) < $this->total_registros){
			echo "<a href='$this->parent_self?".$this->nombre_var_registro."=".($this->registro+$this->registros_por_pagina)."$qs' class='link_sig'>".$this->siguiente."</a> ";
		}else{
			echo "<span class='sig_desact'>".$this->siguiente_des."</span>";
		}

		if($this->mostrarTotalRegistros) echo "&nbsp; - &nbsp; ".$this->str_total.": <span class='rotuloTotalRegistros'>".$this->total_registros."</span> ".($this->total_registros > 1 ? $this->str_registros : $this->str_registro);
		
		echo "</div>";

	}//FIN function mostrar_paginado
}//FIN class_paginado
?>