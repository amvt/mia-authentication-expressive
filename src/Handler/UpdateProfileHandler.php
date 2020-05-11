<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of UpdateProfileHandler
 *
 * @author matiascamiletti
 */
class UpdateProfileHandler extends \Mobileia\Expressive\Auth\Request\MiaAuthRequestHandler
{
    /**
     * Valores extras a guarda
     * @var array
     */
    protected $extras = [];
    
    public function __construct($extras = [])
    {
        $this->extras = $extras;
    }
    
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener usuario
        $item = $this->getUser($request);
        // Obtener valores
        $item->firstname = $this->getParam($request, 'firstname', '');
        $item->lastname = $this->getParam($request, 'lastname', '');
        $item->photo = $this->getParam($request, 'photo', '');
        $item->phone = $this->getParam($request, 'phone', '');
        // Procesar valores extras
        foreach($this->extras as $extra){
            $item->{$extra} = $this->getParam($request, $extra, '');
        }
        $item->save();
        // Devolvemos datos del usuario
        return new \Mobileia\Expressive\Diactoros\MiaJsonResponse($item->toArray());
    }
}