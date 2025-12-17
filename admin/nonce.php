<?php
require('headers.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba CSP con Nonce</title>
</head>
<body>

    <h1>Prueba de Content-Security-Policy con Nonce</h1>

    <!-- ✅ Este script debería funcionar -->
    <script nonce="<?= $nonce ?>">
        alert("✅ Este script con nonce fue ejecutado correctamente.");
    </script>

    <!-- ❌ Este script debería ser bloqueado por la CSP -->
    <script nonce="<?= $nonce ?>a">
        alert("❌ Este script sin nonce debería estar bloqueado.");
    </script>

</body>
</html>
