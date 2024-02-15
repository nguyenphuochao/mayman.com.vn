<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeImage;
use Illuminate\Http\Request;

class HomeImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_images = HomeImage::all();
        return view('admin.home_image.index', compact('home_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $home_image = HomeImage::find($id);
        return view('admin.home_image.edit', compact('home_image'));
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
        $request->validate([
            'name' => 'required|unique:home_images,name,' . $id,
            'image' => 'nullable|mimes:jpeg,png,jpg,gif'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục hình',
            'name.unique' => 'Tên danh mục hình đã tồn tại',
            'image.mimes' => 'Vui lòng chọn hình ảnh đại diện có dịnh dạng jpeg,png,jpg,gif'
        ]);
        $home_image = HomeImage::find($id);
        $home_image->name = $request->name;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/home-image'), $file->getClientOriginalName());
            $home_image->image =  $request->file('image')->getClientOriginalName();
        }
        $home_image->save();
        return redirect()->route('home-image.index')->with(['type' => 'success', 'mess' => 'Sửa thành công hình danh mục ' . $home_image->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
