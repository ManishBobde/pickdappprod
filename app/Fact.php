<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facts';

    public function category()
    {
        return $this->belongsTo('PD\Categories\Categories');
    }
}
