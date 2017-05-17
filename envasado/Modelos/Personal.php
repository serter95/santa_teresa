<?php 
	namespace Modelos;

	class Personal
	{
		private $id;
		private $numeroPersonal;
		private $cedula;
		private $nombres;
		private $apellidos;
		private $departamento;
		private $cargo;
		private $estado;
		private $jornada;
		private $foto;
		private $con;

		public function __construct()
		{
			$this->con = new Conexion();
		}

		public function set($atributo, $valor)
		{
			$this->$atributo=$valor;
		}

		public function get($atributo)
		{
			return $this->$atributo;
		}

		public function listar()
		{
			return $this->con->seleccionar("*", "personal", "estatus=1 ORDER BY cedula ASC");
		}

		public function add()
		{
			$this->con->insertar("personal", "numero_personal, cedula, nombres, apellidos, departamento, cargo, estado, jornada", "'{$this->numeroPersonal}', '{$this->cedula}', '{$this->nombres}', '{$this->apellidos}', '{$this->departamento}', '{$this->cargo}', '{$this->estado}', '{$this->jornada}'");
		}

		public function listarImagen()
		{
			return $this->con->seleccionar("*", "personal", "numero_personal='{$this->numeroPersonal}' AND cedula='{$this->cedula}' AND estatus=1 LIMIT 1");
		}

		public function subirImagen()
		{
			$this->con->actualizar("personal", "foto='{$this->foto}'", "id='{$this->id}'");
		}

		public function delete()
		{
			$this->con->actualizar("personal", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("personal", "numero_personal='{$this->numeroPersonal}', cedula='{$this->cedula}', nombres='{$this->nombres}', apellidos='{$this->apellidos}', departamento='{$this->departamento}', cargo='{$this->cargo}', estado='{$this->estado}', jornada='{$this->jornada}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "personal", "estatus=1 AND id='{$this->id}'");
		}
	}
?>