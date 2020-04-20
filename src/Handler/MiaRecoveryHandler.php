<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of MiaRecoveryHandler
 *
 * @author matiascamiletti
 */
class MiaRecoveryHandler extends \Mobileia\Expressive\Request\MiaRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener parametros obligatorios
        $email = $this->getParam($request, 'email', '');
        // Verificar si ya existe la cuenta
        $account = \Mobileia\Expressive\Auth\Model\MIAUser::where('email', $email)->first();
        if($account === null){
            return new \Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'Este email no existe');
        }
        // Generar registro de token
        $token = \Mobileia\Expressive\Auth\Model\MIAUser::encryptPassword($user->id . '_' . time() . '_' . $user->id);
        $recovery = new \Mobileia\Expressive\Auth\Model\MIARecovery();
        $recovery->user_id = $account->id;
        $recovery->status = \Mobileia\Expressive\Auth\Model\MIARecovery::STATUS_PENDING;
        $recovery->token = $token;
        $recovery->save();
        
        /* @var $sendgrid \Mobileia\Expressive\Mail\Service\Sendgrid */
        $sendgrid = $request->getAttribute('Sendgrid');
        $sendgrid->send($account->email, 'Recovery Password', 'recoveryPassword.phtml', [
            'firstname' => $account->firstname,
            'token' => $token
        ]);
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse(true);
    }
}
