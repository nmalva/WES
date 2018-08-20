<?php
/**
 * Function para manejo de base de datos
 *
 * @version 1.4
 * @author Andres Carizza andrescarizza@gmail.com
 */
class class_db{
	
	/** Graba log con los errores de BD **/
	public $grabarArchivoLogError = false;
	
	/** Graba log con todas las consultas realizadas **/
	public $grabarArchivoLogQuery = false;
	
	/** Ejecuta esta funcion a todos los string de querys antes de llamar a la funcion query. Seria util por ejemplo para guardar un log **/
	public $funcionParaLosQuerys = "";
	
	/** Imprime cuando hay errores sql **/
	public $mostrarErrores = true;
	
	/** Setear un email para enviar email cuando hay errores sql **/
	public $emailAvisoErrorSql;
	
	private $dbUser;
	private $dbHost;
	private $dbPass;
	private $dbName;
	private $con;
	
	public function __construct($host, $user, $pass, $db){
		$this->dbHost = "localhost";
		$this->dbUser = "nmalva";
		$this->dbPass = "Wara1441";
		$this->dbName = "nmalva_nmdalel";
	}
	
	public function connect(){
		$this->con = mysql_connect($this->dbHost , $this->dbUser , $this->dbPass) or die(mysql_error());
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($this->dbName) or die(mysql_error());
		
	}
	
	public function query($str_query){
		global $debug, $sitio;
		
		if ($this->funcionParaLosQuerys != '') {
			eval('$str_query = '.$this->funcionParaLosQuerys.'($str_query);');
		}
	
		$result = mysql_query($str_query);
	
		if($debug) echo "<div style='background-color:#E8E8FF; padding:10px; margin:10px; font-family:Arial; font-size:11px; border:1px solid blue'>".$this->format_query_imprimir($str_query)."</div>";
	
		if ($this->grabarArchivoLogQuery) {
			$str_log = date("d/m/Y H:i:s")." ".getenv("REQUEST_URI")."\n";
			$str_log .= $str_query;
			$str_log .= "\n------------------------------------------------------\n";
			error_log($str_log);
		}
	
		if(mysql_errno()!=0 and mysql_errno()!=1062){ //el error 1062 es "Duplicate entry"
			if( $this->mostrarErrores ){
				echo "<div style='background-color:#FFECEC; padding:10px; margin:10px; font-family:Arial; font-size:11px; border:1px solid red'>";
				echo "<B>Error:</B> ".mysql_error()."<br><br>";
				echo "<B>P�gina:</B> ".getenv("REQUEST_URI")."<br>";
				echo "<br>".$this->format_query_imprimir($str_query);
				echo "</div>";
			}else{
				echo "DB Error";
			}
		}
		
		if (mysql_errno()!=0 and mysql_errno()!=1062) {
			if ($this->grabarArchivoLogError) {
				$str_log = "******************* ERROR ****************************\n";
				$str_log .= date("d/m/Y H:i:s")." ".getenv("REQUEST_URI")."\n";
				$str_log .= "IP del visitante: ".getenv("REMOTE_ADDR")."\n";
				$str_log .= "Error: ".mysql_error()."\n";
				$str_log .= $str_query;
				$str_log .= "\n------------------------------------------------------\n";
				error_log($str_log);
			}

			//envio de aviso de error
			if( $this->emailAvisoErrorSql != "" ){
				@mail($this->emailAvisoErrorSql, "Error MySQL", "Error: ".mysql_error()."\n\nP�gina:".getenv("REQUEST_URI")."\n\nIP del visitante:".getenv("REMOTE_ADDR")."\n\nQuery:".$str_query);
			}

		}
	
		return $result;
	}
	
	public function fetch_assoc($result){
		return mysql_fetch_assoc($result);
	}
	
	public function fetch_array($result){
		return mysql_fetch_array($result);
	}
	
	public function fetch_object($result){
		return mysql_fetch_object($result);
	}
	
	public function num_rows($result){
		return mysql_num_rows($result);
	}
	
	public function num_fields($result){
		return mysql_num_fields($result);
	}
	
	public function result($result, $row, $field = null){
		return mysql_result($result, $row, $field);
	}
	
	public function affected_rows(){
		return mysql_affected_rows($this->con);
	}
	
	public function data_seek($result, $row_number){
		return mysql_data_seek($result, $row_number);
	}
	
	public function insert_id(){
		return mysql_insert_id($this->con);
	}
	
	public function errno(){
		return mysql_errno($this->con);
	}
	
	public function error(){
		return mysql_error($this->con);
	}

	public function close(){
		return mysql_close($this->con);
	}
	
	private function format_query_imprimir($str_query){
		$str_query_debug = nl2br(htmlentities($str_query));
		$str_query_debug = eregi_replace("SELECT",   "<FONT COLOR=green><B>SELECT</B></FONT>",    $str_query_debug);
		$str_query_debug = eregi_replace("INSERT",   "<FONT COLOR=#660000><B>INSERT</B></FONT>",  $str_query_debug);
		$str_query_debug = eregi_replace("UPDATE",   "<FONT COLOR=#FF6600><B>UPDATE</B></FONT>",  $str_query_debug);
		$str_query_debug = eregi_replace("REPLACE",  "<FONT COLOR=#FF6600><B>UPDATE</B></FONT>",  $str_query_debug);
		$str_query_debug = eregi_replace("DELETE",   "<FONT COLOR=#CC0000><B>DELETE</B></FONT>",  $str_query_debug);
		$str_query_debug = eregi_replace("FROM",     "<br><B>FROM</B>",                           $str_query_debug);
		$str_query_debug = eregi_replace("WHERE",    "<br><B>WHERE</B>",                          $str_query_debug);
		$str_query_debug = eregi_replace("ORDER BY", "<br><B>ORDER BY</B>",                       $str_query_debug);
		$str_query_debug = eregi_replace("GROUP BY", "<br><B>GROUP BY</B>",                       $str_query_debug);
		$str_query_debug = eregi_replace("INTO",     "<br><B>INTO</B>",                           $str_query_debug);
		$str_query_debug = eregi_replace("VALUES",   "<br><B>VALUES</B>",                         $str_query_debug);
		return $str_query_debug;
	}
	
	/**
	 * Obtiene el valor de un campo de una tabla. Si no obtiene una sola fila retorna FALSE
	 *
	 * @param string $table Tabla
	 * @param string $field Campo
	 * @param string $id Valor para seleccionar con el campo clave
	 * @param string $fieldId Campo clave de la tabla
	 * @return string o false
	 */
	public function getValue($table, $field, $id, $fieldId="id"){
		$result = mysql_query("SELECT $field FROM $table WHERE $fieldId='$id'");
		
		if ($result and mysql_num_rows($result) == 1) {
			if ($fila = mysql_fetch_assoc($result)) {
				return $fila[$field];
			}
		}else{
			return false;
		}
		
	}
	
	/**
	 * Obtiene una fila de una tabla. Si no obtiene una sola fila retorna FALSE
	 *
	 * @param string $table Tabla
	 * @param string $id Valor para seleccionar con el campo clave
	 * @param string $fieldId Campo clave de la tabla
	 * @return array mysql_fetch_assoc o false
	 */
	public function getRow($table, $id, $fieldId="id"){
		$result = mysql_query("SELECT * FROM $table WHERE $fieldId='$id'");
		
		if ($result and mysql_num_rows($result) == 1) {
			return mysql_fetch_assoc($result);
		}else{
			return false;
		}
		
	}
}
?>