<?php

include_once 'Configuracion.php';

function sec_session_start() {
    $session_name = 'sec_session_id';
    $secure = SECURE;

    $httponly = true;
   ini_set('session.use_only_cookies', true);
   if (ini_get('session.use_only_cookies') === FALSE) {
    header("Location: ../error.php?err=No se pudo inicializar una sesion segura (ini_set)");
     exit();
    }

    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    session_name($session_name);

    session_start();
    session_regenerate_id();
}

function login($cuil, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT id_usuario, cuil, password, nivel, salt, activo, email FROM usuarios WHERE cuil = ? LIMIT 1")) {
        $stmt->bind_param('s', $cuil);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($id_usuario, $cuil, $db_password, $nivel, $salt, $activo, $email);
        $stmt->fetch();

        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            if (checkbrute($id_usuario, $mysqli) == true) {
                return false;
            } else {
                if ($db_password == $password) {
					if ($activo == 0) {
						// Si no está activa la cuenta, notifica
						echo json_encode(array("inactive" => true));
						exit();
					}
					 if(!isset($_SESSION)) 
					{ 
						session_start(); 
					} 
                    //session_start();
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    $id_usuario = preg_replace("/[^0-9]+/", "", $id_usuario);
                    $_SESSION['id_usuario'] = $id_usuario;

                    $cuil = preg_replace("/[^0-9]+/", "", $cuil);

                    $_SESSION['cuil'] = $cuil;
					
					$_SESSION['nivel'] = $nivel;

					$_SESSION['email'] = $email;
					
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

					// Ultima Visita
					$mysqli->query("INSERT INTO visitas(id_usuario, fecha) VALUES ('$id_usuario', now())");

                    return true;
                } else {
                    $now = time();
                    if (!$mysqli->query("INSERT INTO intentos_logueo(id_usuario, hora) VALUES ('$id_usuario', '$now')")) {
						// Si se superaron los limites de intentos, se da aviso
						echo json_encode(array("error" => "Se superaron los intentos de ingreso, intenta más tarde."));
                        exit();
                    }

                    return false;
                }
            }
        } else {
            return false;
        }
    } else {
		// Si da error en la base de datos, se da aviso.
		echo json_encode(array("error" => "¡Ocurrió un error interno!"));
        exit();
    }
}

function checkbrute($id_usuario, $mysqli) {
    $now = time();

    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $mysqli->prepare("SELECT hora FROM intentos_logueo WHERE id_usuario = ? AND hora > '$valid_attempts'")) {
        $stmt->bind_param('i', $id_usuario);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    } else {
		echo json_encode(array("error" => "(checkbrute) ¡No se pudo conectar a la base de datos!"));
        exit();
    }
}

function login_check($mysqli) {
    if (isset($_SESSION['id_usuario'], $_SESSION['cuil'], $_SESSION['login_string'], $_SESSION['nivel'])) {
        $id_usuario = $_SESSION['id_usuario'];
        $login_string = $_SESSION['login_string'];
        $cuil = $_SESSION['cuil'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT password FROM usuarios WHERE id_usuario = ? LIMIT 1")) {
            $stmt->bind_param('i', $id_usuario);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            header("Location: ./index.php");
            exit();
        }
    } else {
        return false;
    }
}


function isLogged() {
	//session_start();

    if (isset($_SESSION['id_usuario'])) {
        return $_SESSION['nivel'];
    } else {
        return false;
    }
}

//Listado de Usuarios no Activos
function usuariosNoActivos($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT id_usuario, cuil, nivel FROM usuarios where activo = 0")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($id_usuario, $cuil, $nivel);
		
		while ($stmt->fetch()) {
			$resultados[] = array($id_usuario, $cuil, $nivel);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ./index.php");
        exit();
    }
}

// obtener estado de verificacion desde sesion
function verificado($id_usuario, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT verificado2 FROM usuarios WHERE id_usuario = ? ")) {
        $stmt->bind_param('i', $id_usuario);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($verificado2);
        $stmt->fetch();
		
		return ($verificado2);

	} else {
        header("Location: ./index.php");
        exit();
    }
}
// obtener nombre desde sesion
function nombre($id_usuario, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT nombres FROM datos_personales WHERE id_usuario = ? ")) {
        $stmt->bind_param('i', $id_usuario);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($nombre);
        $stmt->fetch();
		
		return ($nombre);

	} else {
        header("Location: ./index.php");
        exit();
    }
}
//Obtener estado de verificacion de usuarios
function obtenerV($id_usuario, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT verificado FROM usuarios WHERE id_usuario = ? ")) {
        $stmt->bind_param('i', $id_usuario);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($nivel);
        $stmt->fetch();
		
		return ($nivel);

	} else {
        header("Location: ./index.php");
        exit();
    }
}

//Obtener DESCRIPCION del NIVEL del usuario
function obtenerDescripcionNivel($id_nivel, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT descripcion FROM usuarios_niveles WHERE id_nivel = ? ")) {
        $stmt->bind_param('i', $id_nivel);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($descripcion);
        $stmt->fetch();
		
		return ($descripcion);

	} else {
        header("Location: ./index.php");
        exit();
    }
}

//Obtener si un usuario esta dado de alta como contribuyente
function altasicont($id_usuario, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT id_usuario, numint FROM clientes WHERE id_usuario = ?")) {
        $stmt->bind_param('i', $id_usuario);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($id, $numint);
        $stmt->fetch();
		
		return array( $id, $numint);

	} else {
		return null;
        exit();
    }
}
//Obtener listado de servicios aceptados por el usuario
function listainm($cuenta, $mysqli) {
    $resultados = array();
    if ($stmt = $mysqli->prepare("SELECT numint, servicio, detalle, ap, sm, ip, cable, router   FROM servicios WHERE numint = ?")) {
        $stmt->bind_param('i', $cuenta);

        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($imp, $tipo, $detalle, $ap, $sm, $ip, $cable, $router);
        while ($stmt->fetch()) {
			$resultados[] = array($imp, $tipo, $detalle, $ap, $sm, $ip, $cable, $router);
		}
		
		return ($resultados);

	} else {
        header("Location: ./index.php");
        exit();
    }
}
//Obtener listado de inmuebles usuario
function listatdinm($cuenta, $mysqli) {
    $resultados = array();
    if ($stmt = $mysqli->prepare("SELECT impuesto, tipo, cuenta FROM baseorg WHERE impuesto NOT IN (SELECT impuesto FROM impuestos) AND cuenta = ?")) {
        $stmt->bind_param('s', $cuenta);

        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($imp, $tipo, $ncont);
        while ($stmt->fetch()) {
			$resultados[] = array($imp, $tipo, $ncont);
		}
		
		return ($resultados);

	} else {
        header("Location: ./index.php");
        exit();
    }
}

//Obtener DNI del usuario
function obtenerCUIL($id_usuario, $mysqli) {

    if ($stmt = $mysqli->prepare("SELECT cuil FROM usuarios WHERE id_usuario = ? ")) {
        $stmt->bind_param('i', $id_usuario);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($cuil);
        $stmt->fetch();
		
		return $cuil;

	} else {
        header("Location: ./index.php");
        exit();
    }
}

// Obtener listado de todos los usuarios con datos personales almacenados en la base de datos
function obtenerListadoUsuarios($mysqli) {
	$Resultados = [];
   
	if ($stmt = $mysqli->prepare("SELECT id_usuario FROM datos_personales")) {
        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($uID);

		while ($stmt->fetch()) {
			$Resultados[] = $uID;
		}

		return ($Resultados);
	} else {
         header("Location: ./index.php");
        exit();
    }
}

// Obtener todos los usuarios con un nivel superior a "usuario"
function obtenerUsuariosNv($mysqli) {
	$Resultados = [];
    
	if ($stmt = $mysqli->prepare("SELECT id_usuario FROM usuarios WHERE nivel > 3")) {
        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($uID);
		
		while ($stmt->fetch()) {
			$Resultados[] = $uID;
		}
		
		return ($Resultados);
		
	} else {
        header("Location: ./index.php");
        exit();
    }
}
//// Blog Inicio
function Blog($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT ord, titulo, fecha FROM blog ORDER BY ord DESC LIMIT 15")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($ord, $titulo, $fecha);
		
		while ($stmt->fetch()) {
			$resultados[] = array($ord, $titulo, $fecha);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ./index.php");
        exit();
    }
}
// Listado de todos los Blogs
function obtenerBlog($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT id, titulo, fecha FROM blog ORDER BY id DESC")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($pID, $Titulo, $Fecha);
		
		while ($stmt->fetch()) {
			$resultados[] = array($pID, $Titulo, $Fecha);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ./index.php");
        exit();
    }
}

