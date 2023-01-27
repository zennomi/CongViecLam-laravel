<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('job_category.view'), 403);

        $jobCategories = JobCategory::latest()->paginate(10); //returns all jobcategory
        return view('admin.JobCategory.index', compact('jobCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!userCan('job_category.create'), 403);

        $request->validate([
            'name' => 'required|unique:job_categories,name|max:255',
            'image' =>  'nullable|image|max:1024',
            'icon' =>  'required',
        ]);

        $newCategory = new JobCategory;
        $newCategory->name = $request->name;
        $newCategory->icon = $request->icon;

        if ($request->hasFile('image')) {
            $image = uploadFileToPublic($request->image, 'images/jobCategory');
            $newCategory->image = $image;
        }

        $jobCategories = $newCategory->save();
        $jobCategories ? flashSuccess('Category created!') : flashSuccess('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCategory $jobCategory)
    {
        abort_if(!userCan('job_category.update'), 403);

        $jobCategories = JobCategory::latest()->paginate(10); //returns all jobcategory
        return view('admin.JobCategory.index', compact('jobCategory', 'jobCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCategory $jobCategory)
    {
        abort_if(!userCan('job_category.update'), 403);

        $request->validate([
            'name' => 'required|max:255|unique:job_categories,name,' . $jobCategory->id,
            'image' =>  'nullable|image|max:1024',
            'icon' =>  'required',
        ]);

        $jobCategory->name = $request->name;
        $jobCategory->icon = $request->icon;

        if ($request->hasFile('image')) {
            $image = uploadFileToPublic($request->image, 'images/jobCategory');
            $jobCategory->image = $image;
        }

        $jobCat = $jobCategory->save();
        $jobCat ? flashSuccess('Category updated!') : flashSuccess('Something went wrong...');

        return redirect()->route('jobCategory.edit', $jobCategory->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobCategory)
    {
        abort_if(!userCan('job_category.delete'), 403);

        deleteFile($jobCategory->image);

        $success = $jobCategory->delete();
        $success ? flashSuccess('Category deleted!') : flashSuccess('Something went wrong...');
        return back();
    }
}
