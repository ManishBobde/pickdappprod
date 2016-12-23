<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';


    public function category()
    {
    return $this->belongsTo('PD\Categories\Categories');
    }
}
