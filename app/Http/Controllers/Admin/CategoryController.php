<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeImage;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate_parents = Category::where('parent_id', 0)->get();
        return view('admin.category.create', compact('cate_parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'image.mimes' => 'Vui lòng chọn hình ảnh đại diện có dịnh dạng jpeg,png,jpg,gif'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/category'), $file->getClientOriginalName());
            $category->image =  $request->file('image')->getClientOriginalName();
        }
        $category->description = $request->description;
        $category->save();
        // Tự động thêm 1 hình slide ở trang chủ theo danh mục
        $home_image = new HomeImage();
        $home_image->category_id  = $category->id;
        $home_image->name = "Hình";
        $home_image->image = "banner4.jpg";
        $home_image->save();
        return redirect()->route('category.index')->with(['type' => 'success', 'mess' => 'Thêm thành công danh mục ' . $category->name]);
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
        $cate_parents = Category::where('parent_id', 0)->get();
        return view('admin.category.edit', compact('category', 'cate_parents'));
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
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'nullable|mimes:jpeg,png,jpg,gif'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'image.mimes' => 'Vui lòng chọn hình ảnh đại diện có dịnh dạng jpeg,png,jpg,gif'
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/category'), $file->getClientOriginalName());
            $category->image =  $request->file('image')->getClientOriginalName();
        }
        $category->save();
        return redirect()->route('category.index')->with(['type' => 'success', 'mess' => 'Sửa thành công danh mục ' . $category->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $home_image = HomeImage::where('category_id',$id)->first();
        // dd($home_image);
        try {
            $category->forceDelete();
            $home_image->delete();
            return redirect()->route("category.index")->with(['type' => 'success', 'mess' => 'Xóa thành công danh mục ' . $category->name]);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route("category.index")->with(['type' => 'danger', 'mess' => 'Danh mục đã có sản phẩm. Không thể xóa']);
            } else {
                return redirect()->route("category.index")->with(['type' => 'danger', 'mess' => $e->getMessage()]);
            }
        }
        return redirect()->route("category.index");
    }
}
