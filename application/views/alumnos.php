 <div class="container-fluid animatedParent animateOnce my-3" id="panel">
 	<div class="animated">
 		<div class="row">
 			<div class="col-12 col-md-6 mt-2 mb-2">
 				<div class="card">
 					<div class="card-body">
 						<h5 class="card-title">Agregar Nuevo Alumno</h5>
 						<form>
 							<div class="form-group">
 								<div class="form-group">
 									<label>Nombre</label>
 									<input v-model="alumno.name" type="text" class="form-control">
 									<label>Apellidos</label>
 									<input v-model="alumno.lastname" type="text" class="form-control">
 									<label>Correo electronico</label>
 									<input v-model="alumno.email" type="email" class="form-control">
 									<label>Numero de telefono</label>
 									<input v-model="alumno.phone1" type="text" class="form-control">
 									<label>Nombre de usuario (no se pude repetir)</label>
 									<input v-model="alumno.username" type="text" class="form-control">
 									<label>Contraseña</label>
 									<input v-model="alumno.password" type="text" class="form-control">
 									<label>Ciudad</label>
 									<input v-model="alumno.city" type="text" class="form-control">
 									<label>Dirección</label>
 									<input v-model="alumno.address" type="text" class="form-control">
 									<div class="mt-3 d-flex justify-content-end">
 										<button v-on:click="createAlumnos" class="btn btn-success">Guardar alumno</button>
 									</div>
 								</div>
 							</div>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-12 mt-2 mb-2">
 				<div class="card">
 					<div class="card-body">
						 <h5 class="card-title">Listado de Alumnos</h5>
						 
						 <div v-for="value in arrayAlumnos" >
	<div  class="modal fade" :id="['Vermas' + value.id]" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ value.name}} {{ value.lastname_p}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



	  <table>

  <tr>
    <td scope="row" > Datos</td><td> </td><th scope="col">Informacion </th>
  </tr>
  <tr>
    <th scope="row">Rut:  </th><td> </td><td> {{ value.rut}}</td>
  </tr>
  <tr>
    <th scope="row">Nombre</th><td> </td><td>{{ value.name}}</td>
  </tr>
  <tr>
    <th scope="row">Apellido Paterno:  </th><td> </td><td> {{ value.lastname_p}}</td>
  </tr>
  <tr>
    <th scope="row">Apellido Materno:  </th><td> </td><td> {{ value.lastname_m}}</td>
  </tr>
  <tr>
    <th scope="row">Direccion:  </th><td> </td><td> {{ value.address}}</td>
  </tr>
  <tr>
    <th scope="row">Comuna:  </th><td> </td><td> {{ value.commune}}</td>
  </tr>
  <tr>
    <th scope="row">Coreo:  </th><td> </td><td> {{ value.email}}</td>
  </tr>
  <tr v-if=" value.rol_id>=2">
    <th scope="row">Telefono:  </th><td> </td><td> {{ value.phone}}</td>
  </tr>
  <tr>
    <th scope="row">Rol:  </th><td> </td><td> {{ value.rol}}</td>
  </tr>
  <tr v-if="value.rol_id==1">
    <th scope="row">Representante:  </th><td> {{ value.representative_id}}</td>
  </tr>
  <tr v-if="value.rol_id==1">
    <th scope="row">Representante Suplete:  </th><td> {{ value.representative_supp_id}}</td>
  </tr>

  <tr v-if="value.rol_id==1">
    <th scope="row">Curso Actual:  </th><td> {{ value.course_id}}</td>
  </tr>
</table>
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>

 						<v-client-table :columns="columns" v-model="arrayAlumnos" :options="options">
 							<div slot="fullname" slot-scope="{row}">
 								<div class="avatar avatar-md mr-3 mt-1 d-flex float-left">
 									<img v-bind:src="row.profileimageurl" alt="img">
 								</div>
 								<div>
 									<div>
 										<strong>{{row.fullname}}</strong>
 									</div>
 									<small>{{row.email}}</small>
 								</div>
 							</div>

 							<div slot="acciones" slot-scope="{row}">
							 <button class="btn btn-success"  data-toggle="modal"  :data-target="['#Vermas' + row.id]"> VER</button>
 								<button data-toggle="modal" v-on:click="updateAlumnos(row)" class="btn btn-info"> Editar </button>
 								<button class="btn btn-danger" v-on:click="deleteAlumnos(row)"> Eliminar</button>
 							</div>
 						</v-client-table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>
 </div>
 <script>
 	Vue.use(VueTables.ClientTable);
 	const panel = new Vue({
 		el: "#panel",
 		data() {
 			return {
 				arrayAlumnos: [],
 				alumno: {
 					name: "",
 					lastname: "",
 					email: "",
 					phone1: "",
 					username: "",
 					password: "",
 					city: "",
 					address: ""
 				},
 				columns: ['id', 'rut', 'name', 'lastname_p', 'lastname_m','email','contact_movil','rol','commune','address','acciones' ],
 				options: {
 					headings: {
						name: 'Nombre',
						lastname_p:"Apellido Paterno",
						lastname_m:"Apellido Materno",
 						email: 'Correo electronico',
 						contact_movil: 'N° de Telefono Personal',
						 commune:'Comuna',
 						city: "Ciudad",
 						address: "Dirección",
 						acciones: "Acciones"
 					},
 					filterable: ['fullname', 'email'],
 					texts: {
 						count: "Mostrando {from} a {to} de {count} resultados|{count} records|One record",
 						first: 'Primero',
 						last: 'Ultimo',
 						filter: "Filtro:",
 						filterPlaceholder: "Buscar",
 						limit: "Resultados:",
 						page: "Pagina:",
 						noResults: "No se encontraron resultados",
 						filterBy: "Filtrado por {column}",
 						loading: 'Cargando...',
 						defaultOption: 'Seleccionado {column}',
 						columns: 'Columnas'
 					},
 				},
 			}
 		},

 		methods: {
 			getAlumnos() {
 				axios.post("/index.php/Alumnos/getAlumnos").then((res) => {

 					this.arrayAlumnos = res.data;
 					console.log(this.arrayAlumnos);

 				});
 			},
 			createAlumnos() {
 				Swal.fire({
 					title: 'Ingresando Alumno al sistema',
 					timerProgressBar: true,
 					showConfirmButton: false,
 					willOpen: async () => {
 						Swal.showLoading()

 						await axios.post("/index.php/Alumnos/createAlumnos", {
 							alumno: this.alumno
 						}).then((res) => {
 							this.limpiar();
 							this.getAlumnos();
 							Swal.close();

 						});

 					}
 				})
 			},

 			updateAlumnos(row) {
 				console.log(row)
 			},

 			deleteAlumnos(row) {

 				Swal.fire({
 					title: `Estas seguro de eliminar a ${row.fullname} `,
 					text: "Una vez eliminado no se podra recuperar",
 					icon: 'warning',
 					showCancelButton: true,
 					confirmButtonColor: '#3085d6',
 					cancelButtonColor: '#d33',
 					confirmButtonText: 'Yes, delete it!'
 				}).then((result) => {
 					if (result.isConfirmed) {
 						Swal.fire(
 							'Deleted!',
 							'Your file has been deleted.',
 							'success'


 						)

 						axios.post("/index.php/Alumnos/deleteAlumnos", {
 							alumno: row.id
 						}).then((res) => {
 							this.getAlumnos();
 						});


 					}
 				})


 			},
 			limpiar() {

 				this.alumno.name = "";
 				this.alumno.lastname = "";
 				this.alumno.email = "";
 				this.alumno.phone1 = "";
 				this.alumno.username = "";
 				this.alumno.password = "";
 				this.alumno.city = "";
 				this.alumno.address = "";

 			}

 		},
 		created() {
 			this.getAlumnos();

 		},
 	});
 </script>

 </body>

 </html>
 <!-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Editar cliente</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
						<div class="modal-body">
							<form>
									<div class="form-group">
										<label>Nombre completo:</label>
										<input type="text" class="form-control" v-model="usuario.nombre" required>
										<label>Correo electronico:</label>
										<input type="text" class="form-control" v-model="usuario.email" >
										<label>Telefono:</label>
										<input type="text" class="form-control" v-model="usuario.telefono">
										<label>Direccion:</label>
										<input type="text" class="form-control" v-model="usuario.direccion" >
										<label>Nombre de usuario:</label>
										<input type="text" class="form-control" v-model="usuario.usuario" >
										<label>Contraseña de usuario:</label>
										<input type="text" class="form-control" v-model="usuario.password" >
										<label>Tipo de usaurio:</label>
										<v-select :options="arrayTipoUsuario" label="tipo_usuario" :reduce="tipo => tipo.id" v-model="usuario.id_tipo_usuario" placeholder="Seleccione el tipo de usuario" ></v-select>
									</div>
									<div>
									</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						<input type="button" v-on:click="updateUsuario" class="btn btn-success" value="Guardar">
						</div>
					</div>
			</div>
		</div> -->
