<?
$querybatch = "select * from lettersbatch where letter = '$id'";
$resultbatch = mysqli_query($con, $querybatch);
$numbatch = mysqli_num_rows($resultbatch);
if($numbatch > 0){

if(isset($_GET['visor'])){
	if($_GET['visor'] == 1){
		$gvisor = 1;
	}
}

?>
<h3 class="form-section"><a id="status"></a>Provisión</h3>
<h4 class="block" style="font-weight:400;">Batch y documentos:</h4>                                          
											  
<? while($rowbatch=mysqli_fetch_array($resultbatch)){ ?>
 
<div class="row">
<div class="col-md-3 ">
<div class="form-group">
<input name="nobatch[]" type="text" class="form-control" id="nobatch[]" placeholder="" value="<?php echo $rowbatch['nobatch']; ?>" readonly>
</div>
</div>
<div class="col-md-3 ">
<div class="form-group">
<input name="nodocument[]" type="text" class="form-control" id="nodocument[]" placeholder="" value="<?php echo $rowbatch['nodocument']; ?>" readonly>
</div>
</div>
<div class="col-md-4 ">
<div class="form-group">
<input name="linkdocument[]" type="text" class="form-control" id="linkdocument[]" placeholder="" value="<?php echo $rowbatch['linkdocument']; ?>" readonly><a href="<?php 
echo $nlink = urlProcessor($rowbatch['linkdocument'],4,$rowofile['user']);
?>" class="btn blue" target="new">
<i class="fa fa-file-o"></i> &nbsp;Abrir</a>
</div>
</div>
</div>
<? } ?>
<?php } 

function urlProcessor($furl,$fprocess,$fuser = null){
	switch($fprocess){
		case 1:
		//GET THE code ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('visor.php?key=','',$furl);
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$foutput = $furl;
		break;
		case 2:
		//GET THE FULL URL
		$foutput = '/admin/visor.php?key='.$furl;
		break;
		case 3:
		$fchar = urlProcessor($furl, 1);
		$foutput = "../files/folder_".$fuser."/".str_replace(' ','%20',$fchar).".pdf";
		break; 
		case 4:
		//GET THE visor ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$foutput = $furl;
		break;
	}
	
	return $foutput; 
} ?>



                     
  