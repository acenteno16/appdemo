<?php include_once('sessions.php'); ?>
<table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="5%">

										 ID</th>

									<th width="13%">

										 Archivo</th>

									<th width="17%">

										 Titulo</th>

									<th width="11%">Link</th>

									<th width="22%">

										Fecha

									</th>

									<th width="15%">

										Hora

									</th>

									<th width="17%">

										 Opciones</th>

								</tr>

								</thead>

								<tbody>
                                <?php 
								$query = "select * from filebox where user = '$_SESSION[userid]' order by id desc";
								$result = mysqli_query($con, $query);
								$num = mysqli_num_rows($result);
								while($row=mysqli_fetch_array($result)){
								
								?>
                                
                                <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $row['id']; ?></td>
                                <td><?php echo $row['filename']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><a href="javascript:clipboard('<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'];  ?>');"><i class="fa fa-external-link"></i></a> <a href="<?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'];  ?><?php //echo 'http://www.pagoscp.com/admin/visor.php?key='.$row['url'];  ?>" target="_blank"><?php echo 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'];  ?></a></td>  
                                <td><?php echo $row['today']; ?></td>
                                <td><?php echo $row['now']; ?></td>
                                <td>
                          
                           
                            <a href="<?php echo 'visor.php?key='.$row['url'];  ?>" class="btn btn-xs default btn-editable"><i class="fa fa-search"></i> Ver</a>
                             <a href="files-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-xs default btn-editable"><i class="fa fa-edit"></i> Editar</a>
                            <?php /*
                             <a href="javascript:deletePayment(<?php echo $row['id']; ?>);"><span class="label label-danger">
									<i class="fa fa-trash-o"></i>  Eliminar </span></a>
                                    <script>
									function deletePayment(id){
		if (confirm("Usted desea eliminar este pago\n- Si usted no desea eliminar este pago presione cancelar.")==true){
			window.location="payments-delete.php?id="+id;	
	} 
}

									</script>
                            */ ?>
                         
                            </td>
                            
                            </tr>
                                <?php }
								
								?>
                                   </tbody>

								</table> 
                                
<div>
								<ul class="pagination pagination-lg">
								<?php if($previous != ""){ ?>
                  
                 <li>
										<a href="payments.php?page=<?php echo $previous; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-left"></i> 
										</a>
									</li>
                  <?php }  ?>
								
								<?php if ($totpagina > 1){
  
  for ($i=1;$i<=$totpagina;$i++){ 
        if ($pagina == $i){
			echo '<li class="active"><a href="#">'.$i .'</a></li>';  
		}else{
          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
		  echo '<li><a href="payments.php?page='.$i .'&provider='.$_GET['provider'].'&from='.$_GET['from'].'&to='.$_GET['to'].'&request='.$_GET['request'].'&bill='.$_GET['bill'].'&form=1">'.$i .'</a></li>'; 
		}
    } } ?>
             <?php if($next != ""){ ?>
                 
                 
                 <li>
										<a href="payments.php?page=<?php echo $next; ?>&provider=<?php echo $_GET['provider']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>&request=<?php echo $_GET['request']; ?>&bill=<?php echo $_GET['bill']; ?>&form=1">
										<i class="fa fa-angle-right"></i>
										</a>
									</li>
                  <?php } ?>
                            
								</ul>
							</div> 