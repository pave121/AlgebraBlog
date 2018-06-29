<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
     /**
     * Return the posts relationship
     *
     * 
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    
    /**
     * Return the comments relationship
     *
     * 
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    
}
