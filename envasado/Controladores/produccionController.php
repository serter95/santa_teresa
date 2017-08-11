<?php
	namespace Controladores;
	use Modelos\Produccion as Produccion;

	class produccionController
	{
		private $produccion;

		public function __construct()
		{
			$this->produccion=new Produccion();
		}

		public function index()
		{
			return $datos=$this->produccion->listar();
		}

		public function ver($id)
		{
			return $datos=$this->produccion->ver($id);
		}

		public function detalle($id)
		{
			return $datos=$this->produccion->detalle($id);
		}

		public function historial($parametros)
		{
			return $datos=$this->produccion->historial($parametros);
			var_dump($datos);
			//die();
		}

		public function angular($datos)
		{
			$result=explode('_', $datos);

			if($result[1]=='personal')
			{
				$datos=$this->produccion->personal($result[0]);
			?>
				<table class="table table-hover">
					<h4><u>Personal:</u></h4>
					<thead>
						<tr>
							<th>C.I</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Estación</th>
						</tr>
					</thead>
					<tbody>
					<?php
						while ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
					?>
					<tr>
						<td><?php echo $array['cedula'];?></td>
						<td><?php echo $array['nombres'];?></td>
						<td><?php echo $array['apellidos'];?></td>
						<td><?php echo $array['nombre'];?></td>
					</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			<?php
			}

			if($result[1]=='emergencia')
			{
				$datos=$this->produccion->emergencia($result[0]);
			?>
				<table class="table table-hover">
					<h4><u>Paradas de Emergencia:</u></h4>
					<thead>
						<tr>
							<th>Hora y Fecha</th>
							<th>Hora y Fecha de Reinicio</th>
							<th>Estación</th>
						</tr>
					</thead>
					<tbody>
					<?php
						while ($array=$datos->fetch(\PDO::FETCH_ASSOC))
						{
					?>
					<tr>
						<td><?php echo $array['hora_fecha'];?></td>
						<td>
							<?php
								if($array['hora_fecha_reinicio'])
								{
									echo $array['hora_fecha_reinicio'];
								}
								else
								{
									echo "En Parada";
								}
							?>
						</td>
						<td><?php echo $array['nombre'];?></td>
					</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			<?php
			}

			if ($result[1]=='actualizarlinea')
			{
				$this->produccion->actualizarlinea($result[0], $result[2]);
			}

			if ($result[1]=='buscarlinea')
			{
				$datos=$this->produccion->buscarlinea($result[0]);
				$fetch=$datos->fetch(\PDO::FETCH_ASSOC);
				$array=array('idLinea' => $fetch['id_linea_seleccionada']);
				echo json_encode($array);
			}

			if ($result[1]=='barraderecha')
			{
				$datos=$this->produccion->barraderecha($result[0]);

				echo json_encode($datos);
			}
		}
	}
?>
