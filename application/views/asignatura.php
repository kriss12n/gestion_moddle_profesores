

<div class="container-fluid animatedParent animateOnce my-3" id="asignatura">
	<div class="animated">
	
	<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Nuevo Cursos </h5>
						<form>
							<div class="form-group">
								<div class="form-group">
									<label>Nombre Asignatura</label>
									<input v-model="asignatura.name" placeholder="ej: Historia" type="text" class="form-control">
									<label>Codigo SIGE</label>
									<input v-model="asignatura.sige"  type="text" class="form-control">
									<label>Descripcion de la Asignatura </label>
									<textarea v-model="asignatura.description" type="text" style="min-height: 100px" class="form-control"> </textarea>
									<div class="mt-3 d-flex justify-content-end">
										<button @click="createdAsignaturas($event)" class="button btn btn-success">Guardar Asignatura</button>
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
						<v-client-table :columns="columns" v-model="arrayAsignaturas" :options="options">
						
							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" data-toggle="modal" data-target="#editar" v-on:click="cargarDatos(row)" class="btn btn-info"> Editar </button>
								<button data-toggle="modal" v-on:click="getLevelBySubject(row)" class="btn btn-warning"> Niveles </button>
								<button v-on:click="deleteCursos(row)" class="btn btn-danger"> Eliminar</button>
							</div>
						</v-client-table>
					</div>
				</div>
			</div>
		</div>
				<!-- Modal Editar -->
				<div class="modal fade" data-backdrop="static" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editando Curso</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<form>
							<div class="form-group">
								<div class="form-group">
									<label>Nombre Asignatura</label>
									<input v-model="asignatura.name" placeholder="ejemplo 1-B" type="text" class="form-control">
									<label>Codigo SIGE</label>
									<input v-model="asignatura.sige" type="text" class="form-control">
									<label>Descripcion de la Asignatura </label>
									<textarea v-model="asignatura.description" type="text" style="min-height: 100px" class="form-control"> </textarea>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" v-on:click="limpiar" data-dismiss="modal">Cancelar</button>
						
						<button type="button" class="btn btn-success" @click="updateAsignatura($event)" >Guardar cambios</button>
					</div>
					</div>
				</div>
				</div>

				<!-- Modal Level -->
				<div class="modal fade" data-backdrop="static" id="level" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Niveles de la asignatura</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<div class="container">
									<div class="row">
					<div class="col-12 col-md-12 mt-2 mb-2">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Agregar Nuevo Nivel </h5>
								<form>
									<div class="form-group">
										<div class="form-group">
											<label>Nombre Nivel</label>
											<input v-model="asignatura.name" placeholder="ej: Historia" type="text" class="form-control">
											<label>Descripcion del nivel </label>
											<textarea v-model="asignatura.description" type="text" style="min-height: 100px" class="form-control"> </textarea>
											<div class="mt-3 d-flex justify-content-end">
												<button @click="createdAsignaturas($event)" class="button btn btn-success">Guardar Nivel</button>
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
						<h5 class="card-title">Listado de Niveles de esta asignatura</h5>
						<v-client-table :columns="columnsLevel" v-model="arrayLevel" :options="optionsLevel">
						
							<div slot="acciones" slot-scope="{row}">
								<button data-toggle="modal" data-toggle="modal" data-target="#editar" v-on:click="cargarDatos(row)" class="btn btn-info"> Editar </button>
								<button data-toggle="modal" v-on:click="getLevelBySubject(row)" class="btn btn-warning"> Niveles </button>
								<button v-on:click="deleteCursos(row)" class="btn btn-danger"> Eliminar</button>
							</div>
						</v-client-table>
					</div>
				</div>
			</div>
		</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" v-on:click="limpiar" data-dismiss="modal">Cancelar</button>
						
						<button type="button" class="btn btn-success" @click="updateAsignatura($event)" >Guardar cambios</button>
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
        el:"#asignatura",
        data() {
            return {
				asignatura:{
					id:"",
					name:"",
					sige:"",
					description: "",
				},
				niveles:{
					id:"",
					name:"",
					description:"",
					subject_id:"",
				},
				arrayAsignaturas:[],
				arrayLevel:[],
				filtro:"",
				columns: ['name','sige_code','description',"acciones"],
				options: {
				headings: {
					name: 'Nombre Curso',
					sige_code:"Codigo SIGE",
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
			columnsLevel: ['name','description',"acciones"],
				optionsLevel: {
				headings: {
					name: 'Nombre Nivel',
					description:  'Descripcion Del Nivel',
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
			createdAsignaturas(e){
                e.preventDefault();
					axios.post("/index.php/Asignatura/created_subject",{asignatura:this.asignatura}).then((res) => {

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Asignatura Guardada Correctamente',
							showConfirmButton: false,
							timer: 1500
							});
							this.limpiar();
							this.getAsignaturas();
					});
				

            },
            
            updateAsignatura(e){
                e.preventDefault();
                axios.post("/index.php/Asignatura/update_subject",{asignatura:this.asignatura}).then((res) => {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Cambios Guardados Correctamente',
							showConfirmButton: false,
							timer: 1500
							});
							$("#editar").modal("toggle");
							this.limpiar();
							this.getAsignaturas();
					});

			},
			
			deleteCursos(row){

			axios.post("/index.php/Cursos/delete_courses",{asignatura:row}).then((res) => {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Curso Eliminado Correctamente',
							showConfirmButton: false,
							timer: 1500
							});
							this.limpiar();
							this.getCurso();
					});
				
			},
			getAsignaturas(){

			axios.get("/index.php/Asignatura/getSubject").then((res)=>{
				
				this.arrayAsignaturas =  res.data;
				console.log(this.arrayAsignaturas);
	
			});

		 
		},
		//  getByFiltro(){
		// 	 axios.post("/index.php/Cursos/getcoursesByFilter",{filtro:this.filtro}).then((res)=>{

		// 		this.arrayAsignaturas = res.data.courses;
		// 		console.log(this.arrayAsignaturas);
		//  });
		// },
		getLevelBySubject(row){
			axios.post("/index.php/Asignatura/getLevelBySubject",{asignatura:row.id}).then((res)=>{

				this.arrayLevel = res.data;
				$("#level").modal("toggle");
		 });

		},
		cargarDatos(row){
			
			this.asignatura.id=row.id;
			this.asignatura.name=row.name;
			this.asignatura.sige=row.sige_code;
			this.asignatura.description=row.description;

		},
		limpiar() {
	
			this.asignatura.id="";
			this.asignatura.name="";
			this.asignatura.sige="";
			this.asignatura.description="";
		}
		},
        created() {
        this.getAsignaturas();
        },
    });
</script>
