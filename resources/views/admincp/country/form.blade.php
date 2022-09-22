@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Quốc Gia Phim</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(!isset($country))
                    {!! Form::open(['route'=>'country.store','method'=>'POST'])!!}
                    @else
                    {!! Form::open(['route'=>['country.update',$country->id],'method'=>'PUT'])!!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title','Title',[])!!}
                        {!! Form::text('title', isset($country) ? $country->title : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'slug','onkeyup'=>'ChangeToSlug()','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug','Slug',[])!!}
                        {!! Form::text('slug', isset($country) ? $country->slug : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'convert_slug','readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Description',[])!!}
                        {!! Form::textarea('description', isset($country) ? $country->description : '', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'description','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status','Status',[])!!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($country) ? $country->status : '', ['class'=>'form-control']) !!}
                    </div>
                    @if(!isset($country))
                    {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success']) !!}
                    @else
                    {!! Form::submit('Cập nhật', ['class'=>'btn btn-warning']) !!}

                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$cate->title}}</td>
                        <td>{{$cate->description}}</td>
                        <td>{{$cate->slug}}</td>
                        <td>
                            @if($cate->status)
                            Hiển thị
                            @else
                            Không hiển thị
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','route'=>['country.destroy',$cate->id],'onsubmit'=>'return confirm("Thực hiện xoá?")']) !!}
                            {!! Form::submit('Xoá',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('country.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection