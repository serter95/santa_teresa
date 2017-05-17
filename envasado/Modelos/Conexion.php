<?php 
	namespace Modelos;

# SUPER IMPORTANTE!!!!!!!!!!!!!!!
# Se le debe colocar un '\' a las clases propias de php para evitar conflictos con los namespace

	class Conexion
	{
		#gestor = mysql , pgsql

		private $datos = array(
			"gestor" => "mysql",
			"host" => "localhost",
			"user" => "root",
			"pass" => "1234", #1234
			"db" => "lineas_produccion"
		);

		private $con;
		private $resultadoConexion;

		public function __construct()
		{

		//********PHP7*PHP5**********************FUNCIONA**************************************

			/*$this->con = new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['db']); 

	        if ( $this->con->connect_errno ) 
	        { 
	            echo "Fallo al conectar a MySQL: ". $this->con->connect_error; 
	            return;     
	        } 

        	$this->con->set_charset("utf8");*/

        //*********PHP7*PHP5****************FIN**FUNCIONA**************************************


        //*********PHP7*PDO***********************TAMBIEN FUNCIONA***********************************
        	try
        	{
			    $this->con = new \PDO($this->datos['gestor'].':dbname='.$this->datos['db'].';host='.$this->datos['host'].';charset=utf8', $this->datos['user'], $this->datos['pass']);

			    $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
			catch(\PDOException $e)
			{
			    echo "ERROR: " . $e->getMessage();
			}
	    //*********PHP7*PDO********************FIN*TAMBIEN FUNCIONA***********************************


		//********PHP7*PHP5*PDO**********************TAMBIEN*FUNCIONA*************************************
			//$this->con = new \PDO($this->datos['gestor'].':host='.$this->datos["host"].';dbname='.$this->datos["db"].';charset=utf8', $this->datos["user"], $this->datos["pass"]);
		//********PHP7*PHP5*PDO********************FIN*TAMBIEN*FUNCIONA***********************************


			if ($this->con)
			{
				$this->resultadoConexion=true;
			}
			else
			{
				$this->resultadoConexion=false;
			}
		}

		public function cerrarConexion()
		{
			#mysqli_close($this->con);
			#Close
		}

		public function seleccionar($campos, $tabla, $donde)
		{
			$var=$this->con->prepare("SELECT $campos FROM $tabla WHERE $donde");
			$var->execute();

			return $var;
		}
		
		public function actualizar($tabla, $actualiza, $donde)
		{
			$var=$this->con->prepare("UPDATE $tabla SET $actualiza WHERE $donde");
			$var->execute();
		}

		public function insertar($tabla, $campos, $valores)
		{
			$var=$this->con->query("INSERT INTO $tabla ($campos) VALUES ($valores)");
		}

		public function __destruct()
		{
			if ($this->resultadoConexion==false)
			{
				echo "<br><br>ERROR, No se pudo conectar con la base datos<br><br>";
			}
		}
	}

/*	$obj=new Conexion();

	$datos=$obj->seleccionar("*", "usuario", "estatus=1");

	echo $datos->rowCount();

	while ($result = $datos->fetch(\PDO::FETCH_ASSOC))
	{
        echo $result['nombre']."<br>";
        echo $result['contrasena']."<br>";
    }
*/
?>