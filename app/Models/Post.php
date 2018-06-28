<?php

namespace App\Models;

//use van klase je za servis
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    //koristi trait Sluggable
    use Sluggable;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'user_id'];
    
    /**
    * save new post 
    *
    * @param array $data
    * @return object Post -- da ne moramo 2 zahtjeva bazi slati, odmah ga imamo
    * 
    */
    public function savePost($data = array())
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
    
    public function updatePost($data)
    {
        $this->update($data);
    }
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
    public function comment()
    {   //model user komunicira s bazom
        return $this->hasMany('App\Models\Comment');
    }
}
