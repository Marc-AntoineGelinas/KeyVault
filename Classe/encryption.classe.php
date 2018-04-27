<?php
class encryption
{
    function encrypterInfos($string, $action = 'e')
    {
        //TODO : Actuellement mettre une key et un iv qui a de l'allure
        $secret_key = 'jaimeleschats';
        $secret_iv = '256';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}