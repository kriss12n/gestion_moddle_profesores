<div class="container-fluid animatedParent animateOnce my-3" id="agregarasignatura">
	<div class="animated">
		<div class="row">
			<div class="col-12 col-md-6 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Agregar Ramo </h5>
						<form>
							<div class="form-group">
								<div class="form-group">


									<div class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Estudiante </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayAlumnos" label="rut" :reduce="alumno => alumno" v-model="alumno"></v-select>
										</div>
										<div v-if="alumno" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""></label>
												<input type="text" class="form-control" v-model="alumno.name +' ' +alumno.lastname_p+' ' +alumno.lastname_m">
											</fieldset>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Una Asignatura </label>
											<v-select placeholder="Seleccione una opcion" @input="getNivel()" :options="arraySubject" label="name" :reduce="subject => subject" v-model="subject"></v-select>
										</div>
										<div v-if="subject" class="form-group col-md-6">
											<fieldset disabled>
												<label for="">{{subject.sige_code}} </label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{subject.description}} </textarea>
											</fieldset>
										</div>
									</div>
									<div v-if="subject" class="form-row">
										<div class="form-group col-md-6">

											<label>Selecciona Un Nivel </label>
											<v-select placeholder="Seleccione una opcion" @input="" :options="arrayNivel" label="name" :reduce="nivel => nivel" v-model="nivel"></v-select>
										</div>
										<div v-if="subject && nivel" class="form-group col-md-6">
											<fieldset disabled>
												<label for=""> </label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{nivel.description}} </textarea>
											</fieldset>
										</div>

									</div>


									<div class="mt-3 d-flex justify-content-end">
										<button @click="Guardarestudenasig()" class="button btn btn-success">Guardar Categoria</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>




<script>
	Vue.use(VueTables.ClientTable);
	Vue.component('v-select', VueSelect.VueSelect)
	const agregarasignatura = new Vue({
		el: "#agregarasignatura",
		data() {
			return {
				arrayAlumnos: [],
				arraySubject: [],
				arrayNivel: [],
				alumno: '',
				subject: '',
				nivel: {
					description: ''
				},
				guardar:{
					base_course_id:"",
					subject_id:"",
					student_id:"",
					level_id:""
                 
				}



			}
		},

		methods: {
			getAlumnos() {
				axios.get("/index.php/AgregarAsignaura/getAlumnos").then((res) => {
					this.arrayAlumnos = [];
					this.arrayAlumnos = res.data;
					console.log(this.arrayAlumnos);

				});
			},
			getSubject() {

				this.arrayNivel = [];
				axios.get("/index.php/AgregarAsignaura/getSubject").then((res) => {
					this.arraySubject = [];
					this.arraySubject = res.data;
					console.log(this.arraySubject);

				});
			},
			getNivel() {

				axios.post("/index.php/AgregarAsignaura/getNivel", {
					nivel: this.subject
				}).then((res) => {

					this.arrayNivel = res.data;
					console.log(this.arrayNivel);

				})
			},
			Guardarestudenasig() {
			
					this.guardar.base_course_id= this.alumno.idcor,
					this.guardar.subject_id= this.subject.id,
					this.guardar.student_id=this.alumno.id,
					this.guardar.level_id= this.nivel.id,

					console.log(this.guardar)
           
				axios.post("/index.php/AgregarAsignaura/Guardarestudenasig", {
					nivel: this.subject
				}).then((res) => {

					this.arrayNivel = res.data;
					console.log(this.arrayNivel);

				})
			}

		},
		created() {
			this.getAlumnos();
			this.getSubject();

		},
	});
</script>


</body>

</html>
