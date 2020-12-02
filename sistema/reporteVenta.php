<?php
session_start();
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/functions.php"; ?>
	<title>Reporte de Ventas</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="src/styles/venta.css">
	<link rel="stylesheet" href="src/styles/modal.css">
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1><i class="fas fa-newspaper"></i> Lista de Ventas</h1>
		<a href="generarventa.php" class="btn_new"><i class="fas fa-plus"></i> Nueva venta</a>

		<form action="buscar_venta.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="No. Factura">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>

		<div>
			<h5>Buscar por Fecha</h5>
			<form action="buscar_venta.php" method="get" class="form_search_date">
				<label>De: </label>
				<input type="date" name="fecha_de" id="fecha_de" required>
				<label> A </label>
				<input type="date" name="fecha_a" id="fecha_a" required>
				<button type="submit" class="btn_view"><i class="fas fa-search"></i></button>
			</form>
		</div>

	<br>
		<table>
			<tr>
				<th>No.</th>
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Vendedor</th>
				<th>Estado</th>
				<th class="textright">Total Factura</th>
				<th class="textright">Acciones</th>
			</tr>

			<?php
			//Paginador
			$sql_registe = mysqli_query($con, "SELECT COUNT(*) as total_registro FROM factura WHERE estado != 10 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if (empty($_GET['pagina'])) {
				$pagina = 1;
			} else {
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($con, "SELECT f.nofactura, f.fecha, f.totalfactura, f.codcliente, f.estado, 
				u.nombre as vendedor, cl.nombre as cliente 
				FROM factura f INNER JOIN usuarios u ON f.usuario = u.id
				INNER JOIN clientes cl ON f.codcliente = cl.id_cliente
				WHERE f.estado != 10
				ORDER BY f.fecha DESC LIMIT $desde, $por_pagina");

			mysqli_close($con);

			$result = mysqli_num_rows($query);
			if ($result > 0) {

				while ($data = mysqli_fetch_array($query)) {
					if ($data["estado"] == 1) {
						$estado = '<span class="pagada">Pagada</span>';
					} else {
						$estado = '<span class="anulada">Anulada</span>';
					}
			?>

					<tr id="row_<?php echo $data["nofactura"]; ?>">
						<td><?php echo $data["nofactura"]; ?></td>
						<td><?php echo $data["fecha"]; ?></td>
						<td><?php echo $data["cliente"]; ?></td>
						<td><?php echo $data["vendedor"]; ?></td>
						<td class="estado"><?php echo $estado;?></td>
						<td class="textright totalfactura"><span>S/.</span><?php echo $data["totalfactura"]; ?></td>
						<td>
							<div class="div_acciones">
								<div>
									<button class="btn_view view_factura" type="button" cl="<?php echo $data["codcliente"]; ?>" f="<?php echo $data['nofactura'];?>"><i class="fas fa-eye"></i></button>
								</div>

							<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {
								if ($data["estado"] == 1) 
								{
							?>
							<div class="div_factura">
									<button class="btn_anular anular_factura" fac="<?php echo $data["nofactura"]; ?>"><i class="fas fa-ban"></i></button>
							</div>
							<?php 
								} else {
							?>
								<div class="div_factura">
								<button class="btn_anular inactive"><i class="fas fa-ban"></i></button>
								</div>
							<?php 
								} 
							}
							?>
							</div>
						</td>
					</tr>

			<?php
				}
			}
			?>
		</table>
		<div class="paginador">
			<ul>
				<?php
				if ($pagina != 1) {
				?>
					<li><a href="?pagina=<?php echo 1; ?>">|<</a> </li> <li><a href="?pagina=<?php echo $pagina - 1; ?>">
									<<</a> </li> <?php
												}
												for ($i = 1; $i <= $total_paginas; $i++) {
													# code...
													if ($i == $pagina) {
														echo '<li class="pageSelected">' . $i . '</li>';
													} else {
														echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
													}
												}

												if ($pagina != $total_paginas) {
													?> <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
				<?php } ?>
			</ul>
		</div>


		</table>
	</section>

	<script src="src/scripts/jquery.min.js"></script>
	<script src="src/scripts/functions.js"></script>

</body>

</html>