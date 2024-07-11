<?php 
 
class App{

    function in($string) {
        $cipher = "AES-256-CBC";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext = openssl_encrypt($string, $cipher, "Benny & Hardika", OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext, "Benny & Hardika", true);
        return base64_encode($iv . $hmac . $ciphertext);
    }
    
    function out($string) {
        $cipher = "AES-256-CBC";
        $c = base64_decode($string);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext, $cipher, "Benny & Hardika", OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext, "Benny & Hardika", true);
        if (hash_equals($hmac, $calcmac)) {
            return $original_plaintext;
        }
        return false;
    }
}