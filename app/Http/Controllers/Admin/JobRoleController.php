<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\JobRole;
use Illuminate\Http\Request;

class JobRoleController extends Controller
{
    public function index()
    {
        abort_if(!userCan('job_role.view'), 403);

        $jobRoles = JobRole::withCount('jobs')->latest()->paginate(10); //returns all jobcategory
        return view('admin.JobRole.index', compact('jobRoles'));
    }


    public function store(Request $request)
    {
        abort_if(!userCan('job_role.create'), 403);

        $request->validate([
            'name' => 'required|unique:job_roles,name|max:255',
        ]);

        $newRole = new JobRole;
        $newRole->name = $request->name;

        $jobRole = $newRole->save();
        $jobRole ? flashSuccess('Job Role created!') : flashError('Something went wrong...');
        return back();
    }

    public function edit(JobRole $jobRole)
    {
        abort_if(!userCan('job_role.update'), 403);

        $jobRoles = JobRole::latest()->paginate(10); //returns all jobcategory
        return view('admin.JobRole.index', compact('jobRole', 'jobRoles'));
    }

    public function update(Request $request, JobRole $jobRole)
    {
        abort_if(!userCan('job_role.update'), 403);

        $request->validate([
            'name' => 'required|max:255|unique:job_roles,name,' . $jobRole->id,
        ]);

        $jobRole->name = $request->name;
        $edited = $jobRole->save();

        $edited ? flashSuccess('Job Role updated!') : flashSuccess('Something went wrong...');

        return redirect()->route('jobRole.edit', $jobRole->slug);
    }

    public function destroy(JobRole $jobRole)
    {
        abort_if(!userCan('job_role.delete'), 403);

        $success = $jobRole->delete();
        $success ? flashSuccess('Job Role deleted!') : flashSuccess('Something went wrong...');
        return redirect()->route('jobRole.index');
    }
}
