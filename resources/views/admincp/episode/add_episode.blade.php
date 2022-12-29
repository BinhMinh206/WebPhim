@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-bottom: 20px;">
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

                    <div class="form-group">
                        {!! Form::label('movie_title','Movie',[])!!}
                        {!! Form::text('movie_title',isset($movie) ? $movie->title : '', ['class'=>'form-control','readonly']) !!}
                        {!! Form::hidden('movie_id',isset($movie) ? $movie->id : '') !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('link','Link',[])!!}
                        {!! Form::text('link', isset($episode) ? $episode->link : '', ['class'=>'form-control ','placeholder'=>'Nhập dữ liệu ...','required','autocomplete'=>'off']) !!}
                    </div>

                    @if(isset($episode))
                    <div class="form-group">
                        {!! Form::label('episode','Episode',[])!!}
                        {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class'=>'form-control',isset($episode) ? 'readonly' :'']) !!}
                    </div>

                    @else
                    <div class="form-group">
                        {!! Form::label('movie','Episode',[])!!}
                        {!! Form::selectRange('episode', 1, $movie->ep,$movie->ep, ['class'=>'form-control']) !!}
                    </div>
                    @endif



                    @if(!isset($episode))
                    {!! Form::submit('Thêm tập phim', ['class'=>'btn btn-success']) !!}
                    @else
                    {!! Form::submit('Cập nhật', ['class'=>'btn btn-warning']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-hover" id="tablephim">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title Movie</th>
                        <th scope="col">Poster Movie</th>
                        <th scope="col">Episode</th>
                        <th scope="col">Link</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody class="order_position">
                    @foreach($list_ep as $key => $episode)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$episode->movie->title}}</td>
                        <td><img width="100px" src="{{asset('uploads/movie/'.$episode->movie->image)}}" alt=""></td>
                        <td>{{$episode->episode}}</td>
                        <td>{{$episode->link}}</td>
                        <td>
                            {!!
                            Form::open(['method'=>'DELETE','route'=>['episode.destroy',$episode->id],'onsubmit'=>'return
                            confirm("Thực hiện xoá?")']) !!}
                            {!! Form::submit('Xoá',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('episode.edit',$episode->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection