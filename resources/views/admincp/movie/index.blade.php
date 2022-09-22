@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-hover" id="tablephim">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Poster</th>
                        <th scope="col">Hot</th>
                        <th scope="col">Resolution</th>
                        <th scope="col">Sub</th>
                        <th scope="col">Timelength</th>
                        <th scope="col">Year</th>
                        <th scope="col">Episodes</th>
                        <th scope="col">Status</th>
                        <th scope="col">Category</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Country</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $movie)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$movie->title}}</td>
                        <td><img width="100px" src="{{asset('uploads/movie/'.$movie->image)}}" alt=""></td>
                        <td>
                            @if($movie->phim_hot)
                            Có
                            @else
                            Không
                            @endif
                        </td>
                        <td>
                            @if($movie->resolution==0)
                            HD
                            @elseif($movie->resolution==1)
                            FullHD
                            @elseif($movie->resolution==2)
                            CAM
                            @elseif($movie->resolution==3)
                            Trailer
                            @endif
                        </td>
                        <td>@if($movie->sub==0)
                            Vietsub
                            @elseif($movie->sub==1)
                            Thuyết minh
                            @elseif($movie->sub==2)
                            RAW
                            @endif
                        </td>
                        <td>{{$movie->timelength}}</td>
                        <td>{{$movie->year}}</td>
                        <td>{{$movie->ep}}</td>

                        <td>
                            @if($movie->status)
                            Hiển thị
                            @else
                            Không hiển thị
                            @endif
                        </td>
                        <td>{{$movie->category->title}}</td>

                        <td>
                            @foreach($movie->movie_genre as $gen)
                            <span class="badge badge-dark">{{$gen->title}}</span>
                            @endforeach
                        </td>
                        <td>{{$movie->country->title}}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','route'=>['movie.destroy',$movie->id],'onsubmit'=>'return confirm("Thực hiện xoá?")']) !!}
                            {!! Form::submit('Xoá',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('movie.edit',$movie->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection