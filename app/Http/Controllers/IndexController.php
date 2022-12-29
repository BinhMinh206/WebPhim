<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Rating;
use DB;
use PHPUnit\Framework\Constraint\Count;

class IndexController extends Controller
{
    public function home()
    {
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_date','DESC')->get();
        $phim_trailer = Movie::where('resolution', 3)->where('status', 1)->paginate(2);;
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $category_home = Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();
        $phim_moi = Movie::where('status', 1)->whereNotIn('resolution',[3] )->orderBy('created_date','ASC')->paginate(7);

        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'phim_hot', 'phim_moi', 'phim_trailer'));
    }
    public function timkiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

            $movie = Movie::where('title', 'LIKE', '%' . $search . '%')->paginate(12);;
            return view('pages.search', compact('category', 'genre', 'country', 'search', 'movie', 'phim_hot'));
        } else {
            return redirect()->to('/');
        }
    }

    public function category($slug)
    {
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $cate_slug = Category::where('slug', $slug)->first();
        $movie = Movie::where('category_id', $cate_slug->id)->orderBy('updated_date','DESC')->paginate(12);;
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'phim_hot'));
    }

    public function genre($slug)
    {
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $genre_slug = Genre::where('slug', $slug)->first();

        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->orderBy('updated_date','DESC')->paginate(12);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'phim_hot'));
    }

    public function country($slug)
    {
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $country_slug = Country::where('slug', $slug)->first();
        $movie = Movie::where('country_id', $country_slug->id)->orderBy('updated_date','DESC')->paginate(12);;

        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'phim_hot'));
    }

    public function movie($slug)
    {
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $first_ep = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

        $ep_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $ep_current_list_count = $ep_current_list->count();

        $rating = Rating::where('movie_id',$movie->id)->avg('rating');
        $rating=round($rating);
        $count_total =Rating::where('movie_id',$movie->id)->count();
        $count_views=$movie->count_views;
        $count_views=$count_views + 1;
        $movie->count_views = $count_views;
        $movie->save();

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'related', 'phim_hot', 'first_ep', 'ep_current_list_count','rating','count_total'));
    }

    public function add_rating(Request $request)
    {
        $data = $request->all();
        $ip_address =$request->ip();

        $rating_count = Rating::where('movie_id',$data['movie_id'])->where('ip_address',$ip_address)->count();
        if($rating_count>0){
            echo 'exist';
        }else{
            $rating=new Rating();
            $rating->movie_id=$data['movie_id'];
            $rating->rating=$data['index'];
            $rating->ip_address=$ip_address;
            $rating->save();
            echo 'done';
        }
    }

    public function year($year)
    {
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $year = $year;
        $movie = Movie::where('year', $year)->orderBy('updated_date','DESC')->paginate(12);;
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'phim_hot'));
    }
    public function all()
    {
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();

        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();

        $movie = Movie::orderBy('updated_date','DESC')->paginate(12);
        return view('pages.all', compact('category', 'genre', 'country', 'movie', 'phim_hot'));
    }

    public function watch($slug, $tap)
    {
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $related = Movie::with('category', 'genre', 'country',)->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();
        $phim_hot = Movie::where('phim_hot', 1)->where('status', 1)->get();
        if (isset($tap)) {
            $tapphim = $tap;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
            $tapphim = substr($tap, 4, 1);
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }
        $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        return view('pages.watch', compact('category', 'genre', 'country', 'movie', 'related', 'phim_hot', 'episode', 'tapphim'));
    }

    public function episode()
    {
        return view('pages.episode');
    }
}