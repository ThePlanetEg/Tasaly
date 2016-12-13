<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Show;
use App\Season;
use Validator;
use Image;
use File;

class ShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Show::get();
        return view('admin.show.index', compact('shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.show.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
        'name' => 'required|unique:shows|max:255',
        'seasons' => 'required',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $inputs = $request->all();
        $show = new Show($inputs);
        $show->save();
        for ($i=1; $i < $inputs['seasons_number']+1; $i++) { 
            $season = new Season(['name' => 'Season '.$i, 'show_id' => $show->id]);
            $season->save();
        }
        session()->flash('flash_message', 'Show Added!');
        return redirect('shows');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = Show::findOrFail($id);
        return view('admin.show.edit', compact('show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
        'name' => 'required|max:255',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        
        $show = Show::findOrFail($id);
        $inputs = $request->all();
        $show->update($inputs);
        session()->flash('flash_message', 'Show updated!');
        return redirect('shows');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Show::find($id);    
        $show->delete();
        session()->flash('flash_message', 'Show deleted!');
        return redirect('shows');
    }

    public function upload($request, $dir)
    {
        $inputs = $request->all();
        $file_name = date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
        $image = Image::make($inputs['image']->getRealPath());
        $image->save($dir.$file_name)
            ->fit(1000, 560)
            ->save($dir.'image-'.$file_name);
        return $file_name;
    }

}
