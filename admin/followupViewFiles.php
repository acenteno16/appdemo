<? 

include('sessions.php'); 

$uid = $_POST['uid'];
$id = $_POST['id'];
foreach ($_POST as $param_name => $param_val) {
    $str.="Param: $param_name; Value: $param_val, ";
}

$fileName = $_FILES["file"]["name"]; // The file name
$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file"]["type"]; // The type of file it is
$fileSize = $_FILES["file"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true 

$destination = '../../files/followup';
if (!file_exists($destino)){
	mkdir($destination); 
}
$destination = '../../files/followup/'.$id.'/';
if (!file_exists($destino)){
	mkdir($destination); 
}

for($f=0;$f<sizeof($_FILES["file"]["name"]);$f++){
	
	$title = $uid.'-'.$f.'.jpg'; 
	
	$query = "insert into followupFiles (uid, filename, str) values ('$uid', '$title', '$str')";
	$result = mysqli_query($con, $query);
	$lastid = mysqli_insert_id($con);

	$newDestination = $destination.$title;
	
	if(move_uploaded_file($_FILES["file"]["tmp_name"][$f], $newDestination)){
		
		/*$image_location = $newDestination;

		$image_size = getimagesize($image_location);

		$image_width = $image_size[0];
		$image_height = $image_size[1];

		if($image_width > $image_height){
			$image_type = "landscape";
			$new_w = 1024;  
			$new_h = ($image_height*$new_w)/$image_width; 
	
		}else{
			$image_type = "portrait";
			$new_w = 768;
			//despejar
			$new_h = ($image_height*$new_w)/$image_width;
		}
 
		$src_img = imagecreatefromjpeg($image_location);
		$dst_img = imagecreatetruecolor($new_w,$new_h); 
		imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
		imagejpeg($dst_img, $image_location);
		*/
	} 
	else {
		$querydelete = "delete from followupFiles where id = '$lastid'";
		#$resultdelete = mysqli_query($con, $querydelete);   
	}
}

/*$destino = '/home/multitec/public_html/nicatalogo.com/products/'.$product.'/';
$destino = "../assets/".base64_encode($_SESSION[storeid])."/products/".base64_encode($product)."/";

if (!file_exists($destino)){
    mkdir($destino);
}*/

?>