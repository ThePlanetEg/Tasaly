<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function seasons()
    {
        return $this->hasmany('App\Season');
    }

    public function videos()
    {
        return $this->hasmany('App\Video');
    }

}
