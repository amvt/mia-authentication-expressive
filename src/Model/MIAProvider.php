<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Auth\Model;

/**
 * Description of MIAProvider
 *
 * @author matiascamiletti
 */
class MIAProvider extends \Illuminate\Database\Eloquent\Model
{
    const PROVIDER_GOOGLE = 1;
    const PROVIDER_APPLE = 2;
    const PROVIDER_FACEBOOK = 3;
    const PROVIDER_TWITTER = 4;
    
    protected $table = 'mia_provider';
}
