<? 

require('session-bankingDebtAdmin.php');
require('functions.php');

$id = isset($_GET['id']) ? sanitizeInput(intval($_GET['id']), $con) : 0;

$query = "select * from bankingDebtContracts where id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


if($row['parent'] == 0){
    
    #en caso de pago madre   
    $queryChilds = "select id from bankingDebtContracts where parent = '$row[id]'";
    $resultChilds = mysqli_query($con, $queryChilds);
    $numCheck+= mysqli_num_rows($resultChilds);
    
    $queryContracts = "select * from bankingDebtContracts where id = '$row[id]' or parent = '$row[id]'";
    $resultContracts = mysqli_query($con, $queryContracts);
    $numCheck = 0;
    while($rowContracts = mysqli_fetch_array($resultContracts)){
    
        $queryCheck = "select id from bankingDebt where contract = '$row[id]'";
        $resultCheck = mysqli_query($con, $queryCheck);
        $numCheck+= mysqli_num_rows($resultCheck);

    }
    
    if($numCheck > 0){
        exit('<script>alert("No se pudo eliminar el contrato. Asegurese de que no existan pagos SC o desembolsos vinculados.");history.go(-1);</script>');
    }else{
    
        $queryDelete = "delete from bankingDebtContracts where id = '$row[id]'";
        $resultDelete = mysqli_query($con, $queryDelete);
        
        header('location: bankingDebtContracts.php');
        
    }

    
}

else{
    
    #En caso de pago hijo
    
    #Comprobamos que no hay desembolsos
    $queryCheck = "select id from bankingDebt where contract = '$row[id]'";
    $resultCheck = mysqli_query($con, $queryCheck);
    $numCheck = mysqli_num_rows($resultCheck);
    
    if($numCheck > 0){
        #Si hay desembolsos
        exit('<script>alert("No se pudo eliminar el contrato. Asegurese de que no existan pagos SC o desembolsos vinculados.");history.go(-1);</script>');
    }else{
        
        $today = date('Y-m-d');
        $totime = date('H:i:s');
        
        #Si no hay desembolsos
        
        #Leemos la informacion del contrato padre/madre
        $queryParent = "select * from bankingDebtContracts where id = '$row[parent]'";
        $resultParent = mysqli_query($con, $queryParent);
        $rowParent = mysqli_fetch_array($resultParent);
        
        #Eliminamos el contrato
        $queryDelete = "delete from bankingDebtContracts where id = '$row[id]'";
        $resultDelete = mysqli_query($con, $queryDelete);
        
        #Balance padre
        $queryBalanceParent = "select balance from bankingDebtContractParentBalance where bankingDebtContract = '$row[parent]' order by id desc limit 1";
        $resultBalanceParent = mysqli_query($con, $queryBalanceParent);
        $rowBalanceParent = mysqli_fetch_array($resultBalanceParent);
        $rowBalanceParent['balance'];
        
        #ajustamos el balance madre
        $queryBalance = "select balance from bankingDebtContractBalance where bankingDebtContract = '$row[id]' order by id desc limit 1";
        $resultBalance = mysqli_query($con, $queryBalance);
        $rowBalance = mysqli_fetch_array($resultBalance);
        $rowBalance['balance'];
        
        $balance = $rowBalanceParent['balance']+$rowBalance['balance'];
        
        $queryBalanceUpdate = "INSERT INTO bankingDebtContractParentBalance 
                      (today, totime, bankingDebtContract, bankingDebtContractChild, userid, type, currency, amount, balance) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmtBalanceUpdate = $con->prepare($queryBalanceUpdate);

// Asignación de valores
$balanceToday = $today; // Sanitizada previamente
$balanceToTime = $totime; // Sanitizada previamente
$balanceBankingDebtContract = $row['parent'];
$balanceBankingDebtContractChild = $row['id'];
$balanceUserId = $_SESSION['userid']; // Alfanumérico
$balanceType = 1; // Constante
$balanceCurrency = $row['currency'];
$balanceAmount = $row['amount'];
$balanceFinal = $balance; // Calculado o asignado previamente

// Vincular parámetros
$stmtBalanceUpdate->bind_param(
    "ssiissids",
    $balanceToday, 
    $balanceToTime, 
    $balanceBankingDebtContract, 
    $balanceBankingDebtContractChild, 
    $balanceUserId, 
    $balanceType, 
    $balanceCurrency, 
    $balanceAmount, 
    $balanceFinal
);

// Ejecutar la consulta
$stmtBalanceUpdate->execute();
        
       header('location: bankingDebtContracts.php');
        
    }
    
}

?>