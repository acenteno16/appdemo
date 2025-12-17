<?

require '../connection.php';
require '../assets/PHPMailer/PHPMailerAutoload.php'; 

$queryhalls = "select * from halls where active = 1";
$resulthalls = mysqli_query($con, $queryhalls);
while($rowhalls=mysqli_fetch_array($resulthalls)){
    
    $queryhall = "select hallsretention.id from hallsretention inner join halls on halls.id = hallsretention.hall where hallsretention.status = '0' and halls.id = '$rowhalls[id]'";
    $resulthall = mysqli_query($con, $queryhall);
    $numhall = mysqli_num_rows($resulthall);
    
    echo '<br>'.$rowhalls[1].": ($numhall)";
    
}

?>