<?php

const SERVER = "localhost";
const DB     = "fetch";
const USER   = "root";
const PASS   = "jhonatan";
const UTF8   = "utf8";


const SGBD = "mysql:host=".SERVER.";dbname=".DB.";charset=".UTF8;


class Dbconexion{

	protected function conexion(){

		$con = new PDO(SGBD,USER,PASS);

		return $con;

	}


}

 ?>