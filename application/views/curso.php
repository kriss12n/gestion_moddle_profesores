

<div class="container-fluid animatedParent animateOnce my-3" id="curso">
	<div class="animated">
	







	
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

                this.arrayCursos = res.data;
		 });
		}
		},
        created() {
        this.getCurso();
		this.getCategoria();
        },
    });
</script>
