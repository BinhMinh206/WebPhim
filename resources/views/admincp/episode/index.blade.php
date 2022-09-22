@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
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
                            {!! Form::open(['method'=>'DELETE','route'=>['episode.destroy',$episode->id],'onsubmit'=>'return confirm("Thực hiện xoá?")']) !!}
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