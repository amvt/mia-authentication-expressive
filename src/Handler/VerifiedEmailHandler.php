<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of VerifiedEmailHandler
 *
 * @author matiascamiletti
 */
class VerifiedEmailHandler extends \Mobileia\Expressive\Request\MiaRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener parametros obligatorios
        $email = $this->getParam($request, 'email', '');
        $token = $this->getParam($request, 'token', '');
        // Verificar si ya existe la cuenta
        $account = \Mobileia\Expressive\Auth\Model\MIAUser::where('email', $email)->first();
        if($account === null){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'No existe este mail');
        }
        // Buscar si existe el token
        $recovery = \Mobileia\Expressive\Auth\Model\MIAActive::where('user_id', $account->id)->where('token', $token)->first();
        if($recovery === null){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'El token es incorrecto');
        }
        $recovery->status = \Mobileia\Expressive\Auth\Model\MIAActive::STATUS_USED;
        $recovery->save();
        // Guardar nuevo estado
        $account->status = 1;
        $account->save();
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse(true);
    }
}

