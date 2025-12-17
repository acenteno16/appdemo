<? 

include('sessions.php');

$userType = 2; 

//Comprobamos que el usuario tenga el permiso necesario
# and type '$userType' and unit = '81' and headship = '0' limit 1
echo $queryPermission = "select * from routes where worker = '1441481' and unit = '81' and headship = '0' and type = '2'"; 
$resultPermission = mysqli_query($con, $queryPermission);
$numPermission = mysqli_num_rows($resultPermission);
if($numPermission > 0){
    echo "<br>Si";
}else{
    echo "<br>No";
}
while($rowPermission = mysqli_fetch_array($resultPermission)){
    echo '<br>'.$rowPermission['id']." - ".$rowPermission['type'];
}

?>