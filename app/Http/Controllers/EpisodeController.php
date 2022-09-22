<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ep = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        return view('admincp.episode.index', compact('list_ep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Episode::where('movie_id', 22)
            ->pluck('episode');

        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id');
        return view('admincp.episode.form', compact('list_movie'));
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
        $ep = new Episode();
        $ep->movie_id = $data['movie_id'];
        $ep->episode = $data['episode'];
        $ep->link = $data['link'];

        $ep->save();
        return redirect()->route('movie.index');
    }

    /**
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
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id');
        $episode = Episode::find($id);
        return view('admincp.episode.form', compact('episode', 'list_movie'));
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
        $ep = Episode::find($id);
        //$ep->movie_id = $data['movie_id'];
        //$ep->episode = $data['episode'];
        $ep->link = $data['link'];
        $ep->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->to('episode');
    }

    public function select_movie()
    {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $query = Episode::where('movie_id', $id)
            ->get();


        $output = '<option value="">--Chọn tập phim--</option>';


        for ($i = 0; $i < $movie->ep; $i++) {

            $output .= '<option value="' . $i + 1 . '">' . $i + 1 . '</option>';
        }



        echo $output;
    }
}
