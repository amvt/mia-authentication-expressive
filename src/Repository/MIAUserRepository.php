<?php namespace Mobileia\Expressive\Auth\Repository;

class MIAUserRepository
{
    public static function findByMiaID($miaId)
    {
        return \Mobileia\Expressive\Auth\Model\MIAUser::where('mia_id', $miaId)->first();
    }
}