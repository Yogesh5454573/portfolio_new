<?php

namespace App\Http\Controllers\backend;

use App\Models\Skills;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\SkillsRequest;

class SkillController extends Controller
{
    public function skillList(Request $request)
    {
        // dd('Fetching admin list...'); // Debugging line, can be removed later
        try {
            if ($request->ajax()) {

                $skillList = Skills::query();

                return Datatables::of($skillList)
                    ->addIndexColumn()
                    ->addColumn('action', function ($skillList) {

                        $edit = '<a href="/admin/editSkill/' . $skillList->token . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a>';
                        $delete = '<form method="POST" action="/admin/deleteSkill/' . $skillList->token . '" accept-charset="UTF-8" class="delete" style="display:inline">
                    ' . csrf_field() . '
                    <input name="_method" value="DELETE" type="hidden">
                    <button type="button" class="btn btn-danger btn-sm skill_delete_alert">Delete</button></form>';

                        return $edit . ' ' . $delete;
                    })
                    ->editColumn('status', function ($skillList) {
                        return $skillList->status ? 'Active' : 'Inactive';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            info("Error in skillList(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return view('backend.manage_skills.skillsList');
    }

    public function addSkill()
    {
        return view('backend.manage_skills.addSkill');
    }

    public function addUpdateSkill(SkillsRequest $request, $token = false)
    {
        // dd($request->all()); // Debugging line, can be removed later
        try {

            if ($request->method() == "PUT") {
                $updateSkills = Skills::where(['token' => $token])->first();
                $post = $request->all();
                $updateSkills->update($post);
                Session::flash("success", "Skills details have been successfully updated.");
            } else {
                // dd('Adding new skill...'); // Debugging line, can be removed later
                $post = $request->all();
                $post['token'] = strtoupper((string) Str::uuid());
                Skills::create($post);
                Session::flash("success", "Skills details have been successfully created.");
            }
        } catch (\Exception $e) {
            info("Error in addUpdateSkill(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }

        return redirect()->route('admin.skillList');
    }

    public function editSkill($token)
    {
        if ($token) {
            $skillsData = Skills::where(['token' => $token])->first();
            if ($skillsData) {
                return view('backend.manage_skills.editSkill', ['skillsData' => $skillsData]);
            } else {
                return redirect()->route('admin.skillList')->with(['error' => 'Skill Details not found, please try again later.']);
            }
        } else {
            Session::flash("error", "There was some error, please try again later.");
        }
    }

    public function deleteSkill($token)
    {
        Skills::where(['token' => $token])->first()->delete();
        Session::flash("success", "Skills have been successfully deleted.");
        return redirect()->route('admin.skillList');
    }
}
