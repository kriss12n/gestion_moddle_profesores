<div class="container-fluid animatedParent animateOnce my-3" id="group">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Grupo Profesor</h5>
						<form>
							<div class="form-row">
								<div class="form-group col-md-6">

									<label>Selecciona Un Grupo </label>
									<v-select placeholder="Seleccione una opcion" @input="" :options="arrayGroup" label="name" :reduce="grupo => grupo" v-model="grupo"></v-select>
								</div>
								<div v-if="grupo" class="form-group col-md-6">
									<fieldset disabled>
										<label for=""> </label>
										<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{grupo.description}} </textarea>
									</fieldset>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-6">

									<label>Selecciona Un Curso </label>
									<v-select placeholder="Seleccione una opcion" @input="" :options="arrayCurso" label="name" :reduce="curso => curso" v-model="curso"></v-select>
								</div>

							</div>
							<div class="form-row">
								<div class="form-group col-md-6">

									<label>Selecciona Un Profesor </label>
									<v-select placeholder="Seleccione una opcion" @input="" :options="arrayProfes" label="rut" :reduce="profe => profe" v-model="profe"></v-select>
								</div>
								<div v-if="profe" class="form-group col-md-6">
									<fieldset disabled>
										<label for=""></label>
										<input type="text" class="form-control" v-model="profe.name +' ' +profe.lastname_p+' ' +profe.lastname_m">
									</fieldset>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">

									<label>ingresa el Año </label>
									<input type="text" class="form-control" v-model="ano">
								</div>

							</div>

							<div class="mt-3 d-flex justify-content-end">
								<button @click="GuardaresDatos($event)" class="button btn btn-success">Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="Edit">Estas editando </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">

										<label>Selecciona Un Grupo </label>
										<v-select placeholder="Seleccione una opcion" @input="" :options="arrayGroup" label="name" :reduce="grupor => grupor.id" v-model="edit.group_id"></v-select>
									</div>
									<div v-if="grupo" class="form-group col-md-6">
										<fieldset disabled>
											<label for=""> </label>
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{grupo.description}} </textarea>
										</fieldset>
									</div>
								</div>


								<div class="form-row">
									<div class="form-group col-md-6">

										<label>Selecciona Un Curso </label>
										<v-select placeholder="Seleccione una opcion" @input="" :options="arrayCurso" label="name" :reduce="cursor => cursor.id" v-model="edit.base_course_id"></v-select>
									</div>

								</div>
								<div class="form-row">
									<div class="form-group col-md-6">

										<label>Selecciona Un Profesor </label>
										<v-select placeholder="Seleccione una opcion" @input="" :options="arrayProfes" label="rut" :reduce="profer => profer.id" v-model="edit.teacher_id"></v-select>
									</div>
									<div v-if="profe" class="form-group col-md-6">
										<fieldset disabled>
											<label for=""></label>
											<input type="text" class="form-control" v-model="profe.name +' ' +profe.lastname_p+' ' +profe.lastname_m">
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">

										<label>ingresa el Año </label>
										<input type="text" class="form-control" v-model="edit.year">
									</div>

								</div>



								<div class="mt-3 d-flex justify-content-end">
									<button @click="EditarGroup($event)" class="button btn btn-success">Editar Grupo</button>
								</div>
							</div>
						</form>

					</div>
					<div class="modal-footer">

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Listado de Categorias</h5>
						<v-client-table :columns="columns" v-model="arrayTodo" :options="options">


							<div slot-scope="{row}">
								<strong>{{row.description}}</strong>
							</div>
							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" data-target="#Edit" @click="cargaredit(row)" class="btn btn-info"> Editar </button>
								<button @click="eliminargroum(row)" class="btn btn-danger"> Eliminar</button>
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
	const group = new Vue({
		el: "#group",
		data() {
			return {
				columns: ['rut', 'name', 'lastname_p', 'lastname_m', 'nombregrupo', 'basename','year', 'acciones'],
				arrayGroup: [],
				arrayCurso: [],
				arrayProfes: [],
				arrayTodo: [],
				grupo: '',
				curso: '',
				profe: '',
				ano: '',

				guardar: {
					group_id: "",
					base_course_id: "",
					teacher_id: "",
					year: ""
				},

				edit: {
					id:"",
					group_id: "",
					base_course_id: "",
					teacher_id: "",
					year: ""
				},

				options: {
					headings: {
						name: 'Nombre Categoria',
						name: 'Nombre',
						lastname_p: "Apellido Paterno",
						lastname_m: "Apellido Materno",
						nombregrupo: 'Grupo',
						basename: 'Curso',
						year: "Año",
						acciones: "Acciones"
					},
					filterable: ['name'],
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
			eliminargroum(row) {
				this.edit.id = row.id;
				this.edit.group_id = row.group_id;
				this.edit.base_course_id = row.base_course_id;
				this.edit.teacher_id = row.teacher_id;
				this.edit.year = row.year;
				Swal.fire({
					title: `Estas seguro de eliminar  `,
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

						axios.post("/index.php/Plantilla/eliminargroum", {
							edit: this.edit.id
						}).then((res) => {

							this.getTodo();
						});


					}
				})


			},
			EditarGroup(e) {
				e.preventDefault();

				if (this.edit.group_id === "" || this.edit.base_course_id === "" || this.edit.teacher_id === "" || this.edit.year === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {

				

						if (this.edit.group_id && this.edit.base_course_id && this.edit.teacher_id && this.edit.year) {
						

							
										axios.post("/index.php/Plantilla/verificar3", {
											verificar3: this.edit
										}).then((res) => {
											var dato3 = res.data;
											if (dato3.length == 0) {

												axios.post("/index.php/Plantilla/EditarGroup", {
													edit: this.edit
												}).then((res) => {
								
													this.getTodo();
													Swal.fire({
														position: 'top-end',
														icon: 'success',
														title: 'Cambios Guardados Correctamente',
														showConfirmButton: false,
														timer: 1500
													});
													$("#Edit").modal("toggle");

												});

											} else {
												alert("El curso ya esta asociado a un Profesor");
											}

										})

						} else {
							alert("Error faltan datos ");
						}

				

				}

			},
			cargaredit(row) {
				this.edit.id = row.id;
				this.edit.group_id = row.group_id;
				this.edit.base_course_id = row.base_course_id;
				this.edit.teacher_id = row.teacher_id;
				this.edit.year = row.year;

			},
			limpiar() {
				this.group = [];
			},
			GuardaresDatos(e) {
				e.preventDefault();
				this.guardar.group_id = this.grupo.id
				this.guardar.base_course_id = this.curso.id
				this.guardar.teacher_id = this.profe.id
				this.guardar.year = this.ano

				if (this.grupo === "" || this.curso === "" || this.profe === "" || this.ano === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {

					axios.post("/index.php/Plantilla/verificar", {
						verificar: this.guardar
					}).then((res) => {

						var dato = res.data;

						if (this.guardar.group_id && this.guardar.base_course_id && this.guardar.teacher_id && this.guardar.year) {
							if (dato.length == 0) {

								axios.post("/index.php/Plantilla/verificar2", {
									verificar2: this.guardar
								}).then((res) => {
									var dato2 = res.data;

									if (dato2.length == 0) {
										axios.post("/index.php/Plantilla/verificar3", {
											verificar3: this.guardar
										}).then((res) => {
											var dato3 = res.data;
											if (dato3.length == 0) {
												axios.post("/index.php/Plantilla/GuardaresDatos", {
													nivel: this.guardar
												}).then((res) => {
													this.getTodo();
													this.grupo = '';
													this.curso = '';
													this.profe = '';
													this.ano = '';
													Swal.fire({
														position: 'top-end',
														icon: 'success',
														title: 'Datos Guardados Correctamente',
														showConfirmButton: false,
														timer: 1500
													})

												})

											} else {
												alert("El curso ya esta asociado a un Profesor");
											}

										})

									} else {
										alert("El profesor ya esta asociado a un curso");
									}
								})


							} else {
								alert("ya esta Ingresado esa informacion");

							}
						} else {
							alert("Error faltan datos ");
						}

					})

				}
			},
			getGroup() {
				axios.get("/index.php/Group/getGroup").then((res) => {

					this.arrayGroup = res.data;
					console.log(this.arrayGroup);
				})
			},
			getCurso() {
				axios.get("/index.php/Alumnos/getCurso").then((res) => {

					this.arrayCurso = res.data;
					console.log(this.arrayCurso);
				});

			},
			getProfe() {

				axios.get("/index.php/Notas/getProfe").then((res) => {

					this.arrayProfes = res.data;
					console.log(this.arrayProfes);
				});

			},
			getTodo() {

				axios.get("/index.php/Plantilla/getTodo").then((res) => {

					this.arrayTodo = res.data;
					console.log(this.arrayTodo);
				});

			},


		},
		created() {
			this.getProfe();
			this.getGroup();
			this.getCurso();
			this.getTodo();

		},
	});
</script>


</body>

</html>
