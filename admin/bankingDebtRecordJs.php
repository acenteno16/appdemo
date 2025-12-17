<? 

include('session-bankingDebt.php');
$id = $_GET['id']; 


/*
?>

<script>

function uploadFile<? echo $id; ?>(theFile){
	var file = _(theFile).files[0];
	var lastTransaction = Date.now();
	_('ltransaction').value = lastTransaction;
	if((file.type == 'application/pdf') || (file.type == 'application/kswps')){
		//  
	}else{ 
		//alert('El archivo debe de ser PDF. ('+file.type+')'); 
		//return; 
	}
	<? if($_SESSION['bigfiles'] == 'active'){ ?>
		if(file.size > '10077220'){
		alert('El archivo debe de ser menor que 10 MB.');
		return;  
		}
	<? }else{ ?>
		if(file.size > '6046332'){
		alert('El archivo debe de ser menor que 6 MB.');
		return;  
		}
	<? } ?> 
	var formdata = new FormData();
	formdata.append("file1", file);
	formdata.append("bdstage", lastTransaction);
	formdata.append("bdid", '<? echo $_GET['id']; ?>');
	
	var ajax = new XMLHttpRequest();
	
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	
	ajax.open("POST", "files-upload.php");
	ajax.send(formdata);
}
function progressHandler<? echo $id; ?>(event){
	_("loaded_n_total<? echo $id; ?>").innerHTML = "Cargado "+event.loaded+" bytes de "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar<? echo $id; ?>").value = Math.round(percent);
	_("status<? echo $id; ?>").innerHTML = Math.round(percent)+"% Archivo cargado... por favor espere"; 
}
function completeHandler<? echo $id; ?>(event){
	_("status<? echo $id; ?>").innerHTML = event.target.responseText;
	_("progressBar<? echo $id; ?>").value = 0;
	
	var ltransaction = _('ltransaction').value;
	
	$.post("reload-files-bankingDebt.php", { bdid: '<? echo $_GET['id']; ?>', ltransaction: ltransaction }, function(data){
		_('nofileUrl').value = data;
		_('nofileText').style.display = 'block';
		_('nofileFile').style.display = 'none';
});		 
	
}
function errorHandler<? echo $id; ?>(event){
	_("status<? echo $id; ?>").innerHTML = "Carga de archivo fallida";
}
function abortHandler<? echo $id; ?>(event){
	_("status<? echo $id; ?>").innerHTML = "Carga de archivo cancelada";
}
function showFile<? echo $id; ?>(val){
	_('nofileText<? echo $id; ?>').style.display = 'none';
	_('nofileFile<? echo $id; ?>').style.display = 'block';
	_("status<? echo $id; ?>").innerHTML = "";
	_("loaded_n_total<? echo $id; ?>").innerHTML = "";
	_("nofile<? echo $id; ?>").value = "";
}
	
</script>
*/ ?>
<script>
function tA(){
	alert('test tA'); 
}
</script>