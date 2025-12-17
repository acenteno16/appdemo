<?php 

include("sessions.php");

$myvar = $_POST['myvariable'];

$query = "select * from workers where code = '$_SESSION[userid]'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
    
?>

                                                       <?php //Nombres ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Nombres:</label>
                                                        <input name="sfirst" type="text" class="form-control" id="sfirst" value="<? echo $row['first']; ?>" onkeypress="return justNumbers(event);">                                                        
		
             </div>
													</div>
                                                      <?php //Apellidos ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Apellidos:</label>
                                                        <input name="slast" type="text" class="form-control" id="slast" value="<? echo $row['last']; ?>" onkeypress="return justNumbers(event);" >                 
             </div>
													</div>
                                                      <?php //Email ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Email:</label>
                                                        <input name="semail" type="text" class="form-control" id="semail" value="<? echo $row['email']; ?>">                                                        
		
             </div>
													</div>
                                                      <?php //No ROC ?>
<div class="col-md-3 ">
													  <div class="form-group">
														<label>Teléfono:</label>
                                                        <input name="sphone" type="text" class="form-control" id="sphone" value="<? echo $row['phone']; ?>">   
                                                     
		
             </div>
													</div>
													