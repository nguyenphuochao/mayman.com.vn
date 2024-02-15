<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = Media::orderBy('id','DESC')->paginate(36);
        return view('admin.media.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
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
                'image' => 'required|mimes:jpeg,png,jpg,gif'
            ],
            [
                'image.required' => 'Vui lòng chọn ảnh',
                'image.mimes' => 'Vui lòng chọn hình ảnh có dịnh dạng jpeg,png,jpg,gif'
            ]
        );
        $media = new Media();
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/uploads/images'), $file->getClientOriginalName());
            $media->image =  $request->file('image')->getClientOriginalName();
        }
        $media->save();
        return redirect()->route('media.index')->with(['type' => 'success', 'mess' => 'Thêm mới thành công hình']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
