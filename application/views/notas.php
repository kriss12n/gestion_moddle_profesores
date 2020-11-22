<div class="container-fluid animatedParent animateOnce my-3" id="notas">
	<div class="animated">


		<ul id="v-for-object" class="demo">
			<li v-for="value in arrayNotas.personalnotes">
				<tr>
					<th>Company</th>
					<th>Contact</th>
					<th>Country</th>
				</tr>
				<tr>
					<td> {{ value.id }} </td>
					<td>Maria Anders</td>
					<td>Germany</td>
				</tr>

			</li>
		</ul>



		<div class="row">
			<div class="col-12 mt-2 mb-2">
				<div class="card">
					<div class="card-body">
						<p>Filtro de Cursos por area:</p>

						<h5 class="card-title">Listado de Cursos</h5>

						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Curso</th>
									<th scope="col">Descripcion</th>
									<th scope="col">Usuario</th>
								</tr>
							</thead>
							<tbody v-for="value in arrayNotas.personalnotes">
								<tr>
									<td>{{ value.id }}</td>
									<td>{{ value.courseid }}</td>
									<td>{{ value.content}}</td>
									<td>{{ value.userid}}</td>
								</tr>
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	Vue.use(VueTables.ClientTable);
	Vue.component('v-select', VueSelect.VueSelect)

	const notas = new Vue({
		el: "#notas",
		data() {
			return {

				arrayNotas: [],



			}
		},
		methods: {


			getNotas() {

				axios.post("/index.php/Notas/getnotas").then((res) => {

					this.arrayNotas = res.data;
					console.log(this.arrayNotas.personalnotes);

				});


			},


		},
		created() {
			this.getNotas();
		},
	});
</script>
