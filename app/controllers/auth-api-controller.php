<?php
require_once '../API-RESTFULL/app/views/api.view.php' ;
class AuthApiController{
    private $chapter_model;
    private $api_view;
    private $data;
    private $authHelper;
    private $user_model;

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    function __construct()
    {
        $this->chapter_model = new ChapterModel() ;
        $this->api_view = new ApiView() ;
        $this->data = file_get_contents("php://input");
        $this->authHelper = new AuthHelper() ;
    }
    private function getData() {
        return json_decode($this->data);
    }
    function getToken($params = null){
        $basic = $this->authHelper->getAuthHeader();

        if(empty($basic)){
            $this->api_view->response("Unauthorized" , 401) ;
            return;
        }
        $basic = explode(" " , $basic) ;
        if($basic[0] !=  "Basic"){
            $this->api_view->response("La autenticación debe ser Basic", 401);
            return;
        }
         //validar usuario:contraseña
         $userpass = base64_decode($basic[1]); // user:pass
         $userpass = explode(":", $userpass);
         $user = $userpass[0];
         $pass = $userpass[1];
        
         if($user == "lauta" && $pass == 12345){
             //  crear un token
             $header = array(
                 'alg' => 'HS256',
                 'typ' => 'JWT'
             );
             $payload = array(
                 'id' => 1,
                 'name' => "lauta",
                 'exp' => time()+3600
             );
             $header = $this->base64url_encode(json_encode($header));
             $payload = $this->base64url_encode(json_encode($payload));
             $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
             $signature = $this->base64url_encode($signature);
             $token = "$header.$payload.$signature";
              $this->api_view->response($token);
         }else{
             $this->api_view->response('No autorizado', 401);
         }
     }
 

    }
