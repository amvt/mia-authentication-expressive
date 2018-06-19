<?php namespace Mobileia\Expressive\Auth\Model;

class MIAUser extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_user';
    /**
     * Campos que se ocultan al obtener los registros
     * @var array
     */
    protected $hidden = ['deleted'];
}