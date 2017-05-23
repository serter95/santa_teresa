// ANGULARJS
var miAplicacion = angular.module('santaTeresa', ['ngRoute']);

var URL=$('#HTTP_HOST').val();

$(document).ready(function(){
    $('.fancybox').fancybox();
    $('#myTable').DataTable();
});

miAplicacion.controller('informacionModal', function ($scope,$http)
{
	$scope.informacion=function (valor)
	{
		$http.post(valor).success(function (data)
		{
			$('#informacion').modal({
		        show:true,
		        backdrop:'static'
		    });
		    $('#mensajeInformacion').html(data);
		});
	}
});

miAplicacion.controller('barraDerecha', function ($scope,$http,$interval)
{
	var idUsuario=$('#idUsuario').val();

	$scope.actualizarLinea=function()
	{
		var idLinea=$('#lineaParaEstadistica').val();
		$http.post(URL+'produccion/angular/'+idUsuario+'_actualizarlinea_'+idLinea).success(function ()
		{
			//
		});
	}

	$scope.DatabarraDerecha=function()
	{
		var idLinea=$('#lineaParaEstadistica').val();
		$http.post(URL+'produccion/angular/'+idLinea+'_barraderecha').success(function (data)
		{
			var res=data.split('<');
			$scope.barraDerecha=JSON.parse(res[0]);
			
			if ($scope.barraDerecha.registrosConseguidos>0)
			{
				$scope.imagenActual=$scope.barraDerecha.imagen;
				$scope.estadoLinea=$scope.barraDerecha.estadoLinea;

				if ($scope.estadoLinea!='OPERATIVA')
				{
					$scope.estiloEstado={"color" : "red"};
				}
				else
				{
					$scope.estiloEstado="";
				}

				if ($scope.barraDerecha.parada)
				{
					$scope.paradas=$scope.barraDerecha.parada;
					$scope.estiloParada={"color" : "red"};
				}
				else
				{
					$scope.paradas='No';
					$scope.estiloParada="";
				}
				
				$scope.supervisor=$scope.barraDerecha.supervisor;
				$scope.producto=$scope.barraDerecha.producto;
				
				if(!$scope.barraDerecha.fecha_hora_fin)
				{
					$scope.produccion=$scope.barraDerecha.fecha_hora_inicio+' En Proceso';
					$scope.estiloProduccion="";
				}
				else
				{
					$scope.produccion=$scope.barraDerecha.fecha_hora_inicio+' Finalizada';
					$scope.estiloProduccion={"color" : "green"};
				}
				
				$scope.botellasEstimadas=$scope.barraDerecha.botellasEstimadas;
				$scope.cajasEstimadas=$scope.barraDerecha.cajasEstimadas;
				$scope.totalParadas=$scope.barraDerecha.paradas;
				$scope.UltimaParada=$scope.barraDerecha.ultimaUbicacion;
				$scope.totalCamadas=$scope.barraDerecha.totalCamadas;
				$scope.botellasVacias=$scope.barraDerecha.botellasVacias;
				$scope.botellasLlenas=$scope.barraDerecha.botellasLlenas;
				$scope.cajasVacias=$scope.barraDerecha.cajasVacias;
				$scope.cajasLlenas=$scope.barraDerecha.cajasLlenas;
				$scope.nulo="";

				$scope.graficas=function()
				{
					$('#canvasModal').modal({
				        show:true,
				        backdrop:'static'
				    });

				    var color = Chart.helpers.color;
			        var barChartData = {
			            labels: ["Produccion de "+$scope.barraDerecha.fecha_hora_inicio+" "+$scope.barraDerecha.nombreLinea],

			            datasets: [{
			                label: 'Botellas Vacias',
			                backgroundColor: color(window.chartColors.red).alpha(0.6).rgbString(),
			                borderColor: window.chartColors.red,
			                borderWidth: 1,
			                data: [
			                    $scope.barraDerecha.botellasVacias
			                ]
			            }, {
			                label: 'Botellas Llenas',
			                backgroundColor: color(window.chartColors.blue).alpha(0.6).rgbString(),
			                borderColor: window.chartColors.blue,
			                borderWidth: 1,
			                data: [
			                    $scope.barraDerecha.botellasLlenas
			                ]
			            }, {
			                label: 'Cajas Vacias',
			                backgroundColor: color(window.chartColors.yellow).alpha(0.6).rgbString(),
			                borderColor: window.chartColors.yellow,
			                borderWidth: 1,
			                data: [
			                    $scope.barraDerecha.cajasVacias
			                ]
			            }, {
			                label: 'Cajas Llenas',
			                backgroundColor: color(window.chartColors.green).alpha(0.6).rgbString(),
			                borderColor: window.chartColors.green,
			                borderWidth: 1,
			                data: [
			                    $scope.barraDerecha.cajasLlenas
			                ]
			            }, {
			                label: 'Paradas de Emergencia',
			                backgroundColor: color(window.chartColors.orange).alpha(0.6).rgbString(),
			                borderColor: window.chartColors.orange,
			                borderWidth: 1,
			                data: [
			                    $scope.barraDerecha.paradas
			                ]
			            }, {
			                label: 'Camadas Usadas',
			                backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
			                borderColor: window.chartColors.purple,
			                borderWidth: 1,
			                data: [
			                    $scope.barraDerecha.totalCamadas
			                ]
			            }]

			        };

			        var ctx = document.getElementById("canvas").getContext("2d");
			        window.myBar = new Chart(ctx, {
			            type: 'bar',
			            data: barChartData,
			            options: {
			                responsive: true,
			                legend: {
			                    position: 'top',
			                },
			                title: {
			                    display: true,
			                    text: "Produccion de "+$scope.barraDerecha.fecha_hora_inicio+" "+$scope.barraDerecha.nombreLinea
			                }
			            }
			        });
				}
			}
			else
			{
				$scope.imagenActual="0.png";
				$scope.estadoLinea='Nulo';
				$scope.estiloEstado={"color" : "#333"};
				$scope.paradas='Nulo';
				$scope.estiloParada={"color" : "#333"};
				$scope.supervisor='Nulo';
				$scope.producto='Nulo';
				$scope.produccion='Nulo';
				$scope.estiloProduccion={"color" : "#333"};
				$scope.botellasEstimadas='Nulo';
				$scope.cajasEstimadas='Nulo';
				$scope.totalParadas='Nulo';
				$scope.UltimaParada='Nulo';
				$scope.totalCamadas='Nulo';
				$scope.botellasVacias='Nulo';
				$scope.botellasLlenas='Nulo';
				$scope.cajasVacias='Nulo';
				$scope.cajasLlenas='Nulo';
				$scope.nulo={"color" : "#333"};
			}
		});
	}

	$http.post(URL+'produccion/angular/'+idUsuario+'_buscarlinea').success(function (data)
	{
		var res=data.split('<');
		$scope.buscarLinea=JSON.parse(res[0]);
		
		if ($scope.buscarLinea.idLinea)
		{
			$scope.lineaParaEstadistica=$scope.buscarLinea.idLinea;
		}
	});

	var promise=$interval( function()
	{
		$scope.DatabarraDerecha()
	},
	100);

	$scope.$on('$destroy', function()
	{
		$interval.cancel(promise);
	});
});

