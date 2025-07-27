<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\AdminRequest;

class AdminController extends Controller
{
    public function adminList(Request $request)
    {
        try {
            if ($request->ajax()) {

                $adminList = Admin::query();

                return Datatables::of($adminList)
                    ->addIndexColumn()
                    ->addColumn('action', function ($adminList) {

                        $edit = '<a href="/admin/editAdmin/' . $adminList->token . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a>';
                        $delete = '<form method="POST" action="/admin/deleteAdmin/' . $adminList->token . '" accept-charset="UTF-8" class="delete" style="display:inline">
                    ' . csrf_field() . '
                    <input name="_method" value="DELETE" type="hidden">
                    <button type="button" class="btn btn-danger btn-sm admin_delete_alert">Delete</button></form>';

                        return $edit . ' ' . $delete;
                    })
                    ->editColumn('status', function ($adminList) {
                        return $adminList->status ? 'Active' : 'Inactive';
                    })
                    ->editColumn('admin_type', function ($adminList) {
                        return $adminList->admin_type == 1 ? 'Super Admin' : 'Admin';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            info("Error in adminList(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }
        return view('backend.manage_admin.adminList');
    }

    public function addAdmin()
    {
        return view('backend.manage_admin.addAdmin');
    }

    public function addUpdateAdmin(AdminRequest $request, $token = false)
    {
        try {

            if ($request->method() == "PUT") {
                $updateAdmin = Admin::where(['token' => $token])->first();
                $post = $request->all();
                $post['id'] = $updateAdmin->id;
                if ($request->password != "") {
                    $post['password'] = Hash::make($request->password);
                } else {
                    unset($post['password']);
                }
                $updateAdmin->update($post);
                Session::flash("success", "Admin details have been successfully updated.");
            } else {
                $post = $request->all();
                $post['password'] = Hash::make($post['password']);
                $post['token'] = strtoupper((string) Str::uuid());
                Admin::create($post);
                Session::flash("success", "Admin details have been successfully created.");
            }
        } catch (\Exception $e) {
            info("Error in addUpdateAdmin(): " . $e->getMessage());
            Session::flash("error", "There was some error, please try again later.");
        }

        return redirect()->route('adminList');
    }

    public function editAdmin($token)
    {
        if ($token) {
            $adminData = Admin::where(['token' => $token])->first();
            if ($adminData) {
                return view('backend.manage_admin.editAdmin', ['adminData' => $adminData]);
            } else {
                return redirect()->route('adminList')->with(['error' => 'Admin Details not found, please try again later.']);
            }
        } else {
            Session::flash("error", "There was some error, please try again later.");
        }
    }

    public function deleteAdmin($token)
    {
        Admin::where(['token' => $token])->first()->delete();
        Session::flash("success", "Admin have been successfully deleted.");
        return redirect()->route('adminList');
    }
}
