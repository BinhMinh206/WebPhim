@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Tập Phim</div>
                <a href="{{route('episode.index')}}" class="btn btn-primary">Liệt kê tập phim</a>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(!isset($episode))
                    {!! Form::open(['route'=>'episode.store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                    @else
                    {!! Form::open(['route'=>['episode.update',$episode->id],'method'=>'PUT','enctype'=>'multipart/form-data'])!!}
                    @endif

                    @if(!isset($episode))
                    <div class="form-group">
                        {!! Form::label('movie','Movie',[])!!}
                        {!! Form::select('movie_id', $list_movie, isset($episode) ? $episode->movie_id : '', ['class'=>'form-control select-movie']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('movie','Episode',[])!!}

                        <select name="episode" class="form-control" id="show_movie" required>

                        </select>
                    </div>
                    @else
                    <div class="form-group">
                        {!! Form::label('movie','Movie',[])!!}

                        {!! Form::text('movie_id', isset($episode) ? $episode->movie->title : '', ['class'=>'form-control','placeholder'=>'','disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episode','Episode',[])!!}
                        {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class'=>'form-control','placeholder'=>'','disabled']) !!}
                    </div>
                    @endif


                    <div class="form-group">
                        {!! Form::label('link','Link',[])!!}
                        {!! Form::text('link', isset($episode) ? $episode->link : '', ['class'=>'form-control ','placeholder'=>'Nhập dữ liệu ...','required']) !!}
                    </div>

                    @if(!isset($episode))
                    {!! Form::submit('Thêm tập phim', ['class'=>'btn btn-success']) !!}
                    @else
                    {!! Form::submit('Cập nhật', ['class'=>'btn btn-warning']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection