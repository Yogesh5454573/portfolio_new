<?php

namespace App\Http\Controllers\backend;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\ServiceRequest;

class ServiceController extends Controller
{
    public function serviceList(Request $request)
    {
        try {
            if ($request->ajax()) {

                $serviceList = Service::query();

                return Datatables::of($serviceList)
                    ->addIndexColumn()
                    ->addColumn('action', function ($serviceList) {

                        $edit = '<a href="/admin/editService/' . $serviceList->token . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a>';
                        $delete = '<form method="POST" action="/admin/deleteService/' . $serviceList->token . '" accept-charset="UTF-8" class="delete" style="display:inline">
                    ' . csrf_field() . '
                    <input name="_method" value="DELETE" type="hidden">
                    <button type="button" class="btn btn-danger btn-sm skill_delete_alert">Delete</button></form>';

                        return $edit . ' ' . $delete;
                    })
                    ->editColumn('status', function ($serviceList) {
                        return $serviceList->status ? 'Active' : 'Inactive';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            info("Error in serviceList(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return view('backend.manage_services.serviceList');
    }

    public function addService()
    {
        return view('backend.manage_services.addService');
    }

    public function addUpdateService(ServiceRequest $request, $token = false)
    {
        try {
            if ($request->method() == "PUT") {
                $updateSkills = Service::where(['token' => $token])->first();
                $post = $request->all();
                $updateSkills->update($post);
                Session::flash("success", "Service details have been successfully updated.");
            } else {
                $post = $request->all();
                $post['token'] = strtoupper((string) Str::uuid());
                Service::create($post);
                Session::flash("success", "Service details have been successfully created.");
            }
        } catch (\Exception $e) {
            info("Error in addUpdateService(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return redirect()->route('admin.serviceList');
    }

    public function editService($token)
    {
        if ($token) {
            $serviceData = Service::where(['token' => $token])->first();
            if ($serviceData) {
                return view('backend.manage_services.editService', ['serviceData' => $serviceData]);
            } else {
                return redirect()->route('admin.serviceList')->with(['error' => 'Service Details not found, please try again later.']);
            }
        } else {
            Session::flash("error", "There was some error, please try again later.");
        }
    }

    public function deleteService($token)
    {
        Service::where(['token' => $token])->first()->delete();
        Session::flash("success", "Service have been successfully deleted.");
        return redirect()->route('admin.serviceList');
    }
}