miAplicacion.controller('validarPersonal', function ($scope,$http)
{
	$scope.nacionalidadTotal=["V-","E-"];

	$scope.departamentoTotal=["MANTENIMIENTO","ENVASADO"];

	$scope.cargoTotal=["OPERADOR","OPERADOR INTEGRAL","OPERADOR AVANZADO","OPERADOR ENTRENANTE TEMPORAL","SUPERVISOR"];
	
	$scope.estadoTotal=["ACTIVO","REPOSO","VACACIONES","DESPEDIDO"];

	$scope.jornadaTotal=["1","2","3"];

	var modulo=document.getElementById('accion').value;

	if (modulo=='editar' || modulo=='ver')
	{
		var id=document.getElementById('id').value; 
		var numeroPersonal=document.getElementById('numeroPersonal2').value;
		var nacionalidad=document.getElementById('nacionalidad2').value; 
		var cedula=document.getElementById('cedula2').value;
		var nombres=document.getElementById('nombres2').value; 
		var apellidos=document.getElementById('apellidos2').value;
		var departamento=document.getElementById('departamento2').value; 
		var cargo=document.getElementById('cargo2').value;
		var estado=document.getElementById('estado2').value; 
		var jornada=document.getElementById('jornada2').value;			

		$scope.edit=
		[
			{id: id, numeroPersonal: numeroPersonal, nacionalidad: nacionalidad, cedula: cedula, 
				nombres: nombres, apellidos: apellidos, departamento: departamento, cargo: cargo, 
				estado:estado, jornada: jornada}
		];
	}

	$scope.validarBD=function(accion, campo, form)
	{	
		if (accion=="agregar")
		{
			if (campo=='numero_personal')
			{
				var valorCampo=$scope.numeroPersonal;
			}

			if (campo=='cedula')
			{
				if (!$scope.nacionalidad)
				{
					$scope.personal.nacionalidad.$dirty=true;
					$scope.personal.nacionalidad.$error.required=true;
				}
				else
				{
					var valorCampo=$scope.nacionalidad+$scope.cedula;
				}
			}
		}

		if (accion=='editar')
		{
			if (campo=='numero_personal')
			{
				var valorCampo=document.getElementById('numeroPersonal').value;
			}

			if (campo=='cedula')
			{
				var nac=document.getElementById('nacionalidad').value;
				var ced=document.getElementById('cedula').value;

				if (!nac)
				{
					$scope.personal.nacionalidad.$dirty=true;
					$scope.personal.nacionalidad.$error.required=true;
				}
				else
				{
					var valorCampo=nac+ced;
				}
			}
			accion=accion+'.'+id;
		}

		$http.post(URL+'personal/angular/'+valorCampo+'.'+campo+'.'+accion).success(function (data)
		{
			console.log(data);
			if (accion=="agregar")
			{
				if (campo=='numero_personal')
				{
					if (data[0]==1)
					{
						$scope.personal.$invalid = true;
						$scope.valorPersonal="El número de Personal ya Existe";
					}
					else
					{
						$scope.valorPersonal="";
					}
				}

				if (campo=='cedula')
				{
					if (data[0]==1)
					{
						$scope.personal.$invalid = true;
						$scope.valorCedula="El número de Cedula ya Existe";
					}
					else
					{
						$scope.valorCedula="";
					}
				}
			}

			if (accion=="editar")
			{
				if (campo=='numero_personal')
				{
					if (data[0]==1)
					{
						document.getElementById('boton').disabled = true;
						$scope.valorPersonal="El número de Personal ya Existe";
					}
					else
					{
						$scope.valorPersonal="";
					}
				}

				if (campo=='cedula')
				{
					if (data[0]==1)
					{
						document.getElementById('boton').disabled = true;
						$scope.valorCedula="El número de Cedula ya Existe";
					}
					else
					{
						if (form=="cedula")
						{
							if (ced.length>=7<=9)
							{
								document.getElementById('boton').disabled = false;
							}
						}
						$scope.valorCedula="";
					}
				}
			}
		});
	}
});

