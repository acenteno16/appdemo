<?php 

include("session-admin.php");

$id = $_POST['id']; 
$name = $_POST['name'];
$name2 = $_POST['name2'];
$comments = $_POST['comments'];
$userid = $_SESSION['userid'];
$company = $_POST['company'];
$active = $_POST['active'];

$theroute = $_POST['theroute'];
$headship = $_POST['headship'];

$today = date('Y-m-d');
$totime = date('H:i:s');

$act = "";
$units = $_POST['ckunits'];
if ($units != ""){
    for($c = 0; $c < sizeof($units); $c++) {
      $units1 = $units1 . "$units[$c], ";
   $act = ", units = '$units1'";
    }
}

/* Start */


$filename = $_FILES['file']['name'];

if($filename != ''){
    
     $destino = 'halls/'.$id;
     if (!file_exists($destino)){
        mkdir($destino); 
     }
    
    #Primero chqeuiamos si ya existe el archivo
    if(!file_exists("halls/$id/$id.jpg")){
        
        #Guardamos el formato origen
        $newname = "$id.jpg";
        move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $newname);
        
    }else{
        
        #Guardamos la primera Versión
        
        #Buscamos si hay una version
        $queryVersion = "select version from halls where id = '$id'";
        $resultVersion = mysqli_query($con, $queryVersion);
        $rowVersion = mysqli_fetch_array($resultVersion);
        if($rowVersion['version'] == 0){
            #Creamos la primera version 
            $thisVersion = 1;
            
        }else{
            
            $thisVersion = $rowVersion['version']+1;
        }
        
        $newname = $id.'v'.$thisVersion.'.jpg'; 
        
        $queryVersionUpdate = "update halls set version='$thisVersion' where id='$id'";
        $resultVersionUpdate = mysqli_query($con, $queryVersionUpdate);
        
        move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $newname);
        
        $queryVersionInsert = "insert into hallsretentionVer (today, totime, hall, userid, version) values ('$today', '$totime', '$id', '$_SESSION[userid]', '$thisVersion')";
        $resultVersionInsert = mysqli_query($con, $queryVersionInsert);
        
    }
        	
}

$query = "update halls set name='$name', company='$company', route='$theroute', active='$active', headship='$headship'".$act." where id='$id'";
$result = mysqli_query($con, $query);  

if(isset($_POST['update'])){
	header("location: halls-edit.php?id=".$id);   
}
if(isset($_POST['save'])){
	
	header("location: halls.php"); 
}

?>