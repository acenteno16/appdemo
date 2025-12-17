<? 

include('sessions.php');

$id = $_POST['id'];
$type = $_POST['type'];
$provider = $_POST['provider'];
$collaborator = $_POST['collaborator'];
$intern = $_POST['intern'];

$provider2 = $_POST['provider2'];
$collaborator2 = $_POST['collaborator2'];

$queryBen = "select * from providers where id = '$provider2'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen = mysqli_fetch_array($resultBen);
			if($rowBen['flag'] == 1){
				$ben = "$rowBen[code] | $rowBen[name]";
			}else{
				$ben = "$rowBen[code] | $rowBen[name]";
			}
			$theId = $provider2;
			$queryBen = "select * from workers where id = '$collaborator2'";
			$resultBen = mysqli_query($con, $queryBen);
			$rowBen=mysqli_fetch_array($resultBen);
			$ben.= " @$rowBen[code] | $rowBen[first] $rowBen[last]";
			$theId .= ','.$collaborator2;
		
	
?>
<div class="col-md-8"><input type="hidden" name="bid[]" value="<? echo $theId; ?>"> <input type="text" class="form-control" value="<? echo $ben; ?>"></div>