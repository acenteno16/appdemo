<?php 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require('functions.php');
require('includes.php');
$requiredFiles = ['general'];

?>  
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8"/>
<title>Aplicación de Pagos | Casa Pellas S.A.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link rel="shortcut icon" href="favicon.ico"/>
<?php loadCSS($requiredFiles, $nonce); ?>
<style nonce="<?= $nonce; ?>">
	footer{
		background-color: #21355D !important;
	}
	.overlay{
		background-color: #3FC8EF !important;
	}
	#mc-subscribe1{
		background-color: #51BF87 !important;
		border: none;
	}

.modal {
  position: fixed;
  z-index: 9999;
  left: 0; top: 0;
  width: 100%; height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}
.modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border-radius: 6px;
  width: 90%;
  max-width: 400px;
  text-align: center;
  font-family: sans-serif;
}
.modal-success {
  border-left: 6px solid #4CAF50;
}
.modal-warning {
  border-left: 6px solid #ff9800;
}
.modal-error {
  border-left: 6px solid #f44336;
}
.close-btn {
  color: #aaa;
  float: right;
  font-size: 24px;
  cursor: pointer;
}</style>	
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php include("header.php"); ?>
<div class="clearfix"></div>
<div class="page-container">
	<?php include("side.php"); ?>
	<div class="page-content-wrapper">

		<div class="page-content">

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Lineas de Negocio <?php /*<small>Plantillas de distribución</small>*/ ?>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						<li>
							<i class="fa fa-home"></i>
							<a href="dashboard.php">Inicio</a>
							<i class="fa fa-angle-right"></i>
						</li>

						<li>
							<a href="#">Lineas de negocio</a>
                        </li>
                            
					</ul>

					<!-- END PAGE TITLE & BREADCRUMB-->

				</div>

			</div>

			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->

			<div class="row">

				<div class="col-md-12">

					<?php /*<div class="note note-danger">

						<p>

							NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only.

						</p>

					</div>*/ ?>

					<!-- Begin: life time stats -->

					<div class="portlet">

						<div class="portlet-title">

							<div class="caption">

								<i class="fa fa-shopping-cart"></i>Lista de Lineas</div>

							<div class="actions">

								<a href="lines-add.php" class="btn default blue-stripe">

								<i class="fa fa-plus"></i>

								<span class="hidden-480">

								Agregar Linea</span>

								</a>

                                
                                

							</div>

						</div>

						<div class="row"><!--/span-->


													<div class="col-md-12">
                           
														<?php 
														$query = $con->prepare("select * from businessLines");
														$query->execute();
														$result = $query->get_result();
														$num = $result->num_rows;
														if($num > 0){
														?>
    <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">ID</th>

									<th width="5%">Código</th>
									<th width="70%">Nombre</th>
									<th width="20%"> Opciones</th>

								</tr>

								</thead>

								<tbody>

                                <?php while($row = $result->fetch_assoc()){ ?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $row["id"]; ?></td>
                                  <td><?php echo $row["code"]; ?></td>
									<td><?php echo $row["name"]; ?></td>
                                  <td>
                                    <a href="lines-edit.php?id=<?php echo $row['id']; ?>"><span class="btn blue">
									<i class="fa fa-edit"></i> Editar</span></a>
                                    <a href="#" class="deleteLines" data-id="<?php echo $row['id']; ?>"><span class="btn red">
									<i class="fa fa-trash-o"></i> Eliminar </span></a> 
                                  </td>
								</tr>
								<?php } //while ?>
                                </tbody>

								</table>
                      

					<?php //table 
					}else{ 
					?>	
                    <div class="note note-danger"><p>NOTA: No se encontro ninguna línea.</p></div>
                    <?php } ?>
					</div></div>
					</div>

					<!-- End: life time stats -->

				</div>

			</div>

			<!-- END PAGE CONTENT-->

		</div>

	</div>
<?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); loadJS($requiredFiles, $nonce); ?>
</body>
</html>
<?php include('foot.php'); ?> 
<script nonce="<?= $nonce ?>">
function deleteLines(id){
	if (confirm("Usted desea eliminar esta Linea?\n- Si usted no desea eliminar esta linea presione cancelar.")==true){
		let code = prompt("Por favor, ingresa el codigo de 2fa:");
			window.location=`lines-delete.php?id=${id}&code=${code}`;	
		}
	}
	 
	document.addEventListener("DOMContentLoaded", function () {
  		document.body.addEventListener("click", function (e) {
			const target = e.target.closest('.deleteLines'); // <- más robusto
    		if (target) {
      			e.preventDefault();
      			const id = target.getAttribute('data-id');
      			deleteLines(id);
    		}
  		});
	});

	document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("customModal");
    const modalContent = document.getElementById("modalContent");
    const closeBtn = document.querySelector(".close-btn");
    const messageEl = document.getElementById("modalMessage");

    const params = new URLSearchParams(window.location.search);
    const code = params.get("response"); // incluye errores y éxito

    if (code) {
        let type = "modal-error"; // por defecto
        let msg = "Ocurrió un error desconocido.";

        switch (code) { 
			case 'null':
                return;
                break;
			case '5282':
				type = "modal-error";
                msg = "No se logro eliminar la linea de negocio debido a que fallo el codigo de autenticación.";
                break;
            case '1':
				type = "modal-success";
                msg = "La linea de negocio ha sido eliminada.";
                break;
        }

        // Asignar mensaje y estilo
        messageEl.textContent = msg;
        modalContent.classList.add(type);
        modal.style.display = "block";
		
		setTimeout(() => { modal.style.display = "none"; }, 5000);
    }

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
</script>