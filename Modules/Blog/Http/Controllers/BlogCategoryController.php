<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Contracts\Support\Renderable;

class BlogCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('post.view'), 403);

        $categories = PostCategory::withCount('posts')->get();
        return view('blog::postcategory.index', compact('categories'));
    }

    public function create()
    {
        abort_if(!userCan('post.create'), 403);

        return view('blog::postcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort_if(!userCan('post.create'), 403);

        if ($request->file('image')) {
            $path = 'postcategory';
            $image = uploadImage($request->image, $path);
        }
        $request->validate([
            'name' => "required",
        ]);

        PostCategory::create([
            'name' => $request->name,
            'image' => $request->file('image') ? $image : 'backend/image/default.png',
            'slug' => $request->slug,
        ]);
        flashSuccess('Category Created Successfully');

        return redirect()->route('module.category.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(PostCategory $category)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(PostCategory $category)
    {
        abort_if(!userCan('post.update'), 403);

        return view('blog::postcategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, PostCategory $category)
    {
        abort_if(!userCan('post.update'), 403);

        if ($request->file('image')) {
            $path = 'category';
            $image = uploadImage($request->image, $path);
        }

        $category->update([
            'name' => $request->title,
            'image' => $request->file('image') ? $image : $category->image,
            'slug' => $request->slug,
        ]);

        flashSuccess('Blog Category updated Successfully');

        return redirect()->route('module.category.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(PostCategory $category)
    {
        abort_if(!userCan('post.delete'), 403);

        deleteImage($category->image);
        $category->delete();
        return redirect()->back();
    }
}
