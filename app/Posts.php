<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Posts extends MongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'body', 'postDate'
    ];
}
