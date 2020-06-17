<?php

namespace Mobileia\Expressive\Auth\Helper;

/**
 * Description of GoogleHelper
 *
 * @author matiascamiletti
 */
class GoogleHelper 
{
    /**
     * Información del usuario verificado
     * @var array
     */
    protected $payload;
    /**
     * Verifica si el token de google es correcto
     * @param int $appId
     * @param string $googleToken
     * @return boolean
     */
    public function verifyAccessToken($clientId, $googleToken)
    {
        try {
            // Obtener datos desde la URL
            $string = file_get_contents('https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=' . $googleToken);
            // Convertir string en objeto
            $this->payload = \Zend\Json\Json::decode($string, \Zend\Json\Json::TYPE_ARRAY);
            // Validar si es correcto
            if($this->payload['aud'] != '' && $this->payload['aud'] != null){
                return true;
            }
            return false;
        } catch (\Exception $exc) {
            return false;
        }
    }
    /**
     * Obtiene la información del usuario verificado
     * @return array
     */
    public function getUser()
    {
        return $this->payload;
    }
}