// Obtener estado de verificacion desde el simulador
function obtenerPublicacion($PubliID, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT titulo, fecha, usuario FROM blog WHERE id = ?")) {
        $stmt->bind_param('i', $PubliID);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($Titulo, $Fecha, $Usuario);
        $stmt->fetch();
		
		return array($Titulo, $Fecha, $Usuario);

	} else {
        header("Location: ./index.php");
        exit();
    }
}

// Obtener listado de todos los usuarios pendientes a verificar identidad
function obtenerListadoNoVerificados($mysqli) {
	$resultados = array();

	if ($stmt = $mysqli->prepare("SELECT id_usuario, cuil, alta FROM usuarios WHERE verificado2 = '0' AND datos_enviados = '0' AND denegado = '0' ORDER BY id_usuario ASC")) {
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($ID, $CUIL, $Alta);
		
		while ($stmt->fetch()) {
			$resultados[] = array($ID, $CUIL, $Alta);
		}

		return ($resultados);
	} else {
        header("Location: ../error.php?err=Error de Base de datos: mamawebos.");
        exit();
    }
}

// Obtener listado de usuarios verificados
function obtenerListadoSiV($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT id_usuario, apellido, nombres FROM datos_personales where id_usuario IN (SELECT id_usuario FROM usuarios WHERE verificado2 = '1') ORDER BY apellido ASC")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($id_usuario, $apellido, $nombres);
		
		while ($stmt->fetch()) {
			$resultados[] = array($id_usuario, $apellido, $nombres);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ../error.php?err=Error de Base de datos: mamawebos.");
        exit();
    }
}

// Obtener listado de usuarios denegados
function obtenerListadoDenegados($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT id_usuario, apellido, nombres FROM datos_personales where id_usuario IN (SELECT id_usuario FROM usuarios WHERE denegado >= 1 AND verificado2 = 0 AND datos_enviados = 0) ORDER BY apellido ASC")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($id_usuario, $apellido, $nombres);
		
		while ($stmt->fetch()) {
			$resultados[] = array($id_usuario, $apellido, $nombres);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ../error.php?err=Error de Base de datos");
        exit();
    }
}

// Convierte un CUIL numerico a CUIL separado con guiones
// int $CUIL
function CUILFormat($CUIL) {
    if (strlen($CUIL) != 11) {
        return 'Error, CUIL incorrecto';
    }
    else {
        return substr ($CUIL, 0, 2).'-'.substr ($CUIL, 2, 8).'-'.substr ($CUIL, 10, 1);
    }
}
 
// Convierte un CUIL (con o sin guiones) a DNI con puntos
// string $CUIL
function fromCUILtoDNI($CUIL) {
    $CUIL = str_replace("-", "", $CUIL);
 
    if (strlen($CUIL) != 11) {
        return 'Error, CUIL incorrecto';
    }
    else {
        return substr($CUIL, 2, 2).'.'.substr($CUIL, 4, 3).'.'.substr($CUIL, 7, 3);
    }
}

function getLevel() {
	return $_SESSION['nivel'];
}

// Función para generar un código aleatorio
function generarCodigo($longitud) {
	$key = '';
	$pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];

	return $key;
}

// Obtiene los minutos transcurridos entre dos fechas
function minutosTranscurridos($fecha_i,$fecha_f) {
	$minutos = (strtotime($fecha_i)-strtotime($fecha_f))/60;
	$minutos = abs($minutos); $minutos = floor($minutos);

	return $minutos;
}


// Obfusca un email con asteriscos
function obfuscate_email($email)
{
       $em   = explode("@",$email);
       $name = implode(array_slice($em, 0, count($em)-1), '@');
       $len  = floor(strlen($name)/2);

       return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}


// Obtener todos los reclamos creados por un usuario
function obtenerMisReclamos($ID, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT id, asunto, departamento, estado FROM reclamos WHERE id_usuario = ? ORDER BY id DESC")) {
        $stmt->bind_param('i', $ID);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($ID, $Asunto, $Departamento, $Estado);

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		while ($stmt->fetch()) {
			$resultados[] = array($ID, $Asunto, $Departamento, $Estado);
		}

		return $resultados;

	} else {
        header("Location: ./index.php");
        exit();
    }
}

