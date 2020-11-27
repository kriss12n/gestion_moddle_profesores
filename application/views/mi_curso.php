

<div class="container-fluid animatedParent animateOnce my-3" id="mi_curso">
	<div class="animated">
	
	<div class="row">
			<div class="col-12 col-md-12 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Mis Alumnos </h5>
						<div class="accordion" id="accordionExample">
							<div v-for="alumno in arrayAlumnos" :key="alumno.id" class="card">
								<div class="card-header" id="headingOne">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left" type="button" v-on:click="getCalificationsByStudent(alumno.id)" data-toggle="collapse" :href="'#collapse-'+alumno.id" aria-expanded="true" aria-controls="collapseOne">
									{{alumno.name}} {{alumno.lastname_p}} {{alumno.lastname_m}}
									</button>
								</h2>
								</div>
								<div :id="'collapse-'+alumno.id" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<table class="table">
										<thead class="thead-dark">
											<tr>
											<th scope="col">Asignatura</th>
											<th scope="col">N1</th>
											<th scope="col">N2</th>
											<th scope="col">N3</th>
											<th scope="col">N4</th>
											<th scope="col">N5</th>
											<th scope="col">N6</th>
											<th scope="col">N7</th>
											<th scope="col">N8</th>
											<th scope="col">N9</th>
											<th scope="col">Promedio</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="califications in arrayCalifications" :key=" califications.id">
											<td>{{califications.subject}}</td>
											<td v-for="calification in califications.califications" :key="calification.id" >{{calification.calification}}</td>
											
										</tr>
											<tr>
											</tr>
										</tbody>
									</table>
									<button v-on:click="exportPDF" class="btn btn-success mt-2">Generar reporte de notas</button>
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

    const curso = new Vue({
        el:"#mi_curso",
        data() {
            return {
				arrayAlumnos:[],
				arrayCalifications:[],
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

            }
        },
        methods: {
			getMi_curso(e){
					axios.post("/index.php/Cursos/getStudentsByTeacherChief",{teacher:5}).then((res) => {
							this.arrayAlumnos = res.data;
					});
			},
			getCalificationsByStudent(student){
				axios.post("/index.php/Cursos/getCalificationsByStudent",{student:student}).then((res) => {
					let data = res.data;		
		//			console.log(data)
				let califications = [];

				for (let i = 0; i < data.length; i++) {
							
						califications.push({"subject":data[i].subject,"califications":data[i].califications});
				
				}
						this.arrayCalifications = califications;
					});
			},
			  exportPDF() {
				var vm = this
				var columns = [
					{title: "Asignatura", dataKey: "arrayCalifications.subject"},
					{title: "Description", dataKey: "arrayCalifications[0].califications"}
				];
				var doc = new jsPDF('p', 'pt');
				doc.text('Informe de notas', 40, 40);
				doc.autoTable(columns, vm.todos, {
					margin: {top: 60},
				});
				doc.save('todos.pdf');
				}
		},		
        created() {
        this.getMi_curso();
		},
    });
</script>
