

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
									<label>Nombre Curso</label>
									<input v-model="cursos.name" placeholder="ejemplo 1-B" type="text" class="form-control">
									<label>Abreviación Curso </label>
									<textarea v-model="cursos.description" type="text" style="min-height: 100px" class="form-control"> </textarea>
									<div class="mt-3 d-flex justify-content-end">
										<button @click="createdCursos($event)" class="button btn btn-success">Guardar Curso</button>
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
                        <!-- <v-select placeholder="Seleccione como filtrar  los cursos" @input="getByFiltro" :options="arrayCategorias" label="name" :reduce="categoria => categoria.id" v-model="filtro" ></v-select> -->
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
					id:"",
					name:"",
					description: "",
				},
				arrayCursos:[],
				arrayCategorias:[],
				filtro:"",
				columns: ['name', 'description',"acciones"],
				options: {
				headings: {
					name: 'Nombre Curso',
					description:  'Descripcion Curso',
					acciones: "Acciones",
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
			createdCursos(e){
                e.preventDefault();
				if (this.cursos.fullname === ""|| this.cursos.shortname === "" || this.cursos.categoryid === "") {
					Swal.fire({
						icon: 'error',
						title: 'Oops... todos los campos son obligatorios',
						text: 'corrobora tu informacion',
					})
				} else {
					axios.post("/panel/index.php/Cursos/created_courses",{cursos:this.cursos}).then((res) => {

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Datos Guardados Correctamente',
							showConfirmButton: false,
							timer: 1500
							});
							this.limpiar();
					});
				}

			},
			
			getCurso(){

			axios.get("/panel/index.php/Cursos/getcourses").then((res)=>{
				
				this.arrayCursos =  res.data;
				console.log(this.arrayCursos);
	
			});

		 
		},
		 getByFiltro(){
			 axios.post("/index.php/Cursos/getcoursesByFilter",{filtro:this.filtro}).then((res)=>{

				this.arrayCursos = res.data.courses;
				console.log(this.arrayCursos);
		 });
		},
		limpiar() {
	
			this.cursos.name = "";
			this.cursos.description= "";
		}
		},
        created() {
        this.getCurso();
        },
    });
</script>
