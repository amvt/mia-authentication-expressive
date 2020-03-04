<?php namespace Mobileia\Expressive\Auth\Repository;

class MIAUserRepository
{
    public static function findByID($id)
    {
        return \Mobileia\Expressive\Auth\Model\MIAUser::where('id', $miaId)->first();
    }
    
    public static function findByMiaID($miaId)
    {
        return \Mobileia\Expressive\Auth\Model\MIAUser::where('mia_id', $miaId)->first();
    }
    
    public static function findByEmail($email)
    {
        return \Mobileia\Expressive\Auth\Model\MIAUser::where('email', $email)->first();
    }
}