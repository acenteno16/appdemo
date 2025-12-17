<?php 

include("sessions.php");

$myvar = explode(',',$_POST['myvariable']); 
$unit = $myvar[0];
$headship = $myvar[1];  
$newcode = $_POST['newcode'];
    
?>
<label class="control-label">Información de la ruta <? echo $newcode; ?>:</label> <br>
                                                   
<table class="table table-striped table-bordered table-hover" id="datatable_orders">
	<thead>
		<tr role="row" class="heading">
			<th width="30%">Nombre</th>
			<th width="25%">Email</th>
			<th width="13%">Tipo</th>
		</tr>
	</thead>
	<tbody>
		<?
		if($headship > 0){
			$query = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.type > 1 and routes.unitid = '$unit' and usertype.type = '1' and routes.headship='$headship' order by  usertype.position, usertype.id";
			#echo "<tr><td>$query</td></tr>";
			$result = mysqli_query($con, $query); 
			while($row=mysqli_fetch_array($result)){
				$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'")); 
		?>
		<tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
			<td class="sorting_1"><?php echo $rowworker["first"]." ".$rowworker["last"]; ?></td>
			<td><?php echo $rowworker["email"]; ?></td>
             <td><?php 
				$querytype = "select * from usertype where id = '$row[type]'";
				$resulttype = mysqli_query($con, $querytype);
				$rowtype = mysqli_fetch_array($resulttype);
				echo $rowtype["name"]; ?></td>
		</tr>
		<?php } //End while
		#end headship
		}
		if($unit > 0){
		$query = "select routes.* from routes inner join usertype on routes.type = usertype.id where routes.type > 1 and routes.unitid = '$unit' and usertype.type = '1' and routes.type != '20' order by routes.type";
		$result = mysqli_query($con, $query);
		#echo "<tr><td>$query</td></tr>";
		while($row=mysqli_fetch_array($result)){
			$rowworker = mysqli_fetch_array(mysqli_query($con, "select * from workers where code = '$row[worker]'")); ?>
		
		<tr role="row" class="odd <?php if($red == 1) echo 'newred'; ?>">
			<td class="sorting_1"><?php echo $rowworker["first"]." ".$rowworker["last"]; ?></td><td><?php echo $rowworker["email"]; ?></td>
            <td><?php 
			$querytype = "select * from usertype where id = '$row[type]'";
			$resulttype = mysqli_query($con, $querytype);
			$rowtype = mysqli_fetch_array($resulttype);
			echo $rowtype["name"]; ?></td>
        </tr>
		<?php } } ?>
	</tbody>
</table>