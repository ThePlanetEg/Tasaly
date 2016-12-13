@extends('backend')

@section('content')
<div class="page-head">
    <h3 class="m-b-less">
        All videos
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{URL::to('/admin')}}">Home</a></li>
            <li class="active">All Videos</li>
        </ol>
    </div>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                @include('admin.partials.flash')
                <header class="panel-heading head-border">
                    All videos
                </header>
                <div class="table-responsive">
                    <table class="table responsive-data-table data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Featured</th>
                                <th>Staff Picks</th>
                                <th>Trending</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                            <tr>
                                <td>{{ $video->title }}</td>
                                <td id="video-featured-{{$video->id}}">
                                @if($video->featured == 0)
                                    <a data-toggle="tooltip" title="No" href="#" class="btn btn-warning btn-xs" onclick="featured(this,1,{{$video->id}})" id="unfeatured"><i class="fa fa-star-o"></i></a></td>
                                @else
                                   <a data-toggle="tooltip" title="Yes" href="#" class="btn btn-warning btn-xs" onclick="featured(this,2,{{$video->id}})" id="featured"><i class="fa fa-star"></i></a></td>
                                @endif
                                <td id="video-staffPicks-{{$video->id}}">
                                @if($video->staff_picks == 0)
                                   <a data-toggle="tooltip" title="No" href="#" class="btn btn-warning btn-xs" onclick="staffPicks(this,1,{{$video->id}})" id="notStaff"><i class="fa fa-star-o"></i></a></td>
                                @else
                                   <a data-toggle="tooltip" title="Yes" href="#" class="btn btn-warning btn-xs" onclick="staffPicks(this,2,{{$video->id}})" id="staff"><i class="fa fa-star"></i></a></td>
                                @endif
                                <td id="video-trending-{{$video->id}}">
                                @if($video->trending == 0)
                                   <a data-toggle="tooltip" title="No" href="#" class="btn btn-warning btn-xs" onclick="trending(this,1,{{$video->id}})" id="notTrending"><i class="fa fa-star-o"></i></a></td>
                                @else
                                   <a data-toggle="tooltip" title="Yes" href="#" class="btn btn-warning btn-xs" onclick="trending(this,2,{{$video->id}})" id="trending"><i class="fa fa-star"></i></a></td>
                                @endif
                                <td class="hidden-xs">
                                    <a href="{{ URL::to('/admin/videos/'.$video->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ URL::to('/admin/videos/'.$video->id.'/delete') }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script>
    function featured(link,flag, id){

        if(flag == 1){
            $.ajax({
              url: 'admin/videos/saveFeatured',
              type: "post",
              data: {'id':id, '_token': '{{ csrf_token() }}', 'flag':1},
              success: function(data){
              }
            }); 
            var div = '<a data-toggle="tooltip" title="Yes" href="#" class="btn btn-warning btn-xs" onclick="featured(this,2,'+id+')" id="featured"><i class="fa fa-star"></i></a></td>';
            link.remove();
            $('#video-featured-'+id).append(div); 
        }
        else{
            $.ajax({
              url: 'admin/videos/saveFeatured',
              type: "post",
              data: {'id':id, '_token': '{{ csrf_token() }}', 'flag':2},
              success: function(data){
              }
            }); 
            var div = '<a data-toggle="tooltip" title="No" href="#" class="btn btn-warning btn-xs" onclick="featured(this,1,'+id+')" id="unfeatured"><i class="fa fa-star-o"></i></a>';
            link.remove();
            $('#video-featured-'+id).append(div); 
        }
    }
    
    function staffPicks(link,flag, id){
        if(flag == 1){
            $.ajax({
              url: 'admin/videos/saveStaffPicks',
              type: "post",
              data: {'id':id, '_token': '{{ csrf_token() }}', 'flag':1},
              success: function(data){
              }
            }); 
            var div = '<a data-toggle="tooltip" title="Yes" href="#" class="btn btn-warning btn-xs" onclick="staffPicks(this,2,'+id+')" id="staffPicks"><i class="fa fa-star"></i></a></td>';
            link.remove();
            $('#video-staffPicks-'+id).append(div); 
        }
        else{
            $.ajax({
              url: 'admin/videos/saveStaffPicks',
              type: "post",
              data: {'id':id, '_token': '{{ csrf_token() }}', 'flag':2},
              success: function(data){
              }
            }); 
            var div = '<a data-toggle="tooltip" title="No" href="#" class="btn btn-warning btn-xs" onclick="staffPicks(this,1,'+id+')" id="unstaffPicks"><i class="fa fa-star-o"></i></a>';
            link.remove();
            $('#video-staffPicks-'+id).append(div); 
        }
    }    

    function trending(link,flag, id){
        if(flag == 1){
            $.ajax({
              url: 'admin/videos/saveTrending',
              type: "post",
              data: {'id':id, '_token': '{{ csrf_token() }}', 'flag':1},
              success: function(data){
              }
            }); 
            var div = '<a data-toggle="tooltip" title="Yes" href="#" class="btn btn-warning btn-xs" onclick="trending(this,2,'+id+')" id="trending"><i class="fa fa-star"></i></a></td>';
            link.remove();
            $('#video-trending-'+id).append(div); 
        }
        else{
            $.ajax({
              url: 'admin/videos/saveTrending',
              type: "post",
              data: {'id':id, '_token': '{{ csrf_token() }}', 'flag':2},
              success: function(data){
              }
            }); 
            var div = '<a data-toggle="tooltip" title="No" href="#" class="btn btn-warning btn-xs" onclick="trending(this,1,'+id+')" id="untrending"><i class="fa fa-star-o"></i></a>';
            link.remove();
            $('#video-trending-'+id).append(div); 
        }
    }                           
    </script>
@endsection