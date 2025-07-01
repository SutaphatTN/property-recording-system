<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listRec()
    {
        return view('list_receiving');
    }

    public function getRecData()
    {
        $listR = DB::table('receivings')->get();
        return response()->json($listR);
    }

    function create()
    {
        return view('insert_receiving');
    }

    function insert(Request $request)
    {
        $data = [
            'model_name' => $request->model_name,
            'tank_number' => $request->tank_number,
            'machine_number' => $request->machine_number,
            'color' => $request->color,
            'receiving_company' => $request->receiving_company,
            'sending_company' => $request->sending_company,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
        ];
        DB::table('receivings')->insert($data);

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว']);
        }

        return redirect('/list_rec');
    }

    function delete($id)
    {
        DB::table('receivings')->where('id', $id)->delete();
        return response()->json(['status' => 'success']);
    }

    function edit($id)
    {
        $listR = DB::table('receivings')->where('id', $id)->first();
        return view('/edit_receiving', compact('listR'));
    }

    function update(Request $request, $id)
    {
        $data = [
            'model_name' => $request->model_name,
            'tank_number' => $request->tank_number,
            'machine_number' => $request->machine_number,
            'color' => $request->color,
            'receiving_company' => $request->receiving_company,
            'sending_company' => $request->sending_company,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
        ];

        DB::table('receivings')->where('id', $id)->update($data);

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'แก้ไขข้อมูลสำเร็จ']);
        }
    }
}
