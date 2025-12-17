 <div class="row"></div>
 <div class="row">
<div class="col-md-12 ">
<h3 class="form-section"><a id="provision"></a>Programación</h3> 
</div>
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>Fecha de programación:</label>
			    											
                                        <input name="adch" type="text" class="form-control" id="adch" placeholder="" value="<?php echo date('d-m-Y',strtotime($row['schedule'])); ?>" readonly>
						
</div>
</div>
	 
<? 
	 
$querySchedule = $con->prepare("select schedule.code from schedule inner join schedulecontent on schedule.id = schedulecontent.schedule where schedulecontent.payment = ?");
$querySchedule->bind_param("i", $row['id']);
$querySchedule->execute();
$resultSchedule = $querySchedule->get_result();
$numSchedule = $resultSchedule->num_rows;
$rowSchedule = $resultSchedule->fetch_assoc();

?>	 
<div class="col-md-3 ">
									  <div class="form-group">
			    <label>WID:</label><input name="adch" type="text" class="form-control" id="adch" placeholder="" value="<?php echo $rowSchedule['code']; ?>" readonly>
						
</div>
</div>	 
</div>