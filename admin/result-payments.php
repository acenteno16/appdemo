<?php

/*
include('../connection.php');


$query = "select * from payments where approved = '1' and status < '14'";
$result = mysqli_query($con, $query);
echo $num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
	
	//Si esta ingresado
	if($row['status'] == 1){
			//Lo ponemos en aprobado 1
			$thestage[0][0] = 2;
			$thestage[0][1]++;
			
		}
		if($row['status'] == 2){
			if($row['approved'] == 1){
				$thestage[1][0] = 8;
				$thestage[1][1]++;
			}else{
				$thestage[1][0] = 3;
				$thestage[1][1]++;
			}
		}
		if($row['status'] == 3){
			$thestage[2][0] = 8;
			$thestage[2][1]++;
		}
		if($row['status'] == 8){
			$thestage[3][0] = 9;
			$thestage[3][1]++;
		}
		if($row['status'] == 9){
			$thestage[4][0] = 12;
			$thestage[4][1]++;
			
		}
		if($row['status'] == 12){
			$thestage[5][0] = 13;
			$thestage[5][1]++;
		}
		if($row['status'] == 13){
			$thestage[6][0] = 14;
			$thestage[6][1]++;
		}
		
}

echo $thestage[0][0].": ".$thestage[0][1]."<br>";
echo $thestage[1][0].": ".$thestage[1][1]."<br>";
echo $thestage[2][0].": ".$thestage[2][1]."<br>";
echo $thestage[3][0].": ".$thestage[3][1]."<br>";
echo $thestage[4][0].": ".$thestage[4][1]."<br>";
echo $thestage[5][0].": ".$thestage[5][1]."<br>";
echo $thestage[6][0].": ".$thestage[6][1]."<br>";
*/ 

?>