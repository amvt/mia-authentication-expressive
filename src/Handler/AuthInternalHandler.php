<?php

namespace Mobileia\Expressive\Auth\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mobileia\Expressive\Diactoros\MiaJsonErrorResponse;

/**
 * Description of AuthInternalHandler
 *
 * @author matiascamiletti
 */
class AuthInternalHandler extends \Mobileia\Expressive\Middleware\MiaBaseMiddleware
{
    /**
     * 
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // obtener accessToken
        $accessToken = $this->getAccessToken($request);
        // Buscamos el Token en la DB
        $row = \Mobileia\Expressive\Auth\Model\MIAAccessToken::where('access_token', $accessToken)->first();
        // Validar AccessToken
        if($row === null){
            return new MiaJsonErrorResponse(-2, 'No se ha podido conectar con la cuenta.');
        }
        // Obtener usuario
        $user = \Mobileia\Expressive\Auth\Repository\MIAUserRepository::findByID($row->user_id);
        // Obtener Usuario para guardarlo
        return $handler->handle($request->withAttribute(\Mobileia\Expressive\Auth\Model\MIAUser::class, $user));
    }
    /**
     * Devuelve el accessToken enviado
     * @return string
     */
    protected function getAccessToken(ServerRequestInterface $request)
    {
        return $this->getParam($request, 'access_token');
    }
}
