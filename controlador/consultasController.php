<?php

// require_once "../php/conexion.php";

class Consultas extends Dbconexion {

	public function select_persona(){

		$sqlp = Dbconexion::conexion()->prepare("SELECT * FROM personas ");

		$sqlp->execute();

		return $array = $sqlp->fetchAll(PDO::FETCH_ASSOC);


	}

	public function insert_persona($nombre, $apellido){

		$sql = Dbconexion::conexion()->prepare("INSERT INTO personas (nombre,apellido) VALUES ('$nombre', '$apellido') ");

		if ($sql->execute()) {

			/*acceder y ejecutar la funcion select_persona*/
			$resultado = self::select_persona();

			return $resultado;

		}

	}

	public function obtener_persona($id){

		$sql = Dbconexion::conexion()->prepare("SELECT * FROM personas WHERE id = '$id'");

		if ($sql->execute()) {

			return $array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}else{

			return "error";

		}

	}

	public function update_persona($id, $nombre, $apellido){

		$sql = Dbconexion::conexion()->prepare("UPDATE personas SET nombre = '".$nombre."', apellido = '".$apellido."' WHERE id = '".$id."'");

		$sql->execute();

		/*si la filas que actializo es mayor a 0 queire decir que si se actualizo*/
		if ($sql->rowCount() > 0) {

			$resultado = self::select_persona();

			return $resultado;

		}else{

			return "errorrr";

		}

	}

	public function delete_persona($id){

		$sql = Dbconexion::conexion()->prepare("DELETE FROM personas WHERE id = '$id'");

		$sql->execute();

		if ($sql->rowCount() > 0) {

			$resultado = self::select_persona();

			return $resultado;

		}else{

			return "error al eliminar";

		}

	}

}
 ?>
