<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id','DESC')->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:news',
                'image' => 'required|mimes:jpeg,png,jpg,gif'
            ],
            [
                'name.required' => 'Vui lòng nhập tên tin tức',
                'name.unique' => 'Tên tin tức đã bị trùng',
                'image.required' => 'Vui lòng chọn ảnh đại diện tin tức',
                'image.mimes' => 'Vui lòng chọn hình ảnh có dịnh dạng jpeg,png,jpg,gif'
            ]
        );
        $new = new News();
        $new->name = $request->name;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/news'), $file->getClientOriginalName());
            $new->image =  $request->file('image')->getClientOriginalName();
        }
        $new->description = $request->description;
        $new->save();
        return redirect()->route('news.index')->with(['type' => 'success', 'mess' => 'Thêm mới thành công tin tức ' . $new->name]);
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
        $new = News::find($id);
        return view('admin.news.edit',compact('new'));
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
        $request->validate(
            [
                'name' => 'required|unique:news,name,' . $id,
                'image' => 'mimes:jpeg,png,jpg,gif'
            ],
            [
                'name.required' => 'Vui lòng nhập tên tin tức',
                'name.unique' => 'Tên tin tức đã bị trùng',
                'image.mimes' => 'Vui lòng chọn hình ảnh có dịnh dạng jpeg,png,jpg,gif'
            ]
        );
        $new = News::find($id);
        $new->name = $request->name;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/news'), $file->getClientOriginalName());
            $new->image =  $request->file('image')->getClientOriginalName();
        }
        $new->description = $request->description;
        $new->save();
        return redirect()->route('news.index')->with(['type' => 'success', 'mess' => 'Cập nhật thành công tin tức ' . $new->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $new = News::find($id);
        $new->delete();
        return redirect()->route('news.index')->with(['type' => 'success', 'mess' => 'Xóa thành công tin tức ' . $new->name]);
    }
}