miAplicacion.controller('validarProveedores', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

	$http.post(URL+'proveedores/angular/estados').success(function (data)
	{
		var res=data.split('<');
		$scope.estados=JSON.parse(res[0]);
	});

	if (accion=='editar')
	{
		var id=document.getElementById('id').value;

		$http.post(URL+'proveedores/angular/buscar-municipio-editar_'+id).success(function (data)
		{
			//alert(data);
			var res=data.split('<');
			$scope.municipios=JSON.parse(res[0]);
		});

		$http.post(URL+'proveedores/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editProveedor=JSON.parse("["+res[0]+"]");
			console.log($scope.editProveedor);
		});
	}

	$scope.buscarMunicipios=function ()
	{
		var id_estado=document.getElementById('estado').value;
		$http.post(URL+'proveedores/angular/'+id_estado).success(function (data)
		{
			var res=data.split('<');
			$scope.municipios=JSON.parse(res[0]);
			$scope.proveedores.$invalid=true;
		});
	}

	$scope.validarMunicipio=function ()
	{
		var id_municipio=document.getElementById('municipio').value;

		if (isNaN(id_municipio))
		{
			$scope.proveedores.$invalid=true;
		}
	}

	$scope.validarNombreProveedor=function ()
	{
		var nombre=document.getElementById('nombre').value;
		
		if (accion=='editar')
		{
			var id=document.getElementById('id').value;

			nombre=nombre+'_'+id;
		}

		$http.post(URL+'proveedores/angular/nombre_'+nombre).success(function (data)
		{
			if (data[1]==1)
			{
				$scope.proveedores.$invalid = true;
				$scope.valorNombre="El nombre del proveedor ya existe";
			}
			else
			{
				$scope.valorNombre="";
			}
		});
	}
});

