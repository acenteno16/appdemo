<?php include("session-request.php");

$myvar = explode(',',$_POST['myvariable']); 
$unit = $myvar[0];
$headship = $myvar[1];  



    
?>
<label class="control-label">Información de la ruta:</label> <br>
                                                   
                                                  <table class="table table-striped table-bordered table-hover" id="datatable_orders">

								<thead>

								<tr role="row" class="heading">

									

									<th width="30%">

										 Nombre</th>

									<th width="25%">

										 Email</th>

									<th width="13%">Tipo</th>

								  </tr>

								</thead>

								<tbody>

                                <?php 
								
								//$queryroutes = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.worker = '$_SESSION[userid]' and usertype.type = 1 group by routes.unit";
								$queryroute = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.worker = '$_SESSION[userid]' and routes.id = '$unit' group by routes.unit";
								$resultroute = mysqli_query($con, $queryroute);
								$rowroute = mysqli_fetch_array($resultroute);
								
								$query = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.type > 1 and routes.unit = '$unit' and usertype.type = '1' and routes.headship='$headship' order by routes.type";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
	
$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'")); 

?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $rowworker["first"]." ".$rowworker["last"]; ?></td><td><?php echo $rowworker["email"]; ?></td>
                                  <td><?php $querytype = "select * from usertype where id = '$row[type]'";
								  $resulttype = mysqli_query($con, $querytype);
								  $rowtype = mysqli_fetch_array($resulttype);
								  echo $rowtype["name"]; ?></td>
                                </tr>
                                
                                
                                
                                
                                
                                
                                <?php } //end while 
								
if($headship > 0){	

$query = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.type > 1 and routes.unit = '$unit' and usertype.type = '1' and routes.headship='0' order by routes.type";
$result = mysqli_query($con, $query); 
while($row=mysqli_fetch_array($result)){
	
$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'")); 

?>

								
								
                                <tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
                                  <td class="sorting_1"><?php echo $rowworker["first"]." ".$rowworker["last"]; ?></td><td><?php echo $rowworker["email"]; ?></td>
                                  <td><?php $querytype = "select * from usertype where id = '$row[type]'";
								  $resulttype = mysqli_query($con, $querytype);
								  $rowtype = mysqli_fetch_array($resulttype);
								  echo $rowtype["name"]; ?></td>
                                </tr>
                                
                                
                                
                                
                                
                                
                                <?php }//End while

} //End (headship == 0)
								
								?>
                                </tbody>

								</table>