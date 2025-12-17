<? 

include('sessions.php');

$query = "select * from times where stage = '13.00' and today > '2017-01-22'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
echo 'Num: '.$num."<br><br><br>";
while($row=mysqli_fetch_array($result)){
	//echo "<br>".$row['payment'];
	
	$querypayment = "select * from payments where id = '$row[payment]'";
	$resultpayment = mysqli_query($con, $querypayment);
	$rowpayment = mysqli_fetch_array($resultpayment);
	
	$show = 0;
	$str1 = "";
	$str2 = "";
	$mayor = 0;
	$ir = 0;
	
	
	if($rowpayment['ret1a'] > 0){
		$show = 1;
		$mayor = 1;
		$str1 = ", ret1";
		$ret1++;
	}
	if($rowpayment['ret2a'] > 0){
		$show = 1;
		$ir = 1;
		$str2 = ", ret2";
		$ret2++;
	}
	
	if($show == 1){ 
		
			$queryhall = "select * from halls where id = '$rowpayment[hall]'";
			$resulthall = mysqli_query($con, $queryhall);
			$rowhall = mysqli_fetch_array($resulthall);
			$hallname = ' ('.$rowhall['name']." ".$rowhall['id'].")";
		
		
		$route = $rowpayment['route'];
		if(strlen($route) == 4){
			$querycompany = "select * from units where code = '$route'";
		}else{
			$querycompany = "select * from units where code2 = '$route'";
		}
		$resultcompany = mysqli_query($con, $querycompany);
		$rowcompany = mysqli_fetch_array($resultcompany);
		$companyid = $rowcompany['company'];
			
		$querycompany2 = "select * from companies where id = '$companyid'";
		$resultcompany2 =mysqli_query($con, $querycompany2);
		$rowcompany2 = mysqli_fetch_array($resultcompany2);
		
		$company = " ++ ".$rowcompany2['name'];
		
		if(($rowpayment['ret2a'] > 0)){
			echo "<br>".$row['payment']." ".$str1.$hallname.$str2.$company;
		}
	}
}

echo "<br>
<br>
Ret1: ".$ret1."<br>Ret2: ".$ret2;

?>