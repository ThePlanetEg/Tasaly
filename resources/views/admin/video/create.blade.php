@extends('backend')

@section('content')

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Create new video
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{ URL::to('/admin') }}">Home</a></li>
            <li><a href="{{ URL::to('admin/videos') }}">Video</a></li>
            <li class="active"> Create video </li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Create video
                </header>
                <div class="panel-body">
                    @include('admin.partials.error')
                    <div class="form">
                        {!! Form::open(['url' => 'admin/videos/create', 'id' => 'editpage', 'class' => 'cmxform form-horizontal tasi-form', 'files' =>  TRUE]) !!}
                            <div class="form-group ">
                                <label for="title" class="control-label col-lg-2">Title</label>
                                <div class="col-lg-5">
                                    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="desc" class="control-label col-lg-2">Description</label>
                                <div class="col-lg-5">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'desc']) !!}
                                </div>
                            </div>
                            <div class="form-group" id="video">
                                <label for="file-4" class="control-label col-lg-2">Video</label>
                                <div class="col-lg-10">
                                    {!! Form::file('video', ['class' => 'file', 'accept' => 'video/*']) !!}
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="posters" class="control-label col-lg-2">Posters</label>
                                <div class="col-lg-10">
                                    {!! Form::file('posters[]', ['class' => 'file', 'accept' => 'image/*', 'multiple'=>true]) !!}
                                </div>
                            </div> 
                            <div class="form-group ">
                                <label for="cast" class="control-label col-lg-2">Cast</label>
                                <div class="col-lg-5">
                                    {!! Form::text('cast', null, ['class' => 'form-control', 'id' => 'cast']) !!}
                                </div>
                            </div>  
                            <div class="form-group ">
                                <label for="country" class="control-label col-lg-2">Country</label>
                                <div class="col-lg-5">
                                    {!! Form::text('country', null, ['class' => 'form-control', 'id' => 'country']) !!}
                                </div>
                            </div>  
                            <div class="form-group ">
                                <label for="duration" class="control-label col-lg-2">Duration</label>
                                <div class="col-lg-5">
                                    {!! Form::text('duration', null, ['class' => 'form-control', 'id' => 'duration', 'placeholder' => 'ex: 2H 40M']) !!}
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="year" class="control-label col-lg-2">Year</label>
                                <div class="col-md-5">
                                    <div class="input-append date dpYears">
                                        <input name="year" type="text" readonly="" size="16" class="form-control">
                                          <span class="input-group-btn add-on">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                          </span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="rating" class="control-label col-lg-2">Rating</label>
                                <div class="col-lg-5">
                                    {!! Form::text('rating', null, ['class' => 'form-control', 'id' => 'rating', 'placeholder' => 'ex: 2.4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="is" class="control-label col-lg-2">Type</label>
                                <div class=" col-md-6">
                                    <input type="radio" name='type' value='movie' data-id="1" class="iCheck-blue"/>
                                    <label class="control-label">Movie</label>
                                    <input type="radio" name='type' value='series' data-id="2" class="iCheck-blue"/>
                                    <label class="control-label">Series</label>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;" id="showDiv">
                                <label for="show" class="col-lg-2 control-label">Show</label>
                                <div class="col-lg-10">
                                    <div class="input-group select2-bootstrap-append col-lg-10">
                                        <select id="single-append-text" class="form-control select2-allow-clear" onChange="getSeasons(this.value)">
                                        <option disabled selected="true"></option>
                                            @foreach ($shows as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                          <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                              <span class="glyphicon glyphicon-search"></span>
                                          </button>
                                        </span>
                                    </div>
                                </div>
                                <div id="seasonsMainDiv" style="display: none;">
                                    <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Seasons</label>
                                    <div class="col-lg-10" id="seasonsDiv"></div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="genre" class="col-lg-2 control-label">Genres</label>
                                <div class="col-lg-10">
                                    <div class="input-group select2-bootstrap-append col-lg-10">
                                        <select id="multiple-genres" class="form-control select2-multiple" name="genres[]" multiple>
                                            @foreach ($genres as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group">
                            <label for="is" class="control-label col-lg-2">Featured</label>
                                <div class=" col-md-6 icheck-row">
                                    <div class=" col-md-3">
                                        <input type="checkbox" class="iCheck" name="featured">
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group icheck-row">
                            <label for="is" class="control-label col-lg-2">Staff Picks</label>
                                <div class=" col-md-6">
                                    <div class=" col-md-3">
                                        <input type="checkbox" class="iCheck" name="staff_picks">
                                    </div>
                                </div>
                            </div>     
                            <div class="form-group icheck-row">
                            <label for="is" class="control-label col-lg-2">Trending</label>
                                <div class=" col-md-6">
                                    <div class=" col-md-3">
                                        <input type="checkbox" class="iCheck" name="trending">
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group" style="border-bottom: 0;padding-bottom: 0">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
<!--body wrapper end-->


@endsection

@section('scripts')
    <script>
    

    $("[type='radio']").on('ifClicked',function (event) {
        var id = $(this).data('id');
        if(id ==2)
        {
            $("#showDiv").css('display', 'block');
            
        }
        else
        {
            $("#showDiv").css('display', 'none');
        }
    }); 

    function getSeasons(show_id){
        if(show_id != 0){
            $.ajax({
              url: 'getSeasons',
              type: "post",
              data: {'id':show_id, '_token': $('input[name=_token]').val()},
              success: function(data){
                $("#seasonsMainDiv").css('display', 'block');
                var div = document.getElementById("seasonsDiv");
                div.innerHTML = '<div class="input-group select2-bootstrap-append col-lg-10"><select id="multiple-seasons" class="form-control select2" name="season_id" >';
                var div2 = document.getElementById("multiple-seasons");
                div2.innerHTML = '';
                div2.innerHTML+='<option value="0" selected disabled>Please choose</option>';
                for(i = 0; i < data.length; i++)
                {
                    div2.innerHTML+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                }
                div2.innerHTML+='</select></div>';
                $('#multiple-seasons').select2();
              }

            }); 
        }
    }
    </script>
@endsection