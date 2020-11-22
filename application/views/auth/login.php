<body class="light">
<div class="page parallel" id="login">
    <div class="d-flex row">
        <div class="col-12 col-md-12 col-lg-5  height-full white">
            <div class="p-5 mt-5 ">
                <img src="<?=  base_url()?>assets/img/basic/logo_citizen_app_colored.png" alt=""/>
            </div>
            <div class="p-5">

<html>
<head>
  <title>Contador de accesos</title>
</head>
<body>
<p>


                <h3>Bienvenido</h3>
                <p>Bienvenido al panel de gestión de CitizenApp</p>
                <form>
                    <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                        <input type="text" class="form-control form-control-lg"
                               placeholder="Correo electronico" v-model="user">
                    </div>
                    <div class="form-group has-icon"><i class="icon-lock"></i>
                        <input type="password" class="form-control form-control-lg"
                               placeholder="Contraseña" v-model="password">
                    </div>
                    <input type="button" v-on:click="next" class="btn btn-primary btn-lg btn-block" value="Iniciar sesión">
                </form>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-7  height-full align-self-center text-center" data-bg-repeat="false"
             data-bg-possition="center"
             style="background: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1345&q=80')">
        </div>
    </div>
</div>

<script>
	const login = new Vue({
		el:"#login",
		data() {
			return {
				url:"localhost/panel",
				user:"",
				password:""
			}
		},
		methods: {
			login(){
				axios.post("/panel/index.php/auth/login",{user:this.user,password:this.password}).then((res)=>{

					console.log(res.data);

					if(res.data.userdata){
 						 window.location.href = "/panel/index.php/cliente/index";
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: res.data,
							});
					}
				});
			},
			next(){
				window.location.href = '/index.php/Alumnos/index'

			},

			isLoged(){
			axios.get("/panel/index.php/auth/enter").then((res)=>{

				if(res.data.validation){
					let rol = res.data.rol;
					
					switch (rol) {
						case "1":
							window.location.href = "/panel/index.php/usuario/index";
							break;

						case "2":
							window.location.href = "/panel/index.php/cliente/misClientes";
							break;
					
						default:
							break;
					}

					}
					

				

				});
			}
		},
		
		created() {
			// this.isLoged();
		},
	});
</script>

</body>
</html>

