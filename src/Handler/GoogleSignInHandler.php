<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of GoogleSignInHandler
 *
 * @author matiascamiletti
 */
class GoogleSignInHandler extends \Mobileia\Expressive\Request\MiaRequestHandler
{
    /**
     *
     * @var array
     */
    protected $paramsGoogle = null;
    
    public function __construct($params)
    {
        $this->paramsGoogle = $params;
    }
    
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener parametros obligatorios
        $email = $this->getParam($request, 'email', '');
        $providerToken = $this->getParam($request, 'token', '');
        // Verificamos si el token es valido
        $service = new \Mobileia\Expressive\Auth\Helper\GoogleHelper();
        if(!$service->verifyAccessToken($this->paramsGoogle['client_signin_id'], $providerToken)){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-2, 'El token es incorrecto');
        }
        // Buscamos si este email tiene cuenta de Google
        $account = \Mobileia\Expressive\Auth\Model\MIAUser::where('email', $email)->first();
        if($account === null){
            return $this->register($request, $service->getUser());
        }else{
            return $this->login($request, $account);
        }
    }
    
    protected function register($request, $googleUser)
    {
        $email = $googleUser['email'] == '' ? $this->getParam($request, 'email', '') : $googleUser['email'];
        if($email == ''){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-2, 'No se ha enviado el email correcto!');
        }
        
        // Creamos cuenta
        $account = new \Mobileia\Expressive\Auth\Model\MIAUser();
        $account->mia_id = 0;
        $account->firstname = $this->getParam($request, 'firstname', '');
        $account->lastname = $this->getParam($request, 'lastname', '');
        $account->email = $email;
        $account->phone = $this->getParam($request, 'phone', '');
        $account->photo = $this->getParam($request, 'photo', '');
        $account->password = 'empty';
        $account->role = \Mobileia\Expressive\Auth\Model\MIAUser::ROLE_GENERAL;
        $account->save();
        
        // TODO: guardar token de google
        
        return $this->login($request, $account);
    }
    
    protected function login($request, $account)
    {
        // Generar nuevo AccessToken
        $token = new \Mobileia\Expressive\Auth\Model\MIAAccessToken();
        $token->user_id = $account->id;
        $token->access_token = \Mobileia\Expressive\Auth\Model\MIAAccessToken::generateAccessToken();
        $token->expires = \Mobileia\Expressive\Auth\Model\MIAAccessToken::generateExpires();
        $token->platform = $this->getParam($request, 'platform', \Mobileia\Expressive\Auth\Model\MIAAccessToken::PLATFORM_WEB);
        $token->version = $this->getParam($request, 'version', '');
        $token->device_data = $this->getParam($request, 'device_data', '');
        $token->save();
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse(
                array('access_token' => $token->toArray(), 'user' => $account->toArray())
        );
    }
}