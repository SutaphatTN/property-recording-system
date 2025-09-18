<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.view', compact('user'));
    }

    public function viewMore($id)
    {
        $user = User::findOrFail($id);
        $companies = company::all();
        return view('user.view-more', compact('user', 'companies'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies = company::all();
        return view('user.edit', compact('user', 'companies'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $data = $request->except(['_token', '_method']);

            if ($request->has('company_approver')) {
                $data['company_approver'] = implode(',', $request->company_approver);
            }

            if ($request->filled('password')) {
                $data['password_plain'] = $request->password;
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'แก้ไขข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'ลบข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }
}