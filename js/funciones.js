console.log("se conecto correctamente");


const Formulario = document.querySelector("form");

Formulario.addEventListener('submit', (e) => {

	// para que no se refresque la página
	e.preventDefault();

	const datos = new FormData(document.getElementById('form'));

	let nombre   = datos.get('nombre');
	let apellido = datos.get('apellido');

	let mensajes = document.querySelector("#mensajes");

	if (nombre == "") {

        let tipo_mensaje = "Debes de ingresar un nombre";
        error(tipo_mensaje);

        // console.log("entro nombre")
        return false;

    } else if(apellido == "") {

        let tipo_mensaje = "Debes de ingresar tus apellidos";
        error(tipo_mensaje);
        // console.log("entro apellido");
        return false;

    }else{

    	let tipo_mensaje = "limpiar";

    	error(tipo_mensaje);


    }

   /* console.log("apellido", apellido);

    return false;*/

	let url = 'modelo/ejecutarConsultas.php';

	fetch(url,{

		method: 'post',
		body: datos

	})
	.then (data => data.json())
	.then(data => {

		console.log('success', data);
		 pintar_tabla_resultados(data);

		 Formulario.reset();

	})
	.catch(function(error){

		console.log('eror', error);
	})

});

const error  = (tipo_mensaje) =>{


	if (tipo_mensaje == "limpiar") {

		mensajes.innerHTML = "";

	}else{

		mensajes.innerHTML +=`
	                        <div class="row">
	                            <div class="col-md-5 offset-md-3">
	                                <div class="alert alert-danger" role="alert">
	                                    <h4 class="alert-heading">Error!</h4>
	                                    <p> *${tipo_mensaje}</p>
	                                </div>
	                            </div>
	                        </div>
                        	`;

	}

}

const pintar_tabla_resultados = (data) =>{

	let tab_datos = document.querySelector("#id_persona");

	tab_datos.innerHTML = "";

	for(let item of data){

		tab_datos.innerHTML += `

		<tr>

			<td>${item.id}</td>
			<td>${item.nombre}</td>
			<td>${item.apellido}</td>
			<td class="text-center">
				<button class="btn btn-primary btn-sm" onclick="editar(${item.id})">Editar</button>
				<button class="btn btn-danger btn-sm" onclick="eliminar(${item.id})">Eliminar</button>
			</td>

		</tr>

		`;

	}

}


const eliminar = (id) =>{

	Swal.fire({

	  title: '¿Estás seguro de eliminar el registro?',
	  text: "Ya no se podrá recuperar el registro",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Aceptar'

	}).then((result) => {

	  if (result.isConfirmed) {

	  	const url = "modelo/ejecutarConsultas.php";

		const datos = new FormData();

		datos.append("id", id);
		datos.append("tipo_operacion", "eliminar");

		fetch(url,{

			method: "post",
			body: datos

		})
		.then(data => data.json())
		.then(data =>{

			console.log("successDelete", data);

			pintar_tabla_resultados(data);

			 Swal.fire(
	      	'Eliminado',
	      	'Se ha eliminado el registro',
	      	'success'

	    	)

		})
		.catch(error => console.error('Error:', error));



	  }

	})





}


const editar = (id) =>{

	const url = "modelo/ejecutarConsultas.php";

	const datos = new FormData();

	datos.append("tipo_operacion", "editar");
	datos.append("id",id);

	fetch(url,{

		method: "post",
		body: datos

	})
	.then(data => data.json())
	.then(data =>{

		console.log("success", data);

		let ids      = "";
		let nombre   = "";
		let apellido = "";

		for(let item of data){

			ids      = item.id;
			nombre   = item.nombre;
			apellido = item.apellido;

		}

		Swal.fire({

			title: 'Actualizar datos',
			html: `
                    <form id="update_form">

                    	<input type="text" id="tipo_operacion" name="tipo_operacion" hidden="true" value="update">
                    	<input type="text" id="idu" name="idu" hidden="true" value="${ids}">
                    	<hr>
                    	<input type="text" value="${nombre}" name="nombreu" class="form-control" placeholder="nombre">
                        <hr>
                         <input type="text" value="${apellido}" name="apellidou" class="form-control" placeholder="apellido">


                    </form>

                  `,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'

		}).then((result) =>{

			if (result.value) {

					const datos        = document.querySelector("#update_form");
					const datos_update = new FormData(datos);

					const url = "modelo/ejecutarConsultas.php";

					fetch(url,{

						method: "post",
						body: datos_update

					})
					.then(data => data.json() )
					.then(data => {

						console.log("successUp", data);

						pintar_tabla_resultados(data);

						swal.fire(

							'Exito',
                            'Se actualizo con exito',
                            'success'

							)


					})

					.catch(function(error){

							console.error("error:", error);

					})

			}

		})

	})

	.catch(function (error){

		console.error('error', error);

	});

}