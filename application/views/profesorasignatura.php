<div class="container-fluid animatedParent animateOnce my-3" id="agregarasignatura">
	<div class="animated">
		<div class="row">

			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">

						<h5 class="card-title">Asignar Profesor al ramo</h5>
						<form>
							<div class="form-group">
								<div class="form-group">


									<div class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Profesor </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayProfe" label="rut" :reduce="profe => profe" v-model="profe"></v-select>
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

											<label>Selecciona Una Asignatura </label>
											<v-select placeholder="Seleccione una opcion" :options="arraySubject" label="name" :reduce="subject => subject" v-model="subject"></v-select>
										</div>
										<div v-if="subject" class="form-group col-md-6">
											<fieldset disabled>
												<label for="">{{subject.sige_code}} </label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{subject.description}} </textarea>
											</fieldset>
										</div>
									</div>



									<div class="mt-3 d-flex justify-content-end">
										<button @click="Guardarestudenasig($event)" class="button btn btn-success">Guardar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="Edit" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">


							<div class="form-row">
								<div class="form-group col-md-6">

									<label>Selecciona Una Asignatura </label>
									<v-select placeholder="Seleccione una opcion" :options="arraySubject" label="name" :reduce="subject => subject.id" v-model="edit.subject_id"></v-select>
								</div>
								<div v-if="subject" class="form-group col-md-6">
									<fieldset disabled>
										<label for="">{{subject.sige_code}} </label>
										<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{subject.description}} </textarea>
									</fieldset>
								</div>
							</div>


						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" @click="Guarg($event)" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<div class="form-group col-md-12">


							<v-client-table :columns="columns" v-model="arraytodo" :options="options">

								<div slot="acciones" slot-scope="{row}">
									<button data-toggle="modal" data-target="#Edit" @click="cargardatos(row)" class="btn btn-info"> Editar </button>
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
		const agregarasignatura = new Vue({
			el: "#agregarasignatura",
			data() {
				return {
					arrayProfe: [],
					arraySubject: [],
					arraytodo: [],

					profe: '',
					subject: '',
					nivel: {
						description: ''
					},
					guardar: {
						user_id: "",
						subject_id: "",
					},
					edit: {
						id: "",
						subject_id: ""
					},
					columns: ['rut', 'name', 'lastname_p', 'lastname_m', 'subjectname', "acciones"],
					options: {
						headings: {
							lastname_p: 'Apellido Paterno',
							lastname_m: 'Apellido materno',
							name: 'Nombre',
							subjectname: 'Asignatura',
							acciones: "Acciones",
						},
						filterable: ['rut', 'name', 'subjectname'],
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
					this.edit.id = row.id;
					this.edit.subject_id = row.subject_id;


				},
				getTodo() {
					axios.get("/index.php/ProfesorAsignatura/getTodo").then((res) => {
						this.arraytodo = [];
						this.arraytodo = res.data;
						console.log(this.arraytodo);

					});
				},
				getProfe() {
					axios.get("/index.php/ProfesorAsignatura/getProfe").then((res) => {
						this.arrayProfe = [];
						this.arrayProfe = res.data;
						console.log(this.arrayProfe);

					});
				},
				getSubject() {

					this.arrayNivel = [];
					axios.get("/index.php/ProfesorAsignatura/getSubject").then((res) => {
						this.arraySubject = [];
						this.arraySubject = res.data;
						console.log(this.arraySubject);

					});
				},
				Guarg(e) {
					e.preventDefault();
					if (this.edit.subject_id === "") {
						alert("No dejes los campos vacios");
					} else {
						axios.post("/index.php/ProfesorAsignatura/Editar", {
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
					}

				},


				Guardarestudenasig(e) {
					e.preventDefault();

					if (this.profe === "" || this.subject === "") {
						Swal.fire({
							icon: 'error',
							title: 'Oops... los campos estan sin datos',
							text: 'corrobora tu informacion',

						})

					} else {

						this.guardar.user_id = this.profe.id;
						this.guardar.subject_id = this.subject.id;


						axios.post("/index.php/ProfesorAsignatura/verificar2", {
							verificar2: this.guardar
						}).then((res) => {

							var dato = res.data;
							console.log(dato);

							if (dato.length == 0) {
								axios.post("/index.php/ProfesorAsignatura/createdGroup", {
									user_id: this.guardar.user_id,
									subject_id: this.guardar.subject_id
								}).then((res) => {
									this.profe = '';
									this.subject = '';
									this.getTodo();
									Swal.fire({
										position: 'top-end',
										icon: 'success',
										title: 'Datos Guardados Correctamente',
										showConfirmButton: false,
										timer: 1500
									})
								});
							} else {
								alert("repetido");

							}


						})

					}
				},
				eliminargroum(row){
					this.edit.id = row.id;
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

						axios.post("/index.php/ProfesorAsignatura/eliminargroum", {
							edit: this.edit.id
						}).then((res) => {

							this.getTodo();
						});


					}
				})


				}



			},
			created() {
				this.getProfe();
				this.getSubject();
				this.getTodo();
			},
		});
	</script>


	</body>

	</html>
