<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Movie_Genre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use function PHPUnit\Framework\returnSelf;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category', 'movie_genre', 'country', 'genre')->orderBy('id', 'DESC')->get();
        $destinationPath = public_path() . "/json_file/";
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        File::put($destinationPath . "movies.json", json_encode($list));
        return view('admincp.movie.index', compact('list'));
    }

    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function update_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        return view('admincp.movie.form', compact('category', 'country', 'genre', 'list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->resolution = $data['resolution'];
        $movie->trailer = $data['trailer'];
        $movie->status = $data['status'];
        $movie->ep = $data['ep'];
        $movie->timelength = $data['timelength'];
        $movie->sub = $data['sub'];
        $movie->year = $data['year'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->slug = $data['slug'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];

        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }

        $get_image = $request->file('image');

        if ($get_image) {

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/', $new_image);
            $movie->image  = $new_image;
        }
        $movie->save();

        $movie->movie_genre()->attach($data['genre']);
        return redirect()->route('movie.index');
    }
    /**
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $movie = Movie::find($id);
        $list_genre = Genre::all();
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form', compact('category', 'country', 'genre', 'movie', 'list_genre', 'movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->timelength = $data['timelength'];
        $movie->sub = $data['sub'];
        $movie->year = $data['year'];
        $movie->ep = $data['ep'];
        $movie->resolution = $data['resolution'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->slug = $data['slug'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }
        $get_image = $request->file('image');



        if ($get_image) {
            if (file_exists('uploads/movie/' . $movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie/', $new_image);
                $movie->image  = $new_image;
            }
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);

        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (file_exists('uploads/movie/' . $movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }

        Movie_Genre::whereIn('movie_id', [$movie->id])->delete();

        $movie->delete();
        return redirect()->back();
    }
}
