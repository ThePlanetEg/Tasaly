<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPoster extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video_poster';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['video_id', 'poster_id'];

    public function posters()
    {
        return $this->belongsTo('App\Poster');
    }

}
