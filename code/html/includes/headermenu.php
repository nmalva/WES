<?php 

$session_usu_perfil=$_SESSION["usu_perfil"];
$display_admin=(($session_usu_perfil== RESPONSABLE or $session_usu_perfil== ADMINISTRADOR)  ? "inline": "none");

?>
<div class="page-header-menu">
		<div class="container">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- <form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form> -->
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li>
						<a href="home.php">Home</a>
					</li>
					<li class="menu-dropdown mega-menu-dropdown " style="display: <?php echo $display_admin;?>;">
						<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Admin <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 710px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-4">
											<ul class="mega-menu-submenu">
												<li>
													<h3>Personas</h3>
												</li>
												<li>
													<a href="admin_usuarios.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Usuarios </a>
												</li>
												<li>
													<a href="admin_clientes.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Clientes </a>
												</li>
											</ul>
										</div>
										<div class="col-md-4">
											<ul class="mega-menu-submenu">
												<li>
													<h3>Tipificación</h3>
												</li>
												<li>
													<a href="admin_jurisdicciones.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Jurisdicciones </a>
												</li>
												<li>
													<a href="admin_juzgados.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Juzgados </a>
												</li>
												<li>
													<a href="admin_materias.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Materias </a>
												</li>
												<li>
													<a href="admin_estadocaso.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Estado Caso </a>
												</li>
											</ul>
										</div>
										<div class="col-md-4">
											<ul class="mega-menu-submenu">
												<li>
													<h3>Actividades</h3>
												</li>
												<li>
													<a href="admin_tipoactividad.php" class="iconify">
													<i class="glyphicon glyphicon-align-justify"></i>
													Tipo de Actividad </a>
												</li>
												
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>