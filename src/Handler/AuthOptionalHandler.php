<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of AuthOptionalHandler
 *
 * @author matiascamiletti
 */
class AuthOptionalHandler extends AuthHandler
{
    public function process(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Server\RequestHandlerInterface $handler)
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