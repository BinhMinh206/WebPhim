@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Quản Lý Danh Mục</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(!isset($category))
                    {!! Form::open(['route'=>'category.store','method'=>'POST'])!!}
                    @else
                    {!! Form::open(['route'=>['category.update',$category->id],'method'=>'PUT'])!!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title','Title',[])!!}
                        {!! Form::text('title', isset($category) ? $category->title : '',
                        ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'slug','onkeyup'=>'ChangeToSlug()','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug','Slug',[])!!}
                        {!! Form::text('slug', isset($category) ? $category->slug : '',
                        ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'convert_slug','readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Description',[])!!}
                        {!! Form::textarea('description', isset($category) ? $category->description : '',
                        ['class'=>'form-control','placeholder'=>'Nhập dữ liệu ...','id'=>'description','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status','Status',[])!!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($category) ?
                        $category->status : '', ['class'=>'form-control']) !!}
                    </div>
                    @if(!isset($category))
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