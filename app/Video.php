<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'video', 'cast', 'country', 'duration', 'rating', 'year', 'type', 'featured', 'staff_picks', 'trending', 'season_id'];

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'video_genre');
    }

    public function posters()
    {
        return $this->belongsToMany('App\Poster', 'video_poster');
    }

    // public function getVideoAttribute($value)
    // {
    //     if($value != '')
    //         return 'https://s3-us-west-2.amazonaws.com/newcenturyplatform/uploads/'.$value;
    //     else
    //         return $value;
    // }

}
