@extends('backend')

@section('content')

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Create new show
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{ URL::to('/admin') }}">Home</a></li>
            <li><a href="{{ URL::to('admin/shows') }}">Shows</a></li>
            <li class="active"> Create show </li>
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
                    Create show
                </header>
                <div class="panel-body">
                    @include('admin.partials.error')
                    <div class="form">
                        {!! Form::open(['url' => 'admin/shows/create', 'id' => 'editpage', 'class' => 'cmxform form-horizontal tasi-form', 'files' =>  TRUE]) !!}
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Name</label>
                                <div class="col-lg-5">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="seasons" class="control-label col-lg-2">Seasons #</label>
                                <div class="col-lg-5">
                                {!! Form::number('seasons', 1, ['class' => 'form-control col-lg-8', 'id' => 'number', 'min' => 1]) !!}
                                </div>
                            </div>                           
                            <div class="form-group" style="border-bottom: 0;padding-bottom: 0">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Save</button>
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
