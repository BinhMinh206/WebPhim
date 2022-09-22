@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Phim</div>
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(!isset($movie))
                    {!! Form::open(['route'=>'movie.store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                    @else
                    {!! Form::open(['route'=>['movie.update',$movie->id],'method'=>'PUT','enctype'=>'multipart/form-data'])!!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title','Title',[])!!}
                        {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'slug','onkeyup'=>'ChangeToSlug()','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug','Slug',[])!!}
                        {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'convert_slug','readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Description',[])!!}
                        {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'description','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status','Status',[])!!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('resolution','Resolution',[])!!}
                        {!! Form::select('resolution', ['1'=>'FullHD','0'=>'HD','2'=>'CAM','3'=>'Trailer'], isset($movie) ? $movie->resolution : '', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('year','Year',[])!!}
                        {!! Form::selectYear('year',2000,2022,isset($movie->year)?$movie->year :'',['class'=>'form-control','required'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sub','Sub',[])!!}
                        {!! Form::select('sub', ['1'=>'Thuyết minh','0'=>'Vietsub','2'=>'RAW'], isset($movie) ? $movie->sub : '', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('timelength','Time length',[])!!}
                        {!! Form::number('timelength', isset($movie) ? $movie->timelength : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'timelength','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episodes','Episodes',[])!!}
                        {!! Form::number('ep', isset($movie) ? $movie->ep : '',['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'ep']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('trailer','Trailer',[])!!}
                        {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control','placeholder'=>'Nhập link ...','id'=>'trailer','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Category','Category',[])!!}
                        {!! Form::select('category_id',$category , isset($movie) ? $movie->category_id : '', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Country','Country',[])!!}
                        {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Genre','Genre',[])!!}
                        <br>
                        <!-- {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', ['class'=>'form-control']) !!} -->
                        @foreach($list_genre as $key => $gen)
                        @if(isset($movie))
                        {!! Form::checkbox('genre[]',$gen->id,isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false)!!}
                        @else
                        {!! Form::checkbox('genre[]',$gen->id,'')!!}
                        @endif
                        {!! Form::label('genre',$gen->title)!!}
                        @endforeach
                    </div>
                    <div class="form-group">
                        {!! Form::label('Hot','Hot',[])!!}
                        {!! Form::select('phim_hot', ['1'=>'Có','0'=>'Không'], isset($movie) ? $movie->phim_hot : '', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Image','Image',[])!!}
                        {!! Form::file('image',['class'=>'form-control-file']) !!}
                        @if(isset($movie))

                        <img width="30%" src="{{asset('uploads/movie/'.$movie->image)}}" alt="">
                        <span>Ảnh cũ</span>
                        @endif
                    </div>
                    @if(!isset($movie))
                    {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success']) !!}
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