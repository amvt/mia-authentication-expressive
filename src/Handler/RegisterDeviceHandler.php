<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of RegisterDeviceHandler
 *
 * @author matiascamiletti
 */
class RegisterDeviceHandler extends \Mobileia\Expressive\Auth\Request\MiaAuthRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener token
        $token = $this->getParam($request, 'token', '');
        $type = $this->getParam($request, 'type', '0');
        // Obtener usuario
        $user = $this->getUser($request);
        // Registrar nuevo token
        $device = \Mobileia\Expressive\Auth\Model\MIADevice::where('user_id', $user->id)->first();
        if($device === null){
            $device = new \Mobileia\Expressive\Auth\Model\MIADevice();
            $device->user_id = $user->id;
        }
        $device->device_type = $type;
        $device->device_token = $token;
        $device->save();
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse(true);
    }
}