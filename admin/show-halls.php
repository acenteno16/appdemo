<? 

include('session-admin.php');


#$query = "update providers set hall = '1' where name like '%alcaldia%'";
#$result = mysqli_query($con, $query); 

/*
$query = "select * from providers where name like '%alcaldia%'";
$result = mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
    
    echo "<br>-".$row['code']." | ".$row['name'];
    
    #$idStr.=$row['id'].",";
}

/*
$idStr = substr($idStr,0,-1);
$idArr = explode(',',$idStr);
for($i=0;$i<sizeof($idArr);$i++){
    if($i == 0){
        $str.=" and (";
    }else{
        $str.= " or ";
    }
    $str.="(provider = '$idArr[$i]')";
}
 $str.=")"; 

echo "Query: ".$query = "select * from payments where status = '3' and approved = '0'".$str;
$result = mysqli_query($con, $query);
echo "<br>NUM: ".$num = mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)){
    echo '<br>-'.$row['id'];
}
*/
?>