@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
            <h3 class="section-title"><span>Phim Hot</span></h3>
        </div>
        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
            @foreach($phim_hot as $key =>$hot)
            <article class="thumb grid-item post-38498">
                <div class="halim-item">
                    <a class="halim-thumb" href="{{route('movie',$hot->slug)}}" title="{{$hot->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$hot->image)}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                        <span class="status"> @if($hot->resolution==0)
                            HD
                            @elseif($hot->resolution==1)
                            FullHD
                            @elseif($hot->resolution==2)
                            CAM
                            @elseif($hot->resolution==3)
                            Trailer
                            @endif</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                            <div class="halim-post-title ">
                                <p class="entry-title">{{$hot->title}}</p>
                                <p class="original_title">{{$hot->title}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        <script>
            $(document).ready(function($) {
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({
                    loop: true,
                    margin: 5,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true,
                    nav: true,
                    navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        480: {
                            items: 3
                        },
                        600: {
                            items: 4
                        },
                        1000: {
                            items: 5
                        }
                    }
                })
            });
        </script>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        @foreach($category_home as $key=>$cate_home)
        <section id="halim-advanced-widget-2">
            <div class="section-heading">
                <a href="{{route('category',$cate_home->slug)}}" title="Category">
                    <span class="h-text">{{$cate_home->title}}</span>
                </a>
            </div>
            <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                @foreach($cate_home->movie->take(10) as $key=>$mov)
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
        </section>
        <div class="clearfix"></div>
        @endforeach
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Phim mới</span>
                </div>
                @foreach($phim_moi as $key =>$moi)
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
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Phim Sắp Chiếu</span>
                </div>
                @foreach($phim_trailer as $key =>$tra)
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="{{route('movie',$moi->slug)}}" title="">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$tra->image)}}" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                            </div>
                            <p class="title">{{$tra->title}}</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">New......</div>
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