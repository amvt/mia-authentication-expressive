<?php

namespace Mobileia\Expressive\Auth\Handler;

/**
 * Description of BaseAuthHandler
 *
 * @author matiascamiletti
 */
class BaseMobileiaAuthHandler extends \Mobileia\Expressive\Auth\Request\MiaAuthRequestHandler
{
    /**s
     * @var \MobileIA\Auth\MobileiaAuth
     */
    public $mobileiaAuth;
    /**
     * @param \MobileIA\Auth\MobileiaAuth|null $mobileiaAuth
     */
    public function __construct($mobileiaAuth = null)
    {
        $this->mobileiaAuth = $mobileiaAuth;
    }
}
