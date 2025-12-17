<?php

class TwoFactorAuth {
    public function generateSecret($length = 16) {
        $validChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'; // Base32
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $validChars[random_int(0, strlen($validChars) - 1)];
        }
        return $secret;
    }	

	public function getQRCodeGoogleUrl($label, $secret, $issuer = null) {
    // OJO: No codificamos el label ni el issuer manualmente
    $otpauth = "otpauth://totp/";
    
    if ($issuer) {
        $otpauth .= $issuer . ':' . $label;
        $otpauth .= "?secret=$secret&issuer=" . $issuer;
    } else {
        $otpauth .= $label . "?secret=$secret";
    }

    // Aquí sí codificamos toda la URL para Google Charts
    return "https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=" . urlencode($otpauth);
}

    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null) {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }
        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($calculatedCode === $code) {
                return true;
            }
        }
        return false;
    }

    private function getCode($secret, $timeSlice) {
        $secretKey = $this->base32Decode($secret);
        $time = pack('N*', 0) . pack('N*', $timeSlice);
        $hm = hash_hmac('sha1', $time, $secretKey, true);
        $offset = ord(substr($hm, -1)) & 0x0F;
        $hashpart = substr($hm, $offset, 4);
        $value = unpack('N', $hashpart)[1];
        $value = $value & 0x7FFFFFFF;
        $modulo = 1000000;
        return str_pad($value % $modulo, 6, '0', STR_PAD_LEFT);
    }

    private function base32Decode($b32) {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $b32 = strtoupper($b32);
        $l = strlen($b32);
        $n = 0;
        $j = 0;
        $binary = '';

        for ($i = 0; $i < $l; $i++) {
            $n = $n << 5;
            $n = $n + strpos($alphabet, $b32[$i]);
            $j = $j + 5;
            if ($j >= 8) {
                $j = $j - 8;
                $binary .= chr(($n & (0xFF << $j)) >> $j);
            }
        }
        return $binary;
    }
}

?>