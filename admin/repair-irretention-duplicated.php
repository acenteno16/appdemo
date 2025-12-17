<? 
/*
include('sessions.php');

$ids_chain="31767,31843,32507,32636,32862,33013,33294,33521,34139,34254,34528,34533,34699,34724,34787,34789,34939,34952,35013,35043,35100,35101,35185,35238,35261,35264,35322,35329,35395,35463,35464,35680,35734,35808,35819,35821,35831";

$ids = explode(',',$ids_chain);

for($i=0;$i<sizeof($ids);$i++){
	echo "<br><strong>IDS: ".$ids[$i]."</strong>";
	
	$query_irretention = "select * from irretention where payment = '$ids[$i]' order by id asc";
	$result_irretention = mysqli_query($con, $query_irretention);
	//$row_irretention = mysqli_fetch_array($result_irretention);
	echo "<br><br>IR: ".$num_irretention = mysqli_num_rows($result_irretention);
	$i2 = 1;
	while($row_irretention=mysqli_fetch_array($result_irretention)){
		if($num_irretention > 1){
			if($i2 == $num_irretention){
				//Do Nothing
				echo '<br>IDR: '.$row_irretention['number'].' (Entregar)';
			}else{
				echo '<br>'.$query_irupdate = "update irretention set void = '1', voidcomments='Error en implementacion de envio de retenciones.' where id = '$row_irretention[id]'"; 
				$result_irupdate = mysqli_query($con, $query_irupdate);
				echo '<br>IDR: '.$row_irretention['number'].' (Anulada)';
			}
		$i2++;
		}
	}
		
	$query_imiretention = "select * from hallsretention where payment = '$ids[$i]' order by id asc";
	$result_imiretention = mysqli_query($con, $query_imiretention);
	//$row_imiretention = mysqli_fetch_array($result_imiretention);
	echo "<br><br>IMI: ".$num_imiretention = mysqli_num_rows($result_imiretention);
	$i2 = 1;
	while($row_imiretention=mysqli_fetch_array($result_imiretention)){
		if($num_imiretention > 1){
			if($i2 == $num_imiretention){
				//Do Nothing
				echo '<br>IDR: '.$row_imiretention['number']." (Entregar)";
			}else{
				echo '<br>'.$query_imiupdate = "update hallsretention set void = '1', voidcomments='Error en implementacion de envio de retenciones.' where id = '$row_imiretention[id]'";
				$result_imiupdate = mysqli_query($con, $query_imiupdate);
				echo '<br>IDR: '.$row_imiretention['serial'].'-'.$row_imiretention['number']." (Anulada)";
			}
		$i2++;
		}
	}
	
 echo "<br><br>";	
}

/*
$query_times = "select payment from times where today = '2017-09-28' and stage = '13.00' group by payment";
$result_times = mysqli_query($con, $query_times);
echo "Number of payments: ".$num_times = mysqli_num_rows($result_times);
while($row_times = mysqli_fetch_array($result_times)){
	//echo '<br>'.$row_times['payment'];
	
	$query_times2 = "select payment from times where today = '2017-09-28' and stage = '13.00' and payment = '$row_times[payment]'";
	$result_times2 = mysqli_query($con, $query_times2);
	$num_times2 = mysqli_num_rows($result_times2);
	if($num_times2 > 1){
		//$query_payments = "";
		//$result_payments = mysqli_query($con, $query_payments);
		//$rowpayments = mysqli_fetch_array($result_payments);
		
		$query_irretention = "select * from irretention where payment = '$row_times[payment]'";
		$result_irretention = mysqli_query($con, $query_irretention);
		$row_irretention = mysqli_fetch_array($result_irretention);
		$num_irretention = mysqli_num_rows($result_irretention);
		
		$query_imiretention = "select * from hallsretention where payment = '$row_times[payment]'";
		$result_imiretention = mysqli_query($con, $query_imiretention);
		$row_imiretention = mysqli_fetch_array($result_imiretention);
		$num_imiretention = mysqli_num_rows($result_imiretention);
		
		if(($num_irretention > 0) or ($num_imiretention > 0)){
		
		if(($num_imiretention > 0)){
			//
		}
		if(($num_irretention > 0)){
			//
		}
		
			//echo '<br>'.$row_times['payment']." -> IR: ".$num_irretention." IMI: ".$num_imiretention;
			echo $row_times['payment'].",";
		}
	}	 

}*/


?>