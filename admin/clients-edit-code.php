<?

require('headers.php');
$allowedRoles = ['admin', 'providers'];
require("sessionCheck.php"); 
require('sanitize.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$clienttype = isset($_POST['clienttype']) ? sanitizeInput($_POST['clienttype'], $con) : '';
$ccode = isset($_POST['ccode']) ? sanitizeInput($_POST['ccode'], $con) : '';
$cfirst = isset($_POST['cfirst']) ? sanitizeInput($_POST['cfirst'], $con) : '';
$clast = isset($_POST['clast']) ? sanitizeInput($_POST['clast'], $con) : '';
$caddress = isset($_POST['caddress']) ? sanitizeInput($_POST['caddress'], $con) : '';
$ccity = isset($_POST['ccity']) ? sanitizeInput($_POST['ccity'], $con) : '';
$cnid = isset($_POST['cnid']) ? sanitizeInput($_POST['cnid'], $con) : '';
$cemail = isset($_POST['cemail']) ? sanitizeInput($_POST['cemail'], $con) : '';
$cphone = isset($_POST['cphone']) ? sanitizeInput($_POST['cphone'], $con) : '';
$ccode2 = isset($_POST['ccode2']) ? sanitizeInput($_POST['ccode2'], $con) : '';
$cname = isset($_POST['cname']) ? sanitizeInput($_POST['cname'], $con) : '';
$cruc = isset($_POST['cruc']) ? sanitizeInput($_POST['cruc'], $con) : '';
$cemail2 = isset($_POST['cemail2']) ? sanitizeInput($_POST['cemail2'], $con) : '';
$cphone2 = isset($_POST['cphone2']) ? sanitizeInput($_POST['cphone2'], $con) : '';
$caddress2 = isset($_POST['caddress2']) ? sanitizeInput($_POST['caddress2'], $con) : '';
$ccity2 = isset($_POST['ccity2']) ? sanitizeInput($_POST['ccity2'], $con) : '';
$crfirst = isset($_POST['crfirst']) ? sanitizeInput($_POST['crfirst'], $con) : '';
$crlast = isset($_POST['crlast']) ? sanitizeInput($_POST['crlast'], $con) : '';
$crnid = isset($_POST['crnid']) ? sanitizeInput($_POST['crnid'], $con) : '';
$cremail = isset($_POST['cremail']) ? sanitizeInput($_POST['cremail'], $con) : '';
$crphone = isset($_POST['crphone']) ? sanitizeInput($_POST['crphone'], $con) : '';

//Clean Client
$query_clean = "UPDATE clients SET 
    type = '', code = '', first = '', last = '', address = '', city = '', nid = '', 
    email = '', phone = '', name = '', ruc = '', rfirst = '', rlast = '', 
    rnid = '', remail = '', rphone = ''
    WHERE id = ?";

$stmt_clean = $con->prepare($query_clean);
$stmt_clean->bind_param("i", $id); // Usa "s" si $id es string
$result_clean = $stmt_clean->execute();

if ($clienttype == 1) {
    $query = "UPDATE clients SET 
        type = '1', 
        code = ?, 
        first = ?, 
        last = ?, 
        address = ?, 
        city = ?, 
        nid = ?, 
        email = ?, 
        phone = ? 
        WHERE id = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssssssi", $ccode, $cfirst, $clast, $caddress, $ccity, $cnid, $cemail, $cphone, $id);
    $result = $stmt->execute();

} else {
    $query = "UPDATE clients SET 
        type = '2', 
        code = ?, 
        address = ?, 
        city = ?, 
        email = ?, 
        phone = ?, 
        name = ?, 
        ruc = ?, 
        rfirst = ?, 
        rlast = ?, 
        rnid = ?, 
        remail = ?, 
        rphone = ? 
        WHERE id = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssssssssssi", $ccode2, $caddress2, $ccity2, $cemail2, $cphone2, $cname, $cruc, $crfirst, $crlast, $crnid, $cremail, $crphone, $id);
    $result = $stmt->execute();
}


$today = date("Y-m-d");
$now = date('Y-m-d H:i:s');
$now2 = date('H:i:s');
$userid = $_SESSION['userid'];

//Stages
$gcomments = "El cliente ha sido actualizado.";

$querytime = "INSERT INTO clientstimes 
    (client, today, now, now2, userid, comment) 
    VALUES (?, ?, ?, ?, ?, ?)";

$stmttime = $con->prepare($querytime);
$stmttime->bind_param("isssss", $id, $today, $now, $now2, $_SESSION['userid'], $gcomments);
$resulttime = $stmttime->execute();

header('location: clients.php');

?>