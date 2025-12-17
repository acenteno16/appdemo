<?php $slide = array(); 
$slide[] = '1/11/14';
$slide[] = '2/11/14';
$slide[] = '3/11/14';
$slide[] = '4/11/14';
$slide[] = '5/11/14';
$slide[] = '6/11/14';
$slide[] = '7/11/14';
$slide[] = '8/11/14';
$slide[] = '9/11/14';
$slide[] = '10/11/14';
$slide[] = '11/11/14';
$slide[] = '12/11/14';				 
				 


$rand = array_rand($slide, sizeof($slide));
foreach ($rand as $key => $value) {
	
$_DATOS_EXCEL[$i]['today'] = $slide[$value];
if(strstr($_DATOS_EXCEL[$i]['today'],'/')){
$t = explode('/',$_DATOS_EXCEL[$i]['today']);
	$_DATOS_EXCEL[$i]['today'] = date('Y-m-d', strtotime($t[2].'-'.$t[1].'-'.$t[0]));
}else{
	
	$_DATOS_EXCEL[$i]['today'] = date("Y-m-d", strtotime($_DATOS_EXCEL[$i]['today']));
}
echo '-'.$_DATOS_EXCEL[$i]['today']."-<br>";

}
/*$today = '12/11/14';
if(strstr($today,'/')){
	$t = explode('/',$today);
	echo date('Y-m-d', strtotime($t[2].'-'.$t[1].'-'.$t[0]));
	 
}else{
	echo 'tu mamam';
}

*/
?>