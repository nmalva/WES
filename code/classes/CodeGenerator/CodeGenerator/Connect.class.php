<?php
class DatabaseConnection
{

  private $_handle = null;
  static $user= null;
  static $pass= null;
  static $base= null;
  static $server=null;
  
  
  public static function set($server,$user,$pass,$base)
  {
  	self::$server=$server;
  	self::$user=$user;
  	self::$pass=$pass;
  	self::$base=$base;
  }
  
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
  
  private function __construct()
  {
  		
  		if(!$connect= mysql_connect(self::$server,self::$user,self::$pass))
  		{
  			print 'Error al conectar con el servidor base de datos';
  			return false;
  		}
		if(!mysql_select_db(self::$base))
  		{
  			
  			print 'La base de datos "'.self::$base.'" no existe';
  			return false;
  		}
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
		if(!$this->query= mysql_query($query,$connection))
		{print "Error en la consulta sql";}
		return 	$this->query;	
	}

}

?>