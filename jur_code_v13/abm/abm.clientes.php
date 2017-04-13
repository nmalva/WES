<?

session_start();
ob_start();
include_once('../classes/class.clientes.php');

	//-----------------Campos---------------

	
	$campos[cli_id]=$_POST[cli_id];
	$campos[cli_nombre]=$_POST[cli_nombre];
	$campos[cli_apellido]=$_POST[cli_apellido];
	$campos[cli_direccion]=$_POST[cli_direccion];
	$campos[pro_id]=$_POST[pro_id];
	$campos[loc_id]=$_POST[loc_id];
	$campos[cli_fijo]=$_POST[cli_fijo];
	$campos[cli_movil]=$_POST[cli_movil];
	$campos[cli_email]=$_POST[cli_email];
	$campos[cli_dni]=$_POST[cli_dni];
	$campos[cli_timestamp]=$_POST[cli_timestamp];

	if ($campos["cli_id"]==""){
	    $new_id=insert();
	    echo $new_id;
	}
	else
	    update();

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_clientes= new Clientes();
		$new_id=$class_clientes->insert(
			$campos["cli_nombre"],
			$campos["cli_apellido"],
			$campos["cli_direccion"],
			$campos["pro_id"],
			$campos["loc_id"],
			$campos["cli_fijo"],
			$campos["cli_movil"],
			$campos["cli_email"],
			$campos["cli_dni"]
			);
		return ($new_id);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_clientes= new Clientes($campos["cli_id"]);

			$class_clientes->setCli_nombre($campos["cli_nombre"]);
			$class_clientes->setCli_apellido($campos["cli_apellido"]);
			$class_clientes->setCli_direccion($campos["cli_direccion"]);
			$class_clientes->setPro_id($campos["pro_id"]);
			$class_clientes->setLoc_id($campos["loc_id"]);
			$class_clientes->setCli_fijo($campos["cli_fijo"]);
			$class_clientes->setCli_movil($campos["cli_movil"]);
			$class_clientes->setCli_email($campos["cli_email"]);
			$class_clientes->setCli_dni($campos["cli_dni"]);
			
			
	}
	
    function delete($cli_id){
    	$class_clientes= new Clientes();
    	$class_clientes->delete($cli_id);
    }

?>