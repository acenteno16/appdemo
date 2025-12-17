<?php 

include('session-provision-bt.php');

$theaccount0 = $_POST['theaccount0'];
$theaccount1 = $_POST['theaccount1'];
$theaccount2 = $_POST['theaccount2'];

$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$id = $_POST['id'];
$userid = $_SESSION['userid'];

$gcomments = "Enhorabuena, la solicitud ha sido provisionado."; 

//Provision Normal (No intercompany)
if($theaccount0 == 1){

	$nobatch = $_POST['nobatch'];
	if($nobatch[0] == ""){ ?>
		<script>
			alert('Ingrese el numero de batch.');
			history.go(-1);
		</script>
		<?php exit();
	}
	$linkbatch = $_POST['linkbatch'];
	$nodocument = $_POST['nodocument'];
	if($nodocument[0] == ""){ ?>
	<script>
		alert('Ingrese el numero de documento.');
		history.go(-1);
	</script>
	<?php exit();
	}
	$linkdocument = $_POST['linkdocument']; 
	if($linkdocument[0] == ""){ ?>
	<script>
		alert('Ingrese el link del documento.');
		history.go(-1);
	</script>
	<?php exit(); 
    }
	//End Arrays

	for($c = 0; $c < sizeof($nobatch); $c++){
	 $query4 = "insert lettersbatch  (letter, nobatch, linkbatch, nodocument, linkdocument, preturn, account) values ('$id', '$nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn', '0')"; 
	 $result4 = mysqli_query($con, $query4); 
	}  
 

}
//Fin de provision normal (No intercompany)	

//Inicio de provision intercompany

//Cuenta Origen
if($theaccount1 == 1){

	$nobatch = $_POST['nobatch'];
	if($nobatch[0] == ""){ ?>
		<script>
			alert('Ingrese el numero de batch.');
			history.go(-1);
		</script>
		<?php exit();
	}
	$linkbatch = $_POST['linkbatch'];
	$nodocument = $_POST['nodocument'];
	if($nodocument[0] == ""){ ?>
	<script>
		alert('Ingrese el numero de documento.');
		history.go(-1);
	</script>
	<?php exit();
	}
	$linkdocument = $_POST['linkdocument']; 
	if($linkdocument[0] == ""){ ?>
	<script>
		alert('Ingrese el link del documento.');
		history.go(-1);
	</script>
	<?php exit(); 
    }
	//End Arrays

	$gcomments.= " | Origen"; 


	for($c = 0; $c < sizeof($nobatch); $c++){
	 $query4 = "insert lettersbatch  (letter, nobatch, linkbatch, nodocument, linkdocument, preturn, account) values ('$id', '$nobatch[$c]', '$linkbatch[$c]', '$nodocument[$c]', '$linkdocument[$c]', '$preturn', '1')"; 
	 $result4 = mysqli_query($con, $query4); 
	}  
 

}

//Cuenta destino
if($theaccount2 == 1){

	$nobatchd = $_POST['nobatchd'];
	if($nobatchd[0] == ""){ ?>
		<script>
			alert('Ingrese el numero de batch.');
			history.go(-1);
		</script>
		<?php exit();
	}
	$linkbatchd = $_POST['linkbatchd'];
	$nodocumentd = $_POST['nodocumentd'];
	if($nodocumentd[0] == ""){ ?>
	<script>
		alert('Ingrese el numero de documento.');
		history.go(-1);
	</script>
	<?php exit();
	}
	$linkdocumentd = $_POST['linkdocumentd']; 
	if($linkdocumentd[0] == ""){ ?>
	<script>
		alert('Ingrese el link del documento.');
		history.go(-1);
	</script>
	<?php exit(); 
    }
	//End Arrays

	$gcomments.= " | Destino"; 


	for($c = 0; $c < sizeof($nobatchd); $c++){
	 $query4 = "insert lettersbatch  (letter, nobatch, linkbatch, nodocument, linkdocument, preturn, account) values ('$id', '$nobatchd[$c]', '$linkbatchd[$c]', '$nodocumentd[$c]', '$linkdocumentd[$c]', '$preturnd', '2')"; 
	 $result4 = mysqli_query($con, $query4); 
	}  
 
}

$queryapprove = "update letters set status = '4' where id = '$id'";
$resultapprove = mysqli_query($con, $queryapprove);
	
//time stage
$querytime = "insert into letterstimes (letter, today, now, now2, userid, stage, comment) values ('$id', '$today', '$now', '$now2', '$_SESSION[userid]', '4', '$gcomments')"; 
$resulttime = mysqli_query($con, $querytime);
	
header("location: provision.php"); 
	
?>