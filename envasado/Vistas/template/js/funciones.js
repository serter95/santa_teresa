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

	$scope.DatabarraDerecha=function(graficar)
	{
		var idLinea=$('#lineaParaEstadistica').val();
    $('#resultadoDatabarraDerecha').val(0);
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

				$scope.botellasEstimadas=$scope.barraDerecha.totalCamadas*$scope.barraDerecha.cantidadBotellasPaleta;
        $scope.botellasReales=$scope.barraDerecha.cajasLlenas*$scope.barraDerecha.cantidadBotellasCajas;
				$scope.cajasEstimadas=$scope.barraDerecha.cajasEstimadas;
				$scope.totalParadas=$scope.barraDerecha.paradas;
				$scope.UltimaParada=$scope.barraDerecha.ultimaUbicacion;
				$scope.totalCamadas=$scope.barraDerecha.totalCamadas;
				$scope.botellasVacias=$scope.barraDerecha.botellasVacias;
				$scope.botellasLlenas=$scope.barraDerecha.botellasLlenas;
				$scope.cajasVacias=$scope.barraDerecha.cajasVacias;
				$scope.cajasLlenas=$scope.barraDerecha.cajasLlenas;
        $scope.idProduccion=$scope.barraDerecha.idProduccion;
				$scope.nulo="";

				//$scope.graficas=function()
				//{
					/*$('#canvasModal').modal({
				        show:true,
				        backdrop:'static'
				  });*/
          // fecha actual
          var f = new Date();
          var hours=f.getHours();
          var minutes=f.getMinutes();
          var seconds=f.getSeconds();
          var horas=0;
          var minutos=0;
          var segundos=0;

          if (hours<10) {
            horas="0"+f.getHours();
          } else {
            horas=f.getHours();
          }

          if (minutes<10) {
            minutos="0"+f.getMinutes();
          } else {
            minutos=f.getMinutes();
          }

          if (seconds<10) {
            segundos="0"+f.getSeconds();
          } else {
            segundos=f.getSeconds();
          }

          var maximo=$scope.cajasEstimadas;
          if(isNaN(maximo)){
            maximo=0;
          }
          var terceraParte=maximo/3;
          var distanciaNumeros=maximo/100;

          $scope.fechaActual=horas+":"+minutos+":"+segundos;
          // fin fecha actual
        if (graficar==true) {
          Highcharts.chart('gaugeSpeedometer', {
            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Reloj de Producción'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '107%'
                }, {
                    // default background
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0,
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
            },
            // the value axis
            yAxis: {
                min: 0,
                max: maximo, // MAXIMO

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: distanciaNumeros, // cantidad de numeros
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    distance:-20,
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: $scope.fechaActual
                },
                plotBands: [{
                    from: 0,
                    to: terceraParte, // 1ra Parte
                    color: '#DF5353' // red
                }, {
                    from: terceraParte, // 1ra Parte
                    to: terceraParte+terceraParte, // 2da Parte
                    color: '#DDDF0D' // yellow
                }, {
                    from: terceraParte+terceraParte, // 2da Parte
                    to: maximo, // MAXIMO
                    color: '#55BF3B' // green
                }]
            },
            series: [{
                name: 'Cantidad',
                data: [$scope.cajasLlenas],
                tooltip: {
                    valueSuffix: ' Cajas de Ron'
                }
            }]

          } ,
          // Add some life | ESTA FUNCION SE EJECUTA EN PARALELO CON EL SCRIPT
          function (chart) {
            if (!chart.renderer.forExport) { // necesario para funcionar
              setInterval(function () { // actualizacion de la data
                chart.yAxis[0].update({
                  title:{
                    text: $scope.fechaActual
                  }
                });
                var point = chart.series[0].points[0]; // necesario
                point.update($scope.cajasLlenas); // refresca valor data de series => series.data
              }, 1000); // FIN actualizacion de la data
            } // FIN necesario para funcionar
          }
          );
          if (maximo==0) {
            $('#gaugeSpeedometer').html('<img src="'+URL+'Vistas/template/imagenes/0.png" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">');
          }
        }
				//}
			  $('#gaugeSpeedometer').show();
        $('#resultadoDatabarraDerecha').val(1);
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
        if (graficar==true) {
          $('#gaugeSpeedometer').html('<img src="'+URL+'Vistas/template/imagenes/0.png" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">');
        }
        $('#relojGuage').val(0);
        $('#resultadoDatabarraDerecha').val(1);
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

  $scope.bucleAjax=1;
  var graficar=true;
  var promise=$interval( function() {
    if ($scope.bucleAjax==1) {
      $scope.DatabarraDerecha(graficar);
    }
    graficar = false;
    if ($('#relojGuage').val()==0) {
      graficar = true;
      $('#relojGuage').val(1);
    }
    $scope.bucleAjax = $('#resultadoDatabarraDerecha').val();
  }, 100);

  $scope.$on('$destroy', function() {
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
			var res=data.split('<');
			$scope.municipios=JSON.parse(res[0]);
		});

		$http.post(URL+'proveedores/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editProveedor=JSON.parse("["+res[0]+"]");
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

miAplicacion.controller('validarPlanificacion', function ($scope,$http)
{
	var accion = document.getElementById('accion').value;

  var f = new Date();
  var dia =f.getDate(), mes=f.getMonth()+1, anio=f.getFullYear()
  if (dia<10) {
    dia="0"+dia;
  }
  if (mes<10) {
    mes="0"+mes;
  }
  var date=anio+"-"+mes+"-"+dia;
  $scope.fecha_produccion=date;

  $http.post(URL+'planificacion/angular/lineas_1').success(function (data)
  {
    var res=data.split('<');
    $scope.lineasProduccion=JSON.parse(res[0]);
  });

	if (accion=='editar')
	{
    $scope.fecha_produccion="";
		var id=document.getElementById('id').value;

		$http.post(URL+'planificacion/angular/editar_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.editPlanificacion=JSON.parse("["+res[0]+"]");
		});
	}

  $scope.validacion=function () {
    var fecha=$('#fecha_produccion').val();
    var linea=$('#linea').val();
    $http.post(URL+'planificacion/angular/validar_'+fecha+'_'+linea+'_'+id).success(function (data)
		{
			var res=data.split('<');
			$scope.resultado=JSON.parse(res[0]);
      if ($scope.resultado.resultadoValidacion) {
          $scope.resultadoValidacion=$scope.resultado.resultadoValidacion
          $scope.planificacion.$invalid=true;
      } else {
        $scope.resultadoValidacion="";
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
