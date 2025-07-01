<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listUser()
    {
        return view('list_user');
    }

    public function getUserData()
    {
        $listU = DB::table('users')->get();
        return response()->json($listU);
    }

    function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['status' => 'success']);
    }

    function edit($id)
    {
        $listU = DB::table('users')->where('id', $id)->first();
        return view('/edit_user', compact('listU'));
    }

    function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        DB::table('users')->where('id', $id)->update($data);

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'แก้ไขข้อมูลสำเร็จ']);
        }
    }
}
