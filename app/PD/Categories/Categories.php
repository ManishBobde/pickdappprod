<?php namespace PD\Categories;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';


    /**
     * The roles that belong to the user.
     */
    public function devices()
    {
        return $this->belongsToMany('App\AndroidDevice');
    }

    public function posts()
    {
    return $this->hasMany('App\Post');
    }

    public function facts()
    {
        return $this->hasMany('App\Fact');
    }
}
