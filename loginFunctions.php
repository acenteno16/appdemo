<? 

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function getDeviceAndBrowser() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Detectar navegador
    if (strpos($userAgent, 'Firefox') !== false) {
        $browser = 'Firefox';
    } elseif (strpos($userAgent, 'Chrome') !== false) {
        $browser = 'Chrome';
    } elseif (strpos($userAgent, 'Safari') !== false) {
        $browser = 'Safari';
    } elseif (strpos($userAgent, 'Edge') !== false) {
        $browser = 'Edge';
    } elseif (strpos($userAgent, 'Opera') !== false || strpos($userAgent, 'OPR') !== false) {
        $browser = 'Opera';
    } else {
        $browser = 'Unknown';
    }

    // Detectar dispositivo
    if (strpos($userAgent, 'Mobile') !== false) {
        $device = 'Mobile';
    } elseif (strpos($userAgent, 'Tablet') !== false) {
        $device = 'Tablet';
    } else {
        $device = 'Desktop';
    }

    return ['device' => $device, 'browser' => $browser];
}

function getPreferredLanguage() {
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        return $langs[0]; // Devuelve el idioma principal
    }
    return 'Unknown';
}

?>