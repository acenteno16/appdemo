<? 

include('sessions.php');

$type = $_POST['type'];

if($type == 'providersMenu'){
    echo '<option value="">Todos los Proveedores</option>';
    $query = "select id, code, name from providers where code > '0' order by name";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="'.$row["id"].'">'.$row["code"].' | '.$row["name"].'</option>';
    }  
}

if($type == 'workersMenu'){
    echo '<option value="">Todos los Colaboradores</option>';
    $query = "select id, code, first, last from workers order by first,last";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="'.$row["id"].'">'.$row["code"].' | '.$row["first"].' '.$row["last"].'</option>';
    }  
}

if($type == 'workersMenuCode'){
    echo '<option value="">Todos los Colaboradores</option>';
    $query = "select id, code, first, last from workers order by first,last";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="'.$row["code"].'">'.$row["code"].' | '.$row["first"].' '.$row["last"].'</option>';
    }  
}

if($type == 'internsMenu'){
    echo '<option value="">Todos los Colaboradores</option>';
    $query = "select id, code, first, last from interns order by first,last";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="'.$row["code"].'">'.$row["code"].' | '.$row["first"].' '.$row["last"].'</option>';
    }  
}

if($type == 'clientsMenu'){
    echo '<option value="">Todos los Clientes</option>';
    $query = "select id, code, first, last, name, type from clients order by first, last";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        if($row['type'] == 1){
            echo '<option value="'.$row["code"].'">'.$row["code"].' | '.$row["first"].' '.$row["last"].'</option>';
        }else{
            echo '<option value="'.$row["code"].'">'.$row["code"].' | '.$row["name"].'</option>';
        }
    }  
}

if($type == 'requesterMenu'){
    echo '<option value="">Todos los Colaboradores</option>';
    $query = "select id, code, first, last from workers order by first, last";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="'.$row["code"].'">'.$row["code"].' | '.$row["first"].' '.$row["last"].'</option>';
    }  
}

if($type == 'routesMenu'){
    echo '<option value="">Todas las Rutas</option>';
    $query = "select id, newCode, companyName, lineName, locationName from units where active = '1' order by newCode";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="'.$row["id"].'">'.$row["newCode"].' | '.$row["companyName"].' '.$row["lineName"].' '.$row["locationName"].'</option>';
    }  
}

if($type == 'files'){
    
    $limit = $_POST['limit'];
    echo '<option value="">Seleccionar</option>'; 
    $query = "select * from filebox where user = '$_SESSION[userid]' order by id desc limit $limit";
    $result = mysqli_query($con, $query);
    while($row=mysqli_fetch_array($result)){
        echo '<option value="http://getpay.casapellas.com.ni/admin/visor.php?key='.$row['url'].'">'.$row['id']." | ".$row['title'].'</option>';
    } 
    
}

?>