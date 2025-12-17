<?

require('sessions.php');

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$thefile = $_GET['key'];
$thefile = base64_decode($thefile);
$newkey = parse_str($thefile,$newkeyArr);
$query = "select * from filebox where id = '$newkeyArr[file]'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$url = urlProcessor($thefile,1,0);
$thefile = urlProcessor(str_replace(' ','%20',$row['name']),3,$row['user']);

$fE = explode('.',$row['filename']);
$fES = sizeof($fE)-1;								
if(($fE[$fES] == 'xls') or ($fE[$fES] == 'xlsx')){
	$thefile = urlProcessor(str_replace(' ','%20',$row['name']),4,$row['user']);
}
$thefileStr = str_replace('../files/','',$thefile);
if(($row['rloc'] == 1) or ($row['rloc2'] == 2) or ($row['rloc4'] == 1)){
	$remote_folder = date('Y', strtotime($row['today'])).'/folder_'.$row['user'].'';
	$thefileStr = "$remote_folder/$row[name]";
}

function buscarArchivo($nombreArchivo, $carpetas) {
    foreach ($carpetas as $carpeta) {
        $rutaArchivo = rtrim($carpeta, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $nombreArchivo;
       if (is_file($rutaArchivo)) {
            return $rutaArchivo; // Retorna la ruta completa y detiene la búsqueda
        }
    }

    // Retorna null si el archivo no se encuentra en ninguna carpeta
    return null;
}
function buscarEnSubdirectorios($directorioBase, $nombreArchivo) {
    $iterador = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directorioBase),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterador as $archivo) {
        if ($archivo->isFile() && $archivo->getFilename() === $nombreArchivo) {
            return $archivo->getPathname(); // Ruta completa del archivo encontrado
        }
    }

    return null; // Retorna null si no se encuentra
}

$carpetas = [
    "/home/files",
    "/home/files2/files",
    "/home/files3/files",
    "/home/newfiles/newfiles"
];

$rutaEncontrada = buscarArchivo($thefileStr, $carpetas);
if ($rutaEncontrada) {
    $thefile = $rutaEncontrada;
} else {
	$thefile = "/home/files/nofile.pdf";
	$thefileStr2 = basename($thefileStr);
	$rutaEncontrada2 = buscarEnSubdirectorios('/home/newfiles', $thefileStr2);
	if ($rutaEncontrada2) {
		echo $thefile = $rutaEncontrada2;
	}
    
}

/*

if(!file_exists($thefile)){
	
	$local_file = "//home/getpaycp/filesTemp/$row[id].pdf";
	$thefile = "//home/getpaycp/files/nofile.pdf";

	
	if(($row['rloc'] == 1) or ($row['rloc2'] == 2)){
		$thefile = str_replace('../files/','/home/files2/',$thefile);
	}
    
    if(($row['rloc4'] == 1)){ 
        $thefile = str_replace('../files/','/home/files3/',$thefile);
	}
	
	if($thefile == "//home/getpaycp/files/nofile.pdf"){
		$prethefile = str_replace('../files/','/home/newfiles/newfiles/',$thefile);
		if(file_exists($prethefile)){
			$thefile = $prethefile;
		}
	}
}

*/

if($_SESSION['email'] == "ajairovargasg@gmail.com"){
	echo $row['rloc2'];
	echo '<br>Hola-----'.$remote_file;
	exit();
}

#echo $thefile;
if(($fE[$fES] == 'pdf')	or ($fE[$fES] == 'PDF')){ 
	header('Content-type: application/pdf');
	readfile($thefile);
}
else{
	
	$archivoExcel = $thefile;
	$nombreDescarga = str_replace('.xlsx','.xls',$row['filename']);

	// Verificar si el archivo existe
	if (file_exists($archivoExcel)) {
    	// Configuración de encabezados para la descarga
    	header('Content-Description: File Transfer');
    	header('Content-Type: application/vnd.ms-excel');
    	header('Content-Disposition: attachment; filename="' . $nombreDescarga . '"');
    	header('Expires: 0');
		header('Cache-Control: must-revalidate');
    	header('Pragma: public');
    	#header('Content-Length: ' . filesize($archivoExcel));

    	// Leer el archivo y enviar su contenido al navegador
    	readfile(utf8_decode($archivoExcel));
    	exit;
}
    
}

function urlProcessor($furl,$fprocess,$fuser = null){
	switch($fprocess){
		case 1:
		//GET THE ZmlsZT0xJnVzZXJpZD1QQ1AwMDAx
		$farray = explode('/',$furl);
		$fsize = sizeof($farray);
		$fsize--;
		$furl = $farray[$fsize];
		$furl = str_replace('.pdf','',$furl);
		$furl = str_replace('.PDF','',$furl);
		$furl = str_replace('.XLSX','',$furl);
		$furl = str_replace('.xlsx','',$furl);	
			$furl = str_replace('.xls','',$furl);
			$furl = str_replace('.XLS','',$furl);
		$foutput = $furl;
		break;
		case 2:
		//GET THE FULL URL
		$foutput = 'http://getpay.casapellas.com.ni/admin/visor.php?key='.$furl;
		break;
		case 3:
		$fchar = urlProcessor($furl, 1);
		$foutput = "../files/folder_".$fuser."/".str_replace(' ','%20',$fchar).".pdf";
		break;
		case 4:
		$fchar = urlProcessor($furl, 1);
		$foutput = "../files/folder_".$fuser."/".str_replace(' ','%20',$fchar).'.xls';	
		break; 
			
	}
	
	return $foutput; 
}

?>