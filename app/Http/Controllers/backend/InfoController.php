<?php

namespace App\Http\Controllers\backend;

use App\Models\Info;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\InfoRequest;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    public function infoList(Request $request)
    {
        try {
            if ($request->ajax()) {
                $infoList = Info::query();
                return DataTables::of($infoList)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $edit = '<a href="/admin/editInfo/' . $row->token . '">
                                <button type="button" class="btn btn-sm btn-success">Edit</button>
                            </a>';

                        $delete = '<form method="POST" action="/admin/deleteInfo/' . $row->token . '" accept-charset="UTF-8" class="delete" style="display:inline">
                        ' . csrf_field() . '
                        <input name="_method" value="DELETE" type="hidden">
                        <button type="button" class="btn btn-danger btn-sm info_delete_alert">Delete</button>
                    </form>';

                        return $edit . ' ' . $delete;
                    })
                    ->addColumn('photo', function ($row): string {
                        if (!empty($row->photo)) {
                            $imageUrl = asset('storage/photos/' . $row->photo);
                            $altText = htmlspecialchars($row->photo);
                            return '<img src="' . $imageUrl . '" width="80" height="80" style="object-fit: cover; border-radius: 8px;" alt="' . $altText . '">';
                        }
                        return '<span class="text-muted">No file</span>';
                    })
                    ->addColumn('resume_file', function ($row) {
                        if (!empty($row->resume_file)) {
                            $view = '<a href="' . route('admin.openResumeFile', ['folder' => 'resume_files', 'token' => $row->token]) . '" class="btn btn-primary btn-sm" target="_blank">View</a>';
                            return $view;
                        }
                        return '<span class="text-muted">No file</span>';
                    })
                    ->rawColumns(['photo', 'resume_file', 'action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            info("Error in infoList(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return view('backend.manage_infos.infosList');
    }


    public function addInfo()
    {
        return view('backend.manage_infos.addInfo');
    }

    public function addUpdateInfo(InfoRequest $request, $token = false)
    {
        try {
            if ($request->method() == "PUT") {
                $updateInfo = Info::where(['token' => $token])->first();
                if ($updateInfo) {
                    $post = $request->all();
                    if ($request->hasFile('resume_file')) {
                        if ($updateInfo->resume_file) {
                            if (Storage::disk('public')->exists('resume_files/' . $updateInfo->resume_file)) {
                                Storage::disk('public')->delete('resume_files/' . $updateInfo->resume_file);
                            }
                        }
                        $file = $request->file('resume_file');
                        $originalName = $file->getClientOriginalName();
                        $resume_name = uniqid() . '_' . str_replace(' ', '_', $originalName);
                        $file->storeAs('resume_files/', $resume_name, 'public');
                        $post['resume_file'] = $resume_name;
                    }
                    if ($request->hasFile('photo')) {
                        if ($updateInfo->photo) {
                            if (Storage::disk('public')->exists('photos/' . $updateInfo->photo)) {
                                Storage::disk('public')->delete('photos/' . $updateInfo->photo);
                            }
                        }
                        $file = $request->file('photo');
                        $originalName = $file->getClientOriginalName();
                        $resume_name = uniqid() . '_' . str_replace(' ', '_', $originalName);
                        $file->storeAs('photos/', $resume_name, 'public');
                        $post['photo'] = $resume_name;
                    }
                    $updateInfo->update($post);
                    Session::flash('success', "Information details have been successfully updated.");
                } else {
                    Session::flash('error', "Information not found for update.");
                }
            } else {
                $post = $request->all();
                if ($request->hasFile('resume_file')) {
                    $resume_file = $request->file('resume_file');
                    $originalName = $resume_file->getClientOriginalName();
                    $resume_name = uniqid() . '_' . str_replace(' ', '_', $originalName);
                    $resume_file->storeAs('resume_files/', $resume_name, 'public');
                    $post['resume_file'] = $resume_name;
                }
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $originalName = $photo->getClientOriginalName();
                    $photo_name = uniqid() . '_' . str_replace(' ', '_', $originalName);
                    $photo->storeAs('photos/', $photo_name, 'public');
                    $post['photo'] = $photo_name;
                }
                $post['token'] = strtoupper((string) Str::uuid());
                Info::create($post);
                Session::flash("success", "Information details have been successfully created.");
            }
        } catch (\Exception $e) {
            info("Error in addUpdateInfo(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }

        return redirect()->route('admin.infoList');
    }

    public function editInfo($token)
    {
        if ($token) {
            $InfoData = Info::where(['token' => $token])->first();
            if ($InfoData) {
                return view('backend.manage_Infos.editInfo', ['InfoData' => $InfoData]);
            } else {
                return redirect()->route('admin.InfoList')->with(['error' => 'Information Details not found, please try again later.']);
            }
        } else {
            Session::flash("error", "There was some error, please try again later.");
        }
    }

    public function deleteInfo($token)
    {
        $updateInfo = Info::where('token', $token)->first();

        if ($updateInfo) {
            if ($updateInfo->proj_img && Storage::disk('public')->exists('proj_imgs/' . $updateInfo->proj_img)) {
                Storage::disk('public')->delete('proj_imgs/' . $updateInfo->proj_img);
            }

            $updateInfo->delete();

            Session::flash("success", "Information has been successfully deleted.");
        } else {
            Session::flash("error", "Information not found.");
        }

        return redirect()->route('admin.infoList');
    }

    public function openResumeFile($folder, $token)
    {
        try {
            if (auth('admin')->check()) {
                $InfoData = Info::where(['token' => $token])->first();
                if ($folder == 'resume_files') {
                    $destinationPath = "$folder/" . $InfoData->resume_file;
                }
                if (file_exists(Storage::disk('public')->path($destinationPath))) {
                    return response()->file(Storage::disk('public')->path($destinationPath), [
                        'Pragma' => 'no-cache',
                        'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
                        'Cache-Control' => 'no-cache, must-revalidate, no-store, max-age=0, private'
                    ]);
                }
            } else {
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            info('Error in openReportCmeFile(): ' . $e->getMessage());
            Session::flash('error', 'There was some error, please try again later.');
        }
    }
}
