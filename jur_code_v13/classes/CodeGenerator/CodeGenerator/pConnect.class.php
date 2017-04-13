<?php
class DatabaseConnection
{
  public static function get()
  {
    static $db = null;
    if ( $db == null )
    {
      if($db = new DatabaseConnection())
      {	return $db;}
      else
      { return false;}
    }
    else
    {
    	return $db;
    }	
  }

  private $_handle = null;

  private function __construct()
  {
  	
  		//cambiar estos datos de acuerdo a la conexion a base de datos
  		$server="localhost";
  		$user="root";
  		$pass="";
  		$db="test";
  		//-----------------------------------------------------------
  		
  		if(!$connect= mysql_connect($server, $user, $pass))
  		{
  			return false;
  		}
		if(!mysql_select_db($db))
  		{return false;}
  		$this->_handle =$connect;
  		{return true;}
  }
  
  public function handle()
  {
    return $this->_handle;
  }
}

Class Query
{
	private $query;	
	function executeQuery($query)
	{
		$connection=DatabaseConnection::get()->handle();
		$this->query= mysql_query($query,$connection);
		return 	$this->query;	
	}

}


?>