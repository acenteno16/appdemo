<?php

//Notificacion de distribucion
	
	if($distributable == 1){
		$allunits = array_unique($allunits);
		for($c=0;$c<sizeof($allunits);$c++){
		
		if($allunits[$c] != $route){
			
			//Seleccionamos la unidad de negocio a la que se le envia la distribucion
			$querymanunit = "select * from units where code = '$allunits[$c]'";
			$resultmanunit = mysqli_query($con, $querymanunit);
			$rowmanunit = mysqli_fetch_array($resultmanunit);
			
			//Seleccionamos la ruta aprobado1 de dicha ruta
			$querymanroute = "select * from routes were unit = '$allunits[$c]' and type = '2'";
			$resultmanroute = mysqli_query($con, $querymanroute);
			$rowmanroute = mysqli_fetch_array($resultmanroute);
			
			//Seleccionamos el usuario
			$querymanuser = "select * from workers were code = '$rowmanroute[a]'";
			$resultmanuser = mysqli_query($con, $querymanuser);
			$rowmanuser = mysqli_fetch_array($resultmanuser);
			
			
			$to = $email;  
			$subject = 'Distribucion de gasto | GetPay';
			$message = '';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: '.$manname.' <'.$manemail.'>' . "\r\n";
			$headers .= 'From: GetPay <getpay@casapellas.com.ni>' . "\r\n";
			mail($to, $subject, $message, $headers);  
			
		}
		
	}
	}
	
	
?>	