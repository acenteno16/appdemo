<? 

#include_once('sessions.php');

function getBeneficiary($paymentId, $type){
    
	include('../connection.php'); 
    
    $queryPayment = "select btype, provider, collaborator, intern, client, parent from payments where id = '$paymentId'";
    $resultPayment = mysqli_query($con, $queryPayment);
    $rowPayment = mysqli_fetch_array($resultPayment);
    $pre = "";
    $ben = '';
	$international = 0;
    
    switch($rowPayment['btype']){
		case 1:
		$row=mysqli_fetch_array(mysqli_query($con, "select code, name, flag, term, international, vips from providers where id = '$rowPayment[provider]'"));
		$term = $row['term'];
		$international = $row['international'];
		$vip = $row['vips'];	
		if($row['flag'] == 1){
            $ben = "$row[code] | $row[name]";
			$pre = '<img src="../images/flag.png" width="13" alt=""/> ';
			
		}
        else{
			$ben = "$row[code] | $row[name]";
		}
		break;
		case 2:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from workers where id = '$rowPayment[collaborator]'"));
		$ben = "$row[code] | $row[first] $row[last]";
		$term = '5';
		break;
		case 3:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from interns where code = '$rowPayment[intern]'"));
		$ben = "$row[code] | $row[first] $row[first2] $row[last] $row[last2]";
		$term = '5';
		break; 
		case 4:
		$row=mysqli_fetch_array(mysqli_query($con, "select * from clients where code = '$rowPayment[client]'"));
		$term = '3';	
		if($row['type'] == 1){
            $pre = '<img src="../images/dev.png" width="15"> ';
			$ben = "$row[code] | $row[first] $row[last]";
		}elseif($row['type'] == 2){
			$pre = '<img src="../images/dev.png" width="15"> ';
            $ben = "$row[code] | $row[name]"; 
		}
		break;
	}
    
    if($rowPayment['parent'] == 1){
		$pre = '<i class="fa fa-users" title="'.$ben.'"></i> ';
		$ben = 'Pasantes Varios';
	}
    elseif($rowPayment['parent'] == 2){
		$pre = '<i class="fa fa-users" title="'.$ben.'"></i> ';
		$ben = 'Colaboradores Varios';
	}
	
    if($type == 'term'){
		return $ben.',,,'.$term.',,,'.$international.',,,'.$vip;
	}elseif($type == 'min'){
        return $ben; 
    }else{
        return $pre.$ben;
    }
     
}


?>