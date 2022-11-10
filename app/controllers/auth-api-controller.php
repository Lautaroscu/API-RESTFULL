<?php
require_once '../API-RESTFULL/app/views/api.view.php';
require_once '../API-RESTFULL/app/models/user.model.php';
require_once '../API-RESTFULL/apiAuth/secret.php';
function base64url_encode($data)
{
return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
class AuthApiController
{
private $api_view;
private $data;
private $authHelper;
private $user_model;
function __construct()
{
    $this->chapter_model = new ChapterModel();
    $this->api_view = new ApiView();
    $this->data = file_get_contents("php://input");
    $this->authHelper = new AuthHelper();
    $this->user_model = new UserModel();
}
private function getData()
{
    return json_decode($this->data);
}
function getToken($params = null)
{
    $basic = $this->authHelper->getAuthHeader();

    if (empty($basic)) {
        $this->api_view->response("Unauthorized", 401);
        return;
    }
    $basic = explode(" ", $basic);
    if ($basic[0] !=  "Basic") {
        $this->api_view->response("La autenticación debe ser Basic", 401);
        return;
    }
    //validar usuario:contraseña
    $userpass = base64_decode($basic[1]); // user:pass
    $userpass = explode(":", $userpass);
    $user = $userpass[0];
    $pass = $userpass[1];
    $UserDb = $this->user_model->getUser($user);
    $name = $UserDb->email;

    if ($UserDb  && password_verify($pass, $UserDb->password)) {
        //  crear un token
        $header = array(
            'alg' => 'HS256',
            'typ' => 'JWT'
        );
        $payload = array(
            "id" => 1,
            "name" => $name,
            "exp" => time() + 3000
        );
        $secret = getSecret();
        $header = base64url_encode(json_encode($header));
        $payload = base64url_encode(json_encode($payload));
        var_dump($secret);
        $signature = hash_hmac('SHA256', "$header.$payload", $secret, true);
        $signature = base64url_encode($signature);
        $token = "$header.$payload.$signature";

        $this->api_view->response($token);
    } else {
        $this->api_view->response('No autorizado', 401);
    }
}
}
