

<div class="container-fluid animatedParent animateOnce my-3" id="curso">
	<div class="animated">
	
	<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Nuevo Cursos </h5>
						<form>
							<div class="form-group">
								<div class="form-group">
									<label>Nombre Cursos</label>
									<input v-model="cursos.fullname" type="text" class="form-control">
									<label>Abreviación Curso </label>
									<input v-model="cursos.shortname" type="text"  class="form-control"> </input>
									<label>Descripcion Curso </label>
									<textarea v-model="cursos.summary" type="text" style="min-height: 100px" class="form-control"> </textarea>
									<label >Curso Visible</label>
									<v-select placeholder="Seleccione una opcion" @input="" :options="visible" label="name" :reduce="categoria => categoria.id" v-model="cursos.visible" ></v-select>
									<label>Categoria</label>
									<v-select placeholder="Seleccione cursos" @input="" :options="arrayCategorias" label="name" :reduce="categoria => categoria.id" v-model="cursos.categoryid" ></v-select>
									<div class="mt-3 d-flex justify-content-end">
										<button @click="createdCursos" class="button btn btn-success">Guardar Categoria</button>
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
					<p>Filtro de Cursos por area:</p>
                        <v-select placeholder="Seleccione como filtrar  los cursos" @input="getByFiltro" :options="arrayCategorias" label="name" :reduce="categoria => categoria.id" v-model="filtro" ></v-select>
						<h5 class="card-title">Listado de Cursos</h5>
						<v-client-table :columns="columns" v-model="arrayCursos" :options="options">
						
							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" v-on:click="updateCursos(row)" class="btn btn-info"> Editar </button>
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
		Vue.component('v-select', VueSelect.VueSelect)

    const curso = new Vue({
        el:"#curso",
        data() {
            return {
				cursos:{
					fullname:"",
					shortname:"",
					summary:"",
					categoryid  :"",
					visible:"1",
				},
				visible:[
					{id: '1', name: 'visible', },
                    {id: '0', name: 'no visible',},	
	 			],
				arrayCursos:[],
				arrayCategorias:[],
				filtro:"",
				columns: ['displayname', 'summary','shortname','summaryformat','format',"acciones"],
				options: {
				headings: {
					displayname: 'Nombre Curso',
					summary: 'Descripcion Curso',
					acciones:"Acciones",
				},
				filterable: ['fullname' ],
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
			createdCursos(){
				if (this.cursos.fullname === ""|| this.cursos.shortname === "" || this.cursos.categoryid === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... prese que los campos estan sin datos',
						text: 'corrobora tu informacion',

					})

				} else {


					axios.post("/index.php/Cursos/created_courses",{cursos:this.cursos}).then((res) => {

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
			
			getCurso(){

				
			axios.post("/index.php/Cursos/getcourses").then((res)=>{
				
				this.arrayCursos =  res.data;
				console.log(this.arrayCursos);
	
			});

		 
		},
		 getCategoria(){
			 axios.get("/index.php/Categoria/get_Categori").then((res)=>{
				this.arrayCategorias = res.data;
				console.log(this.arrayCategorias);
			 });
		 },
		 getByFiltro(){
			 axios.post("/index.php/Cursos/getcoursesByFilter",{filtro:this.filtro}).then((res)=>{

				this.arrayCursos = res.data.courses;
				console.log(this.arrayCursos);
		 });
		}
		},
        created() {
        this.getCurso();
		this.getCategoria();
        },
    });
</script>
