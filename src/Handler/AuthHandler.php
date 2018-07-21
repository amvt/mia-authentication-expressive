<?php

declare(strict_types=1);

namespace Mobileia\Expressive\Auth\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router;
use Mobileia\Expressive\Diactoros\MiaJsonResponse;
use Mobileia\Expressive\Diactoros\MiaJsonErrorResponse;

class AuthHandler implements MiddlewareInterface
{
    /**
     * @var \MobileIA\Auth\MobileiaAuth
     */
    private $service;

    public function __construct(\MobileIA\Auth\MobileiaAuth $mobileiaAuth) {
        $this->service = $mobileiaAuth;
    }
    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // obtener accessToken
        $accessToken = $this->getAccessToken($request);
        // Validar AccessToken
        $userId = $this->verifyAccessToken($accessToken);
        if($userId === false){
            return new MiaJsonErrorResponse(-2, 'No se ha podido conectar con la cuenta.');
        }
        // Obtener usuario
        $user = \Mobileia\Expressive\Auth\Repository\MIAUserRepository::findByMiaID($userId);
        // Obtener Usuario para guardarlo
        return $handler->handle($request->withAttribute(\Mobileia\Expressive\Auth\Model\MIAUser::class, $user));
    }
    /**
     * Verifica si el accessToken es valido
     * @return int|false
     */
    protected function verifyAccessToken($accessToken)
    {
        if($this->service->isValidAccessToken($accessToken)){
            return $this->service->getCurrentUserID();
        }
        return false;
    }
    /**
     * Devuelve el accessToken enviado
     * @return string
     */
    protected function getAccessToken(ServerRequestInterface $request)
    {
        return $this->getParam($request, 'access_token');
    }
    /**
     * 
     */
    protected function getParam(ServerRequestInterface $request, $key, $default = null)
    {
        // Obtener parametros
        $params = $request->getParsedBody();
        // verificar si fue enviado
        if(array_key_exists($key, $params)){
            return $params[$key];
        }
        // Obtener Querys
        $querys = $request->getQueryParams();
        if(array_key_exists($key, $querys)){
            return $querys[$key];
        }
        return $default;
    }
}
