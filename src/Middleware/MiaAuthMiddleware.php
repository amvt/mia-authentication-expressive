<?php

namespace Mobileia\Expressive\Auth\Middleware;
/**
 * Description of MiaAuthMiddleware
 *
 * @author matiascamiletti
 */
abstract class MiaAuthMiddleware extends \Mobileia\Expressive\Middleware\MiaBaseMiddleware
{
    /**
     * Obtiene usuario logueado
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Mobileia\Expressive\Auth\Model\MIAUser
     */
    protected function getUser(\Psr\Http\Message\ServerRequestInterface $request)
    {
        return $request->getAttribute(\Mobileia\Expressive\Auth\Model\MIAUser::class);
    }
}