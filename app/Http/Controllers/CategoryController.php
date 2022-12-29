<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Flasher\Prime\FlasherInterface;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::all();
        return view('admincp.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.category.form');
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
        $category_check=Category::where('slug',$data['slug'])->count();
        if($category_check>0){
        flash()->addWarning('Danh mục đã bị trùng, vui lòng thêm danh mục khác');
        return redirect()->back();

        }else{
        $category = new Category();
        $category->title = $data['title'];  
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->save();
        }
        // toastr()->success('Thành công','Thêm danh mục thành công');
        flash()->addSuccess('Thêm danh mục thành công');
        return redirect()->route('category.index');
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
        $category = Category::find($id);
        $list = Category::all();
        return view('admincp.category.form', compact('list', 'category'));
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
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->save();
        
        flash()->addSuccess('Cập nhật danh mục thành công');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        flash()->addSuccess('Xoá danh mục thành công');
        return redirect()->back();
    }
}