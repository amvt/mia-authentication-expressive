<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of FetchProfileHandler
 *
 * @author matiascamiletti
 */
class FetchProfileHandler extends \Mobileia\Expressive\Auth\Request\MiaAuthRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener usuario
        $user = $this->getUser($request);
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse($user->toArray());
    }
}