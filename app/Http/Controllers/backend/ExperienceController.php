<?php

namespace App\Http\Controllers\backend;

use App\Models\Experence;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\ExperenceRequest;

class ExperienceController extends Controller
{
    public function experienceList(Request $request)
    {
        // dd('Fetching admin list...'); // Debugging line, can be removed later
        try {
            if ($request->ajax()) {

                $experienceList = Experence::query();

                return Datatables::of($experienceList)
                    ->addIndexColumn()
                    ->addColumn('action', function ($experienceList) {

                        $edit = '<a href="/admin/editExperience/' . $experienceList->token . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a>';
                        $delete = '<form method="POST" action="/admin/deleteExperience/' . $experienceList->token . '" accept-charset="UTF-8" class="delete" style="display:inline">
                    ' . csrf_field() . '
                    <input name="_method" value="DELETE" type="hidden">
                    <button type="button" class="btn btn-danger btn-sm skill_delete_alert">Delete</button></form>';

                        return $edit . ' ' . $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            info("Error in experienceList(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return view('backend.manage_Experence.experenceList');
    }

    public function addExperience()
    {
        return view('backend.manage_Experence.addExperence');
    }

    public function addUpdateExperience(ExperenceRequest $request, $token = false)
    {
        try {

            if ($request->method() == "PUT") {
                $updateExperence = Experence::where(['token' => $token])->first();
                $post = $request->all();
                $updateExperence->update($post);
                Session::flash("success", "Experence details have been successfully updated.");
            } else {
                $post = $request->all();
                $post['token'] = strtoupper((string) Str::uuid());
                Experence::create($post);
                Session::flash("success", "Experence details have been successfully created.");
            }
        } catch (\Exception $e) {
            info("Error in addUpdateExperience(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }

        return redirect()->route('admin.experienceList');
    }

    public function editExperience($token)
    {
        if ($token) {
            // dd('Fetching experience details for token: ' . $token); // Debugging line, can be removed later
            $experenceData = Experence::where(['token' => $token])->first();
            if ($experenceData) {
                // dd($experenceData); // Debugging line, can be removed later
                return view('backend.manage_Experence.editExperence', ['experenceData' => $experenceData]);
            } else {
                return redirect()->route('admin.experienceList')->with(['error' => 'Skill Details not found, please try again later.']);
            }
        } else {
            Session::flash("error", "There was some error, please try again later.");
        }
    }

    public function deleteExperience($token)
    {
        Experence::where(['token' => $token])->first()->delete();
        Session::flash("success", "Skills have been successfully deleted.");
        return redirect()->route('admin.experienceList');
    }
}
