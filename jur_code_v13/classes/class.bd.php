<?php
class bd
{
  private $servidor="localhost";
  private $usuario="root";
  private $clave="root";
  private $basededatos="nmalva_nmdalel";
  private $conexion;

  function __construct()
  {
    $this->conexion=mysql_connect($this->servidor,$this->usuario,$this->clave);
    mysql_select_db($this->basededatos,$this->conexion);
    mysql_query("SET NAMES 'utf8'");
  }

  function ejecutar($sql)
  {
    $resultados=mysql_query($sql,$this->conexion);
    if (strpos(strtoupper($sql),"INSERT")!==false)       //lleva a mayuscula la consulta, y pregunta si esta insert en la cadena. con el fuckyng operador !== me devuelve true or false
    {
      $resultados = mysql_insert_id(); //me almacena en resultado el id de la ultima operacion, en nuestro caso el registro que estamos agregando
    
    }
    return $resultados;
  }
  function retornar_fila($resultados)
  {
    return @mysql_fetch_array($resultados);
  }
  function __destruct()
  {
    @mysql_close($this->conexion);   //la @ saca los errores para el usuario, en caso de error.
  }
  
}
?>