// Obtiene los datos de un reclamo en específico
function obtenerReclamo($ID_Reclamo, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT id_usuario, asunto, departamento, estado FROM reclamos WHERE id = ?")) {
		$stmt->bind_param('i', $ID_Reclamo);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($ID_Usuario, $Asunto, $Departamento, $Estado);
        $stmt->fetch();

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		return array($ID_Usuario, $Asunto, $Departamento, $Estado);
    } else {
		echo "Error DB";
	}
}

// Obtiene todas las respuestas de un reclamo, incluyendo datos personales del usuario
function obtenerRespuestasReclamo($ID_Reclamo, $ID_Usuario, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT b.apellido, b.nombres, a.fecha, a.mensaje, a.id_usuario, a.IP, a.informacion FROM reclamos_respuestas a INNER JOIN datos_personales b ON b.id_usuario = a.id_usuario WHERE a.id = ? ORDER BY a.fecha ASC")) {
		$stmt->bind_param('i', $ID_Reclamo);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($Apellido, $Nombres, $Fecha, $Mensaje, $ID_Usuario, $IP, $Informacion);

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		while ($stmt->fetch()) {
			$resultados[] = array($Apellido, $Nombres, $Fecha, $Mensaje, $ID_Usuario, $IP, $Informacion);
		}

		return $resultados;
    } else {
		echo "Error DB";
	}
}

function obtenerEstadoReclamo($Estado) {
    if ($Estado == 0) {
        return array('Abierto', 'success');
	} elseif ($Estado == 1) {
        return array('Respuesta cliente', 'warning');
    } elseif ($Estado == 2) {
        return array('Respondido', 'primary');
    } elseif ($Estado == 3) {
        return array('Cerrado', 'secondary');
    } else {
        return array('Desconocido', 'dark');
    }
}

// Obtener todos los reclamos en general para soporte
function obtenerReclamosGeneral($mysqli) {
    if ($stmt = $mysqli->prepare("SELECT id, asunto, departamento, estado FROM reclamos ORDER BY id ASC")) {
        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($ID, $Asunto, $Departamento, $Estado);

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		while ($stmt->fetch()) {
			$resultados[] = array($ID, $Asunto, $Departamento, $Estado);
		}

		return $resultados;

	} else {
        header("Location: ./index.php");
        exit();
    }
}

function obtenerDepartamento($Departamento) {
	if ($Departamento == 1) {
		return "Soporte técnico";
	} elseif ($Departamento == 2) {
		return "Ventas";
	} else {
		return "Otro";
	}
}

// Obtener todos los reclamos creados por un usuario
function obtenerMisReclamosint($ID, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT id, asunto, departamento, estado FROM reclamos2 WHERE id_usuario = ? ORDER BY id DESC")) {
        $stmt->bind_param('i', $ID);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($ID, $Asunto, $Departamento, $Estado);

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		while ($stmt->fetch()) {
			$resultados[] = array($ID, $Asunto, $Departamento, $Estado);
		}

		return $resultados;

	} else {
        header("Location: ./index.php");
        exit();
    }
}

// Obtiene los datos de un reclamo en específico
function obtenerReclamoint($ID_Reclamo, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT id_usuario, asunto, departamento, estado FROM reclamos2 WHERE id = ?")) {
		$stmt->bind_param('i', $ID_Reclamo);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($ID_Usuario, $Asunto, $Departamento, $Estado);
        $stmt->fetch();

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		return array($ID_Usuario, $Asunto, $Departamento, $Estado);
    } else {
		echo "Error DB";
	}
}

// Obtiene todas las respuestas de un reclamo, incluyendo datos personales del usuario
function obtenerRespuestasReclamoint($ID_Reclamo, $ID_Usuario, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT b.apellido, b.nombres, a.fecha, a.mensaje, a.id_usuario, a.IP, a.informacion FROM reclamos_respuestas2 a INNER JOIN datos_personales b ON b.id_usuario = a.id_usuario WHERE a.id = ? ORDER BY a.fecha ASC")) {
		$stmt->bind_param('i', $ID_Reclamo);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($Apellido, $Nombres, $Fecha, $Mensaje, $ID_Usuario, $IP, $Informacion);

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		while ($stmt->fetch()) {
			$resultados[] = array($Apellido, $Nombres, $Fecha, $Mensaje, $ID_Usuario, $IP, $Informacion);
		}

		return $resultados;
    } else {
		echo "Error DB";
	}
}


