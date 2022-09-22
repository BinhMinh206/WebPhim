@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('category',$movie->category->slug)}}">{{$movie->category->title}}</a> » <span><a href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
                </div>
            </div>
        </div>
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section id="content" class="test">
            <div class="clearfix wrap-content">

                <div class="halim-movie-wrapper">
                    <!-- <div class="title-block">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                            <div class="halim-pulse-ring"></div>
                        </div>
                        <div class="title-wrapper" style="font-weight: bold;">
                            Bookmark
                        </div>
                    </div> -->
                    <div class="movie_info col-xs-12">
                        <div class="movie-poster col-md-3">
                            <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->image)}}" alt="">
                            <div class="bwa-content">

                                @if($movie->resolution!=3)
                                @if($ep_current_list_count>0)
                                <div class="loader"></div>
                                <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$first_ep->episode)}}" class="bwac-btn">
                                    <i class="fa fa-play"></i>
                                </a>
                                @endif
                                @endif
                            </div>
                            <div>
                                <button style="width:100%" class="btn btn-primary"><a href="#xemtrailer">Xem Trailer</a> </button>
                            </div>
                        </div>

                        <div class="film-poster col-md-9">
                            <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                            <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->title}}</h2>
                            <ul class="list-info-group">
                                <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                        @if($movie->resolution==0)
                                        HD
                                        @elseif($movie->resolution==1)
                                        FullHD
                                        @elseif($movie->resolution==2)
                                        CAM
                                        @elseif($movie->resolution==3)
                                        Trailer
                                        @endif
                                    </span>
                                    @if($movie->resolution!=3)
                                    <span class="episode">
                                        @if($movie->sub==0)
                                        Vietsub
                                        @elseif($movie->sub==1)
                                        Thuyết minh
                                        @elseif($movie->sub==2)
                                        RAW
                                        @endif
                                    </span>
                                    @endif
                                </li>
                                <li class="list-info-group-item"></li>
                                <li class="list-info-group-item"><span>Số tập</span> :

                                    {{$ep_current_list_count}}/{{$movie->ep}}
                                    @if($ep_current_list_count==$movie->ep)
                                    Hoàn thành
                                    @else
                                    Đang cập nhật
                                    @endif


                                </li>
                                <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->timelength}} Phút</li>
                                <li class="list-info-group-item"><span>Thể loại</span> :
                                    @foreach($movie->movie_genre as $gen)
                                    <a href="{{route('genre',$movie->genre->slug)}}" rel="category tag">{{$gen->title}}</a>
                                    @endforeach
                                </li>
                                <li class="list-info-group-item"><span>Danh mục</span> : <a href="{{route('category',$movie->category->slug)}}" rel="category tag">{{$movie->category->title}}</a></li>
                                <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',$movie->country->slug)}}" rel="tag">{{$movie->country->title}}</a>
                            </ul>
                            <div class="movie-trailer hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="halim_trailer"></div>
                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            {{$movie->description}}
                        </article>
                    </div>
                </div>

                <div class="section-bar clearfix">
                    <h1 id="xemtrailer"></h1>

                    <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>

                </div>
                <div class="entry-content htmlwrap clearfix">

                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            <iframe width="100%" height="450" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="related-movies">
            <div id="halim_related_movies-2xx" class="wrap-slider">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                </div>
                <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                    @foreach($related as $key =>$hot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('movie',$hot->slug)}}" title="{{$hot->title}}">
                                <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$hot->image)}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                                <span class="status">@if($hot->resolution==0)
                                    HD
                                    @elseif($hot->resolution==1)
                                    FullHD
                                    @elseif($hot->resolution==2)
                                    CAM
                                    @elseif($hot->resolution==3)
                                    Trailer
                                    @endif</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>@if($hot->sub==0)
                                    Vietsub
                                    @elseif($hot->sub==1)
                                    Thuyết minh
                                    @elseif($hot->sub==2)
                                    RAW
                                    @endif</span>
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
                            margin: 4,
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
                                    items: 4
                                }
                            }
                        })
                    });
                </script>
            </div>
        </section>
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Phim Hot</span>
                </div>
                @foreach($phim_hot as $key =>$hot)
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="{{route('movie',['slug'=>$hot->slug])}}" title="">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$hot->image)}}" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                            </div>
                            <p class="title">{{$hot->title}}</p>
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