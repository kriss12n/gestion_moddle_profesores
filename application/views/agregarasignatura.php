<div class="container-fluid animatedParent animateOnce my-3" id="agregarasignatura">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Ramo </h5>
						<form>
							<div class="form-group">
								<div class="form-group">


									<div class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Estudiante </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayAlumnos" label="rut" :reduce="alumno => alumno" v-model="alumno"></v-select>
										</div>
										<div v-if="alumno" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""></label>
												<input type="text" class="form-control" v-model="alumno.name +' ' +alumno.lastname_p+' ' +alumno.lastname_m">
											</fieldset>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Una Asignatura </label>
											<v-select placeholder="Seleccione una opcion" @input="getNivel()" :options="arraySubject" label="name" :reduce="subject => subject" v-model="subject"></v-select>
										</div>
										<div v-if="subject" class="form-group col-md-6">
											<fieldset disabled>
												<label for="">{{subject.sige_code}} </label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{subject.description}} </textarea>
											</fieldset>
										</div>
									</div>
									<div v-if="subject" class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Nivel </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayNivel" label="name" :reduce="nivel => nivel" v-model="nivel"></v-select>
										</div>
										<div v-if="subject && nivel" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""> </label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{nivel.description}} </textarea>
											</fieldset>
										</div>

									</div>


									<div class="mt-3 d-flex justify-content-end">
										<button @click="Guardarestudenasig($event)" class="button btn btn-success">Guardar Categoria</button>
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
						<div class="form-group col-md-12">


							<v-client-table :columns="columns" v-model="arrayRamos" :options="options">

								<div slot="acciones" slot-scope="{row}">
								<button class="btn btn-danger" v-on:click="eliminar(row)"> Eliminar</button>
								</div>
							</v-client-table>


						</div>
					</div>
				</div>
			</div>

		</div>
	</div>




	<script>
		Vue.use(VueTables.ClientTable);
		Vue.component('v-select', VueSelect.VueSelect)
		const agregarasignatura = new Vue({
			el: "#agregarasignatura",
			data() {
				return {
					arrayAlumnos: [],
					arraySubject: [],
					arrayNivel: [],
					arrayRamos:[],
					alumno: '',
					subject: '',
					nivel: {
					
						description: ''
					},
					guardar: {
						base_course_id: "",
						subject_id: "",
						student_id: "",
						level_id: "null"

					},
					columns: ['rut', 'nombre', 'apellidoP', 'apellidoM', 'basename', 'asig', 'namelevel', "acciones"],
				options: {
					headings: {
						apellidoP: 'Apellido Paterno',
						apellidoM: 'Apellido materno',
						basename: 'Curso Base',
						asig: 'Asignatura',
						namelevel: 'Estado Actual',
						acciones: "Acciones",
					},
					filterable: ['id', 'rut', 'nombre', 'apellidoP'],
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
				getRamos() {

					axios.get("/index.php/AgregarAsignaura/getRamos").then((res) => {

						this.arrayRamos = res.data;
						console.log(this.arrayRamos);
					});

				},
				getAlumnos() {
					axios.get("/index.php/AgregarAsignaura/getAlumnos").then((res) => {
						this.arrayAlumnos = [];
						this.arrayAlumnos = res.data;
						console.log(this.arrayAlumnos);

					});
				},
				getSubject() {

					this.arrayNivel = [];
					axios.get("/index.php/AgregarAsignaura/getSubject").then((res) => {
						this.arraySubject = [];
						this.arraySubject = res.data;
						console.log(this.arraySubject);

					});
				},
				getNivel() {

					axios.post("/index.php/AgregarAsignaura/getNivel", {
						nivel: this.subject
					}).then((res) => {

						this.arrayNivel = res.data;
						console.log(this.arrayNivel);

					})
				},

				Guardarestudenasig(e) {
					e.preventDefault();

					if(this.nivel){
						this.guardar.base_course_id = this.alumno.idcor,
						this.guardar.subject_id = this.subject.id,
						this.guardar.student_id = this.alumno.id,
							this.guardar.level_id = this.nivel.id
					}else{
						this.guardar.base_course_id = this.alumno.idcor,
						this.guardar.subject_id = this.subject.id,
						this.guardar.student_id = this.alumno.id
					
					}
				

					axios.post("/index.php/AgregarAsignaura/verificar", {
						verificar: this.guardar
					}).then((res) => {

						var dato = res.data;

						if (this.guardar.base_course_id && this.guardar.subject_id && this.guardar.student_id) {
							if (dato.length == 0) {
								axios.post("/index.php/AgregarAsignaura/Guardarestudenasig", {
									nivel: this.guardar
								}).then((res) => {
									this.getRamos();
									Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Datos Guardados Correctamente',
							showConfirmButton: false,
							timer: 1500
							});
								})
							} else {
								alert("repetido");

							}
						} else {
							alert("Error faltan datos ");
						}

					})

				},
				eliminar(row){
					
					
				Swal.fire({
					title: `Estas seguro de eliminar  ${row.nombre}  ${row.apellidoP} ${row.apellidoM} de la asignatura ${row.asig} `,
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
						axios.post("/index.php/AgregarAsignaura/eliminar", {
							id: row.id
						}).then((res) => {

							this.getRamos();
						});


					}
				})
				}

			},
			
			
			created() {
               this.getRamos();
				this.getAlumnos();
				this.getSubject();


			},
		});
	</script>


	</body>

	</html>
