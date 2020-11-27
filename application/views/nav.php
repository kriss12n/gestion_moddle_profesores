<body class="light">
<div id="app">
<aside class="main-sidebar fixed offcanvas  shadow bg-primary text-white no-b">
    <section class="sidebar">
	<a href="#" data-toggle="push-menu" style="margin-right: 10px;" class=" float-right pp-nav-toggle">
                            <i class="icon-times-circle fa fa-bars  " style="font-size:40px"></i>
                        </a>
        <div class="w-50 mt-3 mb-3 ml-3">
			<img src="<?= base_url() ?>assets/img/basic/logo_citizen_app_blank.png" alt="">
			
        </div>
        <hr class="white">
        <ul class="sidebar-menu hover-dark">
		
			<li class="header"><strong>MENU DE NAVEGACIÓN</strong></li>

			<li class="treeview no-b"><a href="<?= base_url() ?>index.php/Alumnos/index">
			   <i class="icon icon-account_box light-green-text s-18"></i>
			   <span>Alumnos</span>
		   </a>
		   </li>

		   <li class="treeview no-b"><a href="<?= base_url() ?>index.php/Categoria/index">
			   <i class="icon icon-account_box light-green-text s-18"></i>
			   <span>Categoria</span>
		   </a>
		   </li>

		   <li class="treeview no-b"><a >
			   <i class="icon icon-note-text light-green-text s-18"></i>
			   <span>Administracion de Notas</span>
			   <i
                    class="icon icon-angle-left s-18 pull-right"></i>
			   
		   </a>
		   <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/Notas/index"><i class="icon icon-account_box purple-text s-18"></i>Crear Notas</a>
                    </li>
                    <li><a href="<?= base_url() ?>index.php/Notas/notastodas"><i class="icon icon-account_box purple-text s-18"></i>Todas Las Notas</a>
					</li>
					<li><a href="<?= base_url() ?>index.php/Notas/notascurso"><i class="icon icon-account_box purple-text s-18"></i>Optener Notas Curso</a>
					</li>
					<li><a href="<?= base_url() ?>index.php/Notas/notascursoasignatura"><i class="icon icon-account_box purple-text s-18"></i>Notas Curso Asignatura</a>
					</li>
					<li><a href="<?= base_url() ?>index.php/Notas/notascursoasignaturastuden"><i class="icon icon-account_box purple-text s-18"></i>Notas Curso Asignatura Estudiante</a>
					<li><a href="<?= base_url() ?>index.php/Notas/notascursoestudiante"><i class="icon icon-account_box purple-text s-18"></i>Notas Curso Estudiante</a>
                    </li>
                    </li>
                </ul>
		   </li>
		   
			   <li class="treeview"><a href="#">
                <i class="icon icon-account_box purple-text s-18"></i> <span>Administracion de cursos</span> <i
                    class="icon icon-angle-left s-18 pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/Cursos/index"><i class="icon icon-account_box purple-text s-18"></i>Cursos</a>
                    </li>
                    <li><a href="<?= base_url() ?>index.php/Asignatura/index"><i class="icon icon-account_box purple-text s-18"></i>Asignaturas</a>
                    </li>
                </ul>
			</li>
                </ul>
            </li>
		</ul>

	

	</section>
</aside>

