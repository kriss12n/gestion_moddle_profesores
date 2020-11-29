<div class="container-fluid animatedParent animateOnce my-3" id="group">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Nuevo Grupo </h5>
						<form>
							<div class="form-group">
								<div class="form-group">
									<label>Nombre Grupo</label>
									<input v-model="group.name" type="text" class="form-control">
									<label>Descripcion Grupo </label>
									<textarea v-model="group.description" type="text" style="min-height: 100px" class="form-control"> </textarea>


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
								<label>Nombre Grupo</label>
								<input v-model="edit.name" type="text" class="form-control">
								<label>Descripcion Grupo </label>
								<textarea v-model="edit.description" type="text" style="min-height: 100px" class="form-control"> </textarea>

							</div>

							<div class="mt-3 d-flex justify-content-end">
								<button @click="EditarGroup($event)" class="button btn btn-success">Editar Grupo</button>
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
						<v-client-table :columns="columns" v-model="arrayGroup" :options="options">


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
	const group = new Vue({
		el: "#group",
		data() {
			return {
				columns: ['id', 'name', 'description', 'acciones'],
				arrayGroup: [],
				group: {
					name: "",
					description: ""
				},
				edit: {
					id: "",
					name: "",
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
			eliminargroum(row) {
				this.edit.id = row.id
				this.edit.name = row.name
				Swal.fire({
					title: `Estas seguro de eliminar a ${this.edit.name}  `,
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

						axios.post("/index.php/Group/eliminargroum", {
							edit: this.edit.id
						}).then((res) => {

							this.limpiar();
							this.getGroup();
						});


					}
				})


			},
			EditarGroup(e) {
				e.preventDefault();
				axios.post("/index.php/Group/EditarGroup", {
					edit: this.edit
				}).then((res) => {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Cambios Guardados Correctamente',
						showConfirmButton: false,
						timer: 1500
					});
					$("#Edit").modal("toggle");
					this.limpiar();
					this.getGroup();
				});
			},
			cargaredit(row) {

                 this.edit.id  =  row.id
				 this.edit.name = row.name
				 this.edit.description 	= row.description
			},
			limpiar() {
				this.group = [];
			},
			createdGroup(e) {
				e.preventDefault();

				if (this.group.name === "" || this.group.description === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {
					axios.post("/index.php/Group/createdGroup", {
						categoria: this.group
					}).then((res) => {
						this.limpiar();
						this.getGroup();
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
			getGroup() {
				axios.get("/index.php/Group/getGroup").then((res) => {

					this.arrayGroup = res.data;
					console.log(this.arrayGroup);
				})
			}


		},
		created() {
			this.getGroup();

		},
	});
</script>


</body>

</html>
