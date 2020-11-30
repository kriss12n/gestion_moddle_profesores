<div class="container-fluid animatedParent animateOnce my-3" id="notascurso">
	<div class="animated">

		<div class="row">
			<div class="col-12 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Listado de Categorias</h5>
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
										<div class="form-group col-md-3">

											<label>Selecciona Un Curso </label>
											<v-select placeholder="Seleccione una opcion" @input="getFiltroestuden()" :options="arraytNotasFiltro" label="nombrecurso" :reduce="curss => curss.idcourse" v-model="filtroCur.cursoid"></v-select>


										</div>
						
										<div  class="form-group col-md-3">

											<label>Selecciona Un Estudiante </label>
											<v-select placeholder="Seleccione una opcion" @input="getFiltroNOTAS()" :options="arraytFiltroalumn" label="rut" :reduce="curssd => curssd.student_id" v-model="filtroCur.alumnoid"></v-select>


										</div>
										<v-client-table :columns="columns" v-model="arrayFiltroNOTAS" :options="options">

											<div slot="acciones" slot-scope="{row}">
												<button data-toggle="modal" data-target="#Edit" @click="cargardatos(row)" class="btn btn-info"> Editar </button>
											</div>
										</v-client-table>


									</div>
								</div>
							</div>
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
	const notascurso = new Vue({
		el: "#notascurso",
		data() {
			return {
				arraytFiltroasignatura: [],
				arraytNotasFiltro: [],
				arraytFiltroalumn: [],
				arrayFiltroNOTAS:[],
				arrayEstuden: [],
				filtroCur: {
					cursoid: "",
					subject_id: "",
					alumnoid: ""

				},
				editnota: {
					id: "",
					student_id: "",
					nota: "",
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

			getFiltroasignatura() {

			
			

				axios.post("/index.php/Notas/getFiltroasignatura", {
					filtroasig: this.filtroCur.cursoid
				}).then((res) => {

					this.arraytFiltroasignatura = res.data;
					console.log(this.arraytFiltroasignatura);
				});
				
			},
			getFiltroestuden() {


				axios.post("/index.php/Notas/getFiltroestudenverx", {
					filtrocurso: this.filtroCur.cursoid
				}).then((res) => {
					console.log(res.data);
					this.arraytFiltroalumn = res.data;
					console.log(this.arraytFiltroalumn);
				});

			},
			getNotasFiltro() {
				this.filtroCur.cursoid ="";
				this.filtroCur.subject_id="";
				axios.get("/index.php/Notas/getNotasFiltro").then((res) => {

					this.arraytNotasFiltro = res.data;
					console.log(this.arraytNotasFiltro);
				});

			},
			getFiltroNOTAS() {


				axios.post("/index.php/Notas/getFiltroNOTASVER", {
					filtrocurso: this.filtroCur.cursoid,
					filtroestuden: this.filtroCur.alumnoid
				}).then((res) => {
					this.arrayFiltroNOTAS = res.data;
					console.log(this.arrayFiltroNOTAS);
				});

			},
			EditarNota() {
				axios.post("/index.php/Notas/EditarNota", {
					editnota: this.editnota
				}).then((res) => {

					this.getNotasFiltro();
					$("#Edit").modal("hide");
					console.log(this.arraytNotasFiltro);
				});
			}



		},
		created() {
			this.getNotasFiltro();


		},
	});
</script>


</body>

</html>
