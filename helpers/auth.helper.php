<?php
require_once '../API-RESTFULL/apiAuth/secret.php';
class AuthHelper
{

    function getToken()
    {
        $auth = $this->getAuthHeader();
        $auth = explode(" ", $auth);
        if ($auth[0] != "Bearer" || count($auth) != 2) {
            return array();
        }
        $token = explode(".", $auth[1]);
        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];
        $secret = getSecret();
        $new_signature = hash_hmac('SHA256', "$header.$payload", $secret, true);
        $new_signature = base64url_encode($new_signature);
        $payload = json_decode(base64_decode($payload));
        if ($signature != $new_signature || !isset($payload) || $payload->exp < time())
            return array();
        return $payload;        
    }
    function isLogged()
    {
        $payload = $this->getToken();
        if (isset($payload->id))
            return true;
        else
            return false;
    }
    function getAuthHeader()
    {
        $header = "";
        if (isset($_SERVER['HTTP_AUTHORIZATION']))
            $header = $_SERVER['HTTP_AUTHORIZATION'];
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
            $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        return $header;
    }
}
