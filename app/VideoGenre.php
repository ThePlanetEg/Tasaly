<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGenre extends Model
{
    /* The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video_genre';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['video_id', 'genre_id'];

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Video');
    }
}
