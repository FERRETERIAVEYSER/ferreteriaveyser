<?php
session_start();
if (empty($_SESSION['active'])) {
	header("location: ../");
}
?>


<div class="header">
	<div class="header-left">
		<div class="menu-icon dw dw-menu"></div>
		<div class="search-toggle-icon dw" data-toggle="header_search"></div>
		<div class="header-search">
			<form>
				<div class="form-group mb-0">
					<?php require "../funciones.php";
					echo fecha(); ?>
				</div>
			</form>
		</div>
	</div>
	<div class="header-right">
		<div class="dashboard-setting user-notification">
			<div class="dropdown">
				<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
					<i class="dw dw-settings2"></i>
				</a>
			</div>
		</div>

		<div class="user-notification">
			<div class="dropdown">
				<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
					<i class="icon-copy dw dw-notification"></i>
					<span class="badge notification-active"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<div class="notification-list mx-h-350 customscroll">
						<ul>
							<li>
								<a href="#">
									<img src="vendors/images/img.jpg" alt="">
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="vendors/images/img.jpg" alt="">
									<h3>Vicki M. Coleman</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon">
						<img src="vendors/images/photo1.jpg" alt="">
					</span>
					<span class="user-name">
						<?php
						echo $_SESSION['usuario'];
						?>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Cambiar contraseña</a>
					<a class="dropdown-item" href="miPerfil.php?id=<?php echo $_SESSION['id'] ?>"><i class="dw dw-user1"></i>Mi Perfil</a>
					<a class="dropdown-item" href="salir.php"><i class="dw dw-logout"></i> Salir</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Opciones del diseño -->
<div class="right-sidebar">
	<div class="sidebar-title">
		<h3 class="weight-600 font-16 text-blue">
			Opciones de Diseño
			<span class="btn-block font-weight-400 font-12">Configuración de la interfaz de usuario</span>
		</h3>
		<div class="close-sidebar" data-toggle="right-sidebar-close">
			<i class="icon-copy ion-close-round"></i>
		</div>
	</div>
	<div class="right-sidebar-body customscroll">
		<div class="right-sidebar-body-content">
			<h4 class="weight-600 font-18 pb-10">Fondo del encabezado</h4>
			<div class="sidebar-btn-group pb-30 mb-10">
				<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Claro</a>
				<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Oscuro</a>
			</div>

			<h4 class="weight-600 font-18 pb-10">Fondo de barra lateral</h4>
			<div class="sidebar-btn-group pb-30 mb-10">
				<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">Claro</a>
				<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Oscuro</a>
			</div>

			<h4 class="weight-600 font-18 pb-10">Icono para menú desplegable</h4>
			<div class="sidebar-radio-group pb-10 mb-10">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
					<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
					<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
					<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
				</div>
			</div>

			<h4 class="weight-600 font-18 pb-10">Icono para la lista de menú</h4>
			<div class="sidebar-radio-group pb-30 mb-10">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
					<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
					<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
					<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
					<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
					<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
					<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
				</div>
			</div>

			<div class="reset-options pt-30 text-center">
				<button class="btn btn-danger" id="reset-settings">Reiniciar Ajustes</button>
			</div>
		</div>
	</div>
</div>
<div class="left-side-bar">
	<div class="brand-logo">
		<a href="index.php">
			<img src="vendors/images/deskapp-logo-white.svg" alt="" class="dark-logo">
			<img src="src/images/veyserperu.png" alt="" class="light-logo">
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>

	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-house-1"></span><span class="mtext">Bienvenida</span>
					</a>
					<ul class="submenu">
						<li><a href="index.php">Bienvenida</a></li>
					</ul>
				</li>

				<?php
				if ($_SESSION['rol'] == 1) {
				?>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-add-user"></span><span class="mtext">Usuarios</span>
						</a>
						<ul class="submenu">
							<li><a href="registroUsuario.php">Registrar Usuario</a></li>
							<li><a href="reporteUsuario.php">Reporte de Usuarios</a></li>
						</ul>
					</li>
				<?php
				}
				?>

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon icon-copy dw dw-id-card1"></span><span class="mtext">Clientes</span>
					</a>
					<ul class="submenu">
						<li><a href="registroCliente.php">Registrar Cliente</a></li>
						<li><a href="reporteCliente.php">Reporte de Clientes</a></li>
					</ul>
				</li>

				<?php
				if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {
				?>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-bus"></span><span class="mtext">Proveedores</span>
						</a>
						<ul class="submenu">
							<li><a href="registroProveedor.php">Registrar Proveedor</a></li>
							<li><a href="reporteProveedor.php">Reporte de Proveedor</a></li>
						</ul>
					</li>
				<?php
				}
				?>

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-suitcase"></span><span class="mtext">Productos</span>
					</a>
					<ul class="submenu">
						<li><a href="registroProducto.php">Registrar Prodcuto</a></li>
						<li><a href="reporteProducto.php">Reporte de Productos</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-invoice-1"></span><span class="mtext">Ventas</span>
					</a>
					<ul class="submenu">
						<li><a href="generarVenta.php">Generar ventas</a></li>
						<li><a href="reporteVenta.php">Reporte de ventas</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-email "></span><span class="mtext">Notificaciones</span>
					</a>
					<ul class="submenu">
						<li><a href="registroComunicado.php">Registrar Notificaciones</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-apartment"></span><span class="mtext"> Anexos </span>
					</a>
					<ul class="submenu">
						<li><a href="ui-cards-hover.php">Redes Sociales</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-right-arrow1"></span><span class="mtext">Opciones</span>
					</a>
					<ul class="submenu">
						<li><a href="video-player.php">Presentación</a></li>
						<li><a href="faq.php">Descripción</a></li>
						<li><a href="cambiarContraseña.php">Cambiar contraseña</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>

</div>