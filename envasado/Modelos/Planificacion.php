<?php
	namespace Modelos;

	class Planificacion extends Modelos implements Interfaz
	{
		private $id;
		private $fecha_produccion;
    private $estimacion_total;
		private $id_linea;

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
			return $this->con->seleccionar("p.id, p.fecha_produccion, p.estimacion_total, p.usado, l.nombre", "planificacion p, lineas l", "p.estatus=1 AND l.estatus=1 AND p.id_linea=l.id ORDER BY p.fecha_produccion ASC");
		}

		public function add()
		{
			$this->con->insertar("planificacion", "fecha_produccion, estimacion_total, id_linea", "'{$this->fecha_produccion}', '{$this->estimacion_total}', '{$this->id_linea}'");
		}

		public function delete()
		{
			$this->con->actualizar("planificacion", "estatus=0", "id='{$this->id}'");
		}

		public function edit()
		{
			$this->con->actualizar("planificacion", "fecha_produccion='{$this->fecha_produccion}', estimacion_total='{$this->estimacion_total}', id_linea='{$this->id_linea}'", "id='{$this->id}'");
		}

		public function view()
		{
			return $this->con->seleccionar("*", "planificacion", "estatus=1 AND id='{$this->id}'");
		}

		public function validacion($fecha)
		{
			return $this->con->seleccionar("*", "planificacion", "estatus=1 AND fecha_produccion='$fecha'");
		}

		public function validacionIndividual($fecha, $id_linea)
		{
			return $this->con->seleccionar("*", "planificacion", "estatus=1 AND fecha_produccion='$fecha' AND id_linea='$id_linea'");
		}
	}
?>
