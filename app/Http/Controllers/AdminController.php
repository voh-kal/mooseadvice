<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $all_information = Admin::orderBy('id', 'DESC')->get();
        return view('admin.home', compact('all_information'));
    }

    public function create_form(Request $request)
    {
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
        ];
        $create = Admin::create($data);
        if ($create) {
            return response()->json([
                'status' => 200,
                'resp' => $create,
            ]);
        }
    }

    public function edit_form(Request $request, $id)
    {
        $admin = Admin::find($id);
        return response()->json([
            'status' => 200,
            'admin' => $admin,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $id = base64_decode($id);
        $admin = Admin::find($id);
        if ($admin) {
            $data = [
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
            ];
            $this_admin = $admin->update($data);
            if ($this_admin) {
                return back()->with('success', 'content updated successfully');
            }
        } else {
            return back()->with('error', 'An error occurred');
        }
    }

    public function delete($id)
    {
        $delete = Admin::destroy(base64_decode($id));
        if ($delete) {
            return back()->with('success', 'Content deleted successfully');
        }
    }
}
