<?php

require_once "../php/conexion.php";

require_once "../controlador/consultasController.php";

 $tipo_consulta = $_POST["tipo_operacion"];

 switch ($tipo_consulta) {

 	case 'guardar':

 		$nombre   = $_POST["nombre"];
 		$apellido = $_POST["apellido"];

 		$consultas = new Consultas();

 		$ejecutar = $consultas->insert_persona($nombre, $apellido);

 		echo json_encode($ejecutar);

 	break;

 	case 'editar':

 		$id = $_POST["id"];

 		$consultas = new Consultas();

 		$ejecutar = $consultas->obtener_persona($id);

 		echo json_encode($ejecutar);

 	break;

 	case 'update':

 		$id       = $_POST["idu"];
 		$nombre   = $_POST["nombreu"];
 		$apellido = $_POST["apellidou"];

 		$consultas = new Consultas();

 		$ejecutar = $consultas->update_persona($id, $nombre, $apellido);

 		echo json_encode($ejecutar);

 	break;

 	case 'eliminar':

 		$id = $_POST["id"];

 		$consultas = new Consultas();

 		$ejecutar = $consultas->delete_persona($id);

 		echo json_encode($ejecutar);


 	break;


 }


 ?>