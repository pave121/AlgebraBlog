<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = ['title', 'content', 'user_id', 'post_id'];
    
    /**
    * save new post 
    *
    * @param array $data
    * @return object Post -- da ne moramo 2 zahtjeva bazi slati, odmah ga imamo
    * 
    */
    public function saveComment($data = array())
    {
        return $this->create($data);
    }
    
    /**
    * update post 
    *
    * @param array $data
    * @return void
    *
    */
    
    public function updateComment($data)
    {
        $this->update($data);
    }
    
     /**
     * return user relationship
     *
     * 
     */
    public function user()
    {   //model user komunicira s bazom
        return $this->belongsTo('App\Models\User');
    }
    
     /**
     * return post relationship
     *
     * 
     */
    public function post()
    {   
        return $this->belongsTo('App\Models\Post');
    }
}
