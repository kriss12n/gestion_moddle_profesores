<div class="container-fluid animatedParent animateOnce my-3" id="categoria">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Nueva Asignatura </h5>
						<form>
							<div class="form-group">
								<div class="form-group">
									<label>Nombre de Asignatura</label>
									<input v-model="categoria.name" type="text" class="form-control">
									<label>Codigo SIGE de Asignatura</label>
									<input v-model="categoria.sige" type="text" class="form-control">
									<label>Descripcion Asignatura </label>
									<textarea v-model="categoria.description" type="text" style="min-height: 100px" class="form-control"> </textarea>


									<div class="mt-3 d-flex justify-content-end">
										<button @click="createdCategori()" class="button btn btn-success">Guardar Asignatura</button>
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
						<h5 class="modal-title" id="Edit">Estas editando </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>

							<div class="form-group">
								<label>Nombre de Asignatura</label>
								<input v-model="edit.name" type="text" class="form-control">
								<label>Codigo SIGE de Asignatura</label>
								<input v-model="edit.sige" type="text" class="form-control">
								<label>Descripcion Asignatura </label>
								<textarea v-model="edit.description" type="text" style="min-height: 100px" class="form-control"> </textarea>


								<div class="mt-3 d-flex justify-content-end">
									<button @click="editar($event)" class="button btn btn-success">Editar Asignatura</button>
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
						<v-client-table :columns="columns" v-model="arrayCategori" :options="options">


							<div slot-scope="{row}">
								<strong>{{row.description}}</strong>
							</div>
							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" v-on:click="updateCategori(row)" data-target="#Edit" class="btn btn-info"> Editar </button>
								<button class="btn btn-danger" v-on:click="deleteSubject(row)"> Eliminar</button>
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
	const categoria = new Vue({
		el: "#categoria",
		data() {
			return {
				columns: ['id', 'name', 'sige_code', 'description', 'acciones'],
				arrayCategori: [],
				categoria: {
					name: "",
					sige: "",
					description: ""
				},
				edit: {
					name: "",
					sige: "",
					description: ""
				},
				options: {
					headings: {
						name: 'Nombre Categoria',
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
			getSubject() {
				axios.post("/index.php/Categoria/getSubject").then((res) => {
					this.arrayCategori = res.data;
				});
			},

			createdCategori() {
				
				if (this.categoria.name === "" || this.categoria.description === "" || this.categoria.sige === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... prese que los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {
					axios.post("/index.php/Categoria/created_Categori", {
						categoria: this.categoria
					}).then((res) => {

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Datos Guardados Correctamente',
							showConfirmButton: false,
							timer: 1500
						})
					});
				}
			},
			updateCategori(row) {
				this.edit.id = row.id
				this.edit.name = row.name,
					this.edit.description = row.description,
					this.edit.sige = row.sige_code


			},
			editar(e) {
				e.preventDefault();

				if (this.edit.name === "" || this.edit.description === "" || this.edit.sige === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... prese que los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {
					axios.post("/index.php/Categoria/editar", {
						categoria: this.edit
					}).then((res) => {
						this.getSubject();
						$("#Edit").modal("toggle");
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Datos Guardados Correctamente',
							showConfirmButton: false,
							timer: 1500
						})

					});
				}
			},
			deleteSubject(row) {

				this.edit.id = row.id;
				this.edit.name = row.name
	
				Swal.fire({
					title: `Estas seguro de eliminar  ${this.edit.name} `,
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
						axios.post("/index.php/Categoria/deleteSubject", {
							id: this.edit.id
						}).then((res) => {

							this.getSubject();
						});


					}
				})

			}


		},
		created() {
			this.getSubject();

		},
	});
</script>


</body>

</html>
