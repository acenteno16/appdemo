<?

function sanitizeInput($val, $con) {
    if (is_array($val)) {
        $sanitizedArray = [];
        foreach ($val as $key => $value) {
            if (is_array($value)) {
                // Llamada recursiva para sanitizar arrays multidimensionales
                $sanitizedArray[$key] = sanitizeInput($value, $con);
            } else {
                // Sanitizar valores individuales
                $sanitizedArray[$key] = is_string($value) 
                    ? mysqli_real_escape_string($con, trim($value)) 
                    : $value;
            }
        }
        return $sanitizedArray;
    } else {
        return is_string($val) 
            ? mysqli_real_escape_string($con, trim($val)) 
            : $val;
    }
}

function sanitizeCkeditorInput($value, $con) {
   
	$value = trim($value);
    // (Opcional) Limpiar párrafos vacíos tipo <p>\r\n\r\n</p>
    $value = preg_replace('/<p>\s*<\/p>/', '', $value);
    return $value;
}

function sanitizedOutput($val) {
    if (is_array($val)) {
        return array_map('sanitizedOutput', $val);
    }
    return is_string($val) 
        ? htmlspecialchars($val, ENT_QUOTES, 'UTF-8') 
        : $val;
}

?>