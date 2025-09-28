<?php

namespace App\Http\Controllers\backend;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\ProjectRequest;
use Illuminate\Support\Facades\Storage;

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
                    ->addColumn('proj_img', function ($row) {
                        $imagePath = $row->proj_img;
                        $imageUrl = asset('storage/proj_imgs/' . $imagePath);
                        $altText = $row->proj_img ?? 'proj_img';
                        return '<img src="' . $imageUrl . '" width="80" height="80" style="object-fit: cover; border-radius: 8px;" alt="' . htmlspecialchars($altText) . '">';
                    })
                    ->editColumn('status', function ($projectList) {
                        return $projectList->status ? 'Active' : 'Inactive';
                    })
                    ->rawColumns(['proj_img', 'action'])
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
                    if ($request->hasFile('proj_img')) {
                        if ($updateProject->proj_img) {
                            if (Storage::disk('public')->exists('proj_imgs/' . $updateProject->proj_img)) {
                                Storage::disk('public')->delete('proj_imgs/' . $updateProject->proj_img);
                            }
                        }
                        $file = $request->file('proj_img');
                        $originalName = $file->getClientOriginalName();
                        $proj_Name = uniqid() . '_' . str_replace(' ', '_', $originalName);
                        $file->storeAs('proj_imgs/', $proj_Name, 'public');
                        $post['proj_img'] = $proj_Name;
                    }
                    $updateProject->update($post);
                    Session::flash('success', "Project details have been successfully updated.");
                } else {
                    Session::flash('error', "Project not found for update.");
                }
            } else {
                $post = $request->all();
                // dd($request->file('proj_img'));
                if ($request->hasFile('proj_img')) {
                    $proj_img = $request->file('proj_img');
                    $originalName = $proj_img->getClientOriginalName();
                    $proj_Name = uniqid() . '_' . str_replace(' ', '_', $originalName);
                    $proj_img->storeAs('proj_imgs/', $proj_Name, 'public');
                    $post['proj_img'] = $proj_Name;
                }
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
