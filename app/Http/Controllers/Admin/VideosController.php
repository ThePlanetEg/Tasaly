<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Show;
use App\Video;
use App\Season;
use App\Genre;
use App\Poster;
use App\VideoPoster;
use Illuminate\Contracts\Filesystem\Filesystem;
use Vinkla\Vimeo\Facades\Vimeo;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        $shows = Show::lists('name', 'id');
        $genres = Genre::lists('genre', 'id');
        return view('admin.video.create', compact('shows', 'genres'));
    }

    public function getSeasons(Request $request)
    {
        $inputs = $request->all();
        $seasons = Season::where('show_id', '=', $inputs['id'])->get();
        // return view('admin.movie.showTime', compact('show_times','index'));
        return $seasons;
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
        'title' => 'required|unique:videos|max:255',
        'type'  =>  'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        $inputs = $request->all();
        if(isset($inputs['featured']) && $inputs['featured'] == 'on')
        {
            $inputs['featured'] = 1;
        }

        if(isset($inputs['trending']) && $inputs['trending'] == 'on')
        {
            $inputs['trending'] = 1;
        }

        if(isset($inputs['staff_picks']) && $inputs['staff_picks'] == 'on')
        {
            $inputs['staff_picks'] = 1;
        }
        
        if($inputs['type'] == 'movie')
        {
            $inputs['season_id'] = 0;
        }

        $video = new Video($inputs);
        if($request->hasFile('video'))
        {
            $video['video'] = Vimeo::upload($request->file('video')->getPathName(), false);
            $video['video'] = str_replace('/videos/', '', $video['video']);
        }
        $video->save();
        if(isset($inputs['genres']) && count($inputs['genres']))
            $video->genres()->attach($inputs['genres']);
        if($request->hasFile('posters'))
        {
            $posters = $request->file('posters');
            foreach ($posters as $poster) {
                $poster_image = $this->upload($poster, 'uploads/posters/', 'image');
                $poster = new Poster(['image' => $poster_image]);
                $poster->save();
                $video_poster = new VideoPoster([
                            'poster_id'  => $poster->id,
                            'video_id' => $video->id
                        ]);
                $video_poster->save();
                }
        }
        session()->flash('flash_message', 'Video Added!');
        return redirect('admin/videos');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $video_embed = Vimeo::request('/me/videos/'.$video->video, ['per_page' => 1], 'GET');
        $video_embed = $video_embed['body']['embed']['html'];
        $shows = Show::lists('name', 'id');
        $genres = Genre::lists('genre', 'id');
        return view('admin.video.edit', compact('video', 'shows', 'genres', 'video_embed'));
    }


    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
        'title' => 'required|max:255',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        $inputs = $request->all();
        if($inputs['type'] == 'movie')
        {
            $inputs['show_id'] = 0;
            $inputs['season_id'] = 0;
        }

        $video = Video::findOrFail($id);
        
        // if(isset($video['video']))
        //     $video['video'] = $this->uploadFileToS3($request->file('video'));
        $video->update($inputs);

        if(isset($inputs['genres']) && count($inputs['genres'])){
            $db_genres = $video->genres->lists('id')->toArray();

            foreach ($inputs['genres'] as $genre) {
                if(in_array($genre, $db_genres))
                    unset($db_genres[array_search($genre, $db_genres)]);
                else
                    $video->genres()->attach($genre);
            }

            if(!empty($db_genres))
                $video->genres()->detach($db_genres);
        }

        if($request->hasFile('posters'))
        {
            $posters = $request->file('posters');
            foreach ($posters as $poster) {
                $poster_image = $this->upload($poster, 'uploads/posters/', 'image');
                $poster = new Poster(['image' => $poster_image]);
                $poster->save();
                $video_poster = new VideoPoster([
                            'poster_id'  => $poster->id,
                            'video_id' => $video->id
                        ]);
                $video_poster->save();
                }
        }

        session()->flash('flash_message', 'Video updated!');
        return redirect('videos');
    }

    public function destroy($id)
    {
        $video = Video::find($id);    
        $video->delete();
        session()->flash('flash_message', 'Video deleted!');
        return redirect('videos');
    }

    public function saveFeatured()
    {
        if($_POST['flag'] == 1)
        {
            $video = Video::findOrFail($_POST['id']);
            $video->featured = 1;
            $video->save();
        }
        else
        {
            $video = Video::findOrFail($_POST['id']);
            $video->featured = 0;
            $video->save();
        }
        return;
    }

    public function saveStaffPicks()
    {
        if($_POST['flag'] == 1)
        {
            $video = Video::findOrFail($_POST['id']);
            $video->staff_picks = 1;
            $video->save();
        }
        else
        {
            $video = Video::findOrFail($_POST['id']);
            $video->staff_picks = 0;
            $video->save();
        }
        return;
    }

    public function saveTrending()
    {
        if($_POST['flag'] == 1)
        {
            $video = Video::findOrFail($_POST['id']);
            $video->trending = 1;
            $video->save();
        }
        else
        {
            $video = Video::findOrFail($_POST['id']);
            $video->trending = 0;
            $video->save();
        }
        return;
    }

    public function upload($file, $dir)
    {
        $file_name = date('YmdHis').'-'.$file->getClientOriginalName();
        $file->move($dir, $file_name);
        return $file_name;
    }

    public function uploadFileToS3($file)
    {
        $file_name = time() .'.'. $file->getClientOriginalExtension();
        $s3 = \Storage::disk('s3');
        $filePath = '/uploads/' . $file_name;
        $s3->put($filePath, file_get_contents($file), 'public');
        return $file_name;
    }

    public function getFileFromS3($file_name)
    {
        $file = 'https://s3-us-west-2.amazonaws.com/newcenturyplatform/uploads/'.$file_name;
        return $file;
    }
}
