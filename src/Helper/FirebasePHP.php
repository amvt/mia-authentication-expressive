<?php

namespace Mobileia\Expressive\Auth\Helper;

use Kreait\Firebase\Factory;
use Firebase\Auth\Token\Exception\InvalidToken;

/**
 * Description of Firebase
 *
 * @author matiascamiletti
 */
class FirebasePHP 
{
    protected $service = null;
    
    public function __construct($filePath)
    {
        $this->service = (new Factory)->withServiceAccount($filePath);
    }
    /**
     * 
     * @param type $idToken
     * @return \Kreait\Firebase\Auth\UserRecord
     */
    public function verifyIdToken($idToken) 
    {
        $auth = $this->service->createAuth();

        try {
            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->getClaim('sub');
            return $auth->getUser($uid);
        } catch (\InvalidArgumentException $e) {
            //echo 'The token could not be parsed: '.$e->getMessage();
            return null;
        } catch (InvalidToken $e) {
            //echo 'The token is invalid: '.$e->getMessage();
            return null;
        }

        return null;
    }
}