miAplicacion.controller('validarBotellas', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

	$http.post(URL+'botellas/angular/proveedores').success(function (data)
	{
		var res=data.split('<');
		$scope.proveedoresTotal=JSON.parse(res[0]);
	});

	$http.post(URL+'botellas/angular/medidas').success(function (data)
	{
		var res=data.split('<');
		$scope.medidasTotal=JSON.parse(res[0]);
	});

	if (accion=='editar')
	{
		var id=document.getElementById('id').value;

		$http.post(URL+'botellas/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editBotella=JSON.parse("["+res[0]+"]");
		});
	}

	$scope.distribucionTotal=["NACIONAL", "INTERNACIONAL"];

	$scope.validarNombre=function ()
	{
		var nombre=document.getElementById('nombre').value;

		if (accion=='editar')
		{
			nombre=nombre+'_'+id;
		}

		$http.post(URL+'botellas/angular/nombre_'+nombre).success(function (data)
		{
			if (data[1]==1)
			{
				$scope.valorNombre="El nombre de la botella ya existe";
				$scope.botellas.$invalid=true;
			}
			else
			{
				$scope.valorNombre="";
			}
		});
	}
});

miAplicacion.controller('validarCajas', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

	$http.post(URL+'cajas/angular/proveedores').success(function (data)
	{
		var res=data.split('<');
		$scope.proveedoresCajas=JSON.parse(res[0]);
	});

	if (accion=='editar')
	{
		var id=document.getElementById('id').value;

		$http.post(URL+'cajas/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editCaja=JSON.parse("["+res[0]+"]");
		});
	}

	$scope.validarNombre=function ()
	{
		var nombre=document.getElementById('nombre').value;

		if (accion=='editar')
		{
			nombre=nombre+'_'+id;
		}

		$http.post(URL+'cajas/angular/nombre_'+nombre).success(function (data)
		{
			if (data[1]==1)
			{
				$scope.valorNombre="El nombre de la caja ya existe";
				$scope.cajas.$invalid=true;
			}
			else
			{
				$scope.valorNombre="";
			}
		});
	}
});

miAplicacion.controller('validarTapas', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

	$http.post(URL+'tapas/angular/proveedores').success(function (data)
	{
		var res=data.split('<');
		$scope.proveedoresTapas=JSON.parse(res[0]);
	});

	if (accion=='editar')
	{
		var id=document.getElementById('id').value;

		$http.post(URL+'tapas/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editTapa=JSON.parse("["+res[0]+"]");
		});
	}

	$scope.validarNombre=function ()
	{
		var nombre=document.getElementById('nombre').value;

		if (accion=='editar')
		{
			nombre=nombre+'_'+id;
		}

		$http.post(URL+'tapas/angular/nombre_'+nombre).success(function (data)
		{
			if (data[1]==1)
			{
				$scope.valorNombre="El nombre de la tapa ya existe";
				$scope.tapas.$invalid=true;
			}
			else
			{
				$scope.valorNombre="";
			}
		});
	}
});

miAplicacion.controller('validarEtiquetas', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

	$http.post(URL+'etiquetas/angular/proveedores').success(function (data)
	{
		var res=data.split('<');
		$scope.proveedoresEtiquetas=JSON.parse(res[0]);
	});

	if (accion=='editar')
	{
		var id=document.getElementById('id').value;

		$http.post(URL+'etiquetas/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editEtiqueta=JSON.parse("["+res[0]+"]");
		});
	}

	$scope.validarNombre=function ()
	{
		var nombre=document.getElementById('nombre').value;

		if (accion=='editar')
		{
			nombre=nombre+'_'+id;
		}

		$http.post(URL+'etiquetas/angular/nombre_'+nombre).success(function (data)
		{
			if (data[1]==1)
			{
				$scope.valorNombre="El nombre de la etiqueta ya existe";
				$scope.etiquetas.$invalid=true;
			}
			else
			{
				$scope.valorNombre="";
			}
		});
	}
});

