<?php

namespace Mobileia\Expressive\Auth\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router;
use Mobileia\Expressive\Diactoros\MiaJsonResponse;
use Mobileia\Expressive\Diactoros\MiaJsonErrorResponse;

/**
 * Description of AuthOptionalHandler
 *
 * @author matiascamiletti
 */
class AuthOptionalHandler extends AuthHandler
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // obtener accessToken
        $accessToken = $this->getAccessToken($request);
        // Validar AccessToken
        $userId = $this->verifyAccessToken($accessToken);
        if($userId === false){
            return $handler->handle($request->withAttribute(\Mobileia\Expressive\Auth\Model\MIAUser::class, null));
        }
        // Obtener usuario
        $user = \Mobileia\Expressive\Auth\Repository\MIAUserRepository::findByMiaID($userId);
        // Obtener Usuario para guardarlo
        return $handler->handle($request->withAttribute(\Mobileia\Expressive\Auth\Model\MIAUser::class, $user));
    }
}