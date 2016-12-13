<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];

    public function getImageAttribute($value)
    {
        return url('uploads/posters/'.$value);
    }
}
