<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asset_maintenance;
use App\Models\asset_information;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ApproveRequestMail;
use App\Mail\RequestMaintenanceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $query = asset_maintenance::with(['asset_information']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('fromDate') && $request->filled('toDate')) {
            $query->whereBetween('repair_date', [$request->fromDate, $request->toDate]);
        }

        $maintenance = $query->orderBy('repair_date', 'desc')->get();

        return view('maintenance.view', compact('maintenance'));
    }

    public function create()
    {
        $asset = asset_information::all();
        return view('maintenance.store', compact('asset'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->asset_id) {
                $exists = asset_maintenance::where('asset_id', $request->asset_id)
                    ->where('status', '!=', asset_maintenance::STATUS_FINISHED)
                    ->exists();

                if ($exists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'ทรัพย์สินนี้ยังมีรายการซ่อมที่ยังไม่เสร็จ กรุณาตรวจสอบ'
                    ], 400);
                }
            }

            $validated = $request->validate([
                'asset_id' => 'required|exists:asset_information,id',
            ]);

            $data = [
                'asset_id' => $validated['asset_id'],
                'repair_date' => $request->repair_date,
                'repair_reason' => $request->repair_reason,
                'presenter' => $request->presenter,
                'status' => asset_maintenance::STATUS_PENDING,
                'category' => '01',
            ];

            $maintenance = asset_maintenance::create($data);

            $presenterEmail = Auth::check() ? Auth::user()->email : null;
            Mail::to(['WorawongM@Chookiat.org', 'HR@Chookiat.org'])
                ->cc($presenterEmail ? [$presenterEmail] : [])
                ->send(new RequestMaintenanceMail($maintenance));

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function createGeneral()
    {
        return view('maintenance.storeGeneral');
    }

    public function storeGeneral(Request $request)
    {
        try {
            if ($request->asset_id) {
                $exists = asset_maintenance::where('asset_id', $request->asset_id)
                    ->where('status', '!=', asset_maintenance::STATUS_FINISHED)
                    ->exists();

                if ($exists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'ทรัพย์สินนี้ยังมีรายการซ่อมที่ยังไม่เสร็จ กรุณาตรวจสอบ'
                    ], 400);
                }
            }

            $data = [
                'repair_name' => $request->repair_name,
                'repair_date' => $request->repair_date,
                'repair_reason' => $request->repair_reason,
                'presenter' => $request->presenter,
                'status' => asset_maintenance::STATUS_PENDING,
                'category' => '02',
            ];

            $maintenance = asset_maintenance::create($data);

            $presenterEmail = Auth::check() ? Auth::user()->email : null;
            Mail::to(['WorawongM@Chookiat.org', 'HR@Chookiat.org'])
                ->cc($presenterEmail ? [$presenterEmail] : [])
                ->send(new RequestMaintenanceMail($maintenance));

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function createFromQr($asset_id)
    {
        $asset = asset_information::findOrFail($asset_id);

        return view('maintenance.storeFromQr', compact('asset'));
    }

    public function storeFromQr(Request $request)
    {
        try {
            if ($request->asset_id) {
                $exists = asset_maintenance::where('asset_id', $request->asset_id)
                    ->where('status', '!=', asset_maintenance::STATUS_FINISHED)
                    ->exists();

                if ($exists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'ทรัพย์สินนี้ยังมีรายการซ่อมที่ยังไม่เสร็จ กรุณาตรวจสอบ'
                    ], 400);
                }
            }

            $data = [
                'asset_id' => $request->asset_id,
                'repair_date' => $request->repair_date,
                'repair_reason' => $request->repair_reason,
                'presenter' => $request->presenter,
                'status' => asset_maintenance::STATUS_PENDING,
                'category' => '01',
            ];

            $maintenance = asset_maintenance::create($data);

            $presenterEmail = Auth::check() ? Auth::user()->email : null;
            Mail::to(['WorawongM@Chookiat.org', 'HR@Chookiat.org'])
                ->cc($presenterEmail ? [$presenterEmail] : [])
                ->send(new RequestMaintenanceMail($maintenance));

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function edit($id)
    {
        $maintenance = asset_maintenance::findOrFail($id);
        $asset = null;
        if ($maintenance->asset_id) {
            $asset = asset_information::find($maintenance->asset_id);
        }

        return view('maintenance.edit', compact('maintenance', 'asset'));
    }

    public function update(Request $request, $id)
    {
        try {
            $maintenance = asset_maintenance::findOrFail($id);

            $data = $request->except(['_token', '_method']);

            if ($request->repair_price) {
                $data['repair_price'] = str_replace(',', '', $request->repair_price);
            }

            $maintenance->update($data);

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
            $maintenance = asset_maintenance::findOrFail($id);
            $maintenance->delete();

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

    public function approve($id)
    {
        try {
            $maintenance = asset_maintenance::findOrFail($id);
            $maintenance->status = asset_maintenance::STATUS_APPROVED;
            $maintenance->approv_date = now();
            $maintenance->save();

            return response()->json([
                'success' => true,
                'message' => 'อนุมัติเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $maintenance = asset_maintenance::findOrFail($id);
            $maintenance->status = asset_maintenance::STATUS_REJECTED;
            $maintenance->note = $request->note;
            $maintenance->approv_date = now();
            $maintenance->save();

            return response()->json([
                'success' => true,
                'message' => 'ไม่อนุมัติเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $term = $request->get('term', '');

        $assets = asset_information::where('assetCode', 'LIKE', "%{$term}%")
            ->select('id', 'assetCode')
            ->limit(20)
            ->get();

        $results = $assets->map(function ($asset) {
            return [
                'label' => $asset->assetCode,
                'value' => $asset->assetCode,
                'id' => $asset->id
            ];
        });

        return response()->json($results->toArray());
    }

    public function viewAudit(Request $request)
    {
        $maintenance = asset_maintenance::with('asset_information')
            ->whereIn('status', ['pending'])
            ->get();

        if ($request->ajax()) {
            return view('maintenance.audit.fragment', compact('maintenance'));
        }

        return view('maintenance.audit.view', [
            'maintenance' => $maintenance,
            'openId' => $request->query('id')
        ]);
    }

    public function editAudit($id)
    {
        $maintenance = asset_maintenance::findOrFail($id);
        $asset = asset_information::all();

        return view('maintenance.audit.edit', compact('maintenance', 'asset'));
    }

    public function updateAudit(Request $request, $id)
    {
        try {
            $maintenance = asset_maintenance::findOrFail($id);

            $data = $request->except(['_token', '_method']);
            $data['status'] = asset_maintenance::STATUS_PROCESSING;
            $data['repair_price'] = (float) str_replace(',', '', $request->repair_price);

            if ($request->hasFile('quotation')) {
                $file = $request->file('quotation');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('maintenance_pdfs', $filename, 'public');
                $data['quotation'] = $path;
            }

            $maintenance->update($data);

            if ($maintenance->approverUser && $maintenance->approverUser->email) {
                Mail::to($maintenance->approverUser->email)
                    ->send(new ApproveRequestMail($maintenance));
            }

            return response()->json([
                'success' => true,
                'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อแอดมิน'
            ], 500);
        }
    }

    public function getApprover(Request $request)
    {
        $repairPrice = (float) str_replace(',', '', $request->repair_price);
        $currentUser = Auth::user();

        $companyApproverIds = [];
        if ($currentUser->company_approver) {
            $companyApproverIds = array_map('trim', explode(',', $currentUser->company_approver));
        }

        $managers = User::where('role', 'manager')
            ->whereIn('company', $companyApproverIds)
            ->get();

        $mds = User::where('role', 'md')
            ->whereIn('company', $companyApproverIds)
            ->get();

        $approvers = [];

        if ($repairPrice <= $managers->max('price')) {
            foreach ($managers as $manager) {
                if ($repairPrice <= $manager->price) {
                    $approvers[] = ['id' => $manager->id, 'name' => $manager->name];
                }
            }
        } else {
            foreach ($mds as $md) {
                $approvers[] = ['id' => $md->id, 'name' => $md->name];
            }
        }

        return response()->json($approvers);
    }


    public function viewApproval(Request $request)
    {
        $maintenance = asset_maintenance::with('asset_information')
            ->whereIn('status', ['processing'])
            ->get();

        if ($request->ajax()) {
            return view('maintenance.approval.fragment', compact('maintenance'));
        }

        return view('maintenance.approval.view', [
            'maintenance' => $maintenance,
            'openId' => $request->query('id')
        ]);
    }

    public function viewMoreApproval($id)
    {
        $maintenance = asset_maintenance::findOrFail($id);

        return view('maintenance.approval.viewMoreApproval', compact('maintenance'));
    }

    public function viewResultApproval()
    {
        $maintenance = asset_maintenance::with('asset_information')
            ->whereIn('status', ['approved'])
            ->get();

        return view('maintenance.result.view', compact('maintenance'));
    }

    public function finish($id)
    {
        try {
            $maintenance = asset_maintenance::findOrFail($id);
            $maintenance->repair_result = 'ซ่อมเสร็จแล้ว';
            $maintenance->result_date = now();
            $maintenance->status = asset_maintenance::STATUS_FINISHED;
            $maintenance->save();

            return response()->json([
                'success' => true,
                'message' => 'บันทึกเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadApprove($id)
    {
        $maintenance = asset_maintenance::with('asset_information.company')->findOrFail($id);

        $filename = 'approve_';
        if ($maintenance->asset_information) {
            $filename .= $maintenance->asset_information->assetCode ?? '-';
        } else {
            $filename .= $maintenance->repair_name ?? '-';
        }
        $filename .= '.pdf';

        $pdf = Pdf::loadView('maintenance.approval.approve_pdf', compact('maintenance'));

        return $pdf->download($filename);
    }
}
