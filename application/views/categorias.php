<div class="container-fluid animatedParent animateOnce my-3" id="categoria">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Nueva Categoria </h5>
						<form>
							<div class="form-group">
								<div class="form-group">
									<label>Nombre Categoria</label>
									<input v-model="categoria.name" type="text" class="form-control">
									<label>Descripcion Categoria </label>
									<textarea v-model="categoria.description" type="text" style="min-height: 100px" class="form-control"> </textarea>


									<div class="mt-3 d-flex justify-content-end">
										<button @click="createdCategori" class="button btn btn-success">Guardar Categoria</button>
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
						<h5 class="card-title">Listado de Categorias</h5>
						<v-client-table :columns="columns" v-model="arrayCategori" :options="options">


							<div slot-scope="{row}">
								<strong>{{row.description}}</strong>
							</div>
							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" v-on:click="updateCategori(row)" class="btn btn-info"> Editar </button>
								<button class="btn btn-danger"> Eliminar</button>
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
				columns: ['id','name', 'description','acciones'],
				arrayCategori: [],
				categoria: {
					name: "",
					description: ""
				},
				options: {
					headings: {
						name: 'Nombre Categoria',
						acciones:"Acciones"
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
			getCategori() {
				axios.post("/index.php/Categoria/get_Categori").then((res) => {
					this.arrayCategori = res.data;
				});
			},

			createdCategori() {
				if (this.categoria.name === "" || this.categoria.description === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... prese que los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {
					axios.post("/index.php/Categoria/created_Categori",{categoria:this.categoria}).then((res) => {

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


		},
		created() {
			this.getCategori();

		},
	});
</script>
<script>
	$(function() {
		$(".button").click(function() {
			// validate and process form here
		});
	});
</script>

</body>

</html>
