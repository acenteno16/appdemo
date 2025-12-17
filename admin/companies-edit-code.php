<? 

require('headers.php');
$allowedRoles = ['admin'];
require("sessionCheck.php"); 
require_once('sanitize.php');

$id = sanitizeInput($_POST['id'], $con);
$active = sanitizeInput($_POST['active'], $con);
$iractive = sanitizeInput($_POST['iractive'], $con);
$name = sanitizeInput($_POST['name'], $con);
$ruc = sanitizeInput($_POST['ruc'], $con);

$query = "UPDATE companies SET name = ?, ruc = ?, active = ?, iractive = ? WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("sssii", $name, $ruc, $active, $iractive, $id);
$stmt->execute();

$filename = $_FILES['file']['name'];
if($filename != ""){
    
    $folder = 'retentions/'.$id;
    if (!file_exists($folder)){
	   mkdir($folder);  
    }
    
    $newname = $id.".jpg"; 
    move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $folder . '/' . $newname);  
  
    
} 

$filenameLogo = $_FILES['fileLogo']['name'];
if($filenameLogo != ""){
    
    $folderLogo = 'companies';
    if (!file_exists($folderLogo)){
	   mkdir($folderLogo);  
    }
    
    $newname = $id.".png"; 
    move_uploaded_file ( $_FILES [ 'fileLogo' ][ 'tmp_name' ], $folderLogo . '/' . $newname);  
  
    
}

$filenameLogo2 = $_FILES['fileLogo2']['name'];
if($filenameLogo2 != ""){
    
    $folderLogo2 = 'companies';
    if (!file_exists($folderLogo2)){
	   mkdir($folderLogo2);  
    }
    
    $newname2 = $id."-email.png";  
    move_uploaded_file ( $_FILES [ 'fileLogo2' ][ 'tmp_name' ], $folderLogo2 . '/' . $newname2);  
    
}

header('location: companies.php');

?>