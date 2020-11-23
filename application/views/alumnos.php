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
 									<label>Rut</label>
 									<input v-model="alumno.rut" type="text" class="form-control">

 									<label>Nombre</label>
 									<input v-model="alumno.name" type="text" class="form-control">

 									<label>Apellido Paterno</label>
 									<input v-model="alumno.lastname_p" type="text" class="form-control">

 									<label>Apellido Materno</label>
 									<input v-model="alumno.lastname_m" type="text" class="form-control">

 									<label v-if="alumno.rol_id == 4 || alumno.rol_id == 2">Correo electronico</label>
 									<input v-if="alumno.rol_id == 4 || alumno.rol_id == 2" v-model="alumno.email" type="text" class="form-control">

 									<label>Rol</label>
 									<v-select placeholder="Seleccione como filtrar  los cursos" @input=" " :options="arrayRol" label="name" :reduce="Rol => Rol.id" v-model="alumno.rol_id"></v-select>

 									<label v-if="alumno.rol_id > 1">Telefono fijo </label>
 									<input v-if="alumno.rol_id > 1" v-model="alumno.phone" type="text" class="form-control">

 									<label>Telefono Movil</label>
 									<input v-model="alumno.contact_movil" type="text" class="form-control">

 									<label>Comuna</label>
 									<input v-model="alumno.commune" type="text" class="form-control">

 									<label>Dirección</label>
 									<input v-model="alumno.address" type="text" class="form-control">

 									<label v-if="alumno.rol_id == 1">Curso</label>
 									<input v-if="alumno.rol_id == 1" v-model="alumno.curso" type="text" class="form-control">

 									<label v-if="alumno.rol_id == 1">Prioridad</label>
 									<v-select v-if="alumno.rol_id == 1" placeholder="Seleccione Tipo de Prioridad" :options="prioridad" label="name" :reduce="prioridad => prioridad.id" v-model="alumno.prioritary"></v-select>

 									<label v-if="alumno.rol_id == 1">Representante</label>
 									<v-select v-if="alumno.rol_id == 1" placeholder="Seleccione Representante" :options="arrayApoderado" label="rut" :reduce="representative_id => representative_id.id" v-model="alumno.representative_id"></v-select>

 									<label v-if="alumno.rol_id == 1">Representante Suplente </label>
 									<v-select v-if="alumno.rol_id == 1" placeholder="Seleccione Representante" :options="arrayApoderado" label="rut" :reduce="representative_supp_id => representative_supp_id.id" v-model="alumno.representative_supp_id"></v-select>

 									<label v-if="alumno.rol_id == 2 || alumno.rol_id == 4">Contraseña</label>
 									<input v-if="alumno.rol_id == 2 || alumno.rol_id == 4" v-model="alumno.password" type="text" class="form-control">

 									<div class="mt-3 d-flex justify-content-end">
 										<button v-on:click="create($event)" class="btn btn-success">Guardar </button>
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

 						<div v-for="value in arrayAlumnos">
 							<div class="modal fade" :id="['Vermas' + value.id]" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
 													<td scope="row"> Datos</td>
 													<td> </td>
 													<th scope="col">Informacion </th>
 												</tr>
 												<tr>
 													<th scope="row">Rut: </th>
 													<td> </td>
 													<td> {{ value.rut}}</td>
 												</tr>
 												<tr>
 													<th scope="row">Nombre</th>
 													<td> </td>
 													<td>{{ value.name}}</td>
 												</tr>
 												<tr>
 													<th scope="row">Apellido Paterno: </th>
 													<td> </td>
 													<td> {{ value.lastname_p}}</td>
 												</tr>
 												<tr>
 													<th scope="row">Apellido Materno: </th>
 													<td> </td>
 													<td> {{ value.lastname_m}}</td>
 												</tr>
 												<tr>
 													<th scope="row">Direccion: </th>
 													<td> </td>
 													<td> {{ value.address}}</td>
 												</tr>
 												<tr>
 													<th scope="row">Comuna: </th>
 													<td> </td>
 													<td> {{ value.commune}}</td>
 												</tr>
 												<tr v-if="value.rol_id == 2 || value.rol_id == 4">
 													<th scope="row">Coreo: </th>
 													<td> </td>
 													<td> {{ value.email}}</td>
 												</tr>
 												<tr v-if=" value.rol_id>=2">
 													<th scope="row">Telefono: </th>
 													<td> </td>
 													<td> {{ value.phone}}</td>
 												</tr>
 												<tr>
 													<th scope="row">Rol: </th>
 													<td> </td>
 													<td> {{ value.rol}}</td>
 												</tr>
 												<tr v-if="value.rol_id==1">
 													<th scope="row">Representante: </th>
 													<td> {{ value.representative_id}}</td>
 												</tr>
 												<tr v-if="value.rol_id==1">
 													<th scope="row">Representante Suplete: </th>
 													<td> {{ value.representative_supp_id}}</td>
 												</tr>

 												<tr v-if="value.rol_id==1">
 													<th scope="row">Curso Actual: </th>
 													<td> {{ value.course_id}}</td>
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

 						<label>Filtrar Por Rol</label>
 						<v-select placeholder="Seleccione como filtrar  los cursos" @input="Filtro" :options="arrayRol" label="name" :reduce="Role => Role.id" v-model="filtro"></v-select>

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
 								<button class="btn btn-success" data-toggle="modal" :data-target="['#Vermas' + row.id]"> VER</button>
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
 	Vue.component('v-select', VueSelect.VueSelect)
 	const panel = new Vue({
 		el: "#panel",
 		data() {
 			return {
 				filtro: '',
 				prioridad: [{
 						id: '0',
 						name: 'No',
 					},
 					{
 						id: '1',
 						name: 'Si',
 					},
 					{
 						id: '2',
 						name: 'En Tramite',
 					},

 				],
 				arrayAlumnos: [],
 				arrayApoderado: [],
 				arrayRol: [],
 				alumno:{
 					rut: "",
 					name: "",
 					lastname_p: "",
 					lastname_m: "",
 					email: "",
 					phone: "",
 					address: "",
 					rol_id: "1",
 					commune: "",
 					password: "",
 					course_id: "",
 					prioritary: "0",
 					representative_id: "",
 					representative_supp_id: "",
 					contact_movil: ""
 				},
 				columns: ['id', 'rut', 'name', 'lastname_p', 'lastname_m', 'email', 'contact_movil', 'rol', 'commune', 'address', 'acciones'],
 				options: {
 					headings: {
 						name: 'Nombre',
 						lastname_p: "Apellido Paterno",
 						lastname_m: "Apellido Materno",
 						email: 'Correo electronico',
 						contact_movil: 'N° de Telefono Personal',
 						commune: 'Comuna',
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
 			getRol() {
 				axios.post("/index.php/Alumnos/getRol").then((res) => {

 					this.arrayRol = res.data;
 					console.log(this.arrayRol);

 				});
 			},
 			getApoderado() {
 				axios.post("/index.php/Alumnos/getApoderado").then((res) => {

 					this.arrayApoderado = res.data;
 					console.log(this.arrayApoderado);

 				});
 			},
 			create(e) {
				 e.preventDefault();
				
				 
 				if (this.alumno.rol_id == 1) {
					 
 					alert("alummmno")
					 
 					Swal.fire({
 						title: 'Ingresando Alumno al sistema',
 						timerProgressBar: true,
 						showConfirmButton: false,
 						willOpen: async () => {
 							Swal.showLoading()

 							await axios.post("/index.php/Alumnos/createAlumnos", {
 								alumno: this.alumno
 							}).then((res) => {

 								this.getAlumnos();
 								this.getRol();
 								this.getApoderado();
 								Swal.close();

 							});

 						}
 					})
 				}
 				if (this.alumno.rol_id == 2) {
 					alert("profesor")
 					Swal.fire({
 						title: 'Ingresando Profesor al sistema',
 						timerProgressBar: true,
 						showConfirmButton: false,
 						willOpen: async () => {
 							Swal.showLoading()

 							await axios.post("/index.php/Alumnos/createProfesor", {
 								alumno: this.alumno
 							}).then((res) => {

 								this.getAlumnos();
 								this.getRol();
 								this.getApoderado();
								 this.limpiar();
 								Swal.close();

 							});

 						}
 					})
 				}
 				if (this.alumno.rol_id == 3) {
				
 					alert("apoderado")
 					Swal.fire({
 						title: 'Ingresando Apoderado al sistema',
 						timerProgressBar: true,
 						showConfirmButton: false,
 						willOpen: async () => {
 							Swal.showLoading()

							 var edit = Object.assign({}, this.alumno)
 							await axios.post("/index.php/Alumnos/createApoderado", {alumno:edit
 							}).then((res) => {
								this.getAlumnos();
 								this.getRol();
 								this.getApoderado();
 								this.limpiar();
 								Swal.close();

 							});

 						}
 					})
 				}
 				if (this.alumno.rol_id == 4) {
 					alert("gestor")
 					Swal.fire({

 						title: 'Ingresando Gesor dePlataforma al sistema',
 						timerProgressBar: true,
 						showConfirmButton: false,
 						willOpen: async () => {
 							Swal.showLoading()

 							await axios.post("/index.php/Alumnos/createGesor", {
 								alumno: this.alumno
 							}).then((res) => {

 								this.getAlumnos();
 								this.getRol();
 								this.getApoderado();
 								this.limpiar();
 								Swal.close();

 							});

 						}
 					})
 				} else {

 				}
 			},

 			updateAlumnos(row) {
 				console.log(row)
 			},

 			deleteAlumnos(row) {

 				Swal.fire({
 					title: `Estas seguro de eliminar a ${row.name} ${row.lastname_p} `,
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
 				this.alumno.rut = "";
 				this.alumno.name = "";
 				this.alumno.lastname_p = "";
 				this.alumno.lastname_m = "";
 				this.alumno.email = "";
 				this.alumno.phone = "";
 				this.alumno.address = "";
 				this.alumno.rol_id = "";
 				this.alumno.password = "";
 				this.alumno.commune = "";
 				this.alumno.course_id = "";
 				this.alumno.prioritary = "";
 				this.alumno.representative_id = "";
 				this.alumno.representative_supp_id = "";
 				this.alumno.contact_movil = "";
 			},
 			Filtro() {
 				axios.post("/index.php/Alumnos/getAlumnosByFilter", {
 					filtro: this.filtro
 				}).then((res) => {
				
 					this.arrayAlumnos = res.data;
					 if(this.arrayAlumnos== 0 ){
						 alert("no hay datos se regargara el valor por defecto")
						this.getAlumnos();
					 }
					 console.log(res.data);
 				});
 			}

 		},


 		created() {
 			this.getAlumnos();
 			this.getRol();
 			this.getApoderado();

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
