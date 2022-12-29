<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Carbon\Carbon;


class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ep = Episode::with('movie')->orderBy('episode', 'DESC')->get();
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

    public function add_episode($id)
    {
        $list_ep = Episode::with('movie')->where('movie_id',$id)->orderBy('episode', 'DESC')->get();
        $movie=Movie::find($id);
        return view('admincp.episode.add_episode', compact('list_ep','movie'));
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
        $episode_check=Episode::where('episode',$data['episode'])->where('movie_id',$data['movie_id'])->count();
        if($episode_check>0){
        flash()->addWarning('Tập phim đã bị trùng, vui lòng thêm tập phim khác');
        return redirect()->back();

        }else{
            $ep = new Episode();
            $ep->movie_id = $data['movie_id'];
            $ep->episode = $data['episode'];
            $ep->link = $data['link'];
            $ep->created_date = Carbon::now('Asia/Ho_Chi_Minh');
            $ep->updated_date = Carbon::now('Asia/Ho_Chi_Minh');
            flash()->addSuccess('Thêm tập phim thành công');
            $ep->save();
        }
        return redirect()->back();
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
        flash()->addSuccess('Cập nhật tập phim thành công');
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
        flash()->addSuccess('Xoá tập phim thành công');
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
