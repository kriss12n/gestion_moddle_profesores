<div class="container-fluid animatedParent animateOnce my-3" id="notas">
	<div class="animated">

		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Notas a Estudiantes</h5>
						<form>
							<div class="form-group">
								<div class=" form-group">


									<div class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Profesor</label>
											<v-select @input="getSubject()" placeholder="Seleccione cursos" :options="arrayProfes" label="rut" :reduce="profe => profe" v-model="profe"></v-select>
										</div>
										<div v-if="profe" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""></label>
												<input type="text" class="form-control" v-model="profe.name +' ' +profe.lastname_p+' ' +profe.lastname_m">
											</fieldset>
										</div>
									</div>

									<div class="form-row">
										<div v-if="arraySubject && profe " class="form-group col-md-6">

											<label v-if="arraySubject.length >= 1">Selecciona Una Asignatura </label>
											<v-select v-if="arraySubject.length >= 1" placeholder="Seleccione cursos" @input="getCurso()" :options="arraySubject" label="Asig" :reduce="asignatura => asignatura" v-model="asignatura"></v-select>
										</div>

									</div>
									<div v-if="asignatura" class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Curso </label>
											<v-select placeholder="Seleccione una opcion" @input="getEstuden()" :options="arrayCurso" label="name" :reduce="Cursoid => Cursoid.base_course_id" v-model="Cursoid"></v-select>
										</div>

									</div>

									<div v-if="Cursoid && asignatura " class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Estudiante </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayEstuden" label="rut" :reduce="alumno => alumno" v-model="alumno"></v-select>
										</div>
										<div v-if="alumno" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""></label>
												<input type="text" class="form-control" v-model="alumno.namex +' ' +alumno.lastname_p+' ' +alumno.lastname_m">
											</fieldset>
										</div>
									</div>
									<div v-if="arraySubject.length >= 1" class="form-row">
										<div v-if="arraySubject && profe " class="form-group col-md-6">
											<label>Ingresa la calificacion del Estudiante </label>
											<input class="form-control" type="text" v-model="guardarN.nota">
										</div>
										<div v-if="arraySubject && profe " class="form-group col-md-6">
											<label>Ingresa la fecha </label>
											<input type="date" class="date-time-picker form-control" v-model="guardarN.fecha">
										</div>


									</div>


									<div class="mt-3 d-flex justify-content-end">
										<button @click="GuardarNota" class="button btn btn-success">Guardar Nota</button>
									</div>
								</div>
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
						<h5 class="modal-title" id="exampleModalLabel">Estas editando a </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>

							<div class="form-row">
								<div class="form-group col-md-6">

									<label>Selecciona Un Estudiante </label>
									<v-select placeholder="Seleccione una opcion" @input="" :options="arrayEstuden" label="rut" :reduce="editnota => editnota.id" v-model="editnota.student_id"></v-select>
								</div>

							</div>

							<div class="form-row">
								<div v-if="editnota" class="form-group col-md-6">
									<label>Ingresa la calificacion del Estudiante </label>
									<input class="form-control" type="text" v-model="editnota.nota">
								</div>
							</div>


							<div class="mt-3 d-flex justify-content-end">
								<button @click="EditarNota" class="button btn btn-success">Editar Nota</button>
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
						<p>Filtro de Cursos por area:</p>

						<h5 class="card-title">Listado de Cursos</h5>

						<v-client-table :columns="columns" v-model="arrayNotas" :options="options">

							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" data-target="#Edit" @click="cargardatos(row)" class="btn btn-info"> Editar </button>
							</div>
						</v-client-table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<p>Filtro de Notas</p>

						<h5 class="card-title">Listado de Notas</h5>

						<div class="form-row">
							<div class="form-group col-md-3">

								<label>Selecciona Un Curso </label>
								<v-select placeholder="Seleccione una opcion" @input="getFiltroasignatura()" :options="arraytNotasFiltro" label="nombrecurso" :reduce="curss => curss.idcourse" v-model="filtroCur.cursoid"></v-select>


							</div>
							<div v-if="filtroCur.cursoid" class="form-group col-md-3">

								<label>Selecciona Una Asignatura </label>
								<v-select placeholder="Seleccione una opcion" @input="getFiltroestuden()" :options="arraytFiltroasignatura" label="asigt" :reduce="asigx => asigx.subject_id" v-model="filtroCur.subject_id"></v-select>


							</div>
							<div v-if="filtroCur.subject_id" class="form-group col-md-3">

								<label>Selecciona Un Estudiante </label>
								<v-select placeholder="Seleccione una opcion" @input="getFiltroNOTAS()" :options="arraytFiltroalumn" label="rut" :reduce="curss => curss.student_id" v-model="filtroCur.alumnoid"></v-select>


							</div>


						</div>
						<h1>holaaaaaaaaaaaaaa</h1>
						<div v-for="value in arrayFiltroNOTAS">

							<h1>{{value.rut}}</h1>
							<h1>{{value.asig}}</h1>
							<h1>{{value.calification}}</h1>
							<table class="table table-striped">
								<thead>
									<tr>
										<th>{{value.asig}}</th>
										<th>Lastname</th>
										<th>Email</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>John</td>
										<td>Doe</td>
										<td>{{value.calification}}</td>
									</tr>
									
								</tbody>
							</table>

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

	const notas = new Vue({
		el: "#notas",
		data() {
			return {
				alumno: '',
				Cursoid: "1",
				profe: '',
				asignatura: '',
				arraytNotasFiltro: [],
				arraytFiltroasignatura: [],
				arrayFiltroNOTAS: [],
				arraytFiltroalumn: [],
				filtroCur: {
					cursoid: "",
					subject_id: "",
					alumnoid: ""

				},
				arrayEstuden: [],
				arrayProfes: [],
				arraySubject: '',
				arrayNotas: [],
				arrayCurso: [],
				editnota: {
					id: "",
					student_id: "",
					nota: "",
				},
				guardarN: {
					student_id: "",
					teacher_id: "",
					subject_id: "",
					nota: "",
					fecha: "",
					cursoid: ""
				},
				columns: ['id', 'rut', 'nombre', 'apellidoP', 'apellidoM', 'calification', 'asig', 'craeted_at', "acciones"],
				options: {
					headings: {
						apellidoP: 'Apellido Paterno',
						apellidoM: 'Apellido materno',
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
			cargardatos(row) {

				this.editnota.id = row.id,
					this.editnota.student_id = row.student_id,
					this.editnota.nota = row.calification
				console.log(this.editnota)
			},

			getNotas() {

				axios.get("/index.php/Notas/getNotas").then((res) => {

					this.arrayNotas = res.data;
					console.log(this.arrayNotas);
				});

			},
			getNotasFiltro() {

				axios.get("/index.php/Notas/getNotasFiltro").then((res) => {

					this.arraytNotasFiltro = res.data;
					console.log(this.arraytNotasFiltro);
				});

			},
			getFiltroasignatura() {


				axios.post("/index.php/Notas/getFiltroasignatura", {
					filtroasig: this.filtroCur.cursoid
				}).then((res) => {

					this.arraytFiltroasignatura = res.data;
					console.log(this.arraytFiltroasignatura);
				});

			},
			getFiltroestuden() {


				axios.post("/index.php/Notas/getFiltroestuden", {
					filtroasig: this.filtroCur.subject_id,
					filtrocurso: this.filtroCur.cursoid
				}).then((res) => {
					console.log(res.data);
					this.arraytFiltroalumn = res.data;
					console.log(this.arraytFiltroalumn);
				});

			},
			getFiltroNOTAS() {


				axios.post("/index.php/Notas/getFiltroNOTAS", {
					filtroasig: this.filtroCur.subject_id,
					filtrocurso: this.filtroCur.cursoid,
					filtroestuden: this.filtroCur.alumnoid
				}).then((res) => {
					console.log(res.data);
					this.arrayFiltroNOTAS = res.data;
					console.log(this.arrayFiltroNOTAS);
				});

			},


			getCurso() {
				this.Cursoid = "";
				this.arrayCurso = [];
				axios.post("/index.php/Notas/getCurso", {
					curso: this.asignatura.subject_id
				}).then((res) => {

					this.arrayCurso = res.data;
					console.log(this.arrayCurso);
				});

			},

			getEstuden() {

				this.arrayEstuden = [];

				axios.post("/index.php/Notas/getEstuden", {
					id: this.Cursoid,
					idasig: this.asignatura.subject_id
				}).then((res) => {

					this.arrayEstuden = res.data;
					console.log(this.arrayEstuden);
				});

			},


			getProfe() {

				axios.get("/index.php/Notas/getProfe").then((res) => {

					this.arrayProfes = res.data;
					console.log(this.arrayProfes);
				});

			},
			getSubject() {
				axios.post("/index.php/Notas/getSubject", {
					id: this.profe.id
				}).then((res) => {
					this.arraySubject = '';
					this.asignatura = '';
					this.arraySubject = res.data;
					console.log(this.arraySubject);
				});
			},
			GuardarNota() {

				if (this.alumno.id && this.profe.id && this.asignatura.subject_id && this.Cursoid && this.guardarN.nota) {

					Swal.fire({
						title: 'Guardando Nota',
						timerProgressBar: true,
						showConfirmButton: false,
						willOpen: async () => {
							Swal.showLoading()

							this.guardarN.student_id = this.alumno.id,
								this.guardarN.teacher_id = this.profe.id,
								this.guardarN.subject_id = this.asignatura.subject_id,
								this.guardarN.cursoid = this.Cursoid,


								await axios.post("/index.php/Notas/GuardarNota", {
									notas: this.guardarN
								}).then((res) => {
									Swal.close();


								});

						}
					})

				} else {
					alert("faltan datos")

				}





			},
			EditarNota() {

			}


		},
		created() {
			this.getNotas();
			this.getProfe();
			this.getNotasFiltro();

		},
	});
</script>
