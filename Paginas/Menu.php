<?php
/*
	Archivo: Menu.php
	Autor: Armas, Juan Manuel
	Proposito: Funcionamiento y configuración del menú
	Fecha: 04/01/2021
	Ultima edición: 05/01/2021
*/

	// Array limpio
	$MenuArr = [];

	// Menú de nivel 3 (Usuario normal)
	$MenuArr[3] = [
		"Inicio" => [
			"Icono" => "nav-icon fas fa-home",
			"Seccion" => "Inicio",
			"Archivo" => "Inicio.php",
		],

		"Mi perfil" => [
			"Icono" => "nav-icon fas fa-user",
			"Seccion" => "Perfil",
			"Archivo" => "Perfil.php",
		],
		
		"Servicios" => [
			"Icono" => "nav-icon far fa-file-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				
				
				"Mis servicios" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadoImpuestos",
					"Archivo" => "Impuestos/lst_Impuestos.php",
				],
			]
		],

		"OTROS" => [
			"Tipo" => "Separador",
		],

		"Soporte" => [
			"Icono" => "nav-icon fas fa-ticket-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Crear nuevo reclamo" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "CrearReclamo",
					"Archivo" => "Reclamos/crearReclamo.php",
				],
				
				"Mis reclamos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "MisReclamos",
					"Archivo" => "Reclamos/lst_MisReclamos.php",
				],

				"Preguntas frecuentes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "FAQ",
				],
			]
		],

		"Documentación" => [
			"Icono" => "nav-icon fas fa-file",
			"Seccion" => "Documentacion",
		],
	];

	// Menú de nivel 4 (Usuario de prensa)
	$MenuArr[4] = [
		"Inicio" => [
			"Icono" => "nav-icon fas fa-home",
			"Seccion" => "Inicio",
			"Archivo" => "Inicio.php",
		],

		"Mi perfil" => [
			"Icono" => "nav-icon fas fa-user",
			"Seccion" => "Perfil",
			"Archivo" => "Perfil.php",
		],
		
		"Servicios" => [
			"Icono" => "nav-icon far fa-file-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				
				
				"Mis servicios" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadoImpuestos",
					"Archivo" => "Impuestos/lst_Impuestos.php",
				],
			]
		],
		
		"Prensa" => [
			"Icono" => "nav-icon fas fa-bullhorn",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Publicar en inicio" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "Publicar",
					"Archivo" => "Prensa/Publicar.php",
				],
				
				"Lista de publicaciones" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListaPublicaciones",
					"Archivo" => "Prensa/lst_Publicaciones.php",
				],
			],
		],

		"OTROS" => [
			"Tipo" => "Separador",
		],

		"Soporte" => [
			"Icono" => "nav-icon fas fa-ticket-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Crear nuevo reclamo" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "CrearReclamo",
					"Archivo" => "Reclamos/crearReclamo.php",
				],
				
				"Mis reclamos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "MisReclamos",
					"Archivo" => "Reclamos/lst_MisReclamos.php",
				],

				"Preguntas frecuentes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "FAQ",
				],
			]
		],

		"Documentación" => [
			"Icono" => "nav-icon fas fa-file",
			"Seccion" => "Documentacion",
		],
	];

	// Menú de nivel 5 (Usuario de soporte)
	$MenuArr[5] = [
		"Inicio" => [
			"Icono" => "nav-icon fas fa-home",
			"Seccion" => "Inicio",
			"Archivo" => "Inicio.php",
		],

		"Mi perfil" => [
			"Icono" => "nav-icon fas fa-user",
			"Seccion" => "Perfil",
			"Archivo" => "Perfil.php",
		],
		
		"Servicios" => [
			"Icono" => "nav-icon far fa-file-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				
				
				"Mis servicios" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadoImpuestos",
					"Archivo" => "Impuestos/lst_Impuestos.php",
				],
			]
		],
		
		"Usuarios" => [
			"Icono" => "nav-icon fas fa-users",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Usuarios no activos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNoActivos",
					"Archivo" => "Usuarios/lst_NoActivos.php",
				],

				"Usuarios no verificados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNoVerificados",
					"Archivo" => "Usuarios/lst_NoVerificados.php",
				],

				"Verificación pendiente" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrPendientes",
					"Archivo" => "Usuarios/lst_Pendientes.php",
				],

				"Usuarios verificados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrVerificados",
					"Archivo" => "Usuarios/lst_Verificados.php",
				],
				
				"Usuarios denegados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrDenegados",
					"Archivo" => "Usuarios/lst_Denegados.php",
				],
				
			],
		],
		
		"Reclamos" => [
			"Icono" => "nav-icon fas fa-comments",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Reclamos abiertos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosAbiertos",
					"Archivo" => "Reclamos/lst_ReclamosAbiertos.php",
				],
				
				"Reclamos sin responder" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosPendientes",
					"Archivo" => "Reclamos/lst_ReclamosPendientes.php",
				],
				
			],
		],

		"Mensajes Internos" => [
			"Icono" => "nav-icon fas fa-comments",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Mensajes abiertos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintAbiertos",
					"Archivo" => "Reclamos int/lst_ReclamosAbiertos.php",
				],
				
				"Mensajes sin responder" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintPendientes",
					"Archivo" => "Reclamos int/lst_ReclamosPendientes.php",
				],
				"Mensajes respondidos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintRespondidos",
					"Archivo" => "Reclamos int/lst_ReclamosRespondidos.php",
				],
				
				"Mensajes cerrados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintCerrados",
					"Archivo" => "Reclamos int/lst_ReclamosCerrados.php",
				],

				"Crear nuevo Mensajes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "CrearReclamoint",
					"Archivo" => "Reclamos int/crearReclamo.php",
				],
				
				"Mis Mensajes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "MisReclamosint",
					"Archivo" => "Reclamos int/lst_MisReclamos.php",
				],
				
			],
		],

		"OTROS" => [
			"Tipo" => "Separador",
		],

		"Documentación" => [
			"Icono" => "nav-icon fas fa-file",
			"Seccion" => "Documentacion",
		],
		
	];

	// Menú de nivel 5 (Usuario de soporte)
	$MenuArr[6] = [
		"Inicio" => [
			"Icono" => "nav-icon fas fa-home",
			"Seccion" => "Inicio",
			"Archivo" => "Inicio.php",
		],

		"Mi perfil" => [
			"Icono" => "nav-icon fas fa-user",
			"Seccion" => "Perfil",
			"Archivo" => "Perfil.php",
		],
		
		"Servicios" => [
			"Icono" => "nav-icon far fa-file-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				
				
				"Mis servicios" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadoImpuestos",
					"Archivo" => "Impuestos/lst_Impuestos.php",
				],
			]
		],
		
		"Usuarios" => [
			"Icono" => "nav-icon fas fa-users",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Usuarios no activos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNoActivos",
					"Archivo" => "Usuarios/lst_NoActivos.php",
				],

				"Usuarios no verificados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNoVerificados",
					"Archivo" => "Usuarios/lst_NoVerificados.php",
				],

				"Verificación pendiente" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrPendientes",
					"Archivo" => "Usuarios/lst_Pendientes.php",
				],

				"Usuarios verificados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrVerificados",
					"Archivo" => "Usuarios/lst_Verificados.php",
				],
				
				"Usuarios denegados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrDenegados",
					"Archivo" => "Usuarios/lst_Denegados.php",
				],
				
			],
		],
		
		"Reclamos" => [
			"Icono" => "nav-icon fas fa-comments",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Reclamos abiertos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosAbiertos",
					"Archivo" => "Reclamos/lst_ReclamosAbiertos.php",
				],
				
				"Reclamos sin responder" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosPendientes",
					"Archivo" => "Reclamos/lst_ReclamosPendientes.php",
				],
				
			],
		],

		
		"Mensajes Internos" => [
			"Icono" => "nav-icon fas fa-comments",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Mensajes abiertos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintAbiertos",
					"Archivo" => "Reclamos int/lst_ReclamosAbiertos.php",
				],
				
				"Mensajes sin responder" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintPendientes",
					"Archivo" => "Reclamos int/lst_ReclamosPendientes.php",
				],
				"Mensajes respondidos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintRespondidos",
					"Archivo" => "Reclamos int/lst_ReclamosRespondidos.php",
				],
				
				"Mensajes cerrados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintCerrados",
					"Archivo" => "Reclamos int/lst_ReclamosCerrados.php",
				],
				

				"Crear nuevo Mensajes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "CrearReclamoint",
					"Archivo" => "Reclamos int/crearReclamo.php",
				],
				
				"Mis Mensajes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "MisReclamosint",
					"Archivo" => "Reclamos int/lst_MisReclamos.php",
				],
				
				
			],
		],

		"OTROS" => [
			"Tipo" => "Separador",
		],

		"Documentación" => [
			"Icono" => "nav-icon fas fa-file",
			"Seccion" => "Documentacion",
		],
		
	];
	
	// Menú de nivel 9 (Usuario ROOT)
	$MenuArr[9] = [
		"Inicio" => [
			"Icono" => "nav-icon fas fa-home",
			"Seccion" => "Inicio",
			"Archivo" => "Inicio.php",
		],

		"Mi perfil" => [
			"Icono" => "nav-icon fas fa-user",
			"Seccion" => "Perfil",
			"Archivo" => "Perfil.php",
		],
		
		"Servicios" => [
			"Icono" => "nav-icon far fa-file-alt",
			"Tipo" => "Sub-menu",
			"Menu" => [
				
				
				"Mis servicios" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadoImpuestos",
					"Archivo" => "Impuestos/lst_Impuestos.php",
				],
			]
		],
		
		"Usuarios" => [
			"Icono" => "nav-icon fas fa-users",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Usuarios no activos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNoActivos",
					"Archivo" => "Usuarios/lst_NoActivos.php",
				],
				
				"Usuarios no verificados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNoVerificados",
					"Archivo" => "Usuarios/lst_NoVerificados.php",
				],
				
				"Verificación pendiente" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrPendientes",
					"Archivo" => "Usuarios/lst_Pendientes.php",
				],
				
				"Usuarios verificados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrVerificados",
					"Archivo" => "Usuarios/lst_Verificados.php",
				],
				
				"Usuarios denegados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrDenegados",
					"Archivo" => "Usuarios/lst_Denegados.php",
				],

				"Listado completo" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrListado",
					"Archivo" => "Usuarios/lst_Usuarios.php",
				],
				
				"Niveles de usuario" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "usrNiveles",
					"Archivo" => "Usuarios/lst_Nivel.php",
				]
			],
		],
		
		"Reclamos" => [
			"Icono" => "nav-icon fas fa-comments",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Reclamos abiertos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosAbiertos",
					"Archivo" => "Reclamos/lst_ReclamosAbiertos.php",
				],
				
				"Reclamos sin responder" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosPendientes",
					"Archivo" => "Reclamos/lst_ReclamosPendientes.php",
				],
				
				"Reclamos respondidos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosRespondidos",
					"Archivo" => "Reclamos/lst_ReclamosRespondidos.php",
				],
				
				"Reclamos cerrados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosCerrados",
					"Archivo" => "Reclamos/lst_ReclamosCerrados.php",
				],

				"Listado completo" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadoReclamos",
					"Archivo" => "Reclamos/lst_Reclamos.php",
				],
			],
		],

		"Mensajes Internos" => [
			"Icono" => "nav-icon fas fa-comments",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Mensajes abiertos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintAbiertos",
					"Archivo" => "Reclamos int/lst_ReclamosAbiertos.php",
				],
				
				"Mensajes sin responder" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintPendientes",
					"Archivo" => "Reclamos int/lst_ReclamosPendientes.php",
				],
				"Mensajes respondidos" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintRespondidos",
					"Archivo" => "Reclamos int/lst_ReclamosRespondidos.php",
				],
				
				"Mensajes cerrados" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ReclamosintCerrados",
					"Archivo" => "Reclamos int/lst_ReclamosCerrados.php",
				],

				"Listado completo" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListadointReclamos",
					"Archivo" => "Reclamos int/lst_Reclamos.php",
				],

				

				"Crear nuevo Mensajes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "CrearReclamoint",
					"Archivo" => "Reclamos int/crearReclamo.php",
				],
				
				"Mis Mensajes" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "MisReclamosint",
					"Archivo" => "Reclamos int/lst_MisReclamos.php",
				],
				
				
			],
		],
		
		"Prensa" => [
			"Icono" => "nav-icon fas fa-bullhorn",
			"Tipo" => "Sub-menu",
			"Menu" => [
				"Publicar en inicio" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "Publicar",
					"Archivo" => "Prensa/Publicar.php",
				],
				
				"Lista de publicaciones" => [
					"Icono" => "far fa-circle nav-icon",
					"Seccion" => "ListaPublicaciones",
					"Archivo" => "Prensa/lst_Publicaciones.php",
				],
			],
		],

		"OTROS" => [
			"Tipo" => "Separador",
		],

		"Estadísticas" => [
			"Icono" => "nav-icon fas fa-stream",
			"Seccion" => "Estadisticas",
			"Archivo" => "Estadisticas.php",
		],

		"Importar/Exportar" => [
			"Icono" => "nav-icon fas fa-download",
			"Seccion" => "Exportar",
			"Archivo" => "Exportar.php",
		],

		"Documentación" => [
			"Icono" => "nav-icon fas fa-file",
			"Seccion" => "Documentacion",
		],

		"Registros" => [
			"Icono" => "nav-icon fas fa-clipboard-list",
			"Seccion" => "Registros",
			"Archivo" => "Registros.php",
		],

	];

	// Clase del menú
	class Menu {
		// Propiedades
		var $ArrayLst;
		var $Seccion;
		var $Archivo;

		// Constructor
		function __construct($ArrayLst) {
			$this->ArrayLst = $ArrayLst;
			
			if (!isset($_GET['Seccion'])) {
				$this->Seccion = "Inicio";
			} else {
				$this->Seccion = $_GET['Seccion'];
			}
		}

		/////////////
		// MÉTODOS //
		/////////////
		
		// Crear un item nuevo en el menú
		function crearItem($SubArray, $Key) {
			echo
			'<li class="nav-item">'.
				'<a href="'.(null == $SubArray['Seccion'] ? '#': '?Seccion='.$SubArray['Seccion']).'" class="nav-link '.(isset($SubArray['Activo']) ? 'active': '').'">'.
					(null == $SubArray['Icono'] ? '': '<i class="'.$SubArray['Icono'].'"></i>').
					'<p>'.$Key.'</p>'.
				'</a>
			</li>';
		}

		function crearSubMenu($SubArray, $Key) {
			echo
			'<li class="nav-item has-treeview '.(isset($SubArray['Activo']) ? 'menu-open': '').'">
				<a href="#" class="nav-link '.(isset($SubArray['Activo']) ? 'active': '').'">'.
					(null == $SubArray['Icono'] ? '': '<i class="'.$SubArray['Icono'].'"></i>').'
					<p>
						'.$Key.'
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>

				<ul class="nav nav-treeview">';
		}

		// Crear un separador con texto
		function crearSeparador($SubArray, $Key) {
			echo '<li class="nav-header">'.$Key.'</li>';
		}
		
		function obtenerArchivo() {
			return $this->Archivo;
		}

		// Crea el menú completo mediante el array entregado
		function crearMenu() {
			// Primer foreach para marcar como activos los menús y los archivos de cada uno
			foreach ($this->ArrayLst as $Key => $Valor) {
				// Chequea si hay un tipo
				if (isset($Valor['Tipo'])) {
					if ($Valor['Tipo'] == "Sub-menu") {
						foreach ($Valor['Menu'] as $SubKey => $SubMenu) {
							if (null !== $SubMenu['Seccion'] && $SubMenu['Seccion'] == $this->Seccion) {
								$this->ArrayLst[$Key]['Menu'][$SubKey]['Activo'] = true;
								$this->ArrayLst[$Key]['Activo'] = true;
								$this->Archivo = $SubMenu['Archivo'];
							}
						}
					}
				} else {
					if (null !== $Valor['Seccion'] && $Valor['Seccion'] == $this->Seccion) {
						$this->ArrayLst[$Key]['Activo'] = true;
						
						if (null !== $Valor['Archivo']) {
							$this->Archivo = $Valor['Archivo'];
						}
					}
				}
			}

			// Segundo foreach, para crear el menú
			foreach ($this->ArrayLst as $Key => $Valor) {
				// Chequea si hay un tipo
				if (isset($Valor['Tipo'])) {
					if ($Valor['Tipo'] == "Sub-menu") {
						$this->crearSubMenu($Valor, $Key);

						foreach ($Valor['Menu'] as $SubKey => $SubMenu) {
							$this->crearItem($SubMenu, $SubKey);
						}

						echo '</ul> </li>';
					}

					// Funcionamiento de los separadores
					elseif ($Valor['Tipo'] == "Separador") {
						$this->crearSeparador($Valor, $Key);
					}
				} else {
					$this->crearItem($Valor, $Key);
				}
			}
		}
	}
	
	// Incluye las secciones aparte del menú
	include "Secciones.php";