function obtenerEstadoReclamoint($Estado) {
    if ($Estado == 0) {
        return array('Abierto', 'success');
	} elseif ($Estado == 1) {
        return array('Respuesta cliente', 'warning');
    } elseif ($Estado == 2) {
        return array('Respondido', 'primary');
    } elseif ($Estado == 3) {
        return array('Cerrado', 'secondary');
    } else {
        return array('Desconocido', 'dark');
    }
}

// Obtener todos los reclamos en general para soporte
function obtenerReclamosGeneralint($mysqli) {
    if ($stmt = $mysqli->prepare("SELECT id, asunto, departamento, estado FROM reclamos2 ORDER BY id ASC")) {
        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($ID, $Asunto, $Departamento, $Estado);

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		while ($stmt->fetch()) {
			$resultados[] = array($ID, $Asunto, $Departamento, $Estado);
		}

		return $resultados;

	} else {
        header("Location: ./index.php");
        exit();
    }
}

function obtenerDepartamentoint($Departamento) {
	if ($Departamento == 1) {
		return "Soporte";
	} elseif ($Departamento == 2) {
		return "Tecnicos";
	} else {
		return "Otro";
	}
}

//Obtener listado de todos los usuarios no activos
function obtenerListadoNoActivos($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT id_usuario, cuil, alta FROM usuarios WHERE activo = 0")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($ID, $CUIL, $Alta);
		
		while ($stmt->fetch()) {
			$resultados[] = array($ID, $CUIL, $Alta);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ../error.php?err=Error de Base de datos: mamawebos.");
        exit();
    }
}

// Obtiene el estado del modo oscuro
function getDarkMode($mysqli) {
	// Se obtiene la ID del usuario
	$ID = $_SESSION['id_usuario'];

	if ($stmt = $mysqli->prepare("SELECT darkmode FROM usuarios WHERE id_usuario = ?")) {
        $stmt->bind_param('i', $ID);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($Estado);
		$stmt->fetch();

		if ($Estado == 0) {
			return 'light';
		} else {
			return 'dark';
		}
		
	} else {
		return 'light';
    }
}

function obtenerDatosPerfil($mysqli) {
	// Se obtiene la ID del usuario
	$ID = $_SESSION['id_usuario'];

	if ($stmt = $mysqli->prepare("SELECT a.cuil, a.email, a.alta, b.apellido, b.nombres FROM usuarios a INNER JOIN datos_personales b ON b.id_usuario = a.id_usuario WHERE a.id_usuario = ?")) {
		$stmt->bind_param('i', $ID);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($CUIL, $Email, $Alta, $Apellido, $Nombres);
		$stmt->fetch();

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		return array($CUIL, $Email, $Alta, $Apellido, $Nombres);
    } else {
		echo "Error DB";
	}
}

// Obtiene la cantidad de reclamos totales
function obtenerReclamosTotales($mysqli) {
	$Resultado = $mysqli->query("SELECT COUNT(*) AS Reclamos FROM reclamos")->fetch_array();

	return $Resultado['Reclamos'];
}

// Obtiene la cantidad de reclamos abiertos
function obtenerReclamosAbiertos($mysqli) {
	$Resultado = $mysqli->query("SELECT COUNT(*) AS Reclamos FROM reclamos WHERE estado = 0")->fetch_array();

	return $Resultado['Reclamos'];
}

// Obtiene la cantidad de reclamos sin responder
function obtenerReclamosPendientes($mysqli) {
	$Resultado = $mysqli->query("SELECT COUNT(*) AS Reclamos FROM reclamos WHERE estado = 1")->fetch_array();

	return $Resultado['Reclamos'];
}

// Obtiene la cantidad de reclamos respondidos
function obtenerReclamosRespondidos($mysqli) {
	$Resultado = $mysqli->query("SELECT COUNT(*) AS Reclamos FROM reclamos WHERE estado = 2")->fetch_array();

	return $Resultado['Reclamos'];
}

// Obtiene la cantidad de reclamos cerrados
function obtenerReclamosCerrados($mysqli) {
	$Resultado = $mysqli->query("SELECT COUNT(*) AS Reclamos FROM reclamos WHERE estado = 3")->fetch_array();

	return $Resultado['Reclamos'];
}

