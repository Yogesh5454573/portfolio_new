<?php

namespace App\Http\Controllers\backend;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\{Session, Storage};
use App\Http\Requests\Admin\ProjectRequest;

class ProjectController extends Controller
{
    public function projectList(Request $request)
    {
        try {
            if ($request->ajax()) {
                $projectList = Project::query();
                return Datatables::of($projectList)
                    ->addIndexColumn()
                    ->addColumn('action', function ($projectList) {
                        $edit = '<a href="/admin/editProject/' . $projectList->token . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a>';
                        $delete = '<form method="POST" action="/admin/deleteProject/' . $projectList->token . '" accept-charset="UTF-8" class="delete" style="display:inline">
                    ' . csrf_field() . '
                    <input name="_method" value="DELETE" type="hidden">
                    <button type="button" class="btn btn-danger btn-sm skill_delete_alert">Delete</button></form>';
                        return $edit . ' ' . $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            info("Error in projectList(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return view('backend.manage_projects.projectsList');
    }

    public function addProject()
    {
        return view('backend.manage_projects.addProject');
    }

    public function addUpdateProject(ProjectRequest $request, $token = false)
    {
        try {
            if ($request->method() == "PUT") {
                $updateProject = Project::where(['token' => $token])->first();
                if ($updateProject) {
                    $post = $request->all();
                    $updateProject->update($post);
                    Session::flash('success', "Project details have been successfully updated.");
                } else {
                    Session::flash('error', "Project not found for update.");
                }
            } else {
                $post = $request->all();
                $post['token'] = strtoupper((string) Str::uuid());
                Project::create($post);
                Session::flash("success", "Project details have been successfully created.");
            }
        } catch (\Exception $e) {
            info("Error in addUpdateProject(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }

        return redirect()->route('admin.projectList');
    }

    public function editProject($token)
    {
        if ($token) {
            $projectData = Project::where(['token' => $token])->first();
            if ($projectData) {
                return view('backend.manage_projects.editProject', ['projectData' => $projectData]);
            } else {
                return redirect()->route('admin.projectList')->with(['error' => 'Project Details not found, please try again later.']);
            }
        } else {
            Session::flash("error", "There was some error, please try again later.");
        }
    }

    public function deleteProject($token)
    {
        $updateProject = Project::where('token', $token)->first();

        if ($updateProject) {
            if ($updateProject->proj_img && Storage::disk('public')->exists('proj_imgs/' . $updateProject->proj_img)) {
                Storage::disk('public')->delete('proj_imgs/' . $updateProject->proj_img);
            }

            $updateProject->delete();

            Session::flash("success", "Project has been successfully deleted.");
        } else {
            Session::flash("error", "Project not found.");
        }

        return redirect()->route('admin.projectList');
    }
}