miAplicacion.controller('validarPaletas', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

	$http.post(URL+'paletas/angular/botellas').success(function (data)
	{
		var res=data.split('<');
		$scope.botellasPaletas=JSON.parse(res[0]);
	});

	if (accion=='editar')
	{
		var id=document.getElementById('id').value;

		$http.post(URL+'paletas/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editPaleta=JSON.parse("["+res[0]+"]");
		});
	}

	$scope.validarNombre=function ()
	{
		var nombre=document.getElementById('nombre').value;

		if (accion=='editar')
		{
			nombre=nombre+'_'+id;
		}

		$http.post(URL+'paletas/angular/nombre_'+nombre).success(function (data)
		{
			if (data[1]==1)
			{
				$scope.valorNombre="El nombre de la Paleta ya existe";
				$scope.paletas.$invalid=true;
			}
			else
			{
				$scope.valorNombre="";
			}
		});
	}
});
// FIN ANGULARJS

// JAVASCRIPT JQUERY

// CYCLE
(function($){
"use strict";
$.fn.tcycle = function(){

return this.each(function(){
	var i=0, c=$(this), s=c.children(), o=$.extend({speed:500,timeout:4000},c.data()), f=o.fx!='scroll',
		l=s.length, w=c.width(), z=o.speed, t=o.timeout, css={overflow:'hidden'}, p='position', a='absolute',
		tfn=function(){setTimeout(tx,t);}, scss = $.extend({position:a,top:0}, f?{left:0}:{left:w}, o.scss);
	if (c.css(p)=='static')
		css[p]='relative';
	c.prepend($(s[0]).clone().css('visibility','hidden')).css(css);
	s.css(scss);
	if(f)
		s.hide().eq(0).show();
	else
		s.eq(0).css('left',0);
	setTimeout(tx,t);

	function tx(){
		var n = i==(l-1) ? 0 : (i+1), w=c.width(), a=$(s[i]), b=$(s[n]);
		if (f){
			a.fadeOut(z);
			b.fadeIn(z,tfn);
		}else{
			a.animate({left:-w},z,function(){
				a.hide();
			});
			b.css({'left':w,display:'block'}).animate({left:0},z,tfn);
		}
		i = i==(l-1) ? 0 : (i+1);
	}
});

};
$(function(){$('.tcycle').tcycle();});
})(jQuery);

// FIN CYCLE data-fx="scroll,fade"

// FUNCIONES GENERALES

function modales(parametro)
{
	var mensaje=0;
	var modal = parametro.split('-');

	if (parametro=='exito-registrar' || parametro=='exito-modificar')
    {
    	mensaje='Registro procesado con éxito';
    }

    if (parametro=='error-registrar' || parametro=='error-modificar')
    {
    	mensaje='No se pudo procesar el registro, por favor revise los datos colocados';
    }

	if (parametro=='exito-eliminar')
    {
    	mensaje='Registro eliminado con exito';
    }

    if (mensaje!=0)
    {
    	$('#'+modal[0]).modal({
	        show:true,
	        backdrop:'static'
	    });

	    $('.mensajeModal').html(mensaje);
    }
}

// ELIMINAR

function eliminar(modulo, dato, id, mensaje)
{
	$('#eliminar').modal({
        show:true,
        backdrop:'static'
    });

	$('#moduloEliminar').val(modulo);
	$('#datosEliminar').html(dato);
    $('#eliminarId').val(id);
    $('#mensajeEliminar').html(mensaje);
}

function confirmarEliminar()
{
	var id=document.getElementById('eliminarId').value;
	var modulo=document.getElementById('moduloEliminar').value;
	window.location.href=URL+modulo+'/eliminar/'+id;
}

// FIN ELIMINAR


// FIN DE FUNCIONES GENERALES