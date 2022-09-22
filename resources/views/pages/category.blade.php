@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{$cate_slug->title}}</div>
                </div>
            </div>
        </div>
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section>
            <div class="section-bar clearfix">
                <h1 class="section-title"><span>{{$cate_slug->title}}</span></h1>
            </div>
            <div class="halim_box">
                @foreach($movie as $key => $mov)
                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                    <div class="halim-item">
                        <a class="halim-thumb" href="{{route('movie',$mov->slug)}}">
                            <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->image)}}" alt="{{$mov->title}}" title="{{$mov->title}}"></figure>
                            <span class="status">@if($mov->resolution==0)
                                HD
                                @elseif($mov->resolution==1)
                                FullHD
                                @elseif($mov->resolution==2)
                                CAM
                                @elseif($mov->resolution==3)
                                Trailer
                                @endif</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>@if($mov->sub==0)
                                Vietsub
                                @elseif($mov->sub==1)
                                Thuyết minh
                                @elseif($mov->sub==2)
                                RAW
                                @endif</span>
                            <div class="icon_overlay"></div>
                            <div class="halim-post-title-box">
                                <div class="halim-post-title ">
                                    <p class="entry-title">{{$mov->title}}</p>
                                    <p class="original_title">{{$mov->title}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="clearfix"></div>
            <div class="text-center">
                <ul class='page-numbers'>
                    {!! $movie->links("pagination::bootstrap-4") !!}
            </div>
        </section>
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Phim Hot</span>
                </div>
                @foreach($phim_hot as $key =>$moi)
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="{{route('movie',$moi->slug)}}" title="">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$moi->image)}}" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                            </div>
                            <p class="title">{{$moi->title}}</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">Hot......</div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                <span style="width: 0%"></span>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="clearfix"></div>
        </div>
    </aside>
</div>
@endsection