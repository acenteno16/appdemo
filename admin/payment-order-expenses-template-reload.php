<?

include('session-request.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$destino = "/home/paymentstemplates/".$id."/".$id.".xlsx"; 

if(file_exists($destino)){ ?>
	<input type="hidden" name="template_isset" id="template_isset" value="1">
	<input type="hidden" name="template_id" id="template_id" value="<? echo $id; ?>">
<? } ?>