// Obtiene el nombre con solo mayúsculas en las primeras letras
function obtenerNombre($mysqli) {
	// Se obtiene la ID del usuario
	$ID = $_SESSION['id_usuario'];

    if ($stmt = $mysqli->prepare("SELECT nombres FROM datos_personales WHERE id_usuario = ? ")) {
        $stmt->bind_param('i', $ID);

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($nombre);
        $stmt->fetch();

		return ucwords(mb_strtolower($nombre, 'UTF-8'));
	} else {
        header("Location: ./index.php");
        exit();
    }
}


// Obtener listado todos los usuarios con verificación de identidad pendiente
function obtenerListadoPendientes($mysqli) {
	$resultados = array();

	if ($stmt = $mysqli->prepare("SELECT id_usuario FROM usuarios WHERE verificado2 = '0' AND datos_enviados = '1' AND denegado = '0' ORDER BY id_usuario ASC")) {
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($ID);
		
		while ($stmt->fetch()) {
			$resultados[] = $ID;
		}

		return ($resultados);
	} else {
		return "Error";
        exit();
    }
}


// Obtener estado de un usuario mediante su ID
function obtenerEstadoUsuario($uID, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT activo, verificado2, datos_enviados, denegado FROM usuarios WHERE id_usuario = ?")) {
		$stmt->bind_param('i', $uID);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($Activo, $Verificado, $Enviado, $Denegado);
		$stmt->fetch();

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

		if ($Activo == 0) {
			return "No activo";
		} elseif ($Activo == 1 && $Verificado == 0 && $Enviado == 0 && $Denegado == 0) {
			return "No verificado";
		} elseif ($Activo == 1 && $Verificado == 0 && $Enviado == 1) {
			return "Pendiente";
		} elseif ($Activo == 1 && $Verificado == 1) {
			return "Verificado";
		} elseif ($Activo == 1 && $Verificado == 0 && $Enviado == 0 && $Denegado > 0) {
			return "Denegado";
		} else {
			return null;
		}
    } else {
		echo "Error DB";
	}
}

// Obtiene todos los datos de un usuario mediante su ID
function obtenerDatosUsuario($uID, $mysqli) {
	if ($stmt = $mysqli->prepare("SELECT a.cuil, a.email, a.activacion, a.alta, b.apellido, b.nombres, b.direccion, b.localidad, b.zip, b.telefono, a.nivel, a.admin FROM usuarios a LEFT JOIN datos_personales b ON b.id_usuario = a.id_usuario WHERE a.id_usuario = ?")) {
		$stmt->bind_param('i', $uID);

		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($CUIL, $Email, $Activacion, $Alta, $Apellido, $Nombres, $Direccion, $Localidad, $Zip, $Telefono, $Nivel, $Admin);
		$stmt->fetch();

		// Chequea el número de resultados obtenidos, en caso de ser 0, se devuelve nulo
		if ($stmt->num_rows == 0) {
			return null;
			exit();
		}

        // Devuelve todos los datos obtenidos
		return array($CUIL, $Email, $Activacion, $Alta, $Apellido, $Nombres, $Direccion, $Localidad, $Zip, $Telefono, $Nivel, $Admin);
    } else {
		echo "Error DB";
	}
}

// Obtener todos los niveles de usuario
function obtenerNiveles($mysqli) {
	$resultados = array();
    
	if ($stmt = $mysqli->prepare("SELECT id_nivel, descripcion FROM usuarios_niveles ORDER BY id_nivel ASC")) {

        $stmt->execute();
        $stmt->store_result();

		$stmt->bind_result($nID, $Nivel);
		
		while ($stmt->fetch()) {
			$resultados[] = array($nID, $Nivel);
		}
		
		return ($resultados);
		
	} else {
        header("Location: ./index.php");
        exit();
    }
}

// Obtener la IP real del usuario
function getRealIP() {
	if (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	} elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
		return $_SERVER["HTTP_X_FORWARDED"];
	} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_FORWARDED"])) {
		return $_SERVER["HTTP_FORWARDED"];
    } else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

// Obtiene todos los usuarios registrados en cierto mes de un año
function obtenerRegistrosEnMes($Fecha, $mysqli) {
	$Resultado = 0;

	if ($stmt = $mysqli->prepare("SELECT alta FROM usuarios")) {
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($Alta);

		while ($stmt->fetch()) {
			if (date("Ym", strtotime($Alta)) == $Fecha) {
				$Resultado = $Resultado + 1;
			}
		}

		return ($Resultado);
	} else {
        header("Location: ./index.php");
        exit();
    }
}
?>