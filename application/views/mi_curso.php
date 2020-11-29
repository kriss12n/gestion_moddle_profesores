

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
								<div class="card-body" >
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
									<button @click="print" data-target="#informe" data-toggle="modal" class="btn btn-success mt-2">Generar reporte de notas</button>
								</div>
								<!-- <button @click="print" class="btn btn-success mt-2">Generar reporte de notas</button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<!-- Modal Editar -->
				<div class="modal fade"  data-backdrop="static" id="informe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl" id="printableTable">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Informe de notas de "alumno"</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container" id="printMe">
							<div class="row">
								<div class="col-12">
									<div class="media">
										<img src="https://www.liceosannicolas.cl/wp-content/uploads/2018/10/LogoLiceo2kX2k-300x300.png" style="width:10%"   class="align-self-center mr-4" alt="logo liceo">
										<div class="media-body">
											<h5 class="mt-0 color-black">Liceo politecnico de Excelencia Polivalente San Nicolás</h5>
											<p class="mb-0">RBD: 4140 - 8 </p>
											<p class="mb-0">Balmaceda 462 - San Nicolás </p>
											<p class="mb-0">Fono: 42-2561512 </p>
										</div>	
									</div>
									<h3 class="text-center">INFORME DE NOTAS PARCIALES</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<p class="mb-0">NOMBRE: Matías Exequiel Almonte Aceitón</p>
									<p class="mb-0">CURSO: 7º Básico E </p>
									<p class="mb-0">Primer semestre del 2020</p>
								</div>
								<div class="col-12 mt-3 p-4">
									<table class="table table-bordered">
										<thead>
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
								</div>
								<div class="col-12">
									<h4>INFORME DE ASISTENCIA:</h4>
									<hr>
									<div class="d-flex">
										<p class="mr-5"> Días Trabajados por el Alumno: 164  </p>   
										<p class="mr-5"> Días Inasistentes: 0 </p>
										<p class="mr-5"> % de asistencia: 100%</p>	
									</div>
									<div class="d-flex">
										<p class="mr-5"> Días Atrasados: 0  </p>  
										<p class="mr-5"> % de asistencia: 0 %</p>	
									</div>
									<h4>OBSERVACIONES:</h4>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<div class="d-flex row justify-content-around">
										<div class="col-4">
											<hr class="w-100 color-black">
											<p class="text-center">Nombre profesor</p>
											<p class="text-center">PROFESOR JEFE</p>
										</div>
										<div class="col-4">
											<hr class="w-100 color-black">
											<p  class="text-center"> Nombre director</p>
											<p class="text-center">DIRECTOR</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					
				</div>
				<Button>imprimir</Button>
				</div>



	</div>
</div>

<script>

	const options = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css'
  ]
}

		Vue.use(VueHtmlToPaper, options);
		Vue.use(VueTables.ClientTable);
		Vue.component('v-select', VueSelect.VueSelect)

    const curso = new Vue({
        el:"#mi_curso",
        data() {
            return {
				arrayAlumnos:[],
				arrayCalifications:[],

				informe:{
					"alumno":"",
					"curso":"",
					"profesor_jefe":"",

				},
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
			print () {
			// Pass the element id here
			this.$htmlToPaper('printMe');
    }
  		},
        created() {
        this.getMi_curso();
		},
    });
</script>
