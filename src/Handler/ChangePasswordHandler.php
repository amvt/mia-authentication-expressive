<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of ChangePasswordHandler
 *
 * @author matiascamiletti
 */
class ChangePasswordHandler extends \Mobileia\Expressive\Auth\Request\MiaAuthRequestHandler
{
    
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener parametros
        $password = $this->getParam($request, 'password', '');
        // Obtener usuario
        $item = $this->getUser($request);
        // Cambiar valores
        $item->password = \Mobileia\Expressive\Auth\Model\MIAUser::encryptPassword($password);
        // Guardar nueva contraseña
        $item->save();
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse(true);
    }
}
