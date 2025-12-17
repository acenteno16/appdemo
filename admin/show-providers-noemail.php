<? 

include('sessions.php');

$queryProviders = "select * from providers where active = '1' and code != '0'";
$resultProviders = mysqli_query($con, $queryProviders);
$num = mysqli_num_rows($resultProviders);
while($rowProviders=mysqli_fetch_array($resultProviders)){
    $queryProviders2 = "select id from providerscontacts where provider = '$rowProviders[id]' and cemail != ''";
    $resultProviders2 = mysqli_query($con, $queryProviders2);
    $numproviders2 = mysqli_num_rows($resultProviders2);
    if($numproviders2 == 0){    
        echo '<br>-'.$rowProviders['code']." | ".$rowProviders['name'];
    }
}

?>