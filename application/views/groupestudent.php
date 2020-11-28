<div class="container-fluid animatedParent animateOnce my-3" id="group">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Nuevo Estudiante al Grupo </h5>
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

											<label>Selecciona Una Grupo </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayGroup" label="name" :reduce="d => d" v-model="grou"></v-select>
										</div>
										<div v-if="grou" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""></label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{grou.description}} </textarea>
											</fieldset>
										</div>
									</div>


									<div class="mt-3 d-flex justify-content-end">
										<button @click="createdGroup($event)" class="button btn btn-success">Guardar Grupo</button>
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
						<h5 class="card-title">Listado de Alumnos y Su Grupo</h5>
						<v-client-table :columns="columns" v-model="Groupestudent" :options="options">


							<div slot="acciones" slot-scope="{row}">
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
				arrayAlumnos: [],
				alumno: '',
				columns: ['rut','name', 'lastname_p','lastname_m','nombregrupo', 'acciones'],
				arrayGroup: [],
				Groupestudent:[],
				grou: '',

				edit: {
					id: "",
					name: "",
					lastname_p: "",
					lastname_m: "",
					nombregrupo:""

				},
				options: {
					headings: {
						name: 'Nombre Categoria',
						acciones: "Acciones"
					},
					filterable: ['rut'],
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
				this.edit.name = row.name
				this.edit.lastname_p = row.lastname_p;
				this.edit.lastname_m = row.lastname_m;
				this.edit.nombregrupo = row.nombregrupo;
				Swal.fire({
					title: `Estas seguro de eliminar a ${this.edit.name}  ${this.edit.lastname_p}  ${this.edit.lastname_m}  del Grupo ${this.edit.nombregrupo} `,
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
						axios.post("/index.php/GroupEstudent/eliminargroum", {
							edit: this.edit.id
						}).then((res) => {

							this.limpiar();
							this.getGroupestudent();
						});


					}
				})


			},


			limpiar() {
				this.grou = '';
				this.alumno = '';
			},
			createdGroup(e) {
				e.preventDefault();

				if (this.alumno === "" || this.grou === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {


					axios.post("/index.php/GroupEstudent/verificar", {
						verificar: this.alumno.id, verificar2:this.grou.id
					}).then((res) => {

						var dato = res.data;

					
							if (dato.length == 0) {
								axios.post("/index.php/GroupEstudent/createdGroup", {
									alumno: this.alumno.id,
									group: this.grou.id
								}).then((res) => {
									this.limpiar();
									this.getGroupestudent();
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
			getAlumnos() {
				axios.get("/index.php/AgregarAsignaura/getAlumnos").then((res) => {
					this.arrayAlumnos = [];
					this.arrayAlumnos = res.data;
					console.log(this.arrayAlumnos);

				});
			},
			getGroup() {
				axios.get("/index.php/Group/getGroup").then((res) => {

					this.arrayGroup = res.data;
					console.log(this.arrayGroup);
				})
			},
			getGroupestudent() {
				axios.get("/index.php/GroupEstudent/getGroupestudent").then((res) => {

					this.Groupestudent = res.data;
					console.log(this.Groupestudent);
				})
			}


		},
		created() {
			this.getAlumnos();
			this.getGroup();
			this.getGroupestudent();

		},
	});
</script>


</body>

</html>
