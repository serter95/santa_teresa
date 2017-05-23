<?php 
	namespace Modelos;
	
	class Produccion
	{
		private $con;

		public function __construct()
		{
			$this->con=new Conexion();
		}

		public function listar()
		{
			return $this->con->seleccionar("*", "lineas", "estatus=1");
		}

		public function ver($id_linea)
		{
			return $this->con->seleccionar("p.id as id_produccion, p.id_linea, p.fecha_hora_inicio, p.fecha_hora_fin, b.nombre, l.nombre as nombre_linea", "produccion p, botellas b, lineas l", "l.id=p.id_linea AND p.id_linea='$id_linea' AND p.estatus=1 AND b.id=p.id_botella");
		}

		public function detalle($id)
		{
			$produccion=$this->con->seleccionar("p.id, p.id_linea, p.fecha_hora_inicio, p.fecha_hora_fin, p.cantidad_paletas, p.id_botella, p.id_caja, p.id_etiqueta, p.id_tapa, l.nombre as nombre_linea, pe.cedula, pe.nombres, pe.apellidos, pe.jornada, pa.nombre as nombre_paleta, pa.bulk, pa.cantidad_bulks", "produccion p, lineas l, personal pe, paleta pa", "l.id=p.id_linea AND pe.id=p.supervisor AND pa.id_botella=p.id_botella AND p.estatus=1 AND l.estatus=1 AND pe.estatus=1 AND pa.estatus=1 AND p.id='$id' LIMIT 1");
			$produccionTotal=$produccion->fetch(\PDO::FETCH_ASSOC);
			

			$botella=$this->con->seleccionar("b.nombre as nombre_botella, b.distribucion, m.tipo, p.nombre as nombre_proveedor","botellas b, medidas m, proveedor p","b.id_medida=m.id AND b.id_proveedor=p.id AND b.estatus=1 AND m.estatus=1 AND p.estatus=1 AND b.id='".$produccionTotal['id_botella']."' LIMIT 1");
			$botella=$botella->fetch(\PDO::FETCH_ASSOC);


			$caja=$this->con->seleccionar("c.nombre as nombre_caja, c.medida as medida_caja, c.cantidad_botellas, p.nombre as nombre_proveedor_caja","cajas c, proveedor p","c.id_proveedor=p.id AND c.estatus=1 AND p.estatus=1 AND c.id='".$produccionTotal['id_caja']."' LIMIT 1");
			$caja=$caja->fetch(\PDO::FETCH_ASSOC);


			$etiqueta=$this->con->seleccionar("e.nombre as nombre_etiqueta, e.medida as medida_etiqueta, p.nombre as nombre_proveedor_etiqueta","etiqueta e, proveedor p","e.id_proveedor=p.id AND e.estatus=1 AND p.estatus=1 AND e.id='".$produccionTotal['id_etiqueta']."' LIMIT 1");
			$etiqueta=$etiqueta->fetch(\PDO::FETCH_ASSOC);


			$tapa=$this->con->seleccionar("t.nombre as nombre_tapa, t.medida as medida_tapa, p.nombre as nombre_proveedor_tapa","tapas t, proveedor p","t.id_proveedor=p.id AND t.estatus=1 AND p.estatus=1 AND t.id='".$produccionTotal['id_tapa']."' LIMIT 1");
			$tapa=$tapa->fetch(\PDO::FETCH_ASSOC);


			$array=$this->contadores($produccionTotal['id']);

			array_push($produccionTotal, $botella, $caja, $etiqueta, $tapa, $array);

			return $produccionTotal;
		}

		public function contadores($id)
		{
			$botellas_llenas=$this->con->seleccionar("*","botellas_llenas","estatus=1 AND id_produccion='$id'");
			$botellas_llenas=$botellas_llenas->rowCount();


			$botellas_vacias=$this->con->seleccionar("*","botellas_vacias","estatus=1 AND id_produccion='$id'");
			$botellas_vacias=$botellas_vacias->rowCount();


			$cajas_llenas=$this->con->seleccionar("*","cajas_llenas","estatus=1 AND id_produccion='$id'");
			$cajas_llenas=$cajas_llenas->rowCount();


			$cajas_vacias=$this->con->seleccionar("*","cajas_vacias","estatus=1 AND id_produccion='$id'");
			$cajas_vacias=$cajas_vacias->rowCount();

			$bulks_usados=$this->con->seleccionar("*","bulk_usados","estatus=1 AND id_produccion='$id'");
			$bulks_usados=$bulks_usados->rowCount();

			$parada_emergencia=$this->con->seleccionar("*","parada_emergencia","estatus=1 AND id_produccion='$id'");
			$parada_emergencia=$parada_emergencia->rowCount();

			return $array=array(
				"botellas_llenas" => $botellas_llenas,
				"botellas_vacias" => $botellas_vacias,
				"cajas_llenas" => $cajas_llenas,
				"cajas_vacias" => $cajas_vacias,
				"bulks_usados" => $bulks_usados,
				"parada_emergencia" => $parada_emergencia,
			);
		}

		public function personal($id)
		{
			return $this->con->seleccionar("p.fecha_hora_inicio, p.fecha_hora_fin, pe.cedula, pe.nombres, pe.apellidos, e.nombre, l.nombre as nombre_linea", "produccion p, personal_trabajo pt, personal pe, estacion e, lineas l", "p.id=pt.id_produccion AND pt.id_personal=pe.id AND pt.id_estacion=e.id AND p.id_linea=l.id AND p.estatus=1 AND pt.estatus=1 AND pe.estatus=1 AND e.estatus=1 AND l.estatus=1 AND pt.id_produccion='$id'");
		}

		public function emergencia($id)
		{
			return $this->con->seleccionar("p.hora_fecha, p.hora_fecha_reinicio, e.nombre", "parada_emergencia p, estacion e", "p.id_estacion=e.id AND p.estatus=1 AND e.estatus=1 AND p.id_produccion='$id'");
		}

		public function actualizarlinea($id, $id2)
		{
			if ($id2) 
			{
				$this->con->actualizar("usuario","id_linea_seleccionada=$id2","id='$id'");
			}
			else
			{
				$this->con->actualizar("usuario","id_linea_seleccionada=NULL","id='$id'");
			}
		}

		public function buscarlinea($id)
		{
			return $this->con->seleccionar("id_linea_seleccionada", "usuario", "id='$id'");
		}

		public function barraderecha($id)
		{
			$lineas=$this->con->seleccionar("l.nombre AS l_nombre, l.estado, l.imagen, p.id, b.nombre, p.fecha_hora_inicio, p.fecha_hora_fin, pe.nombres, pe.apellidos", "lineas l, produccion p, botellas b, personal pe", "l.id=p.id_linea AND p.id_botella=b.id AND p.supervisor=pe.id AND l.estatus=1 AND p.estatus=1 AND b.estatus=1 AND pe.estatus=1 AND l.id='$id' AND p.id_linea='$id' ORDER BY p.id DESC");

			$num=$lineas->rowCount();
			$lineas=$lineas->fetch(\PDO::FETCH_ASSOC);

			$paradas=$this->con->seleccionar("hora_fecha_reinicio","parada_emergencia","id_produccion='".$lineas['id']."' AND estatus=1 ORDER BY id DESC");

			while ($fetch=$paradas->fetch(\PDO::FETCH_ASSOC))
			{
				if(!$fetch['hora_fecha_reinicio'])
				{
					$parada='Si';
				}
			}

			$paradas2=$this->con->seleccionar("e.nombre","parada_emergencia p, estacion e","p.id_estacion=e.id AND p.id_produccion='".$lineas['id']."' AND p.estatus=1 AND e.estatus=1 ORDER BY p.id DESC");

			$nomParadas=$paradas2->fetch(\PDO::FETCH_ASSOC);

			$contadores=$this->contadores($lineas['id']);

			return $array=array(
				'registrosConseguidos' => $num,
				'nombreLinea' => $lineas['l_nombre'],
				'idProduccion' => $lineas['id'],
				'estadoLinea' => $lineas['estado'],
				'imagen' => $lineas['imagen'],
				'parada' => $parada,
				'supervisor' => $lineas['nombres'].' '.$lineas['apellidos'],
				'producto' => $lineas['nombre'],
				'fecha_hora_inicio' => $lineas['fecha_hora_inicio'],
				'fecha_hora_fin' => $lineas['fecha_hora_fin'],
				'botellasEstimadas' => 'En Espera...',
				'cajasEstimadas' => 'En Espera...',
				'ultimaUbicacion' => $nomParadas['nombre'],
				'paradas' => $contadores['parada_emergencia'],
				'totalCamadas' => $contadores['bulks_usados'],
				'botellasVacias' => $contadores['botellas_vacias'],
				'botellasLlenas' => $contadores['botellas_llenas'],
				'cajasVacias' => $contadores['cajas_vacias'],
				'cajasLlenas' => $contadores['cajas_llenas'],
			);
		}
	}
?>