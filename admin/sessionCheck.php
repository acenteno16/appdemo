<?

#$allowedRoles = ["admin", "imiexcel"];

session_start();

function hasAccess($roles) {
    foreach ($roles as $role) {
        if (isset($_SESSION[$role]) && $_SESSION[$role] === "active") {
            return true;
        }
    }
    return false;
}

if(hasAccess($allowedRoles)){
	
	/* if (!isset($_SESSION['2fa_verified']) || $_SESSION['2fa_verified'] !== true) {
        session_destroy();
        header("Location: ../?err=2fa_required");
        exit;
    }*/
    include("../connection.php");
}
else{
    session_destroy();
    header("Location: ../?err=5282");
    exit;
}

include('online.php');


/*
function hasAccess($roles) {
    if (!isset($_SESSION['roles']) || !is_array($_SESSION['roles'])) {
        return false;
    }

    foreach ($roles as $role) {
        if (in_array($role, $_SESSION['roles'])) {
            return true;
        }
    }

    return false;
}

if (hasAccess(["bankingDebtAccountantCompanies:$companyId"])) {
    // acceso permitido
}



*/

?>