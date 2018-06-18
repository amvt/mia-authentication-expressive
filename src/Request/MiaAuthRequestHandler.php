<?php namespace Mobileia\Expressive\Auth\Request;


/**
 * Description of MiaAuthRequestHandler
 *
 * @author matiascamiletti
 */
abstract class MiaAuthRequestHandler extends \Mobileia\Expressive\Request\MiaRequestHandler
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
