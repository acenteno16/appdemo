<?php 

include("sessions.php"); 

$name = $_POST['name'];
$company = $_POST['company'];
$line = $_POST['bline'];
$location = $_POST['location'];

#company
$queryCompany = "select * from companies where id = '$company'";
$resultCompany = mysqli_query($con, $queryCompany);
$rowCompany = mysqli_fetch_array($resultCompany);

#line
$queryLine = "select * from businessLines where id = '$line'";
$resultLine = mysqli_query($con, $queryLine);
$rowLine = mysqli_fetch_array($resultLine);

#location
$queryLocation = "select * from locations where id = '$location'";
$resultLocation = mysqli_query($con, $queryLocation);
$rowLocation = mysqli_fetch_array($resultLocation);

$code = $rowCompany['code'].$rowLine['code'].$rowLocation['code'];

$queryUnit = "select * from units where newCode = '$code'";
$resultUnit = mysqli_query($con, $queryUnit);
$numUnit = mysqli_num_rows($resultUnit);

if($numUnit > 0){
    
    $rowUnit = mysqli_fetch_array($resultUnit);
    echo "<script>alert('La unidad de negocio $code ya existe. Se encuentra registrada como $rowUnit[name].');history.go(-1);</script>";
    exit();
    
}else{
    
    $query = "insert into units (name, company, newCode, visible, active, companyCode, companyName, lineCode, lineName, locationCode, locationName) values ('$name', '$company', '$code', '1', '1', '$rowCompany[code]', '$rowCompany[name]', '$rowLine[code]', '$rowLine[name]', '$rowLocation[code]', '$rowLocation[name]')";
    $result = mysqli_query($con, $query);

    header("location: units.php"); 
    
}

?>