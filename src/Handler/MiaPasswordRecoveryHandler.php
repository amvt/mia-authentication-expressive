<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of MiaPasswordRecoveryHandler
 *
 * @author matiascamiletti
 */
class MiaPasswordRecoveryHandler extends \Mobileia\Expressive\Request\MiaRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener parametros obligatorios
        $email = $this->getParam($request, 'email', '');
        $password = $this->getParam($request, 'password', '');
        $token = $this->getParam($request, 'token', '');
        // Verificar si ya existe la cuenta
        $account = \Mobileia\Expressive\Auth\Model\MIAUser::where('email', $email)->first();
        if($account === null){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'No existe este mail');
        }
        // Buscar si existe el token
        $token = \Mobileia\Expressive\Auth\Model\MIARecovery::where('user_id', $account->id)->where('token', $token)->first();
        if($token === null){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'El token es incorrecto');
        }
        $recovery->status = \Mobileia\Expressive\Auth\Model\MIARecovery::STATUS_USED;
        $recovery->save();
        // Guardar nueva contraseña
        $account->password = \Mobileia\Expressive\Auth\Model\MIAUser::encryptPassword($password);
        $account->save();
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse(true);
    }
}

