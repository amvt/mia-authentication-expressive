<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of FetchProfileHandler
 *
 * @author matiascamiletti
 */
class FetchProfileHandler extends \Mobileia\Expressive\Request\MiaRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener cuenta seleccionada
        $miaId = $this->getParam($request, 'id', 0);
        // Verificamos que se haya enviado los datos del usuario
        if($miaId <= 0){
            return new Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'No se ha enviado el ID');
        }
        // Buscar por el MIA_ID
        $user = \Mobileia\Expressive\Auth\Model\MIAUser::where('mia_id', $miaId)->first();
        // Verificamos si ya existe este MIA_ID
        if($user === null){
            return new Mobileia\Expressive\Diactoros\MiaJsonErrorResponse(-1, 'No se ha encontrado el usuario');
        }
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse($user->toArray());
    }
}