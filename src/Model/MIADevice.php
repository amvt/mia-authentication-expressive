<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mobileia\Expressive\Auth\Model;

/**
 * Description of MIADevice
 *
 * @author matiascamiletti
 */
class MIADevice extends \Illuminate\Database\Eloquent\Model
{
    const TYPE_ANDROID = 1;
    const TYPE_IOS = 2;
    
    protected $table = 'mia_device';
    
    public $timestamps = false;
}