?>


<?php
	ob_start();
?>
<?php
	isLogged();

	$nombre = nombre($_SESSION['id_usuario'],$mysqli);
?>
<?php
setlocale(LC_CTYPE, 'es');
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cooperativa Agropecuaria-Electrica MC</title>
	<link rel="shortcut icon" href="Media/favicon.ico" type="image/x-icon">
	<link rel="icon" href="Media/favicon.ico" type="image/x-icon">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="Plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="Plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="Plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="Plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="Plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="Plugins/summernote/summernote-bs4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
	
	<!-- Librería jQuery -->
	<script src="Librerias/jQuery.js"></script>

	<!-- Librería jQuery - maskedinput -->
	<script src="Librerias/jquery.maskedinput.js"></script>

	<!-- Librería Notiflix -->
	<link rel="stylesheet" href="Librerias/Notiflix/notiflix-2.6.0.min.css" />
	<script src="Librerias/Notiflix/notiflix-2.6.0.min.js"></script>
	
	<!-- Librería SHA512 -->
	<script src="Librerias/sha512.js"></script>

	<!-- Librería CropperJS -->
	<link  href="Librerias/CropperJS/cropper.css" rel="stylesheet">
	<script src="Librerias/CropperJS/cropper.js"></script>

	<!-- Librería PSWmeter -->
	<script src="Librerias/pswmeter.min.js"></script>
	
	<!-- Bootstrap -->
	<link href="Librerias/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />

	<!-- Owl Carousel -->
    <link href="Librerias/OwlCarousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="Librerias/OwlCarousel/owl.theme.default.css" rel="stylesheet" type="text/css"/>

	<!-- Modernizr JS -->
	<script src="Librerias/modernizr-3.5.0.min.js"></script>
	
	<!-- SweetAlert 2 -->
	<script src="Librerias/sweetalert2.all.min.js"></script>
	
	<!-- Librería Moment -->
	<script src="Plugins/moment/moment-with-locales.min.js"></script>

	<link rel="stylesheet" href="Librerias/flatpickr.min.css">
	<script src="Librerias/flatpickr.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed single">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Cooperativa Agropecuaria-Electrica MC</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-<?php echo getDarkMode($mysqli); ?>-success elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
						<?php if (file_exists("Perfil/".$ID.".jpeg")) {
							echo '<img src="Perfil/'.$ID.'.jpeg?='.filemtime("Perfil/".$ID.".jpeg").'" alt="C.A.E.M.C" class="brand-image img-circle elevation-3" style="opacity: .8" >';
						} else {
							echo '<img src="Media/logo.jpg" alt="C.A.E.M.C" class="brand-image img-circle elevation-3" style="opacity: .8">';
						}
						?>
				
				<span class="brand-text font-weight-light">User Ver. 1.0.0</span>		   
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
					with font-awesome or any other icon font library -->
					<?php
						$nMenu = new Menu($MenuArr[$Nivel]);
						$nMenu->crearMenu();
					?>
					
					<li class="nav-item">
						<a href="includes/Logout.php" class="nav-link">
							<i class="nav-icon fas fa-sign-out-alt"></i>
							<p>Cerrar sesión</p>
						</a>
					</li>	
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?php
				if (isset($_GET['Seccion'])) {
					$Seccion = $_GET['Seccion'];
				}

				
				if (null == $nMenu->obtenerArchivo() && null !== $Secciones[$Nivel][$Seccion]) {
					include './Paginas/'.$Secciones[$Nivel][$Seccion];
				} elseif (null !== $nMenu->obtenerArchivo()) {
					include './Paginas/'.$nMenu->obtenerArchivo();
				} else {
					include './Paginas/404.php';
				}
			?>
		</div>

		<!-- /.content-wrapper -->
		<footer class="main-footer">
			Copyright &copy; 2021 <a href="https://www.caemc.com.ar">Cooperativa Agropecuaria-Electrica MC</a>.
			<div class="float-right d-none d-sm-inline-block">
				<b>C.A.E.M.C Ver.</b> 1.0.0
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<script>
		
	</script>
	<!-- ./wrapper -->

	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<!-- jQuery -->
	<script src="Plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="Plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- ChartJS -->
	<script src="Plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="Plugins/sparklines/sparkline.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="Plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="Plugins/moment/moment.min.js"></script>
	<script src="Plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Summernote -->
	<script src="Plugins/summernote/summernote-bs4.min.js"></script>
	<script src="Plugins/summernote/lang/summernote-es-ES.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="Plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	
	<script src="Librerias/Bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<script src="Librerias/bootbox.min.js"></script>
	<!-- DataTables -->
	<script src="Plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="Plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="Plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="Plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	
	<script src="Librerias/OwlCarousel/owl.carousel.min.js"></script>
</body>
</html>
