<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>CRUD Fetch</title>
</head>
<body>

	<div class="container">

		<form id="form">

			<input type="text" id="tipo_operacion" name="tipo_operacion" hidden="true" value="guardar">

			<div class="row">

				<div class="col-md-4">

				<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa el nombre">

				</div>

				<div class="col-md-4">

					<input type="text" name="apellido" id="apellido" class="form-control" placeholder="ingresa el apellido">

				</div>

				<div class="col-md-2">

				<button type="submit" class=" btn btn-info btn-block">Guardar</button>

				</div>

			</div>

		</form>

	</div>

	<br>

	<div class="container" id="mensajes"></div>

	<br>

	<div class="container">

		<br>

		<table class="table table-bordered">

			<thead>

				<tr>

					<th>ID</th>
					<th>NOMBRE</th>
					<th>APELLIDO</th>
					<th>ACCIONES</th>

				</tr>

			</thead>

			<tbody id="id_persona">

				<?php

					require_once "php/conexion.php";
					require_once "controlador/consultasController.php";

					$sentencia = new Consultas();

					$mostrarDatos = $sentencia->select_persona();

					foreach ($mostrarDatos as $res) { ?>

						<tr>

							<td><?php echo $res['id']; ?></td>
							<td><?php echo $res['nombre']; ?></td>
							<td><?php echo $res['apellido']; ?> </td>
							<td class="text-center">

								<button class="btn btn-primary btn-sm" onclick="editar(<?php echo $res['id']; ?>)">Editar</button>
								<button class="btn btn-danger btn-sm" onclick="eliminar(<?php echo $res['id']; ?>)">Eliminar</button>

							</td>

						</tr>

					<?php
					}

				 ?>

			</tbody>

		</table>


	</div>

	<br>

	<p>Dua Lipa, amet consectetur, adipisicing elit. Quia perferendis voluptatum dolores est tempore autem magnam non animi temporibus aliquam, ex doloribus assumenda nobis sint mollitia perspiciatis sit impedit? Voluptas? 1111111111</p>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="js/funciones.js"></script>

</body>

</html>


