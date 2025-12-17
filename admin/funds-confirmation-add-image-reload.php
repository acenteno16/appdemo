<? 

include('sessions.php'); 

$id = $_POST['fileid'];
?>
<p>  <a href="javascript:deleteImage(<? echo $rowimages['id']; ?>);" style="color:#F2070B;">[Remplazar imágen]</a> </p>
<img src="eimage.php?key=<? echo base64_encode($id); ?>&transaction=<? echo uniqid(); ?>" width="500px;">  